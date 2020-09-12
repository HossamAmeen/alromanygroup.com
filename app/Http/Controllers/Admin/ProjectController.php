<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\{Employee , Project ,ProjectConfigration};
use Auth;
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $items = Project::where('active','=','1')->orderBy('id','desc')->get();
        $pageTitle = "كل المشاريع";
        return view('admin.projects.all', compact('items','pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function create()
    {
        $pageTitle = "إضافة مشروع";
        $default = ['0'=>'لايوجد'];
        $items = Employee::where('active','=','1')->orderBy('id','desc')->pluck('name','id')->toArray();
        // $clients = Client::all()->pluck('title','id')->toArray();
        $items = $default + $items;
       // dd($projects);
        return view('admin.projects.add', compact('pageTitle' , 'items'));

    }//end store

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, $this->getFormValidationRules(), $this->getFormValidationMessages());
        //$thumbnail = FileHelper::storeImage('img','uploads/news',320,180,'ZM_');
        // return $request->name;
       $item =  new Project();
       $item->name =$request->name ;
       $item->description =$request->description ;
       $item->point = $request->point;
    //    return $request->employee_id ;
       if($request->employee_id != 0){
                // return "test";
        $item->employee_id = $request->employee_id;
       }
       else
       {
           return redirect()->back()->withInput();
       }
      $configration = ProjectConfigration::find(1);
      if( $configration ){

        $employee= Employee::find($request->employee_id);
        $employee->total_point +=  $configration->pull_ratio * $request->point / 100;
        $employee->save();

      }
     

       $item->user_id =  Auth::id();
       $item->save();

       return redirect('admin/projects'. "?msg=11");
    }//end store


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit( $id)
    {
        $default = ['0'=>'لايوجد'];
        $items = Employee::where('active','=','1')->orderBy('id','desc')->pluck('name','id')->toArray();
        $items = $default + $items;
        $item = Project::findOrFail($id);
        $pageTitle = "تعديل مشروع " . $item->name;
      
        return view('admin.projects.update', compact('item','pageTitle' , 'items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update( $id, Request $request )
    {
        $id = intval($id);
        // $this->validate($request, $this->getFormValidationRules(), $this->getFormValidationMessages());
        $item= Project::findOrFail($id);
        $item->name =$request->name ;
        $item->description =$request->description ;
        $item->point = $request->point;
        $item->user_id =  Auth::id();
        $item->save();
        return redirect('admin/projects'. "?msg=12");
    }//end update

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $item = Project::find(intval($id));

        if(!empty($item->id)){
            $item->active = 0 ;
            $item->user_id = Auth::id();
            $item->save();
        }

        return redirect('admin/projects');
    }
    public function configration(Request $request)
    {
        $item = ProjectConfigration::find(1);
        if($request->isMethod('post'))
        {
            if(!$item){
                $item = new ProjectConfigration();
             
            }
           
            $item->minimum = $request->minimum ;
            $item->pull_ratio = $request->pull_ratio ;
            $item->user_id = Auth::id() ;
            $item->save();
            return redirect()->back();
        }
        $pageTitle = "تعديل اعدادت مشروع الافادة " ;
        
        return view('admin.projects.configration', compact('item','pageTitle'));
    }

}

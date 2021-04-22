<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProjectConfigration;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\{Employee ,Client, Project ,ProjectConfigration};
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
        $pageTitle = "عمليات الشراء";
        return view('admin.projects.all', compact('items','pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function create()
    {
        $pageTitle = "إضافة عملية شراء";
        $default = ['0'=>'لايوجد'];
        $items = Employee::where('active','=','1')->orderBy('id','desc')->pluck('name','id')->toArray();
        // $clients = Client::all()->pluck('title','id')->toArray();
        $items = $default + $items;

        $default = ['0'=>'لايوجد'];
        $clients = Client::where('active','=','1')->orderBy('id','desc')->pluck('name','id')->toArray();
        // $clients = Client::all()->pluck('title','id')->toArray();
        $clients = $default + $clients;
       // dd($projects);
        return view('admin.projects.add', compact('pageTitle' , 'items' , 'clients'));

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
       $item->date =$request->date ;
       $item->bill_number =$request->bill_number ;
       $item->bill_value =$request->bill_value ;
      
        //    return $request->employee_id ;
       if($request->employee_id != 0){
                // return "test";
        $item->employee_id = $request->employee_id;
       }
       else
       {
           return redirect()->back()->withInput();
       }
        if($request->client_id != 0){
                // return "test";
        $item->client_id = $request->client_id;
       }
       else
       {
           return redirect()->back()->withInput();
       }
        // $employee= Employee::find($request->employee_id);
        // $employee->total_point +=$request->bill_value;
        // $employee->save();
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
        $pageTitle = "تعديل عملية شراء " . $item->name;
      
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
    public function configuration(Request $request)
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
        $pageTitle = "تعديل برنامج الوفاء" ;
        
        return view('admin.projects.configration', compact('item','pageTitle'));
    }

}

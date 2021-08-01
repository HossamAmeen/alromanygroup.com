<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\{Employee , Equivalent ,ProjectConfigration};
use Auth;
class EquivalentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $items = Equivalent::where('active','=','1')->where('employee_id',request('employeeId') )->orderBy('id','desc')->get();
        $pageTitle = "صرف مكافئات";
        return view('admin.equivalents.all', compact('items','pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function create()
    {
               // $default = ['0'=>'لايوجد'];
        $employee = Employee::where('active','=','1')->where('id',request('employeeId'))->first();
        // $clients = Client::all()->pluck('title','id')->toArray();
        // $items = $default + $items;
       // dd($equivalents);
       $pageTitle = " صرف مكافئة ل " . $employee->name;
       $configration = ProjectConfigration::find(1);
        return view('admin.equivalents.add', compact('pageTitle' , 'employee','configration'));

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
       $item =  new Equivalent();
       $item->value =$request->value ;
      
    //    return $request->employeeId ;
    //    if($request->employee_id != 0){
                // return "test";
        $item->employee_id = $request->employeeId;
    //    }
    //    else
    //    {
    //        return redirect()->back()->withInput();
    //    }
       $configration = ProjectConfigration::find(1);
       if( $request->value < $configration->minimum   ) {
        return redirect()->back()->withErrors(['error' => "قيمه الصرف اقل من الحد الادني "])->withInput();    
       }
      
        $employee= Employee::find($request->employeeId);
        if(($employee->get_total_projects_bill_values() - $employee->get_total_equivalent() ) >=  $request->value)
        {
            $item->user_id =  Auth::id();
            $item->save();
            
            return redirect('admin/equivalents/create?employeeId='.$employee->id)
                ->with(['addAction' => "تم صرف المكافأة بنجاح"]);
        }
        else
        { 
            return redirect()->back()->withErrors(['error' => "قيمه الصرف اكبر من نقاط الفني"])->withInput();    
        }
        // return $employee;
     

     
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
        $item = Equivalent::findOrFail($id);
        $pageTitle = "تعديل مشروع " . $item->name;
      
        return view('admin.equivalents.update', compact('item','pageTitle' , 'items'));
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
        $item= Equivalent::findOrFail($id);
        $item->name =$request->name ;
        $item->description =$request->description ;
        $item->point = $request->point;
        $item->user_id =  Auth::id();
        $item->save();
        return redirect('admin/equivalents'. "?msg=12");
    }//end update

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $item = Equivalent::find(intval($id));

        if(!empty($item->id)){
            $item->active = 0 ;
            $item->user_id = Auth::id();
            $item->save();
        }

        return redirect('admin/equivalents');
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
        
        return view('admin.equivalents.configration', compact('item','pageTitle'));
    }

}

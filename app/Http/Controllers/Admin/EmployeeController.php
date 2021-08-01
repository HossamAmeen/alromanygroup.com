<?php

namespace App\Http\Controllers\Admin;

use App\Models\Equivalent;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use Auth;
use DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
//        $items = Employee::where('active','=','1')->orderBy('id','desc')->get();
//        dd ($items);
        //count(p.id) as total_operations
        //sum(bill_value) as total_sales

        $query = "select e.id, e.name, e.job, e.address, e.phone   ";
        $query .= ",  e.created_at ";
//        $query .= " , sum(eq.value) as total_equivalents ";

        $query .= "from employees e ";
//        $query .= ", projects p ";

//        $query .= "right Join projects p ";
//        $query .= "on e.id = p.employee_id  ";

//        $query .= "left Join equivalents eq ";
//        $query .= "on e.id = eq.employee_id  ";


        $query .= "where e.active = 1  ";

//        $query .= "GROUP BY e.id  ";
        $query .= "order by name  ";


        $items = DB::select($query);

        Equivalent::add_total_equivalents($items);

        $pageTitle = "كل الفنيين";
        $configration = \App\Models\ProjectConfigration::find(1);
        return view('admin.employees.all', compact('items','pageTitle','configration'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function create()
    {
        $pageTitle = "إضافة فني";
        $default = ['0'=>'لايوجد'];
        // $projects = Employee::all()->pluck('title','id')->toArray();
        // $projects = $default + $projects;
       // dd($projects);
        return view('admin.employees.add', compact('pageTitle'));

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
       $item =  new Employee();
       $item->name =$request->name ;
       $item->job =$request->job ;
       $item->total_point =0;
       $item->phone = $request->phone;
       $item->address = $request->address;
       $item->user_id =  Auth::id();
       $item->save();
       return redirect('admin/employees'. "?msg=11");
    }//end store


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit( $id)
    {

        $item = Employee::findOrFail($id);
        $pageTitle = "تعديل فني " . $item->name;
      
        return view('admin.employees.update', compact('item','pageTitle'));
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
        $item= Employee::findOrFail($id);
        $item->name =$request->name ;
        $item->job =$request->job ;
        $item->total_point = $request->total_point;
        $item->phone = $request->phone;
        $item->address = $request->address;
        $item->user_id =  Auth::id();
        $item->save();
        return redirect('admin/employees'. "?msg=12");
    }//end update

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $item = Employee::find(intval($id));

        if(!empty($item->id)){
            $item->active = 0 ;
            $item->user_id = Auth::id();
            $item->save();
        }

        return redirect('admin/employees');
    }

}

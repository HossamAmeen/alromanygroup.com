<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\{Client , Employee};
use Auth;
class ClientController extends Controller
{
        /**
         * Display a listing of the resource.
         *
         * @return Response
         */
        public function index()
        {
            $items = Client::where('active','=','1')->orderBy('id','desc')->get();
            $pageTitle = "كل العملاء";
            return view('admin.clients.all', compact('items','pageTitle'));
        }
    
        /**
         * Store a newly created resource in storage.
         *
         * @return Response
         */
        public function create()
        {
            $pageTitle = "إضافة عميل";
            $default = ['0'=>'لايوجد'];
            $items = Employee::where('active','=','1')->orderBy('id','desc')->pluck('name','id')->toArray();
            // $clients = Client::all()->pluck('title','id')->toArray();
            $items = $default + $items;
           // dd($projects);
            return view('admin.clients.add', compact('pageTitle','items'));
    
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
           $item =  new Client();
           $item->name =$request->name ;
           $item->job =$request->job ;
           $item->employee_id = $request->employee_id;
           $item->phone = $request->phone;
           $item->address = $request->address;
           $item->user_id =  Auth::id();
           $item->save();
           return redirect('admin/clients'. "?msg=11");
        }//end store
    
    
        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return Response
         */
        public function edit( $id)
        {
    
            $item = Client::findOrFail($id);
            // $items = Employee::where('active','=','1')->orderBy('id','desc')->get()->pluck('name','id')->toArray();
            $default = ['0'=>'اختر مشروع'];
            $items = Employee::where('active','=','1')->pluck('name','id')->toArray();
            $items = $default + $items;
            $pageTitle = "تعديل فني " . $item->name;
          
            return view('admin.clients.update', compact('item','items','pageTitle'));
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
            $item= Client::findOrFail($id);
            $item->name =$request->name ;
            $item->job =$request->job ;
            // $item->total_point = $request->total_point;
            $item->employee_id = $request->employee_id;
            $item->phone = $request->phone;
            $item->address = $request->address;
            $item->user_id =  Auth::id();
            $item->save();
            return redirect('admin/clients'. "?msg=12");
        }//end update
    
        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return Response
         */
        public function destroy($id)
        {
            $item = Client::find(intval($id));
    
            if(!empty($item->id)){
                $item->active = 0 ;
                $item->user_id = Auth::id();
                $item->save();
            }
    
            return redirect('admin/clients');
        }
    
    
}

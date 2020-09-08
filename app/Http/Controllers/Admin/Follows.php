<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\followsModel;
use App\Models\ProjectModel;
use Illuminate\Http\Request;

use App\Http\Requests;

class Follows extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $news = followsModel::where('active','=','1')->orderBy('id','desc')->get();
        $pageTitle = "كل المتابعات";
        return view('admin.follows.all-follows', compact('news','pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function create()
    {
        $pageTitle = "إضافة متابعة";
        $default = ['0'=>'لايوجد'];
        $projects = ProjectModel::all()->pluck('title','id')->toArray();
        $projects = $default + $projects;
        // dd($projects);
        return view('admin.follows.add', compact('pageTitle','projects'));

    }//end store

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->getFormValidationRules(), $this->getFormValidationMessages());
        $thumbnail = FileHelper::storeImage('img','uploads/news',320,180,'ZM_');
        followsModel::create_news();
        return redirect(followsModel::get_news_url() . "?msg=11");
    }//end store


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit( $id)
    {

        $mNews = followsModel::find($id);
        if(empty($mNews->title))
            return redirect(followsModel::get_news_url());

        $pageTitle = "تعديل متابعه " . $mNews->title;
        $default = ['0'=>'اختر مشروع'];
        $projects = ProjectModel::all()->pluck('title','id')->toArray();
        $projects = $default + $projects;
        return view('admin.follows.update', compact('mNews','pageTitle','projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update( $id, Requests $request )
    {
        $id = intval($id);
        $this->validate($request, $this->getFormValidationRules(), $this->getFormValidationMessages());
        followsModel::update_news($id);
        return redirect(followsModel::get_news_url() . "?msg=12");
    }//end update

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $mNews = followsModel::find(intval($id));

        if(!empty($mNews->id)){
            $mNews->deactivate();
        }

        return redirect(followsModel::get_news_url());
    }



    private function getFormValidationMessages() {
        return array(
            'title.required'                => "رجاء إدخال اسم المتابعه",
            'content.required'                => "رجاء إدخال المتابعه",
            'img.max'                => "لقد تجاوزت الحد الأقصى لحجم الصورة",
        );
    }//end get validation messages

    private function getFormValidationRules() {
        return array(
            'title'               => 'required|max:99',
            'content'               => 'required|max:2048',
            'img'               => 'image|max:3000',
        );
    }//end get validation rules
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Equivalent;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use Auth;
use DB;

class ApplicationUser extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $news = NewsModel::where('active', '=', '1')->orderBy('id', 'desc')->get();
        $pageTitle = "?? ???????";
        return view('admin.news.all-news', compact('news', 'pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function create()
    {
        $pageTitle = "????? ???";
        $default = ['0' => '??????'];
        $projects = ProjectModel::all()->pluck('title', 'id')->toArray();
        $projects = $default + $projects;
        // dd($projects);
        return view('admin.news.add', compact('pageTitle', 'projects'));

    }//end store

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Requests $request)
    {
        $this->validate($request, $this->getFormValidationRules(), $this->getFormValidationMessages());
        //$thumbnail = FileHelper::storeImage('img','uploads/news',320,180,'ZM_');
        NewsModel::create_news();
        return redirect(NewsModel::get_news_url() . "?msg=11");
    }//end store


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {

        $mNews = NewsModel::find($id);
        if (empty($mNews->title))
            return redirect(NewsModel::get_news_url());

        $pageTitle = "????? ??? " . $mNews->title;
        $default = ['0' => '???? ?????'];
        $projects = ProjectModel::all()->pluck('title', 'id')->toArray();
        $projects = $default + $projects;
        return view('admin.news.update', compact('mNews', 'pageTitle', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, Requests $request)
    {
        $id = intval($id);
        $this->validate($request, $this->getFormValidationRules(), $this->getFormValidationMessages());
        NewsModel::update_news($id);
        return redirect(NewsModel::get_news_url() . "?msg=12");
    }//end update

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $mNews = NewsModel::find(intval($id));

        if (!empty($mNews->id)) {
            $mNews->deactivate();
        }

        return redirect(NewsModel::get_news_url());
    }


    private function getFormValidationMessages()
    {
        return array(
            'title.required' => "???? ????? ??? ?????",
            'content.required' => "???? ????? ?????",
            'img.max' => "??? ?????? ???? ?????? ???? ??????",
        );
    }//end get validation messages

    private function getFormValidationRules()
    {
        return array(
            'title' => 'required|max:99',
            'content' => 'required|max:2048',
            'img' => 'image|max:3000',
        );
    }//end get validation rules

}//end application user
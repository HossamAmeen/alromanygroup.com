<?php namespace App\Http\Controllers\Admin;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\CityModel;
use App\Models\CollegeModel;
use App\Models\LevelModel;
use App\Models\ManagerModel;
use App\Models\MediaModel;
use App\Models\NewsModel;
use App\Models\ProjectModel;
use App\Models\VideoModel;
use Illuminate\Http\Request as Requests;
use Illuminate\Support\Facades\Input;
use Request;
use Auth;

class News extends Controller {



    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $news = NewsModel::where('active','=','1')->orderBy('id','desc')->get();
        $pageTitle = "كل الأخبار";
        return view('admin.news.all-news', compact('news','pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function create()
    {
        $pageTitle = "إضافة خبر";
        $default = ['0'=>'لايوجد'];
        $projects = ProjectModel::all()->pluck('title','id')->toArray();
        $projects = $default + $projects;
       // dd($projects);
        return view('admin.news.add', compact('pageTitle','projects'));

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
     * @param  int  $id
     * @return Response
     */
    public function edit( $id)
    {

        $mNews = NewsModel::find($id);
        if(empty($mNews->title))
            return redirect(NewsModel::get_news_url());

        $pageTitle = "تعديل خبر " . $mNews->title;
        $default = ['0'=>'اختر مشروع'];
        $projects = ProjectModel::all()->pluck('title','id')->toArray();
        $projects = $default + $projects;
        return view('admin.news.update', compact('mNews','pageTitle','projects'));
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
        NewsModel::update_news($id);
        return redirect(NewsModel::get_news_url() . "?msg=12");
    }//end update

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $mNews = NewsModel::find(intval($id));

        if(!empty($mNews->id)){
            $mNews->deactivate();
        }

        return redirect(NewsModel::get_news_url());
    }



    private function getFormValidationMessages() {
        return array(
            'title.required'                => "رجاء إدخال اسم الخبر",
            'content.required'                => "رجاء إدخال الخبر",
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

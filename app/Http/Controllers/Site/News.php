<?php namespace App\Http\Controllers\Site;

use App\Helpers\APIHelper;
use App\Http\Controllers\Controller;
use App\Models\CityModel;
use App\Models\CollegeModel;
use App\Models\ImageModel;
use App\Models\LevelModel;
use App\Models\ManagerModel;
use App\Models\MediaModel;
use App\Models\NewsModel;
use App\Models\ProjectImageModel;
use App\Models\ProjectModel;
use App\Models\VideoModel;
use Illuminate\Http\Request as Requests;
use Illuminate\Support\Facades\Input;
use Request;
use Auth;

class News extends Controller {

    public function index()
    {
        $news = NewsModel::where('active','=','1')->orderBy('id','desc')->paginate(11);
        $pageTitle = "الأخبار";
        $projects = ProjectModel::get_last_projects(6);
        return view('site.news.all', compact('pageTitle','projects','news','projects'));
    }

    public function single($id)
    {
        $id = intval($id);
        $mNews = NewsModel::findOrNew($id);
        if(!($mNews->active))
            return redirect('/');

        $pageTitle = $mNews->title;
        $projects = ProjectModel::get_last_projects(6);
        $news = NewsModel::get_last_news(3,$id);
        return view('site.news.single', compact('pageTitle','mNews','news','projects'));
    }

    public function api_index(){
        $token = Input::get('token');
        if ($token !== APIHelper::TOKEN) {
            $data['error'] = "true";
            echo json_encode($data);
            return;
        }
        $news = NewsModel::where('active','=','1')->orderBy('id','desc')->paginate(9);
        $data['error'] = "false";
        $data['news'] = $news;
        echo json_encode($data);
        return;
    }

    public function api_single(){
        $token = Input::get('token');
        if ($token !== APIHelper::TOKEN) {
            $data['error'] = "true";
            echo json_encode($data);
            return;
        }
        $id = intval(Input::get('id'));
        $mNews = NewsModel::findOrNew($id);
        if(!$mNews->active){
            $data['error'] = "true";
            echo json_encode($data);
            return;
        }

        $data['error'] = "false";
        $data['news'] = $mNews;
        echo json_encode($data);
        return;
    }


}//end news

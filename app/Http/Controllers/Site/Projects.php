<?php namespace App\Http\Controllers\Site;

use App\Helpers\APIHelper;
use App\Http\Controllers\Controller;

use App\Models\NewsModel;
use App\Models\ProjectImageModel;
use App\Models\ProjectModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

class Projects extends Controller
{
    public function index()
    {

        $years = ProjectModel::get_projects_years();
       // $mYears =$years[0]->year;
       // dd($mYears);

        $projects = ProjectModel::where('active','=','1')->orderBy('deliver','desc')->get();
        $pageTitle = "المشروعات";
        return view('site.projects.all', compact('pageTitle','projects','years'));
    }

    public function single($id)
    {
        $mProject = ProjectModel::findOrNew($id);
        $mNews = NewsModel::where('project_id','=',$id)
                            ->where('active','=','1')->get();
        $pahses = ProjectModel::get_progress_phase();
        //dd($pahses);
        $lastProjects = ProjectModel::get_last_projects(6,$id);
        $books = explode(',',$mProject->booked);
        $totalFlats = $mProject->levels * $mProject->level_flats_no;
        $images = ProjectImageModel::get_project_all_images($id);
        if(!$mProject->active){
            return redirect('/');
        }
        $pageTitle = $mProject->title;
        return view('site.projects.single',compact('pageTitle','mProject','totalFlats',
            'books','images','lastProjects','mNews','pahses'));
    }
}

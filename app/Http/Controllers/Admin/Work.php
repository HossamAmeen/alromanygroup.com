<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CityModel;
use App\Models\CollegeModel;
use App\Models\LevelModel;
use App\Models\ManagerModel;
use App\Models\ImageModel;
use App\Models\WorkModel;
use Illuminate\Http\Request as Requests;
use Illuminate\Support\Facades\Input;
use Request;
use Auth;

class Work extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $works = WorkModel ::where('active','=','1')->orderBy('id','desc')->get();
        $pageTitle = "سابقة الأعمال";
        $types = WorkModel::get_types_array();
        return view('admin.works', compact('works','pageTitle','types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Requests $request)
    {
        $this->validate($request, $this->getFormValidationRules(), $this->getFormValidationMessages());
        WorkModel::create_work();

        return redirect(WorkModel::get_work_url() . "?msg=11");
    }//end store


    public function destroy($id)
    {
        $mWork = WorkModel::find(intval($id));

        if(!empty($mWork->url)){
            $mWork->deactivate();
        }

        return redirect(WorkModel::get_work_url() . "?msg=13");
    }



    private function getFormValidationMessages() {
        return array(
            'images.required'                => "لم يتم اختيار صور",
        );
    }//end get validation messages

    private function getFormValidationRules() {
        return array(
            'images'               => 'required',
            'type' =>'required|integer|min:1|digits_between: 1,5'
        );
    }//end get validation rules
}

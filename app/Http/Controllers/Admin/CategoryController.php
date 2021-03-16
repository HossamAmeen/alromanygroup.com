<?php namespace App\Http\Controllers\Admin;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\CityModel;
use App\Models\CollegeModel;
use App\Models\LevelModel;
use App\Models\ManagerModel;
use App\Models\MediaModel;
use App\Models\NewsModel;
use App\Models\ProductModel;
use App\Models\ProjectModel;
use App\Models\VideoModel;
use Illuminate\Http\Request as Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Request;
use Auth;
use URL;

class CategoryController extends Controller {



    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
           $cats = CategoryModel::where('active','=','1')->orderBy('id','desc')->get();
        $pageTitle = "كل التصنيفات";
        return view('admin.categories.all', compact('cats','pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function create()
    {
        $pageTitle = "إضافة تصنيف جديد";
        return view('admin.categories.add', compact('pageTitle'));

    }//end store

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Requests $request)
    {
        $this->validate($request, $this->getFormValidationRules(), $this->getFormValidationMessages());
        CategoryModel::create_category();
       return redirect(URL::to('admin/cats'));
    }//end store


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit( $id)
    {

        $mCat = CategoryModel::find($id);
        if(empty($mCat->name))
            return redirect(URL::to('admin/cats'));

        $pageTitle = "تعديل التصنيف " . $mCat->name;
        return view('admin.categories.update', compact('mCat','pageTitle'));
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
        CategoryModel::update_category($id);
        return redirect(URL::to('admin/cats'));
    }//end update

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $mCat = CategoryModel::find(intval($id));

        if(!empty($mCat->id)){
            $mCat->deactivate();
        }

        return redirect(URL::to('admin/cats'));
    }



    private function getFormValidationMessages() {
        return array(
            'name.required'                => "رجاء إدخال اسم التصنيف",
            'icon.max'                => "لقد تجاوزت الحد الأقصى لحجم الصورة",
            'category_id.exists'                => "exists:categories",
        );
    }//end get validation messages

    private function getFormValidationRules() {
        return array(
            'name'               => 'required|max:99',
            'icon'               => 'image',
            'category_id'                => "exists:categories",
        );
    }//end get validation rules

    public function api_get_categories(){
        $cats = CategoryModel::get_categories_names_and_icons();
        $return = [];
        $return ['success'] = true;
        $return ['data']['categories'] = $cats;
        echo json_encode($return);

    }
}

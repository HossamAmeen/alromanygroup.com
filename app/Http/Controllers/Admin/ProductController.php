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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request as Requests;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Milon\Barcode\DNS1D;
use Request;
use Auth;
use URL;

class ProductController extends Controller {



    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $products = ProductModel::where('active','=','1')->orderBy('id','desc')->get();
        $pageTitle = "كل المنتجات";
        return view('admin.products.all', compact('products','pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function create()
    {
        $pageTitle = "إضافة منتج جديد";
        $categories = CategoryModel::where('active','=','1')->pluck('name','id')->toArray();
        return view('admin.products.add', compact('pageTitle','categories'));

    }//end store

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Requests $request)
    {


        $this->validate($request, $this->getFormValidationRules(), $this->getFormValidationMessages());
        ProductModel::create_product();
        return redirect(URL::to('admin/products'));
    }//end store

    public function download_qr_code($id){

        $mProduct = ProductModel::find($id);

        if(empty($mProduct->name))
            return redirect(URL::to('admin/products'));
        
        return \Response::download(URL::to($mProduct->qr_code));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit( $id)
    {

        $mProduct = ProductModel::find($id);

        if(empty($mProduct->name))
            return redirect(URL::to('admin/products'));

        $categories = CategoryModel::where('active','=','1')->pluck('name','id')->toArray();


        $pageTitle = "تعديل المنتج " . $mProduct->name;
        return view('admin.products.update', compact('mProduct','pageTitle','categories'));
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
        ProductModel::update_product($id);
        return redirect(URL::to('admin/products'));
    }//end update

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $mProduct = ProductModel::find(intval($id));

        if(!empty($mProduct->id)){
            $mProduct->deactivate();
        }

        return redirect(URL::to('admin/products'));
    }



    private function getFormValidationMessages() {
        return array(
            'name.required'                => "رجاء إدخال اسم المنتج",
            'price.required'                => "رجاء إدخال اسم المنتج",
            'image.max'                => "لقد تجاوزت الحد الأقصى لحجم الصورة",
        );
    }//end get validation messages

    private function getFormValidationRules() {
        return array(
            'name'               => 'required|max:99',
            'image'               => 'image',
        );
    }//end get validation rules

    public function api_get_categories(){
        $cats = CategoryModel::get_categories_names_and_icons();
        $return = [];
        $return ['success'] = true;
        $return ['data']['categories'] = $cats;
        echo json_encode($return);

    }

    public function api_get_products($categoryId = null){

        $limit = Input::get('limit');
        $offset = Input::get('offset');


        $query = "select name, image, description, price, offer_price ";
        $query .= "from product ";
        $query .= "where active = 1 ";

        if(!empty($categoryId)){
            $query .="and category_id = " . intval($categoryId)." ";

        }

        if(!empty($limit)) {
            $query .= "limit $limit ";
        }

        if(!empty($offset)){
            $query .= "offset $offset";
        }

        $results = DB::select($query);

        $return = [];
        $return['success'] = true;
        $return['data'] = $results;


//        echo json_encode($query);
        echo json_encode($return);


    }//end api get products

    public function api_get_offers($categoryId = null){

        $limit = Input::get('limit');
        $offset = Input::get('offset');


        $query = "select id, name, image, description, price, offer_price ";
        $query .= "from product ";
        $query .= "where active = 1 and has_offer = 1 ";

        if(!empty($categoryId)){
            $query .="and category_id = " . intval($categoryId)." ";

        }

        if(!empty($limit)) {
            $query .= "limit $limit ";
        }

        if(!empty($offset)){
            $query .= "offset $offset";
        }

        $results = DB::select($query);

        $return = [];
        $return['success'] = true;
        $return['data'] = $results;

//        echo json_encode($query);
        echo json_encode($return);


    }//end api get products

    public function api_get_single_product($id)
    {
        $mProduct = ProductModel::find($id);
        $return = [];

        if(empty($mProduct->name)){
            $return['success'] = false;
            $return['data'] = null;
            return $return;
        }

        $return['success'] = true;
        $return['data']['name'] = $mProduct->name;
        $return['data']['description'] = $mProduct->description;
        $return['data']['price'] = $mProduct->price;
        $return['data']['offer_price'] = $mProduct->offer_price;
        $return['data']['has_offer'] = $mProduct->has_offer;
        $return['data']['image'] = $mProduct->image;

        echo json_encode($return);

    }//end api_get_single_product
}

<?php

namespace App\Models;

use App\Helpers\APIHelper;
use App\Helpers\FileHelper;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Redirect;
use Mpociot\Firebase\SyncsWithFirebase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input as Input;
use Auth;
use DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\URL;

class ProductModel extends Model {


    const DEFAULT_MEDIA_COVER = "resources/assets/admin/images/fav.png";
    protected $table = 'product';

    //revise
    public static function get_categories_names_and_icons(){
        $query = "select name, icon from categories ";
        $query .= "where active = 1 ";
        $query .= "order by id ";

        $results = DB::select($query);
        if(!empty($results)){
            foreach($results as $key => $row){
                $data[$key]['name'] = $row->name;
                $data[$key]['icon'] = $row->icon;
            }
            return $data;
        }else{
            return FALSE;
        }

    }//end getting categories name


    public  static function create_product(){


        $mProduct = new ProductModel();
        $mProduct->name = Input::get('name');
        $mProduct->description = Input::get('description');
        $mProduct->price = doubleval(Input::get('price'));
        $mProduct->offer_price = doubleval(Input::get('offer_price'));
        $mProduct->category_id = Input::get('category_id');


        if(!empty(Input::get('offer_price')) && Input::get('offer_price') != 0){
            $mProduct->offer_price = Input::get('offer_price');
            $mProduct->has_offer = 1;
        }


        //image
        $image = FileHelper::storeImage('image','uploads/categories',400,400,'ROMANY_CAT_');
        if(!empty($image)){
            $mProduct->image = $image;
        }else{
            $mProduct->image = ProductModel::DEFAULT_MEDIA_COVER;
        }

        $mProduct->user_id = Auth::id();
        $mProduct->save();


        if (!is_dir(base_path()."/products")) {
            mkdir(base_path()."/products", 0777, TRUE);
        }

        QrCode::size(500)
            ->format('png')
//            ->generate(URL::to("product/".$mProduct->id), public_path("products/product".$mProduct->id.".png"));
            ->generate(URL::to("product/".$mProduct->id), base_path()."/products/product".$mProduct->id.".png");

        $mProduct->qr_code = URL::to("/products/product".$mProduct->id.".png");

        $mProduct->save();
    }//end create product

    public  static function update_product($id){

        $mProduct = ProductModel::find($id);

        if(empty($mProduct->name))
            return Redirect::back();

        $mProduct->name = Input::get('name');
        $mProduct->description = Input::get('description');
        $mProduct->price = doubleval(Input::get('price'));
        $mProduct->offer_price = doubleval(Input::get('offer_price'));
        $mProduct->category_id = Input::get('category_id');


        if(!empty(Input::get('offer_price')) && Input::get('offer_price') != 0){
            $mProduct->offer_price = Input::get('offer_price');
        }else{
            $mProduct->offer_price = 0;
            $mProduct->has_offer = 0;
        }

//        $mProduct->qr_code =

        //image
        $image = FileHelper::storeImage('image','uploads/categories',400,400,'ROMANY_CAT_');
        if(!empty($image)){
            $mProduct->image = $image;
        }
        $mProduct->user_id = Auth::id();
        $mProduct->save();


    }


    public function deactivate(){
        $this->active = 0;
        $this->user_id = Auth::id();
        $this->save();
    }



}//end Categories Model

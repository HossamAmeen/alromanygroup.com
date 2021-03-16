<?php

namespace App\Models;

use App\Helpers\APIHelper;
use App\Helpers\FileHelper;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Mpociot\Firebase\SyncsWithFirebase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input as Input;
use Auth;
use DB;

class CategoryModel extends Model {


    const DEFAULT_MEDIA_COVER = "resources/assets/admin/images/fav.png";
    protected $table = 'categories';

    public static function get_categories_names_and_icons(){
        $query = "select name, icon from categories ";
        $query .= "where active = 1 ";
//        $query .= "order by id ";

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

    }//end getting categories name and icons


    public static function get_categories_names_as_array(){
        $query = "select id, name from categories ";
        $query .= "where active = 1 ";
        $query .= "order by id ";

        $results = DB::select($query);
        if(!empty($results)){
            $index = 0;
            foreach($results as $row){
                $data[$index]['value'] = $row->name;
                $data[$index]['name'] = $row->name;
                $index++;
            }
            return $data;
        }else{
            return FALSE;
        }

    }//end getting categories name and icons

    public  static function create_category(){

        $mCategory = new CategoryModel();
        $mCategory->name = Input::get('name');

        //image
        $icon = FileHelper::storeImage('icon','uploads/categories',400,400,'ROMANY_PRODUCT_');
        if(!empty($icon)){
            $mCategory->icon = $icon;
        }else{
            $mCategory->icon = ProductModel::DEFAULT_MEDIA_COVER;
        }

        $mCategory->user_id = Auth::id();
        $mCategory->save();

    }//end create category

    public  static function update_category($catId){
        $mCat =  CategoryModel::find(intval($catId));
        $mCat->name = Input::get('name');

        //image
        $icon = FileHelper::storeImage('icon','uploads/categories',400,400,'ROMANY_CAT_');
        if(!empty($icon)){
            $mCat->icon = $icon;
        }
        $mCat->user_id = Auth::id();

        $mCat->save();
    }


    public function deactivate(){
        $this->active = 0;
        $this->user_id = Auth::id();
        $this->save();
    }



}//end Categories Model

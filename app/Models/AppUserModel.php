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

class AppUserModel extends Model {


    protected $table = 'application_user';

    public static function get_news_title($id){
        $query = "select title from aldiar_news_tb ";
        $query .= "where id = ". intval($id) ." ";

        $results = DB::select($query);
        if(!empty($results[0])){
            return $results[0]->title;
        }else{
            return FALSE;
        }

    }//end getting level title


    public  static function create_app_user(){

        $mAppUser = new AppUserModel();
        $mAppUser->name = Input::get('name');
        $mAppUser->tel = Input::get('tel');
        $mAppUser->email = Input::get('email');
        $mAppUser->job = Input::get('job');
        $mAppUser->macAddress = Input::get('macAddress');
        $mAppUser->user_no = AppUserModel::generateAppUserNumber();
        $mAppUser->save();

        return $mAppUser;
    }//end create App User


    public  static function generateAppUserNumber() {
        $number = mt_rand(10000000, 99999999); // better than rand()

        // call the same function if the barcode exists already
        if (AppUserModel::UserNoExists($number)) {
            return AppUserModel::generateAppUserNumber();
        }

        // otherwise, it's valid and can be used
        return $number;
    }

    public static  function UserNoExists($number) {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return AppUserModel::whereuser_no($number)->exists();
    }

    public  static function update_news($newsId){
        $mNews =  NewsModel::find(intval($newsId));
        $mNews->title = Input::get('title');
        $mNews->content = Input::get('content');
//        $mNews->description = Input::get('description');
        //thumbnail
        $thumbnail = FileHelper::storeImage('img','uploads/news',320,180,'ZM_');
        if(!empty($thumbnail)){
            $mNews->thumbnail = $thumbnail;
        }
        //image
        $img = FileHelper::storeImage('img','uploads/news',865,400,'ZM_');
        if(!empty($img)){
            $mNews->img = $img;
        }
        $mNews->user_id = Auth::id();

        $mNews->save();

//        dd($mNews);
    }


    public function deactivate(){
        $this->active = 0;
        $this->user_id = Auth::id();
        $this->save();
    }

    public static function get_last_news($limit = null, $except = null){
        $query = "select * ";
        $query .= "from aldiar_news_tb ";
        $query .= "where active = 1 ";
        if(!empty($except) ){
            $except = intval($except);
            $query .= "and id <> {$except} ";
        }
        $query .="order by  id desc ";
        $query .="limit $limit";
        return DB::select($query);

    }
    public static function get_last_titles($limit = null, $except = null){
        $query = "select n.id, n.title ";
        $query .= "from aldiar_news_tb n ";
        $query .= "where active = 1 ";


        if(!empty($except)){
            $query .="and id <> $except ";
        }

        $query .= "order by id desc ";

        if(!empty($limit)){
            $query .="limit {$limit} ";
        }

        return DB::select($query);

    }


}//end News Model

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


class followsModel extends Model
{


    const DEFAULT_MEDIA_COVER = "resources/assets/admin/images/fav.png";
    protected $table = 'aldiar_follows_tb';

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

    public  static function get_news_url(){
        return 'admin/follows';
    }

    public  static function create_news(){

        $mNews = new followsModel();
        $mNews->title = Input::get('title');
        $mNews->content = Input::get('content');
        $mNews->project_id = Input::get('project_id');
//        $mNews->description = Input::get('description');


        //thumbnail
        $thumbnail = FileHelper::storeImage('img','uploads/follows',320,180);
        if(!empty($thumbnail)){
            $mNews->thumbnail = $thumbnail;
        }else{
            $mNews->thumbnail = followsModel::DEFAULT_MEDIA_COVER;
        }

        //image
        $img = FileHelper::storeImage('img','uploads/follows',865,400);
        if(!empty($img)){
            $mNews->img = $img;
        }else{
            $mNews->img = followsModel::DEFAULT_MEDIA_COVER;
        }


        $mNews->user_id = Auth::id();
        $mNews->save();


    }//end create news

    public  static function update_news($newsId){
        $mNews =  followsModel::find(intval($newsId));
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
        $query = "select n.id, n.title, content, n.created_at, thumbnail ";
        $query .= "from aldiar_news_tb n ";
        $query .= "where active = 1 ";
        /*  $query .= "order by id desc  ";
          $query .= "limit {$limit}";*/


        if(!empty($except)){
            $query .="and id <> $except ";
        }

        $query .= "order by id desc ";

        if(!empty($limit)){
            $query .="limit {$limit} ";
        }

        return \DB::select($query);

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

}

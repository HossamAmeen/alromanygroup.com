<?php

namespace App\Models;

use App\Helpers\APIHelper;
use App\Helpers\FileHelper;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input as Input;
use Auth;
use DB;

class OffersModel extends Model {

    const DEFAULT_MEDIA_COVER = "resources/assets/site/images/logo-3.png";
    protected $table = 'elromani_offers_tb';

    public  static function get_projects_url(){
        return 'admin/offers';
    }

    public  static function create_offer(){

        $mProject = new OffersModel;
        $mProject->title = Input::get('title');
        $mProject->content = Input::get('content');
        $mProject->price = intval(Input::get('price'));
        $mProject->discount = Input::get('discount');
        $img = FileHelper::storeImage('img','resources/uploads/offers',800,600,'romani_');
        if(!empty($img)){
            $mProject->img = $img;
        }else{
            $mProject->img = OffersModel::DEFAULT_MEDIA_COVER;
        }
        $mProject->user_id = Auth::id();
        $mProject->save();
        return $mProject->id;
    }//end create offers

    public  static function update_project($projectId){
        $mProject =  OffersModel::find(intval($projectId));
        $mProject->title = Input::get('title');
        $mProject->small_description = Input::get('small_description');
        $mProject->area = Input::get('area');
        $mProject->address = Input::get('address');
        $mProject->description = Input::get('description');
        $mProject->levels = Input::get('levels');
        $mProject->meter_price = intval(Input::get('meter_price'));
        $mProject->finishing_type = Input::get('finishing_type');
        $mProject->progress_percentage = Input::get('progress_percentage');
        $mProject->progress_phase = Input::get('progress_phase');
        $mProject->level_flats_no = Input::get('level_flats_no');
        $mProject->sizes = Input::get('sizes');
        $mProject->deliver = date_create(Input::get('deliver'));
        //$mProject->booked = Input::get('booked');
        $mProject->coordinators = Input::get('coordinators');
        $mProject->area = Input::get('area');
        $img = FileHelper::storeImage('img','resources/uploads/projects',800,600,'ZM_');
        if(!empty($img)){
            $mProject->img = $img;
        }
        $mProject->user_id = Auth::id();
        $mProject->save();
    }



    public static function get_total_projects(){
        $query = "select count(id) as count ";
        $query .= "from aldiar_project_tb ";
        $query .= "where active = 1 ";
        $results = DB::select($query);
        return $results[0]->count;
    }//end getting total projects

    public function deactivate(){
        $this->active = 0;
        $this->user_id = Auth::id();
        $this->save();
    }

    public static function get_projects_years(){
        $query = "select distinct EXTRACT(YEAR FROM deliver ) year ";
        $query .= "from elromani_offers_tb ";
        $query .= "where active = 1 ";
        $query .= "order by year desc";
        return DB::select($query);
    }
    public static function get_offers_by_id($id){
        if ($id == 0)
        {
            //{ [0]=> array(1) { ["title"]=> string(1) "-" } }
            $empty =[0 =>['title'=>'-']];
            return $empty;
        }
        else
        {
            $query  = "select *";
            $query .= "from elromani_offers_tb ";
            $query .= "where active = 1 ";
            $query .= "and id = {$id} ";
            $result = DB::select($query);
            return $result;
        }
    }

    public static function get_offers_by_year($year){
        $nextYear = $year+1;
        $query = "select *  ";
        $query .= "from elromani_offers_tb ";
        $query .= "where active = 1 ";
        $query .= "and year(deliver) >= {$year} ";
        $query .= "and year(deliver) < {$nextYear} ";
        $query .= "order by deliver ";
        return DB::select($query);
    }

    public static function get_last_offers($limit = null , $except = null){
        $query = "select * ";
        $query .= "from elromani_offers_tb ";
        $query .= "where active = 1 ";
        if(!empty($except) ){
            $except = intval($except);
            $query .= "and id <> {$except} ";
        }
        $query .="order by  id desc ";
        $query .="limit $limit";
        return DB::select($query);
    }
    public static function get_top_view_offers($limit = null , $except = null){
        $query = "select * ";
        $query .= "from elromani_offers_tb ";
        $query .= "where active = 1 ";
        if(!empty($except) ){
            $except = intval($except);
            $query .= "and id <> {$except} ";
        }
        $query .="order by  page_views desc ";
        $query .="limit $limit";
        return DB::select($query);
    }


public static function get_progress_phase()
{
    $phase = array(
        1 => 'أعمال الحفر',
        2 => 'الأساسات',
        3 => 'البناء',
        4 => 'التشطيبات',
       /* 5 => 'مكتمل',*/
    );
    return $phase;
}
}//end Project Model

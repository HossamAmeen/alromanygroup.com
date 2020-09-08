<?php

namespace App\Models;

use App\Helpers\FileHelper;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input as Input;
use Auth;
use DB;

class OffersImageModel extends Model {

    const DEFAULT_MEDIA_COVER = "resources/assets/site/images/logo-3.png";
    protected $table = 'elromani_offers_image_tb';

    public  static function get_project_images_url($projectId){
        return "admin/offers/{$projectId}/images";
    }

    public  static function store_images($projectId){

        $images = FileHelper::multiple_upload_images('images','resources/uploads/offers',400,400,'romani_');
        if(empty($images))
            return;
        foreach($images as $image)
        {
            $mImage = new OffersImageModel();
            $mImage->img = $image;
            $mImage->offers_id = $projectId;
            $mImage->user_id = Auth::id();
            $mImage->save();
        }
    }//end store images

    public static function get_offer_all_images($projectId){
        $query = "select id, img ";
        $query .= "from elromani_offers_image_tb ";
        $query .= "where offers_id = {$projectId} ";
        $query .= "and active = 1 ";
        return DB::select($query);
    }//end getting project all images

    public function deactivate(){
        $this->active = 0;
        $this->user_id = Auth::id();
        $this->save();
    }

}//end Project Model

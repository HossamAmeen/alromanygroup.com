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

class WorkModel extends Model {


    const DEFAULT_MEDIA_COVER = "resources/assets/admin/images/fav.png";
    protected $table = 'aldiar_work_tb';

    public  static function get_work_url(){
        return 'admin/works';
    }

    public static function get_types_array(){

        $types ['1'] = "شقق سكنية";
        $types ['2'] = "غرف معيشة";
        $types ['3'] = "مطابخ";
        $types ['4'] = "جراج";

        return $types;
    }

    public  static function create_work(){

        $images =  FileHelper::multiple_upload_images('images','resources/uploads/images',370,326,'ZM_');
        foreach($images as $image){
            $mWork = new WorkModel();
            $mWork->url = $image;
            $mWork->type = intval(Input::get('type'));
            $mWork->active = 1;
            $mWork->user_id = Auth::id();
            $mWork->save();
        }


    }//end create service


    public function deactivate(){
        $this->active = 0;
        $this->user_id = Auth::id();
        $this->save();
    }



}//end work Model

<?php namespace App\Helpers;
use App\Models;

class PrefsHelper  {
    
   public function get_title(){
        return Models\PrefsModel::find(1)->title;
    }

}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectConfigration extends Model
{
    public  static function get_pull_ratio(){
        
        return ProjectConfigration::find(1)->pull_ratio;
    }
}

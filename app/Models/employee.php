<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Illuminate\Support\Facades\DB;

class Employee extends Model
{

    public function get_total_equivalent(){
        $query = 'select sum(value) as total_equivalent from equivalents ';
        $query .= 'where employee_id =  ' . $this->id ;
        $results = DB::select($query);
        if(empty($results[0]))
            return 'empty';
        else
            return $results[0]->total_equivalent;

    }
    public function disbursedRewards()
    {
        return $this->hasMany(Equivalent::class)->where('active','=','1');
    }
    /////////////// edit from laptop
    public function projects()
    {
        return $this->hasMany(Project::class)->where('active','=','1');
    }
}

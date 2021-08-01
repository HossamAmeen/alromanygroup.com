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
            return 0;
        else
            return $results[0]->total_equivalent;

    }
    public static function get_employee_last_equivalents($employeeId){
        $query = 'select created_at,points,value from equivalents ';
        $query .= "where employee_id = $employeeId  " ;
        $query .= "order by id desc  " ;
        $results = DB::select($query);
        if(empty($results[0]))
            return null;
        else
            return $results;

    }


    public function get_total_projects_bill_values(){
        $query = 'select sum(bill_value) as total_projects_bill_values from projects ';
        $query .= 'where employee_id =  ' . $this->id ;
        $results = DB::select($query);
        if(empty($results[0]))
            return 0;
        else
            return $results[0]->total_projects_bill_values;

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

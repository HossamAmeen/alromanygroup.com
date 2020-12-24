<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Illuminate\Support\Facades\DB;

class Equivalent extends Model
{
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public static function add_total_equivalents($employees){
        $pull_ratio = ProjectConfigration::get_pull_ratio();

        foreach($employees as $key => $employee){
            $query = "select sum(value) as total_points ";
            $query .= "from equivalents  ";
            $query .= "where employee_id = {$employee->id}  ";
            $query .= "and active = 1  ";
            $results = DB::select($query);

            if(!empty($results[0]->total_points)) {

                $employee->total_points = $results[0]->total_points;
                $employee->total_equivalents = $results[0]->total_points * $pull_ratio / 100;
//                dd($results);
            }
            else {
                $employee->total_points = 0;
                $employee->total_equivalents = 0;
            }

        }
//        dd($employees);

    }
}

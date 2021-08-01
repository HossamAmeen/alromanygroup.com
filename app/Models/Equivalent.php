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
            $query = "select sum(value) as total_equivalents ";
            $query .= ",sum(points) as total_equivalent_points ";
            $query .= "from equivalents  ";
            $query .= "where employee_id = {$employee->id}  ";
            $query .= "and active = 1  ";
            $results = DB::select($query);

            $query = "select count(id) as total_operations, sum(bill_value) as total_points ";
            $query .= "from projects ";
            $query .= "where employee_id = {$employee->id}  ";
            $query .= "and active = 1  ";
            $projects_results = DB::select($query);

            if(!empty($results[0]->total_equivalents)) {

                $employee->total_equivalent_points = $results[0]->total_equivalent_points ;
                $employee->total_equivalents = $results[0]->total_equivalents;
            }else {
                $employee->total_equivalent_points = 0;
                $employee->total_equivalents = 0;
            }

            if(!empty($projects_results[0]->total_points)) {

                $employee->total_points = $employee->total_sales = $projects_results[0]->total_points;
                $employee->total_operations = $projects_results[0]->total_operations;
//                dd($results);
            }
            else {
                $employee->total_points = $employees->total_sales = 0;
                $employee->total_equivalents = 0;
                $employee->total_operations = 0;
            }

        }
//        dd($employees);

    }
}

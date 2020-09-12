<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

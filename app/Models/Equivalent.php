<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Equivalent extends Model
{
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

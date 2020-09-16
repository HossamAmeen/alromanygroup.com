<?php

namespace App\Models;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

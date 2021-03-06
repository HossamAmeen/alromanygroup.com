<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Employee extends Model
{
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

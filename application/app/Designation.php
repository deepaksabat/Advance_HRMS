<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $table = 'sys_designation';
    protected $fillable = ['did','designation'];

    /* department_name  Function Start Here */
    public function department_name()
    {
        return $this->hasOne('App\Department','id','did');
    }


}

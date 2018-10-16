<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    protected $table = 'sys_jobs';

    /* position  Function Start Here */
    public function position_name()
    {
        return $this->hasOne('App\Designation','id','position');
    }



}

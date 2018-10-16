<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrainingNeedsAssessment extends Model
{
    protected $table='sys_training_needs_assessment';


    /* department  Function Start Here */
    public function department_name()
    {
        return $this->hasOne('App\Department','id','department');
    }

}

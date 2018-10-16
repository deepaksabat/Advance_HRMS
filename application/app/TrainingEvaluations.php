<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrainingEvaluations extends Model
{
    protected $table='sys_training_evaluations';


    /* department  Function Start Here */
    public function training_title()
    {
        return $this->hasOne('App\EmployeeTraining','id','training_id');
    }
}

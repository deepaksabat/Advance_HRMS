<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskComments extends Model
{
    protected $table='sys_task_comments';


    /* employee_name  Function Start Here */
    public function employee_name()
    {
        return $this->hasOne('App\Employee','id','emp_id');
    }


}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskFiles extends Model
{
    protected $table='sys_task_files';


    /* employee_name  Function Start Here */
    public function employee_name()
    {
        return $this->hasOne('App\Employee','id','emp_id');
    }
}

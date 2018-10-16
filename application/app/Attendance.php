<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table='sys_attendance';

    /* employee_name  Function Start Here */
    public function employee_info()
    {
        return $this->hasOne('App\Employee','id','emp_id');
    }

    /* designation  Function Start Here */
    public function designation_name()
    {
        return $this->hasOne('App\Designation','id','designation');
    }

    /* department  Function Start Here */
    public function department_name()
    {
        return $this->hasOne('App\Department','id','department');
    }


}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $table='sys_leave';

    /* employee_id  Function Start Here */
    public function employee_id()
    {
        return $this->hasOne('App\Employee','id','emp_id');
    }

    /* leave_type  Function Start Here */
    public function leave_type()
    {
        return $this->hasOne('App\LeaveType','id','ltype_id');
    }


}

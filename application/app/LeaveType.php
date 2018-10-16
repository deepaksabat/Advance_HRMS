<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    protected $table='sys_leave_type';
    protected $fillable = ['leave','leave_quota'];
}

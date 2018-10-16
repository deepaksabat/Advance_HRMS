<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'sys_department';
    protected $fillable = ['department'];
}

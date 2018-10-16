<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $table='sys_holiday';
    protected $fillable = ['occasion','holiday'];
}

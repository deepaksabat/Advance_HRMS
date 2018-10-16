<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table='sys_language';
    protected $fillable=['language','status','icon'];
}

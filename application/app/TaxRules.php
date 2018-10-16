<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaxRules extends Model
{
    protected $table='sys_tax_rules';
    protected $fillable = ['tax_name','status'];
}

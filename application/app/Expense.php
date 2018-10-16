<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $table='sys_expense';

    /* employee_id  Function Start Here */
    public function employee_info()
    {
        return $this->hasOne('App\Employee','id','purchase_by');
    }

}

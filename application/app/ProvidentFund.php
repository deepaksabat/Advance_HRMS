<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProvidentFund extends Model
{
    protected $table='sys_provident_fund';


    /* employee_name  Function Start Here */
    public function employee_info()
    {
        return $this->hasOne('App\Employee','id','emp_id');
    }

}

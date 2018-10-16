<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeBankAccount extends Model
{
    protected $table='sys_employee_bank_accounts';
    protected $fillable=['emp_id','bank_name','branch_name','account_name','account_number','ifsc_code','pan_no'];
}

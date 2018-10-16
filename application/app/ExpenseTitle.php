<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseTitle extends Model
{
    protected $table = 'sys_expense_title';
    protected $fillable = ['expense'];
}

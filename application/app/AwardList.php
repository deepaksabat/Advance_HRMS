<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AwardList extends Model
{
    protected $table='sys_award_list';

    /* award_name  Function Start Here */
    public function award_name()
    {
       return $this->hasOne('App\Award','id','award');
    }


}

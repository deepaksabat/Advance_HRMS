<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobApplicants extends Model
{
    protected $table = 'sys_job_applicants';

    /* jobTitle  Function Start Here */
    public function jobTitle()
    {
        return $this->hasOne('App\Jobs','id','job_id');
    }


}

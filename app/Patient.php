<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //
    public function status(){

        return $this->hasMany('App\Patient_status');
    }

    public function session(){

        return $this->hasManyThrough('App\Patient_session','App\Patient_status','patient_id','status_id','id','id');
    }

}

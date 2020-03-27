<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient_status extends Model
{
    //
    public function patient(){

        return $this->belongsTo('App\Patient','patient_id','id');
    }

    public function session(){

        return $this->hasMany('App\Patient_session');
    }


}

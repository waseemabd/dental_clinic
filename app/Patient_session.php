<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient_session extends Model
{
    //
    public function status(){

        return $this->belongsTo('App\Patient_status','status_id','id');
    }

//    public function assets(){
//
//        return $this->belongsTo('App\Asset');
//    }
    public function assets()
    {
        return $this->belongsToMany('App\asset','asset_patient_sessions')
            ->withPivot([
                'quantity',
                'created_by',

            ])->withTimestamps();
    }

}

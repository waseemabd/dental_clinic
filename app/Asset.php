<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    //

    public function supplier(){
        return  $this->belongsTo('App\supplier', 'supplier_id','id');
    }

//    public function patient_session(){
//
//        return $this->belongsTo('App\Patient_session');
//    }

    public function patient_sessions()
    {
        return $this->belongsToMany('App\Patient_session','asset_patient_sessions')

            ->withPivot([
                'quantity',
                'created_at',

            ])->withTimestamps();
    }
}

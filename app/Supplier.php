<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //

    public function asset(){
        return  $this->hasMany('App\Asset');
    }
}

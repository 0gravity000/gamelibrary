<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    //
    public function platform()
    {
        return $this->belongsTo('App\Platform');
    }

    public function gametitlealiases()
    {
        return $this->hasMany('App\GametitleAliase');
    }

}

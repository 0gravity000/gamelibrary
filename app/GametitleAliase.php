<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GametitleAliase extends Model
{
    //
    public function game()
    {
        return $this->belongsTo('App\Game');
    }

    public function searchlists()
    {
        return $this->hasMany('App\Searchlist');
    }
}

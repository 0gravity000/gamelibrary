<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Searchlist extends Model
{
    //
    public function apirequest()
    {
        return $this->belongsTo('App\ApiRequest');
    }

    public function gametitle_aliase()
    {
        return $this->belongsTo('App\GametitleAliase');
    }
}

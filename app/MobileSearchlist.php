<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MobileSearchlist extends Model
{
    //
    public function apirequest()
    {
        return $this->belongsTo('App\ApiRequest');
    }

    public function mobiletitle_aliase()
    {
        return $this->belongsTo('App\MobiletitleAliase');
    }
    
}

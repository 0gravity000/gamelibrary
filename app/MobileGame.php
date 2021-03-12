<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MobileGame extends Model
{
    //
    public function mobiletitlealiases()
    {
        return $this->hasMany('App\MobiletitleAliase');
    }
}

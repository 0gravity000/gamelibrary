<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MobiletitleAliase extends Model
{
    //
    public function mobile_game()
    {
        return $this->belongsTo('App\MobileGame');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiRequest extends Model
{
    //
    public function seachlists()
    {
        return $this->hasMany('App\Seachlist');
    }
}

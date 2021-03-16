<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiRequest extends Model
{
    //
    public function searchlists()
    {
        return $this->hasMany('App\Searchlist');
    }
    public function mobile_searchlists()
    {
        return $this->hasMany('App\MobileSearchlist');
    }
}

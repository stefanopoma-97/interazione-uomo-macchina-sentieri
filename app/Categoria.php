<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public $timestamps = false;
    
     public function sentieri() {
        // use the 'user' property: $author->user (returns an object LibUser)
        return $this->hasMany('PW_runningExample_v6_Laravel\Sentiero');
    }
}

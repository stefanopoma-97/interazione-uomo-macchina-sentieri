<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Esperienza extends Model
{
    public $timestamps = false;
    protected $table = "esperienza";
     
    
     public function utente() {
        // use the 'user' property: $author->user (returns an object LibUser)
        return $this->belongsTo('PW_runningExample_v6_Laravel\LibUser');
    }
    
    public function sentiero() {
        // use the 'user' property: $author->user (returns an object LibUser)
        return $this->belongsTo('PW_runningExample_v6_Laravel\Sentiero');
    }
}

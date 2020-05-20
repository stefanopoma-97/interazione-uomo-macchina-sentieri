<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Esperienza extends Model
{
    public $timestamps = false;
    protected $table = "esperienza";
     
    
     public function utente() {
        // use the 'user' property: $author->user (returns an object LibUser)
        return $this->belongsTo('App\LibUser');
    }
    
    public function sentiero() {
        // use the 'user' property: $author->user (returns an object LibUser)
        return $this->belongsTo('App\Sentiero');
    }
}

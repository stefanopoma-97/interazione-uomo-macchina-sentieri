<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sentiero extends Model
{
     public $timestamps = false;
     
    
     public function difficolta() {
        // use the 'user' property: $author->user (returns an object LibUser)
        return $this->belongsTo('PW_runningExample_v6_Laravel\Difficolta');
    }
    
    public function categoria() {
        // use the 'user' property: $author->user (returns an object LibUser)
        return $this->belongsTo('PW_runningExample_v6_Laravel\Categoria');
    }
    
    public function citta() {
        // use the 'user' property: $author->user (returns an object LibUser)
        return $this->belongsTo('PW_runningExample_v6_Laravel\Citta');
    }
    
    public function esperienze() {
        // use the 'user' property: $author->user (returns an object LibUser)
        return $this->hasMany('PW_runningExample_v6_Laravel\Esperienza');
    }
    
    public function autore() {
        // use the 'user' property: $author->user (returns an object LibUser)
        return $this->belongsTo('PW_runningExample_v6_Laravel\LibUser');
    }
}

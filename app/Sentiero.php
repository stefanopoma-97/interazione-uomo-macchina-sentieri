<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sentiero extends Model
{
     public $timestamps = false;
     protected $table = "sentiero";
     
    
     public function difficolta() {
        // use the 'user' property: $author->user (returns an object LibUser)
        return $this->belongsTo('App\Difficolta');
    }
    
    public function categoria() {
        // use the 'user' property: $author->user (returns an object LibUser)
        return $this->belongsTo('App\Categoria');
    }
    
    public function citta() {
        // use the 'user' property: $author->user (returns an object LibUser)
        return $this->belongsTo('App\Citta');
    }
    
    public function esperienze() {
        // use the 'user' property: $author->user (returns an object LibUser)
        return $this->hasMany('App\Esperienza', 'sentiero_id');
    }
    
     public function preferiti() {
        // use the 'user' property: $author->user (returns an object LibUser)
        return $this->hasMany('App\Preferiti', 'sentiero_id');
    }
    
    public function autore() {
        // use the 'user' property: $author->user (returns an object LibUser)
        return $this->belongsTo('App\LibUser', 'utente_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preferiti extends Model
{
    protected $table = "preferiti";
    public $timestamps = false;
    
    
    public function sentiero() {
        // è un attributo non un metodo $utente->citta
        return $this->belongsTo('App\Sentiero'); //relazione 1:1
    } 
    
    public function utente() {
        // è un attributo non un metodo $utente->citta
        return $this->belongsTo('App\LibUser'); //relazione 1:1
    } 
    
}
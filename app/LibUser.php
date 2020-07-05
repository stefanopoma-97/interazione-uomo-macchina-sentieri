<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LibUser extends Model
{
    protected $table = "utente";
    public $timestamps = false;
    
    protected $fillable = ['id', 'username', 'nome', 'cognome', 'mail', 'descrizione', 'citta_id', 'consiglio_password', 'codice'];
    
    public function citta() {
        // è un attributo non un metodo $utente->citta
        return $this->belongsTo('App\Citta'); //relazione 1:1
    }    
    
    public function esperienze() {
        // è un attributo non un metodo $utente->citta
        return $this->hasMany('App\Esperienza', 'utente_id'); //relazione 0:n
    } 
    
     public function preferiti() {
        // use the 'user' property: $author->user (returns an object LibUser)
        return $this->hasMany('App\Preferiti', 'utente_id');
    }
    
     public function sentieri() {
        // use the 'user' property: $author->user (returns an object LibUser)
        return $this->hasMany('App\Sentiero', 'utente_id');
    }
    
}

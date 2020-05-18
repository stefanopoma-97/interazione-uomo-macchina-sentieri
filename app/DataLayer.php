<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\LibUser;
use App\Sentiero;
use App\DatiSentiero;
use App\Citta;

//AUTENTICAZIONE
class DataLayer extends Model
{
    public function validUser($username, $password) {
        $users = LibUser::where('username',$username)->get(['password']);
        
        if(count($users) == 0)
        {
            return false;
        }
        
        return (md5($password) == ($users[0]->password));
    }
    
    public function addUser($username, $password, $mail, $nome, $cognome, $descrizione, $citta ) {
        
        $citta_id= $this->getCityID($citta);
        
        $user = new LibUser();
        $user->username = $username;
        $user->password = md5($password);
        $user->mail = $mail;
        $user->nome = $nome;
        $user->cognome = $cognome;
        $user->descrizione = $descrizione;
        $user->citta_id = $citta_id;
        $user->save();
        
    }
    
    public function getUserID($username) {
        $users = LibUser::where('username',$username)->get(['id']);
        return $users[0]->id;
    }
    
    public function getCityID($nome) {
        $citta = Citta::where('nome',$nome)->get(['id']);
        return $citta[0]->id;
    }
    
    public function getUserByID($user_id) {
        $user = LibUser::where('id', $user_id)->get();
        return $user[0];
    }
    
    public function getCity($user_id) {
        $user = $this->getUserByID($user_id);
        $citta = Citta::where('id', $user->citta_id)->get();
        return $citta[0];
    }
    
    //SENTIERI
    public function getRecent() {
        $sentieri_recenti = DatiSentiero::orderBy('id', 'DESC')->take(4)->get();
        return $sentieri_recenti;
    }
    
    public function getPiuVotati() {
        $sentieri_piu_votati = DatiSentiero::orderBy('mediavoti', 'DESC')->take(4)->get();
        return $sentieri_piu_votati;
    }
    
    public function getPreferiti($user_id) {
        $user = $this->getUserByID($user_id);
        $preferiti = $user->preferiti->pluck('sentiero_id');
       
        $sentieri_preferiti = DatiSentiero::whereIn('id', $preferiti)->take(4)->get();
        return $sentieri_preferiti;
    }
    
     public function getConsigliati($user_id) {
        $citta = $this->getCity($user_id);
        $sentieri_consigliati = DatiSentiero::where('citta_id', $citta->id)->take(4)->get();
        return $sentieri_consigliati;
    }
    
}

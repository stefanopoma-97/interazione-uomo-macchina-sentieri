<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\LibUser;
use App\Sentiero;
use App\DatiSentiero;
use App\Citta;
use Illuminate\Support\Facades\DB;

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
        if(count($users)==0)
            return -1;
        else
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
    
    
    //UTENTI
    public function getAllUsers() {
        $users = LibUser::all();
        return $users;
    }
    
    
    public function getEsperienzeByUserID($user_id) {
        $user = $this->getUserByID($user_id);
        return $user->esperienze;
    }
    
    public function getSentieriEffettuati($user_id) {
        $user = $this->getUserByID($user_id);
        $sentieri_effettuati = $user->esperienze->pluck('sentiero_id');
        $effettuati = Sentiero::whereIn('id', $sentieri_effettuati)->take(4)->get();
        return $effettuati;
    }
    
     public function getSentieriEsperienze($user_id) {
        
        return DB::table('sentiero')
        ->select('sentiero.*','esperienza.*')
        ->join('esperienza','esperienza.sentiero_id','=','sentiero.id')
        ->where('esperienza.utente_id', '=', $user_id)
        ->get();
    }
    
    public function updateUtente($id, $username, $nome, $cognome, $mail, $citta, $descrizione) {
        $user = LibUser::find($id);
        $user->username = $username;
        $user->nome = $nome;
        $user->cognome = $cognome;
        $user->mail = $mail;
        $user->citta_id = $citta;
        $user->descrizione = $descrizione;
        $user->save();
        // massive update (only with fillable property enabled on Book): 
        // Book::find($id)->update(['title' => $title, 'author_id' => $author_id]);
    }
    
    
    
    
     
    
    
    
     public function fromSentieriToDatiSentieri($sentieri) {
        $sentieri_id=$sentieri->pluck('id');
        $dati_sentieri = DatiSentiero::wherein('id', $sentieri_id)->get();
        return $dati_sentieri;
    }
    
    
    //SENTIERI
    public function getSentieriRecenti() {
        $sentieri_recenti = Sentiero::orderBy('id', 'DESC')->take(4)->get();
        return $sentieri_recenti;
    }
    
    public function getPiuVotati() {
        $sentieri_piu_votati = DatiSentiero::orderBy('mediavoti', 'DESC')->take(4)->get();
        return $sentieri_piu_votati;
    }
    
    public function getPreferiti($user_id) {
        $user = $this->getUserByID($user_id);
        $preferiti = $user->preferiti->pluck('sentiero_id');
       
        return Sentiero::wherein('id',$preferiti)->take(4)->get();
    }
    
     public function getConsigliati($user_id) {
        $citta = $this->getCity($user_id);
        $sentieri_consigliati = Sentiero::where('citta_id', $citta->id)->take(4)->get();
        return $sentieri_consigliati;
    }
    
     public function getAllSentieri() {
        $sentieri = Sentiero::all();
        return $sentieri;
    }
    
    public function getSentieroByID($id) {
        
        return Sentiero::where('id',$id)->first();
    }
    
    
     public function updateSentiero($id, $titolo, $durata, $descrizione, $lunghezza, $salita, $discesa, $altezza_massima
             , $altezza_minima, $difficolta, $categoria, $citta) {
        $sentiero = Sentiero::find($id);
        $sentiero->titolo = $titolo;
        $sentiero->durata = $durata;
        $sentiero->descrizione = $descrizione;
        $sentiero->lunghezza = $lunghezza;
        $sentiero->salita = $salita;
        $sentiero->discesa = $discesa;
        $sentiero->altezza_massima = $altezza_massima;
        $sentiero->altezza_minima = $altezza_minima;
        $sentiero->difficolta_id = $difficolta;
        $sentiero->categoria_id = $categoria;
        $sentiero->citta_id = $citta;
        $sentiero->save();
        // massive update (only with fillable property enabled on Book): 
        // Book::find($id)->update(['title' => $title, 'author_id' => $author_id]);
    }
    
    
    public function addSentiero($user_id, $titolo, $durata, $descrizione, $lunghezza, $salita, $discesa, $altezza_massima
             , $altezza_minima, $difficolta, $categoria, $citta) {
        $sentiero = new Sentiero;
        $sentiero->titolo = $titolo;
        $sentiero->durata = $durata;
        $sentiero->descrizione = $descrizione;
        $sentiero->lunghezza = $lunghezza;
        $sentiero->salita = $salita;
        $sentiero->discesa = $discesa;
        $sentiero->altezza_massima = $altezza_massima;
        $sentiero->altezza_minima = $altezza_minima;
        $sentiero->difficolta_id = $difficolta;
        $sentiero->categoria_id = $categoria;
        $sentiero->citta_id = $citta;
        $sentiero->utente_id = $user_id;
        $sentiero->save();
        // massive update (only with fillable property enabled on Book): 
        // Book::find($id)->update(['title' => $title, 'author_id' => $author_id]);
    }
    
    public function deleteSentiero($id) {
        $sentiero = Sentiero::find($id)->delete();
    }
    
    
    
    
    
     public function getAllCitta() {
        return Citta::all();
    }
    
     public function getCategorie() {
        return Categoria::all();
    }
    
     public function getDifficolta() {
        return Difficolta::all();
    }
    
}

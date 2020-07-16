<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\LibUser;
use App\Sentiero;
use App\DatiSentiero;
use App\Citta;
use App\Preferiti;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
    
    public function addUser($username, $password, $mail, $nome, $cognome, $descrizione, $citta_id, $consiglio_password ) {
                
        $user = new LibUser();
        $user->username = $username;
        $user->password = md5($password);
        $user->mail = $mail;
        $user->nome = $nome;
        $user->cognome = $cognome;
        $user->descrizione = $descrizione;
        $user->citta_id = $citta_id;
        $user->consiglio_password = $consiglio_password;
        $user->save();
        
    }
    
    public function getUserID($username) {
        $users = LibUser::where('username',$username)->get(['id']);
        if(count($users)==0)
            return -1;
        else
            return $users[0]->id;
    }
    

    public function validateUsername($username, $id) {
        $users = DB::select("select * from utente where (username = ? AND id != ?)",[$username, $id]);
        if(count($users)==0)
            return true;
        else
            return false;
    }
    
    public function validateNewUsername($username) {
        $users = DB::select("select * from utente where (username = ?)",[$username]);
        if(count($users)==0)
            return true;
        else
            return false;
    }
    
    public function validateCitta($citta) {
        $cities = Citta::where('nome',$citta)->get();
        if(count($cities)==0)
            return false;
        else
            return true;
    }
    
    public function validateMail($mail, $id) {
        $utente = $this->getUserByID($id);
        if($utente->mail == $mail)
            return true;
        else
            return false;
    }
    
    public function validateMailDatabase($mail) {
        $mails = LibUser::where('mail',$mail)->get();
        if(count($mails)==0)
            return false;
        else
            return true;
    }
    
    public function validateUsernameDatabase($username) {
        $utenti = LibUser::where('username',$username)->get();
        if(count($utenti)==0)
            return false;
        else
            return true;
    }
    
    public function getCityID($nome) {
        $citta = Citta::where('nome',$nome)->get(['id']);
        return $citta[0]->id;
    }
    
    public function getUserByID($user_id) {
        $user = LibUser::where('id', $user_id)->get();
        return $user[0];
    }
    
    public function getUserByUsername($username) {
        $user = LibUser::where('username', $username)->get();
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
        $effettuati = Sentiero::whereIn('id', $sentieri_effettuati)->get();
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
    
    public function addCode($id, $codice) {
        $user = LibUser::find($id);
        $user->codice = $codice;
        $user->save();
        // massive update (only with fillable property enabled on Book): 
        // Book::find($id)->update(['title' => $title, 'author_id' => $author_id]);
    }
    
    public function getCode($id) {
        $user = LibUser::find($id);
        return $user->codice;
        // massive update (only with fillable property enabled on Book): 
        // Book::find($id)->update(['title' => $title, 'author_id' => $author_id]);
    }
    
    public function removeCode($id) {
        $user = LibUser::find($id);
        $user->codice="null";
        // massive update (only with fillable property enabled on Book): 
        // Book::find($id)->update(['title' => $title, 'author_id' => $author_id]);
    }
    
    public function updatePasswordUtente($id, $password, $consiglio) {
        $user = LibUser::find($id);
        $user->password = md5($password);
        $user->consiglio_password = $consiglio;
        $user->save();
        // massive update (only with fillable property enabled on Book): 
        // Book::find($id)->update(['title' => $title, 'author_id' => $author_id]);
    }
    
    
    public function check_password($id, $password){
        $utente= $this->getUserByID($id);
        return (md5($password) == ($utente->password));
    }
    
    public function consiglioPassword($id){
        $utente= $this->getUserByID($id);
        return $utente->consiglio_password;
    }
    
    
    







public function getGpx($sentiero_id){
    $gpx= Storage::has('public/gpx/'.$sentiero_id);
        if($gpx)
            $gpx=asset(Storage::url('public/gpx/'.$sentiero_id));
        else
            $gpx="";
        return $gpx;
}


public function getFotoProfilo($user_id){
    $exists = Storage::has("public/fotoprofilo/profilo".$user_id);
    if($exists)
        $url = asset(Storage::url("public/fotoprofilo/profilo".$user_id));
    else
        $url=asset(Storage::url("public/fotoprofilo/default"));
    
    return $url;
}

public function hasImages($id){
    $immagini = array();
    $exists1 = Storage::has("public/fotosentieri/".$id."/1");
    if($exists1){
        $link1 = asset(Storage::url("public/fotosentieri/".$id."/1"));
        array_push($immagini, $link1);
    }

    $exists2 = Storage::has("public/fotosentieri/".$id."/2");
    if($exists2){
        $link2 = asset(Storage::url("public/fotosentieri/".$id."/2"));
        array_push($immagini, $link2);
    }
    
    $exists3 = Storage::has("public/fotosentieri/".$id."/3");
    if($exists3){
        $link3 = asset(Storage::url("public/fotosentieri/".$id."/3"));
        array_push($immagini, $link3);
    }
    
    if(count($immagini)==0)
        return false;
    else
        return true;
    
        //$link3=asset(Storage::url("public/fotosentieri/default"));
    }
    
    public function GetNumberOfImage($id){
    $immagini = array();
    $exists1 = Storage::has("public/fotosentieri/".$id."/1");
    if($exists1){
        $link1 = asset(Storage::url("public/fotosentieri/".$id."/1"));
        array_push($immagini, $link1);
    }

    $exists2 = Storage::has("public/fotosentieri/".$id."/2");
    if($exists2){
        $link2 = asset(Storage::url("public/fotosentieri/".$id."/2"));
        array_push($immagini, $link2);
    }
    
    $exists3 = Storage::has("public/fotosentieri/".$id."/3");
    if($exists3){
        $link3 = asset(Storage::url("public/fotosentieri/".$id."/3"));
        array_push($immagini, $link3);
    }
    
    return count($immagini);
    
        //$link3=asset(Storage::url("public/fotosentieri/default"));
    }
    
    public function GetImages($id){
    $immagini = array();
    $exists1 = Storage::has("public/fotosentieri/".$id."/1");
    if($exists1){
        $link1 = asset(Storage::url("public/fotosentieri/".$id."/1"));
        array_push($immagini, $link1);
    }
    else{
        $link1=asset(Storage::url("public/fotosentieri/default"));
        array_push($immagini, $link1);
    }

    $exists2 = Storage::has("public/fotosentieri/".$id."/2");
    if($exists2){
        $link2 = asset(Storage::url("public/fotosentieri/".$id."/2"));
        array_push($immagini, $link2);
    }
     else{
        $link2=asset(Storage::url("public/fotosentieri/default"));
        array_push($immagini, $link2);
    }
    
    $exists3 = Storage::has("public/fotosentieri/".$id."/3");
    if($exists3){
        $link3 = asset(Storage::url("public/fotosentieri/".$id."/3"));
        array_push($immagini, $link3);
    }
     else{
        $link3=asset(Storage::url("public/fotosentieri/default"));
        array_push($immagini, $link3);
    }
    
    return $immagini;
    
        //$link3=asset(Storage::url("public/fotosentieri/default"));
    }
    
    public function GetImagesOnlyValid($id){
    $immagini = array();
    if($this->hasImages($id)){
        
        
                $exists1 = Storage::has("public/fotosentieri/".$id."/1");
                if($exists1){
                    $link1 = asset(Storage::url("public/fotosentieri/".$id."/1"));
                    array_push($immagini, $link1);
                }
                $exists2 = Storage::has("public/fotosentieri/".$id."/2");
                if($exists2){
                    $link2 = asset(Storage::url("public/fotosentieri/".$id."/2"));
                    array_push($immagini, $link2);
                }
                $exists3 = Storage::has("public/fotosentieri/".$id."/3");
                if($exists3){
                    $link3 = asset(Storage::url("public/fotosentieri/".$id."/3"));
                    array_push($immagini, $link3);
                }
                for ($i=count($immagini); $i<3; $i++){
                    $immagini[$i]=$immagini[$i-1];
                }
                return $immagini;
        
        
    }
    else {
        return $immagini;
    }
    
    
    
    
        //$link3=asset(Storage::url("public/fotosentieri/default"));
    }



    public function fromSentieriToDatiSentieri($sentieri) {
        $sentieri_id=$sentieri->pluck('id');
        $dati_sentieri = DatiSentiero::wherein('id', $sentieri_id)->get();
        return $dati_sentieri;
    }
    
    public function fromSentieroToDatiSentiero($sentiero) {
        $sentiero_id=$sentiero->id;
        $dati_sentiero = DatiSentiero::where('id', $sentiero_id)->get();
        return $dati_sentiero[0];
    }
    
    public function getEsperienzeBySentiero($sentiero){
        $esperienze=$sentiero->esperienze;
        return $esperienze;
    }
    
    public function getRevisioni($user_id){
        $revisioni = Esperienza::where('utente_id', $user_id)->where('stato',"revisione")->get();
        return $revisioni;
    }
    
    public function getRevisioniNonApprovate($user_id){
        $revisioni = Esperienza::where('utente_id', $user_id)->where('stato', '!=','approvato')->get();
        return $revisioni;
    }
    
    public function getEsperienzeApprovate($user_id){
        $revisioni = Esperienza::where('utente_id', $user_id)->where('stato',"approvato")->get();
        return $revisioni;
    }
    
    public function getEsperienzeApprovatePaginate($user_id){
        $revisioni = Esperienza::where('utente_id', $user_id)->where('stato',"approvato")->paginate(20);
        return $revisioni;
    }
    
    public function getEsperienzeApprovateSentiero($sentiero_id){
        $revisioni = Esperienza::where('sentiero_id', $sentiero_id)->where('stato',"approvato")->get();
        return $revisioni;
    }
    
    public function getEsperienzeApprovateSentieroPaginate($sentiero_id){
        $revisioni = Esperienza::where('sentiero_id', $sentiero_id)->where('stato',"approvato")->paginate(20);
        return $revisioni;
    }
    
    public function getRevisioniDaRevisionare($user_id){
        $revisioni = Esperienza::where('revisore_id', $user_id)->where('stato',"revisione")->get();
        return $revisioni;
    }
    
    public function getRevisioniSentiero($user_id, $sentiero_id){
        $revisioni = Esperienza::where('utente_id', $user_id)->where('stato','!=','approvato')->where('sentiero_id',$sentiero_id)->get();
        return $revisioni;
    }
    public function trovaRevisore(){
        $revisore=DB::select("select COUNT(esperienza.id) as revisioni, esperienza.revisore_id from esperienza "
                . "LEFT JOIN utente ON (utente.admin='y' AND utente.id = esperienza.revisore_id) "
                . "WHERE esperienza.revisore_id!='' GROUP by utente.id  order by revisioni ASC");
        return $revisore[0]->revisore_id;
    }
    
    public function approvaEsperienza($id){
        $esperienza = Esperienza::find($id);
        $esperienza->stato="approvato";
        $esperienza->save();
    }
    
    public function rifiutaEsperienza($id, $nota){
        $esperienza = Esperienza::find($id);
        $esperienza->stato="rifiutato";
        $esperienza->nota=$nota;
        $esperienza->save();
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
    
     public function preferito($sentiero, $user) {
        $sentieri_preferiti = $user->preferiti->pluck('sentiero_id')->toArray();
        if (in_array($sentiero->id, $sentieri_preferiti))
            return true;
        else
            return false;
    }
    
    public function addPreferito($sentiero_id, $user_id) {
       $preferito = new Preferiti;
       $preferito->sentiero_id=$sentiero_id;
       $preferito->utente_id = $user_id;
       $preferito->save();
    }
    
    public function removePreferito($sentiero_id, $user_id) {
        $pre = Preferiti::where('sentiero_id', $sentiero_id)->where('utente_id',$user_id)->get();
       if (count($pre)>1 || count($pre)==0)
           return False;
       else
       {
           $preferito=$pre[0];
           Preferiti::find($preferito->id)->delete();
       }
       
    }
    
    public function pre() {
        $s_id=10;
        $u_id=1;
       $pre = Preferiti::where('sentiero_id', $s_id)->where('utente_id',$u_id)->get();
       if (count($pre)>1 || count($pre)==0)
           return False;
       else
       {
           return $pre[0];
           
       }
       
    }
    
    public function findPreferito($sentiero_id, $user_id) {
        $preferito = Preferiti::where('sentiero_id', $sentiero_id)->where('utente_id', $user_id)->take(1)->get();
        return $preferito;
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
        $sentiero->dislivello = $altezza_massima-$altezza_minima;
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
        $sentiero->dislivello = $altezza_massima-$altezza_minima;

        $sentiero->save();
        // massive update (only with fillable property enabled on Book): 
        // Book::find($id)->update(['title' => $title, 'author_id' => $author_id]);
    }
    
    public function deleteSentiero($id) {
        Esperienza::where('sentiero_id',$id)->delete();
        Preferiti::where('sentiero_id',$id)->delete();
        Sentiero::find($id)->delete();
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
    
    
    
    
    
    
     public function addEsperienza($user_id, $sentiero_id, $data, $voto, $difficolta, $descrizione, $revisore_id, $stato) {
        $esperienza = new Esperienza;
        $esperienza->utente_id = $user_id;
        $esperienza->sentiero_id = $sentiero_id;
        $esperienza->data = $data;
        $esperienza->voto = $voto;
        $esperienza->difficolta = $difficolta;
        $esperienza->commento = $descrizione;
        $esperienza->revisore_id = $revisore_id;
        $esperienza->stato = $stato;
        
        
        $esperienza->save();
        // massive update (only with fillable property enabled on Book): 
        // Book::find($id)->update(['title' => $title, 'author_id' => $author_id]);
    }
}

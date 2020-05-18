<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\DataLayer;

class UserController extends Controller
{
    public function elenco() {
       
        session_start();
    
        if(!isset($_SESSION['logged'])) {
            return Redirect::to(route('user.auth.login'));
        }
        
        $dl = new DataLayer();
        $user_id = $dl->getUserID($_SESSION['loggedName']);
        if($user_id==-1){
            session_destroy();
            return Redirect::to(route('user.auth.login'));
        }
        $users = $dl->getAllUsers();
        
        return view('utenti.utenti')->with('logged',true)->with('loggedName', $_SESSION["loggedName"])
                ->with('users', $users)
                ->with('user_id', $user_id);        
    }
    
    
    public function dettagli($id) {
       
        session_start();
    
        if(!isset($_SESSION['logged'])) {
            return Redirect::to(route('user.auth.login'));
        }
        
        $dl = new DataLayer();
        $user_id = $dl->getUserID($_SESSION['loggedName']);
        if($user_id==-1){
            session_destroy();
            return Redirect::to(route('user.auth.login'));
        }
        $user_dettagli = $dl->getUserByID($id);
        
        $esperienza = $dl->getEsperienzeByUserID($id);
        $numero_esperienze = count($esperienza);
        
        $preferiti = $dl ->getPreferiti($id);
        $numero_preferiti=count($preferiti);
        
        $sentieri_effettuati = $dl->getSentieriEffettuati($id);
        
        $sentieri_esperienze = $dl->getSentieriEsperienze($id)->take(4);
        
        $citta = $dl->getCity($id);
        
        return view('utenti.dettagliutente')->with('logged',true)->with('loggedName', $_SESSION["loggedName"])
                ->with('user_dettagli', $user_dettagli)
                ->with('user_id', $user_id)
                ->with('numero_preferiti', $numero_preferiti)
                ->with('numero_esperienze', $numero_esperienze)
                ->with('sentieri_effettuati', $sentieri_effettuati)
                ->with('sentieri_esperienze', $sentieri_esperienze)
                ->with('citta', $citta);        
    }
    
    
    public function edit($id) {
       
        session_start();
    
        if(!isset($_SESSION['logged'])) {
            return Redirect::to(route('user.auth.login'));
        }
       
        
        $dl = new DataLayer();
        $user_id = $dl->getUserID($_SESSION['loggedName']);
        if($user_id==-1){
            session_destroy();
            return Redirect::to(route('user.auth.login'));
        }
            
        
        if($user_id!=$id){
            return Redirect::to(route('user.elenco'));
        }
        
        $user = $dl->getUserByID($id);
        
        $citta = $dl->getCitta();
        
        $mia_citta = $dl->getCity($id);
        
        
        return view('utenti.modificautente')->with('logged',true)->with('loggedName', $_SESSION["loggedName"])
                ->with('user_id', $user_id)
                ->with('user', $user)
                ->with('citta', $citta)
                ->with('mia_citta', $mia_citta);        
    }
    
    public function update($user_id, Request $request) {
       
        session_start();
    
        if(!isset($_SESSION['logged'])) {
            return Redirect::to(route('user.auth.login'));
        }
       
        
        $dl = new DataLayer();
        $dl->updateUtente($user_id, $request->input('username'), $request->input('nome'), $request->input('cognome'),
                $request->input('mail'), $request->input('citta'),
                $request->input('descrizione'));
        return Redirect::to(route('user.elenco'));      
    }
    
}

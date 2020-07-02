<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\DataLayer;

class UserController extends Controller
{
    public function elenco() {
//       
//        session_start();
//    
//        if(!isset($_SESSION['logged'])) {
//            return Redirect::to(route('user.auth.login'));
//        }
        
        $dl = new DataLayer();
        $user_id = $dl->getUserID($_SESSION['loggedName']);
        if($user_id==-1){
            session_destroy();
            return Redirect::to(route('user.auth.login'));
        }
        $users = $dl->getAllUsers();
        $user = $dl->getUserByID($user_id);

        
        return view('utenti.utenti')->with('logged',true)->with('loggedName', $_SESSION["loggedName"])
                ->with('users', $users)
                ->with('user', $user)
                ->with('user_id', $user_id);        
    }
    
    
    public function dettagli($id) {
       
//        session_start();
//    
//        if(!isset($_SESSION['logged'])) {
//            return Redirect::to(route('user.auth.login'));
//        }
        
        $dl = new DataLayer();
        $user_id = $dl->getUserID($_SESSION['loggedName']);
        if($user_id==-1){
            session_destroy();
            return Redirect::to(route('user.auth.login'));
        }
        
        $user = $dl->getUserByID($user_id);

        $user_dettagli = $dl->getUserByID($id);
        
        $sentieri_effettuati = $dl->getSentieriEffettuati($id);
        
        return view('utenti.dettagliutente')->with('logged',true)->with('loggedName', $_SESSION["loggedName"])
                ->with('user_dettagli', $user_dettagli)
                ->with('user_id', $user_id)
                ->with('user', $user)
                ->with('sentieri_effettuati', $sentieri_effettuati);
    }
    
    
    public function edit($id) {
       
//        session_start();
//    
//        if(!isset($_SESSION['logged'])) {
//            return Redirect::to(route('user.auth.login'));
//        }
       
        
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
        
        $citta = $dl->getAllCitta();
       
       
        return view('utenti.modificautente')->with('logged',true)->with('loggedName', $_SESSION["loggedName"])
                ->with('user_id', $user_id)
                ->with('user', $user)
                ->with('citta', $citta);        
    }
    
    public function update($id, Request $request) {
       
//        session_start();
//    
//        if(!isset($_SESSION['logged'])) {
//            return Redirect::to(route('user.auth.login'));
//        }
        
        $dl = new DataLayer();
        $user_id = $dl->getUserID($_SESSION['loggedName']);
        if($user_id==-1){
            session_destroy();
            return Redirect::to(route('user.auth.login'));
        }
       
        if($user_id!=$id){
            return Redirect::to(route('user.elenco'));
        }
        
        $citta_id = $dl->getCityID($request->input('citta_completamento'));
        
        $dl->updateUtente($id, $request->input('username'), $request->input('nome'), $request->input('cognome'),
                $request->input('mail'), /*$request->input('citta'),*/ $citta_id,
                $request->input('descrizione'));
        return Redirect::to(route('user.dettagli', ['id'=> $user_id]));      
    }
    
    
    //SERVIZIO
    //restituiamo una stringa json per verificare la validità di un username inserito
    public function ajax_check_username_citta(Request $request){
        $dl = new DataLayer();
        $valid_user = $dl->validateUsername($request->input('username'), $request->input('id'));
        $valid_city = $dl->validateCitta($request->input('citta'));
        
        if ($valid_user)
        //if(true)
        {
            $username = true;
        }
        else
        {
            $username = false;
        }
        
        if ($valid_city)
        //if(true)
        {
            $citta = true;
        }
        else
        {
            $citta = false;
        }
        $response = array('username'=>$username, 'citta'=>$citta);
        
        return response()->json($response); //mando indietro json

    }
    
    public function ajax_check_citta(Request $request){
        $dl = new DataLayer();
        
        if ($dl->validateCitta($request->input('citta')))
        //if(true)
        {
            $response = array('found'=>false); //response http
        }
        else
        {
            $response = array('found'=>false); //response http
        }
        
        return response()->json($response); //mando indietro json

    }
    
}

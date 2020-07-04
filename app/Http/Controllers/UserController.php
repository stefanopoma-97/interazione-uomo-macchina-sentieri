<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\DataLayer;
use App\Http\Requests;
use Mail;
use Illuminate\Support\Collection;
use App\Mail\Contact;

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
    
    
    public function edit_password($id) {
       
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
        
       
       
        return view('utenti.modificapassword')->with('logged',true)->with('loggedName', $_SESSION["loggedName"])
                ->with('user_id', $user_id)
                ->with('user', $user);        
    }
    
    public function edit_recupero_password($id) {
        $dl = new DataLayer();
        unset($_SESSION["codice"]);
        $user_id = $dl->getUserID($_SESSION['loggedName']);
        if($user_id==-1){
            session_destroy();
            return Redirect::to(route('user.auth.login'));
        }
            
        
        if($user_id!=$id){
            return Redirect::to(route('user.elenco'));
        }
        
        $user = $dl->getUserByID($id);
        
        //Mando una mail all'ingresso (Tentativo di reset password)
        //$this->send_mail_reset_password("1", 'stefano', 'stefano1997poma97@gmail.com');
//        if(isset($_SESSION["codice"])){
//                unset($_SESSION["codice"]);
//                $_SESSION["codice"]="1";
//            }
//        else{
//            $_SESSION["codice"]="1";
//        }
//            $codice=$_SESSION["codice"];
//            $this->send_mail_reset_password($codice, "stefano", "stefano1997poma97@gmail.com");
        
       
       
        return view('utenti.recuperopassword')->with('logged',true)->with('loggedName', $_SESSION["loggedName"])
                ->with('user_id', $user_id)
                ->with('user', $user);        
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
    
    public function update_password($id, Request $request) {
        
        $dl = new DataLayer();
        $user_id = $dl->getUserID($_SESSION['loggedName']);
        if($user_id==-1){
            session_destroy();
            return Redirect::to(route('user.auth.login'));
        }
       
        if($user_id!=$id){
            return Redirect::to(route('user.elenco'));
        }
                
        $dl->updatePasswordUtente($id, $request->input('password_nuova'));
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
    
     public function ajax_check_codice(Request $request){
        if(isset($_SESSION["codice"])){
            if ($_SESSION["codice"]==$request->input('codice'))
            //if(true)
            {
                $response = array('codice'=>true, 'set'=>true); //response http
            }
            else
            {
                $response = array('codice'=>false, 'set'=>true); //response http
            }
        }
        else{
            $response = array('codice'=>false, 'set'=>false);
        }
        
        return response()->json($response); //mando indietro json

    }
    
    public function ajax_send_reset_mail(Request $request){
        $dl = new DataLayer();
        $utente=$dl->getUserByID($request->input('id'));
        if(isset($_SESSION["codice"])){
            unset($_SESSION["codice"]);
            //$_SESSION["codice"]="1";
            $_SESSION["codice"]= substr(uniqid('', true), -5);
        }
        else {
            //$_SESSION["codice"]="1";
            $_SESSION["codice"]= substr(uniqid('', true), -5);
        }
        $codice=($_SESSION["codice"]);
        $this->send_mail_reset_password($codice, $utente->username, $request->input('mail'));
        
        $response = array('ok'=>true);
        return response()->json($response); //mando indietro json
    }


    public function ajax_check_mail(Request $request){
        $dl = new DataLayer();
        
        if ($dl->validateMail($request->input('mail'),$request->input('id')))
        //if(true)
        {
            $response = array('mail'=>true); //response http
            //INVIO MAIL SETTO CODICE E LO RESETTO NEL CASO DI REINVIO
            $utente=$dl->getUserByID($request->input('id'));
            if(isset($_SESSION["codice"])){
                unset($_SESSION["codice"]);
                $_SESSION["codice"]="1";
            }
            else {
                $_SESSION["codice"]="1";
            }
            $codice=($_SESSION["codice"]);
            //$this->send_mail_reset_password($codice, $utente->username, $request->input('mail'));
        }
        else
        {
            $response = array('mail'=>false); //response http
        }
        
        return response()->json($response); //mando indietro json

    }
    
    public function ajax_check_password(Request $request){
        $dl = new DataLayer();
        $consiglio = $dl->consiglioPassword($request->input('id'));
        
        
        
        if ($dl->check_password($request->input('id'),$request->input('password')))
        //if(true)
        {
            $response = array('check'=>true, 'consiglio'=>$consiglio); //response http
        }
        else
        {
            $response = array('check'=>false, 'consiglio'=>$consiglio); //response http
        }
        
        return response()->json($response); //mando indietro json

    }
    
    public function send_mail_reset_password($codice, $username, $mail) {
        $data = array('codice' => $codice, 'username' => $username , 'mail'=>$mail);
        Mail::send('mail_reset_password', $data, function($message) use ($data){ //mail è il nome della view
            $message->to($data['mail'], $data['username'])->subject
                    ('Reset password');
            $message->from('s.poma001@studenti.unibs.it', 'Laravel');
        });
    }
    
    public function send_mail_cambio_password($username, $mail){
        $data = array('data'=>time());
        Mail::send('mail_cambio_password', $data, function($message) {
            $message->to($mail, $username)->subject
                        ('Avviso cambio password');
            $message->from('s.poma001@studenti.unibs.it', 'Laravel');
      });
    }
    
    public function send_mail_tentativo_accesso($username, $mail){
        $data = array('data'=>time());
        Mail::send('mail_tentativo_accesso', $data, function($message) {
            $message->to($mail, $username)->subject
                        ('Tentativo di accesso');
            $message->from('s.poma001@studenti.unibs.it', 'Laravel');
      });
    }
    
}

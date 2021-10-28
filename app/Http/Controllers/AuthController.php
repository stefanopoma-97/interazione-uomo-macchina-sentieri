<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataLayer;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Mail;
use Illuminate\Support\Collection;
use App\Mail\Contact;
use DateTime;


class AuthController extends Controller
{
    public function authentication_login() {
        $dl = new DataLayer();
        $citta = $dl->getAllCitta();
        if(isset($_COOKIE["username_login"]))
            $username=$_COOKIE["username_login"];
        else
            $username="";
        
        return view('auth.auth')->with('login', true)->with('citta', $citta)->with('username', $username);
    }
    
    public function authentication_register() {
        $dl = new DataLayer();
        $citta = $dl->getAllCitta();
        if(isset($_COOKIE["username_login"]))
            $username=$_COOKIE["username_login"];
        else
            $username="";
        return view('auth.auth')->with('login', false)->with('citta', $citta)->with('username', $username);
    }

    public function logout() {

        session_start();
        session_destroy();
        //setcookie("username_login", "", time() -1);
        return Redirect::to(route('home'));
    }
    
    public function login(Request $request) {
        
        session_start();
        $dl = new DataLayer();
        
        if ($dl->validUser($request->input('username'), $request->input('password'))) 
        {
            $_SESSION['logged'] = true;
            $_SESSION['loggedName'] = $request->input('username');
            if($request->input('remember'))
                setcookie("username_login", $request->input('username'), time() + (10 * 365 * 24 * 60 * 60));
            else if(isset($_COOKIE["username_login"]))
                setcookie("username_login", "", time() -1);
            else{}
            
            $user_id = $dl->getUserID($_SESSION['loggedName']);
            $user = $dl->getUserByID($user_id);
            $dl->removeCode($user_id);

            if($user->admin == 'y')
                $_SESSION['admin'] = true;
            
            return Redirect::to(route('home'));

        }
       
        return view('auth.authErrorPage');
    }
    
    public function registration(Request $request) {
        session_start();
        $dl = new DataLayer();
        $citta_id = $dl->getCityID($request->input('citta_completamento'));
        $dl->addUser($request->input('username'), $request->input('password_nuova'), $request->input('mail'),
                $request->input('nome'),$request->input('cognome'),$request->input('descrizione'),
                $citta_id, $request->input('consiglio'));
               
        if ($dl->validUser($request->input('username'), $request->input('password_nuova'))) 
        {
            $_SESSION['logged'] = true;
            $_SESSION['loggedName'] = $request->input('username');
            
            return Redirect::to(route('home'));


        }    
        
        }
        
        
        public function ajax_check_new_username_citta(Request $request){
        $dl = new DataLayer();
        $valid_user = $dl->validateNewUsername($request->input('username'));
        $valid_citta = $dl->validateCitta($request->input('citta'));
        
        if ($valid_user)
        //if(true)
        {
            $username = true;
        }
        else
        {
            $username = false;
        }
        
        if($valid_citta){
            
            $citta=true;
        }
        else {
            $citta=false;
        }
        
        $response = array('username'=>$username, 'citta'=>$citta);
        
        return response()->json($response); //mando indietro json

    }
    
    
    public function edit_recupero_password_login() {
        //session_start();
//        if(isset($_SESSION['codice'])){
//            unset($_SESSION['codice']);
//        }
//            
//        $dl = new DataLayer();
//        unset($_SESSION["codice"]);
        //$_SESSION['codice']=1;

       
        return view('auth.recuperopassword_login');        
    }
    
    public function update_password(Request $request) {
        
        $dl = new DataLayer();
        $user=$dl->getUserByUsername($request->input('username'));
        $user_id = $user->id;
                
        $dl->updatePasswordUtente($user_id, $request->input('password_nuova'), $request->input('consiglio'));
        $dl->removeCode($user_id);
        
        
        //MANDARE MAIL PER AVVERTIRE
        //$this->send_mail_info_cambio_password($request->input('username'), $user->mail);
        
        return view('auth.authInfoPage');      
    }
        
    public function send_mail_info_cambio_password($username, $mail) {
        $orario = new DateTime();
        $result = $orario->format('Y-m-d H:i:s');
        $data = array('username' => $username , 'mail'=>$mail, 'data'=>$result);
        Mail::send('mail_info_cambio_password', $data, function($message) use ($data){ //mail è il nome della view
            $message->to($data['mail'], $data['username'])->subject
                    ('Attenzione cambio password');
            $message->from('s.poma001@studenti.unibs.it', 'Laravel');
        });
    }
        
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataLayer;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function authentication_login() {
        return view('auth.auth')->with('login', true);
    }
    
    public function authentication_register() {
        return view('auth.auth')->with('login', false);
    }

    public function logout() {

        session_start();
        session_destroy();
        return Redirect::to(route('home'));
    }
    
    public function login(Request $request) {
        
        session_start();
        $dl = new DataLayer();
        
        if ($dl->validUser($request->input('username'), $request->input('password'))) 
        {
            $_SESSION['logged'] = true;
            $_SESSION['loggedName'] = $request->input('username');
            
            $user_id = $dl->getUserID($_SESSION['loggedName']);
            $user = $dl->getUserByID($user_id);

            if($user->admin == 'y')
                $_SESSION['admin'] = true;
            
            return Redirect::to(route('home'));

        }
       
        return view('auth.authErrorPage');
    }
    
    public function registration(Request $request) {
        session_start();
        $dl = new DataLayer();
        
        $dl->addUser($request->input('username'), $request->input('password'), $request->input('email'),
                $request->input('nome'),$request->input('cognome'),$request->input('descrizione'),
                $request->input('citta'));
               
        if ($dl->validUser($request->input('username'), $request->input('password'))) 
        {
            $_SESSION['logged'] = true;
            $_SESSION['loggedName'] = $request->input('username');
            
            return Redirect::to(route('home'));


        }    
        
        }  
        
        
}

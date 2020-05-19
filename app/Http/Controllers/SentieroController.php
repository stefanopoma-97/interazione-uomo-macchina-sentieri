<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\DataLayer;

class SentieroController extends Controller
{
    public function index() {
       
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
        
        $user = $dl->getUserByID($user_id);
        if($user->admin != 'y')
            return Redirect::to(route('sentiero.errore'));
        
        $sentieri = $dl->getAllSentieri();
        
        return view('sentieri.sentieri')->with('logged',true)->with('loggedName', $_SESSION["loggedName"])
                ->with('sentieri', $sentieri)
                ->with('user', $user)
                ->with('user_id', $user_id);        
    }
    
    public function edit($sentiero) {
       
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
        
        $user = $dl->getUserByID($user_id);
        if($user->admin != 'y')
            return Redirect::to(route('sentiero.errore'));
        
        $sentiero = $dl->getSentieroByID($sentiero);
        $citta = $dl->getAllCitta();
        $categoria = $dl->getCategorie();
        $difficolta = $dl->getDifficolta();
        
        return view('sentieri.modificasentiero')->with('logged',true)->with('loggedName', $_SESSION["loggedName"])
                ->with('sentiero', $sentiero)
                ->with('user', $user)
                ->with('categoria', $categoria)
                ->with('difficolta', $difficolta)
                ->with('citta', $citta)
                ->with('user_id', $user_id);        
    }
    
    public function create() {
       
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
        
        $user = $dl->getUserByID($user_id);
        if($user->admin != 'y')
            return Redirect::to(route('sentiero.errore'));
        
        $citta = $dl->getAllCitta();
        $categoria = $dl->getCategorie();
        $difficolta = $dl->getDifficolta();
        
        return view('sentieri.modificasentiero')->with('logged',true)->with('loggedName', $_SESSION["loggedName"])
                ->with('user', $user)
                ->with('categoria', $categoria)
                ->with('difficolta', $difficolta)
                ->with('citta', $citta)
                ->with('user_id', $user_id);        
    }
    
    
     public function update($sentiero_id, Request $request) {
       
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
        
        $user = $dl->getUserByID($user_id);
        if($user->admin != 'y')
            return Redirect::to(route('sentiero.errore'));
       
        
        $dl->updateSentiero($sentiero_id, $request->input('titolo'), $request->input('durata'), $request->input('descrizione'),
                $request->input('lunghezza'), $request->input('salita'), $request->input('discesa'),
                $request->input('altezza_massima'), $request->input('altezza_minima'), $request->input('difficolta'),
                $request->input('categoria'), $request->input('citta')
                );
        return Redirect::to(route('sentiero.index'));      
    }
    
    public function store(Request $request) {
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
        
        $user = $dl->getUserByID($user_id);
        if($user->admin != 'y')
            return Redirect::to(route('sentiero.errore'));
        
        
        $dl->addSentiero($user_id, $request->input('titolo'), $request->input('durata'), $request->input('descrizione'),
                $request->input('lunghezza'), $request->input('salita'), $request->input('discesa'),
                $request->input('altezza_massima'), $request->input('altezza_minima'), $request->input('difficolta'),
                $request->input('categoria'), $request->input('citta')
                );
        return Redirect::to(route('sentiero.index'));
    }
    
    public function destroy ($id) {
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
        
        $user = $dl->getUserByID($user_id);
        if($user->admin != 'y')
            return Redirect::to(route('sentiero.errore'));
        
        $dl->deleteSentiero($id);
        return Redirect::to(route('sentiero.index'));
    }
    
    public function confirmDestroy($id) {
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
        
        $user = $dl->getUserByID($user_id);
        if($user->admin != 'y')
            return Redirect::to(route('sentiero.errore'));
        
        
        $sentiero = $dl->getSentieroByID($id);
        if($sentiero !== null)
        {
            return view('sentieri.cancellasentiero')->with('logged',true)
                ->with('loggedName', $_SESSION["loggedName"])
                ->with('sentiero',$sentiero);
        }
        else
        {
            return Redirect::to(route('sentiero.errore'));

        }
    }
    
    public function errore() {
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
        
        
        return view('sentieri.paginaerrore')->with('logged',true)
                ->with('loggedName', $_SESSION["loggedName"]);
        
        
        
    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataLayer;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Sentiero;

class FrontController extends Controller
{
   public function getHome() {
        
        session_start(); //fa partire la sessione e rimanda alla view index
        $dl = new DataLayer();
        
        //controlla che sia loggato
        if(isset($_SESSION['logged'])) {
            $user_id = $dl->getUserID($_SESSION['loggedName']);
            
            //user_id == -1 significa che ho un username che non esiste (modificato)
            if($user_id==-1){
            session_destroy();
            return Redirect::to(route('user.auth.login'));
             }
             
            $user = $dl->getUserByID($user_id);
            
            $sentieri_recenti = $dl->getSentieriRecenti();
            $sentieri_piu_votati = $dl->getPiuVotati();
            $sentieri_consigliati = $dl->getConsigliati($user_id);
            $sentieri_preferiti = $dl->getPreferiti($user_id);
            $count_revisioni = count($dl->getRevisioniDaRevisionare($user_id));
            
            //paginazione
            $users = Sentiero::paginate(4);
            
            return view('index')->with('logged',true)->with('loggedName', $_SESSION['loggedName'])
                    ->with('user_id', $user_id)->with('sentieri_recenti', $sentieri_recenti)
                    ->with('sentieri_piu_votati', $sentieri_piu_votati)
                    ->with('user', $user)
                    ->with('link', 'http://www.google.com/search?q=Google+tutorial+create+link')
                    ->with('count_revisioni', $count_revisioni)
                    ->with('sentieri_consigliati', $sentieri_consigliati)
                    ->with('sentieri_preferiti', $sentieri_preferiti)->with('users', $users);
        } else {
            $sentieri_recenti = $dl->getSentieriRecenti();
            $sentieri_piu_votati = $dl->getPiuVotati();
            
            $users = Sentiero::paginate(4);
            
            
            return view('index')->with('logged',false)->with('sentieri_recenti', $sentieri_recenti)
                    ->with('sentieri_piu_votati', $sentieri_piu_votati)->with('users', $users);
        }
    }
}

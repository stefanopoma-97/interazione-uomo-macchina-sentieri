<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\DataLayer;

class EsperienzaController extends Controller
{
    public function store($sentiero_id, Request $request) {     
        $dl = new DataLayer();
        $user_id = $dl->getUserID($_SESSION['loggedName']);
        if($user_id==-1){
            session_destroy();
            return Redirect::to(route('user.auth.login'));
        }
        
        $user = $dl->getUserByID($user_id);
        if($user_id != $request->input('user_id'))
            return Redirect::to(route('sentiero.errore'));
        
        $revisore_id = $dl->trovaRevisore();
        //$revisore_id=1;
        $stato="revisione";
        
        if($user->admin=='y')
            $stato="approvato";
        
        $dl->addEsperienza($user_id, $sentiero_id, $request->input('data'), $request->input('voto'),
                $request->input('difficolta'), $request->input('descrizione'), $revisore_id, $stato
                );
        return Redirect::to(route('sentiero.show',['sentiero'=>$sentiero_id]));
    }
    
    
     public function mie_esperienze($user_id) {

        
        $dl = new DataLayer();
        $user_id = $dl->getUserID($_SESSION['loggedName']);
        if($user_id==-1){
            session_destroy();
            return Redirect::to(route('user.auth.login'));
        }
        
        $user = $dl->getUserByID($user_id);
        
        
        $esperienze = $dl->getEsperienzeByUserID($user_id);
        $count_revisioni = count($dl->getRevisioniDaRevisionare($user_id));

        
         return view('utenti.esperienze')->with('logged',true)
                ->with('loggedName', $_SESSION["loggedName"])
                ->with('esperienze', $esperienze)
                ->with('user_id', $user_id)
                 ->with('utente_id', $user_id)
                 ->with('count_revisioni', $count_revisioni)
                ->with('user', $user);
    }
    
    public function esperienze_utente($id) {

        
        $dl = new DataLayer();
        $user_id = $dl->getUserID($_SESSION['loggedName']);
        if($user_id==-1){
            session_destroy();
            return Redirect::to(route('user.auth.login'));
        }
        
        $user = $dl->getUserByID($user_id);
        
        
        $esperienze = $dl->getEsperienzeApprovate($id);
        $count_revisioni = count($dl->getRevisioniDaRevisionare($user_id));

        
         return view('utenti.esperienze')->with('logged',true)
                ->with('loggedName', $_SESSION["loggedName"])
                ->with('esperienze', $esperienze)
                ->with('user_id', $user_id)
                 ->with('count_revisioni', $count_revisioni)
                 ->with('utente_id', $id)
                ->with('user', $user);
    }
    
    public function da_revisionare($user_id) {

        
        $dl = new DataLayer();
        $user_id = $dl->getUserID($_SESSION['loggedName']);
        if($user_id==-1){
            session_destroy();
            return Redirect::to(route('user.auth.login'));
        }
        
        $user = $dl->getUserByID($user_id);
 
        $esperienze = $dl->getRevisioniDaRevisionare($user_id);
        $count_revisioni = count($dl->getRevisioniDaRevisionare($user_id));

        
         return view('utenti.revisionare')->with('logged',true)
                ->with('loggedName', $_SESSION["loggedName"])
                ->with('esperienze', $esperienze)
                ->with('user_id', $user_id)
                ->with('count_revisioni', $count_revisioni)
                ->with('user', $user);
    }
    
    public function rifiutato($id, Request $request) {

        
        $dl = new DataLayer();
        $user_id = $dl->getUserID($_SESSION['loggedName']);
        if($user_id==-1){
            session_destroy();
            return Redirect::to(route('user.auth.login'));
        }
        
        $user = $dl->getUserByID($user_id);
 
        $dl->rifiutaEsperienza($id, $request->input('nota'));
        
        return Redirect::to(route('esperienza.darevisionare',  ['id'=> $user_id]));
    }
    
    public function approvato($id) {

        
        $dl = new DataLayer();
        $user_id = $dl->getUserID($_SESSION['loggedName']);
        if($user_id==-1){
            session_destroy();
            return Redirect::to(route('user.auth.login'));
        }
        
        $user = $dl->getUserByID($user_id);
 
        $dl->approvaEsperienza($id);
        
         return Redirect::to(route('esperienza.darevisionare',  ['id'=> $user_id]));
    }
}

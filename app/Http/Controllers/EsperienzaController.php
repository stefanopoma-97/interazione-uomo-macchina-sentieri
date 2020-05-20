<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\DataLayer;

class EsperienzaController extends Controller
{
    public function store($sentiero_id, Request $request) {
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
        if($user_id != $request->input('user_id'))
            return Redirect::to(route('sentiero.errore'));
        
        
        $dl->addEsperienza($user_id, $sentiero_id, $request->input('data'), $request->input('voto'),
                $request->input('difficolta'), $request->input('descrizione')
                );
        return Redirect::to(route('sentiero.show',['sentiero'=>$sentiero_id]));
    }
}

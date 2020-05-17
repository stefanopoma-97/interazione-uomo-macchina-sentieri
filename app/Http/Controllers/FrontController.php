<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataLayer;
use Illuminate\Support\Facades\Redirect;

class FrontController extends Controller
{
   public function getHome() {
        
        session_start(); //fa partire la sessione e rimanda alla view index
        $dl = new DataLayer();
        
        if(isset($_SESSION['logged'])) {
            $user_id = $dl->getUserID($_SESSION['loggedName']);
            return view('index')->with('logged',true)->with('loggedName', $_SESSION['loggedName'])
                    ->with('user_id', $user_id);
        } else {
            return view('index')->with('logged',false);
        }
    }
}

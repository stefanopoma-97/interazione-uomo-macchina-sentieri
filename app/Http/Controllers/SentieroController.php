<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\DataLayer;
use App\Sentiero;
use App\Preferiti;
use Illuminate\Support\Facades\DB;


class SentieroController extends Controller
{
    public function index() {
       
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
//        if($user->admin != 'y')
//            return Redirect::to(route('sentiero.errore'));
        
        $sentieri = $dl->getAllSentieri();
        
        return view('sentieri.sentieri')->with('logged',true)->with('loggedName', $_SESSION["loggedName"])
                ->with('sentieri', $sentieri)
                ->with('user', $user)
                ->with('user_id', $user_id);        
    }
    
    public function edit($sentiero) {
       
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
//        if($user->admin != 'y')
//            return Redirect::to(route('sentiero.errore'));
        
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
//        if($user->admin != 'y')
//            return Redirect::to(route('sentiero.errore'));
        
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
//        if($user->admin != 'y')
//            return Redirect::to(route('sentiero.errore'));
//       
        $citta_id=$dl->getCityID($request->input('citta'));
        
        $dl->updateSentiero($sentiero_id, $request->input('titolo'), $request->input('durata'), $request->input('descrizione'),
                $request->input('lunghezza'), $request->input('salita'), $request->input('discesa'),
                $request->input('altezza_massima'), $request->input('altezza_minima'), $request->input('difficolta'),
                $request->input('categoria'), $citta_id
                );
        return Redirect::to(route('sentiero.index'));      
    }
    
    public function preferito($sentiero_id, Request $request) {
       
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
        
        if($request->input('preferito')=="False")
            $dl->removePreferito($sentiero_id,$user_id);
        if($request->input('preferito')=="True")
            $dl->addPreferito($sentiero_id,$user_id);
        
        return redirect()->back();//mi rimanda sulla stessa pagina dove è stato chiamato 
    }
    
    
    
    public function store(Request $request) {
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
//        if($user->admin != 'y')
//            return Redirect::to(route('sentiero.errore'));
        $citta_id=$dl->getCityID($request->input('citta'));
        
        $dl->addSentiero($user_id, $request->input('titolo'), $request->input('durata'), $request->input('descrizione'),
                $request->input('lunghezza'), $request->input('salita'), $request->input('discesa'),
                $request->input('altezza_massima'), $request->input('altezza_minima'), $request->input('difficolta'),
                $request->input('categoria'), $citta_id
                );
        return Redirect::to(route('sentiero.index'));
    }
    
    public function destroy ($id) {
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
//        if($user->admin != 'y')
//            return Redirect::to(route('sentiero.errore'));
        
        $dl->deleteSentiero($id);
        return Redirect::to(route('sentiero.index'));
    }
    
    public function confirmDestroy($id) {
//       session_start();
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
//        if($user->admin != 'y')
//            return Redirect::to(route('sentiero.errore'));
        
        
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
//       session_start();
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
        
        
        return view('sentieri.paginaerrore')->with('logged',true)
                ->with('loggedName', $_SESSION["loggedName"]);
        
        
        
    }
    
    public function show($id) {
//       session_start();
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
        $user=$dl->getUserByID($user_id);
        $sentiero = $dl->getSentieroByID($id);
        $dati_sentiero = $dl->fromSentieroToDatiSentiero($sentiero);
        $esperienze = $dl->getEsperienzeBySentiero($sentiero);
        $preferito = $dl->preferito($sentiero, $user);
        $pre = $dl->pre();
        
        return view('sentieri.sentiero')->with('logged',true)
                ->with('loggedName', $_SESSION["loggedName"])
                ->with('sentiero', $sentiero)
                ->with('esperienze', $esperienze)
                ->with('user_id', $user_id)
                ->with('user', $user)
                ->with('preferito', $preferito)
                ->with('dati_sentiero', $dati_sentiero);
        
        
        
    }
    
    
    public function ricerca() {
//       session_start();
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
            $sentieri = $dl->getAllSentieri();
            $dati_sentieri = $dl->fromSentieriToDatiSentieri($sentieri);
            $citta=$dl->getAllCitta();
            $categorie=$dl->getCategorie();
            $difficolta=$dl->getDifficolta();

            return view('sentieri.ricercasentieri')->with('logged', true)
                            ->with('loggedName', $_SESSION["loggedName"])
                            ->with('sentieri', $sentieri)
                            ->with('user_id', $user_id)
                            ->with('user', $user)
                            ->with('citta', $citta)
                            ->with('categorie', $categorie)
                            ->with('difficolta', $difficolta)
                            ->with('dati_sentieri', $dati_sentieri);

    }
    
    
    public function ricerca_filtra(Request $request) {
//       session_start();
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
        
        $s = new Sentiero;
        $filtro = $s->newQuery();

        if ($request->has('testo_titolo')) {
            $titolo = $request->input('testo_titolo');
            $filtro->where('titolo', 'like', '%'.$titolo.'%'); 
        }
        if ($request->has('testo_descrizione')) {
            $descrizione = $request->input('testo_descrizione');
            $filtro->where('descrizione', 'like', '%'.$descrizione.'%'); 
        }
        if ($request->input('citta')!="") {
            $citta = $request->input('citta');
            $filtro->where('citta_id', $citta); 
        }
        if ($request->input('categoria')!="") {
            $filtro->where('categoria_id', $request->input('categoria')); 
        }
        if ($request->input('difficolta')!="") {
            $filtro->where('difficolta_id', $request->input('difficolta')); 
        }
        if ($request->input('lunghezza')!= null) {
            $lunghezza = $request->input('lunghezza');
            $filtro->where('lunghezza', '<', $lunghezza); 
        }
        if ($request->input('dislivello')!= null) {
            $dislivello = $request->input('dislivello');
            $filtro->where(DB::raw("(altezza_massima - altezza_minima as dislivello)"), '<', $dislivello); 
        }
        if ($request->input('durata')!= null) {
            $durata = $request->input('durata');
            $filtro->where('durata', '<', $durata); 
        }
        
        
        $sentieri = $filtro->get();


        $user = $dl->getUserByID($user_id);
        $dati_sentieri = $dl->fromSentieriToDatiSentieri($sentieri);
        $citta=$dl->getAllCitta();
        $categorie=$dl->getCategorie();
        $difficolta=$dl->getDifficolta();

        return view('sentieri.ricercasentieri')->with('logged', true)
                        ->with('loggedName', $_SESSION["loggedName"])
                        ->with('sentieri', $sentieri)
                        ->with('user_id', $user_id)
                        ->with('user', $user)
                        ->with('citta', $citta)
                        ->with('categorie', $categorie)
                        ->with('difficolta', $difficolta)
                        ->with('dati_sentieri', $dati_sentieri);

    }
    
    
    public function ricerca_filtra_home(Request $request) {
//       session_start();
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
        
        $s = new Sentiero;
        $filtro = $s->newQuery();

        
        $titolo = $request->input('ricerca');
        $filtro->where('titolo', 'like', '%'.$titolo.'%'); 
                
        
        $sentieri = $filtro->get();


        $user = $dl->getUserByID($user_id);
        $dati_sentieri = $dl->fromSentieriToDatiSentieri($sentieri);
        $citta=$dl->getAllCitta();
        $categorie=$dl->getCategorie();
        $difficolta=$dl->getDifficolta();

        return view('sentieri.ricercasentieri')->with('logged', true)
                        ->with('loggedName', $_SESSION["loggedName"])
                        ->with('sentieri', $sentieri)
                        ->with('user_id', $user_id)
                        ->with('user', $user)
                        ->with('citta', $citta)
                        ->with('categorie', $categorie)
                        ->with('difficolta', $difficolta)
                        ->with('dati_sentieri', $dati_sentieri);

    }
    
    
    
    
    ////AJAX
    public function ajax_check_citta(Request $request){
        $dl = new DataLayer();
        $valid_city = $dl->validateCitta($request->input('citta'));
        
        if ($valid_city)
        //if(true)
        {
            $citta = true;
        }
        else
        {
            $citta = false;
        }
        $response = array('citta'=>$citta);
        
        return response()->json($response); //mando indietro json

    }
    
    
           
    
    
}

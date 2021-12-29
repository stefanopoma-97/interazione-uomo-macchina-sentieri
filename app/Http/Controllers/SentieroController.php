<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\DataLayer;
use App\Sentiero;
use App\Preferiti;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage; 


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
        $count_revisioni = count($dl->getRevisioniDaRevisionare($user_id));

        
        return view('sentieri.sentieri')->with('logged',true)->with('loggedName', $_SESSION["loggedName"])
                ->with('sentieri', $sentieri)
                ->with('user', $user)
                ->with('count_revisioni', $count_revisioni)
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
        $count_revisioni = count($dl->getRevisioniDaRevisionare($user_id));
        
        return view('sentieri.modificasentiero')->with('logged',true)->with('loggedName', $_SESSION["loggedName"])
                ->with('sentiero', $sentiero)
                ->with('user', $user)
                ->with('categoria', $categoria)
                ->with('difficolta', $difficolta)
                ->with('citta', $citta)
                ->with('count_revisioni', $count_revisioni)
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
        $count_revisioni = count($dl->getRevisioniDaRevisionare($user_id));
        
        return view('sentieri.modificasentiero')->with('logged',true)->with('loggedName', $_SESSION["loggedName"])
                ->with('user', $user)
                ->with('categoria', $categoria)
                ->with('difficolta', $difficolta)
                ->with('citta', $citta)
                ->with('count_revisioni', $count_revisioni)
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
            $count_revisioni = count($dl->getRevisioniDaRevisionare($user_id));
            return view('sentieri.cancellasentiero')->with('logged',true)
                ->with('loggedName', $_SESSION["loggedName"])
                ->with('count_revisioni', $count_revisioni)
                ->with('user_id', $user_id)
                ->with('logged', true)
                ->with('user', $user)
                ->with('sentiero',$sentiero);
        }
        else
        {
            return Redirect::to(route('sentiero.errore'));

        }
    }
    
    
    public function sentiero_esperienze($id) {
        
        $dl = new DataLayer();
        $user_id = $dl->getUserID($_SESSION['loggedName']);
        if($user_id==-1){
            session_destroy();
            return Redirect::to(route('user.auth.login'));
        }
        
        $user = $dl->getUserByID($user_id);
       
        
        $sentiero = $dl->getSentieroByID($id);
        $count_revisioni = count($dl->getRevisioniDaRevisionare($user_id));
        $esperienze = $dl->getEsperienzeApprovateSentieroPaginate($sentiero->id);
        
        return view('sentieri.esperienzesentiero')->with('logged',true)
            ->with('loggedName', $_SESSION["loggedName"])
            ->with('count_revisioni', $count_revisioni)
            ->with('esperienze', $esperienze)
            ->with('user', $user)
            ->with('user_id', $user_id)
            ->with('sentiero',$sentiero);
       
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
        $count_revisioni = count($dl->getRevisioniDaRevisionare($user_id));
        
        
        return view('sentieri.paginaerrore')->with('logged',true)
                ->with('count_revisioni', $count_revisioni)
                ->with('user_id', $user_id)
                ->with('user', $user)
                ->with('logged',true)
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
        $esperienze = $dl->getEsperienzeApprovateSentiero($id);
        $preferito = $dl->preferito($sentiero, $user);
        $pre = $dl->pre();
        if ($dl->hasImages($sentiero->id)){
            $immagini=$dl->GetImagesOnlyValid($id);
        }
        else {
            $immagini = null;
        }
        
        $link_google="http://www.google.com/search?q=";
        $link_youtube="https://www.youtube.com/results?search_query=";
        
        $parole = explode(" ", $sentiero->titolo);
        $link_google=$link_google.array_shift($parole);
        $link_youtube=$link_youtube.array_shift($parole);
        
        foreach ($parole as $parola){
            $link_google=$link_google.'+'.$parola;
            $link_youtube=$link_youtube.'+'.$parola;
        }
        
        $gpx=$dl->getGpx($id);
        
        
        
        $revisioni=$dl->getRevisioniSentiero($user_id, $id);
        $count_revisioni = count($dl->getRevisioniDaRevisionare($user_id));
            
        
        return view('sentieri.sentiero')->with('logged',true)
                ->with('loggedName', $_SESSION["loggedName"])
                ->with('sentiero', $sentiero)
                ->with('esperienze', $esperienze)
                ->with('user_id', $user_id)
                ->with('user', $user)
                ->with('link_google', $link_google)
                ->with('link_youtube', $link_youtube)
                ->with('immagini', $immagini)
                ->with('gpx', $gpx)
                ->with('preferito', $preferito)
                ->with('revisioni', $revisioni)
                ->with('count_revisioni', $count_revisioni)
                ->with('dati_sentiero', $dati_sentiero);
        
        
        
    }
    
    public function immagini($id) {
        
        $dl = new DataLayer();
        $user_id = $dl->getUserID($_SESSION['loggedName']);
        if($user_id==-1){
            session_destroy();
            return Redirect::to(route('user.auth.login'));
        }
        $user=$dl->getUserByID($user_id);
        $sentiero = $dl->getSentieroByID($id);
        
        //http://localhost:8000/storage/fotosentieri/{id}/1,2o2
        
        $exists1 = Storage::has("public/fotosentieri/".$id."/1");
        if($exists1)
            $link1 = asset(Storage::url("public/fotosentieri/".$id."/1"));
        else
            $link1=asset(Storage::url("public/fotosentieri/default"));
        
        $exists2 = Storage::has("public/fotosentieri/".$id."/2");
        if($exists2)
            $link2 = asset(Storage::url("public/fotosentieri/".$id."/2"));
        else
            $link2=asset(Storage::url("public/fotosentieri/default"));
        
        $exists3 = Storage::has("public/fotosentieri/".$id."/3");
        if($exists3)
            $link3 = asset(Storage::url("public/fotosentieri/".$id."/3"));
        else
            $link3=asset(Storage::url("public/fotosentieri/default"));
        
        //$link3='http://localhost:8000/storage/fotosentieri/default';
        $count_revisioni = count($dl->getRevisioniDaRevisionare($user_id));
            
        
        return view('sentieri.immagini')->with('logged',true)
                ->with('loggedName', $_SESSION["loggedName"])
                ->with('sentiero', $sentiero)
                ->with('user', $user)
                ->with('user_id', $user_id)
                ->with('count_revisioni', $count_revisioni)
                ->with('link1', $link1)
                ->with('link3', $link3)
                ->with('link2', $link2);
     
    }
    
    public function aggiungi_immagine (Request $request, $id){
        /*$this->validate($request, [
        'immagine' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);*/
        $request->file('immagine')->storeAs('public/fotosentieri/'.$id, $request->input('nome_file'));
        
        return Redirect::to(route('sentiero.immagini',['id' => $id])); 
    }
    
     public function rimuovi_immagine ($id, $nome){
        //Log::info("public/fotosentieri/".$id."/".$nome);
        error_log("public/fotosentieri/".$id."/".$nome);
        $exists = Storage::has("public/fotosentieri/".$id."/".$nome);
        if($exists)
            Storage::delete("public/fotosentieri/".$id."/".$nome);
        return Redirect::to(route('sentiero.immagini',['id' => $id]));
        
        
        /*$exists = Storage::has("public/fotosentieri/".$id."/3");
        if($exists)
            Storage::delete("public/fotosentieri/".$id."/3");
        return Redirect::to(route('sentiero.immagini',['id' => $id]));*/
        
    }
    
    
    
    public function gpx($id) {
        
        $dl = new DataLayer();
        $user_id = $dl->getUserID($_SESSION['loggedName']);
        if($user_id==-1){
            session_destroy();
            return Redirect::to(route('user.auth.login'));
        }
        $user=$dl->getUserByID($user_id);
        $sentiero = $dl->getSentieroByID($id);
        
        //http://localhost:8000/storage/fotosentieri/{id}/1,2o2
        
        $gpx=$dl->getGpx($id);      
        $count_revisioni = count($dl->getRevisioniDaRevisionare($user_id));
        
        return view('sentieri.gpx')->with('logged',true)
                ->with('loggedName', $_SESSION["loggedName"])
                ->with('sentiero', $sentiero)
                ->with('user', $user)
                ->with('count_revisioni', $count_revisioni)
                ->with('user_id', $user_id)
                ->with('gpx', $gpx);
     
    }
    
    public function aggiungi_gpx (Request $request, $id){
//        $this->validate($request, [
//        'immagine' => 'required|mimes:gpx|max:2048',
//        ]);
        $request->file('gpx')->storeAs('public/gpx', $id);
        
        return Redirect::to(route('sentiero.gpx',['id' => $id])); 
    }
    
     public function rimuovi_gpx ($id){
        $exists = Storage::has('public/gpx/'.$id);
        if($exists)
            Storage::delete('public/gpx/'.$id);
        return Redirect::to(route('sentiero.gpx',['id' => $id])); 
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
            //$sentieri = $dl->getAllSentieri();
            $sentieri = Sentiero::paginate(5);
            $totale_risultati=count($dl->getAllSentieri());
            $dati_sentieri = $dl->fromSentieriToDatiSentieri($sentieri);
            $citta=$dl->getCittaSentieri();
            $categorie=$dl->getCategorie();
            $difficolta=$dl->getDifficolta();
            $count_revisioni = count($dl->getRevisioniDaRevisionare($user_id));
            $immagini=[];
            $partecipanti=[];
            $media_voti=[];
                foreach($sentieri as $key => $sentiero){
                    if ($dl->hasImages($sentiero->id)){
                        $im=$dl->GetImagesOnlyValid($sentiero->id);
                        $immagini[$key]=$im[0];
                    }
                    else {
                        $immagini[$key]=null;
                    }

                    $dati_sent = $dl->fromSentieroToDatiSentiero($sentiero);
                    $partecipanti[$key]=$dati_sent->partecipanti;
                    $media_voti[$key]=$dati_sent->mediavoti;
                }
            

            return view('sentieri.ricercasentieri')->with('logged', true)
                            ->with('loggedName', $_SESSION["loggedName"])
                            ->with('sentieri', $sentieri)
                            ->with('user_id', $user_id)
                            ->with('user', $user)
                            ->with('citta', $citta)
                            ->with('count_revisioni', $count_revisioni)
                            ->with('categorie', $categorie)
                            ->with('difficolta', $difficolta)
                            ->with('immagini', $immagini)
                            ->with('totale_risultati', $totale_risultati)
                            ->with('partecipanti', $partecipanti)
                            ->with('media_voti', $media_voti)
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
        
        $titolo="";
        $descrizione="";
        $citta_valore="";
        $difficolta_valore="";
        $categoria_valore="";
        $lunghezza_massima="";
        $dislivello_massimo="";
        $durata_massima="";

        if ($request->has('testo_titolo')) {
            $titolo = $request->input('testo_titolo');
            $filtro->where('titolo', 'like', '%'.$titolo.'%');
        }
        if ($request->has('testo_descrizione')) {
            $descrizione = $request->input('testo_descrizione');
            $filtro->where('descrizione', 'like', '%'.$descrizione.'%');
        }
        $citta_valida=false;
        if ($request->input('citta')!="") {
            $citta = $request->input('citta');
            $citta_id=$dl->getCityID($citta);
            if($citta_id!=null){
                $filtro->where('citta_id', $citta_id);
                $citta_valore=$citta;
                $citta_valida=true;
            }
            
        }
        if ($request->input('categoria')!="") {
            $filtro->where('categoria_id', $request->input('categoria'));
            $categoria_valore=$request->input('categoria');
        }
        if ($request->input('difficolta')!="") {
            $filtro->where('difficolta_id', $request->input('difficolta')); 
            $difficolta_valore=$request->input('difficolta');
        }
        if ($request->input('lunghezza')!= null) {
            $lunghezza = $request->input('lunghezza');
            $filtro->where('lunghezza', '<=', $lunghezza); 
            $lunghezza_massima=$lunghezza;
        }
        if ($request->input('dislivello')!= null) {
            $dislivello = $request->input('dislivello');
            //$filtro->where(DB::raw("(altezza_massima - altezza_minima as dislivello)"), '<', $dislivello);
            $filtro->where('dislivello', '<=', $dislivello);
            $dislivello_massimo=$dislivello;
        }
        if ($request->input('durata')!= null) {
            $durata = $request->input('durata');
            $filtro->where('durata', '<=', $durata);
            $durata_massima=$durata;
        }
        
        
        
        
        $sentieri = $filtro->paginate(5);
        $sentieri_tot = $filtro->paginate(1000);
        
        if ($request->has('testo_titolo')) {
            $sentieri->appends('testo_titolo',request('testo_titolo'));
        }
        if ($request->has('testo_descrizione')) {
            $sentieri->appends('testo_descrizione',request('testo_descrizione'));
        }
        if (($request->input('citta')!="")&&($citta_id==true)) {
            $sentieri->appends('citta',request('citta'));
        }
        if ($request->input('categoria')!="") {
            $sentieri->appends('categoria',request('categoria'));
        }
        if ($request->input('difficolta')!="") {
           $sentieri->appends('difficolta',request('difficolta'));
        }
        if ($request->input('lunghezza')!= null) {
            $sentieri->appends('lunghezza',request('lunghezza'));
        }
        if ($request->input('dislivello')!= null) {
           $sentieri->appends('dislivello',request('dislivello'));
        }
        if ($request->input('durata')!= null) {
            $sentieri->appends('durata',request('durata'));
        }
        //$sentieri = $filtro->get();
        $sentieri_tot->appends('testo_titolo',request('testo_titolo'));
        $sentieri_tot->appends('testo_descrizione',request('testo_descrizione'));
        $sentieri_tot->appends('citta',request('citta'));
        $sentieri_tot->appends('categoria',request('categoria'));
        $sentieri_tot->appends('difficolta',request('difficolta'));
        $sentieri_tot->appends('dislivello',request('dislivello'));
        $sentieri_tot->appends('durata',request('durata'));
        
        $totale_risultati=count($sentieri_tot);
       



        $user = $dl->getUserByID($user_id);
        $dati_sentieri = $dl->fromSentieriToDatiSentieri($sentieri);
        $citta=$dl->getCittaSentieri();
        $categorie=$dl->getCategorie();
        $difficolta=$dl->getDifficolta();
        $count_revisioni = count($dl->getRevisioniDaRevisionare($user_id));
        
        $immagini=[];
        $partecipanti=[];
        $media_voti=[];
            foreach($sentieri as $key => $sentiero){
                if ($dl->hasImages($sentiero->id)){
                    $im=$dl->GetImagesOnlyValid($sentiero->id);
                    $immagini[$key]=$im[0];
                }
                else {
                    $immagini[$key]=null;
                }
                
                $dati_sent = $dl->fromSentieroToDatiSentiero($sentiero);
                $partecipanti[$key]=$dati_sent->partecipanti;
                $media_voti[$key]=$dati_sent->mediavoti;
            }
        
//         $sentieri->withPath(view('sentieri.ricercasentieri')->with('logged', true)
//                        ->with('loggedName', $_SESSION["loggedName"])
//                        ->with('sentieri', $sentieri)
//                        ->with('user_id', $user_id)
//                        ->with('user', $user)
//                        ->with('citta', $citta)
//                        ->with('categorie', $categorie)
//                        ->with('difficolta', $difficolta)
//                        ->with('dati_sentieri', $dati_sentieri));

        return view('sentieri.ricercasentieri')->with('logged', true)
                        ->with('loggedName', $_SESSION["loggedName"])
                        ->with('sentieri', $sentieri)
                        ->with('user_id', $user_id)
                        ->with('user', $user)
                        ->with('citta', $citta)
                        ->with('count_revisioni', $count_revisioni)
                        ->with('categorie', $categorie)
                        ->with('difficolta', $difficolta)
                        ->with('immagini', $immagini)
                        ->with('dati_sentieri', $dati_sentieri)
                        ->with('titolo', $titolo)
                        ->with('descrizione', $descrizione)
                        ->with('citta_valore', $citta_valore)
                        ->with('difficolta_valore', $difficolta_valore)
                        ->with('categoria_valore', $categoria_valore)
                        ->with('lunghezza_massima', $lunghezza_massima)
                        ->with('dislivello_massimo', $dislivello_massimo)
                        ->with('durata_massima', $durata_massima)
                        ->with('partecipanti', $partecipanti)
                        ->with('media_voti', $media_voti)
                        ->with('totale_risultati', $totale_risultati);

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
                
        
        $sentieri = $filtro->paginate(5);


        $user = $dl->getUserByID($user_id);
        $dati_sentieri = $dl->fromSentieriToDatiSentieri($sentieri);
        $citta=$dl->getAllCitta();
        $categorie=$dl->getCategorie();
        $difficolta=$dl->getDifficolta();
        $count_revisioni = count($dl->getRevisioniDaRevisionare($user_id));

        return view('sentieri.ricercasentieri')->with('logged', true)
                        ->with('loggedName', $_SESSION["loggedName"])
                        ->with('sentieri', $sentieri)
                        ->with('user_id', $user_id)
                        ->with('user', $user)
                        ->with('citta', $citta)
                        ->with('count_revisioni', $count_revisioni)
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

<!--<!DOCTYPE html>
<htm>
    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>User authentication</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        
         Fogli di stile 
        <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ url('/') }}/css/mio_stile.css">
        <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

        
         jQuery e plugin JavaScript 
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="{{ url('/') }}/js/bootstrap.min.js"></script>
        <script src="{{ url('/') }}/js/scriptValidazione.js"></script>
        <script src="{{ url('/') }}/js/scriptPopUp.js"></script>
        <script type="text/javascript">@yield('javascript')</script>
         <script src="http://code.jquery.com/jquery.js"></script>
        <script src="{{ url('/') }}/js/bootstrap.min.js"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>
    </head>

    <body>-->
@extends('layouts.masterlogin')

@section('titolo', 'Login')

@section('corpo')
        
        <div class="container"> 
            <div class="row" style="margin-top: 4em;"> <!-- unica riga--> <!-- margin top lo sposta in basso -->
                <div class="col-md-6 col-md-offset-3"> <!-- offset sposta a dx di 3 -->
                    
                    <div> <!-- costruzione tab -->
                        
                        <!--tab di navigazione  -->
                        <ul class="nav nav-tabs">  <!-- intestazione del tab -->
                            @if ($login)
                                <li class="active"><a href="#login-form" data-toggle="tab">Login</a></li> <!--due tab che puntano a due form diverse Login e Register -->
                                <li><a href="#register-form" data-toggle="tab">Registrazione</a></li> <!-- registern non è attivo, Login si-->
                            @else
                                <li><a href="#login-form" data-toggle="tab">Login</a></li> <!--due tab che puntano a due form diverse Login e Register -->
                                <li class='active'><a href="#register-form" data-toggle="tab">Register</a></li>
                            @endif
                            <!--data-toggle lo trasforma in un vero e proprio tab -->
                        </ul>
                        
                        <!--contenuto-->
                        <div class="tab-content"> 

                            <!--tab di login-->
                            
                            
                            
                            @if ($login) 
                            <div class="tab-pane active" id="login-form"> <!-- id serve ad essere richimato dai tab  -->
                            @else
                            <div class="tab-pane" id="login-form"> <!-- id serve ad essere richimato dai tab  -->
                            @endif
                            <div style="margin-bottom: 2em;" hidden="" class="col-md-12 alert alert-danger">
                                <ul id="ul_errori">
                                </ul>
                            </div>
                                <form id="login-form" action="{{ route('user.login') }}" method="post" style="margin-top: 2em;"> <!-- margine per distanziare -->
                                @csrf
                                    <div class="form-group"> <!-- form-group contiene i campi -->
                                        @if($username=="")
                                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" required="" maxlength="32" type="text" name="username" class="form-control" placeholder="Username" value=""> <!-- se il cookie è settato scrivo valore -->
                                        @else
                                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" required="" maxlength="32" type="text" name="username" class="form-control" placeholder="Username" value="{{$username}}"> <!-- se il cookie è settato scrivo valore -->
                                        @endif
                                    </div> <!-- form-control da lo stile --> <!-- POST[name] -->
                                    
                                    <div class="form-group">
                                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" required="" maxlength="100" type="password" name="password" class="form-control" placeholder="Password">
                                    </div><!-- type password non fa capire cosa si sta inserendo-->
                                    
                                    <div class="form-group text-center"> <!-- messo al centro -->
                                        @if($username!="")
                                        <input type="checkbox" checked="" name="remember">
                                        @else
                                        <input type="checkbox" name="remember"> <!-- lascia flag se cookie settato -->
                                        @endif
                                        <label for="remember"> Ricordami</label>
                                    </div> <!-- text box + label -->
                                    
                                    <div class="form-group"> <!-- pulsante -->
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3"> <!-- messo al centro -->
                                                <input type="submit" name="login-submit" class="form-control btn btn-primary" value="Log In" onclick="event.preventDefault(); login(this);">
                                                <!-- login-sumbit per capire se POST ha passato qualcosa -->
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="text-center"> <!-- metterlo al centro -->
                                            <a href="{{route('user.edit.recuperopassword.login')}}" class="forgot-password">Password dimenticata?</a> <!-- per ora link vuoto -->
                                        </div>
                                    </div>
                                    
                                </form>
                            </div>

                            <!--tab di registrazione-->
                            @if(!$login)
                            <div class="tab-pane active" id="register-form">
                            @else
                            <div class="tab-pane" id="register-form">
                            @endif
                            <div style="margin-bottom: 2em;" hidden="" class="col-md-12 alert alert-danger">
                                <ul id="ul_errori_registrazione">
                                </ul>
                            </div>
                            
                                <form id="register-form" action="{{ route('user.register') }}" method="post" style="margin-top: 2em;"> <!-- invoca la stessa pagina con -->
                                @csrf
                                    <div class="form-group">
                                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" required="" maxlength="32" type="text" name="username" class="form-control" placeholder="Username" value="">
                                        <span class="invalid-input" id="invalid-username"></span>
                                    </div>
                                    
                                    <div class="form-group">
                                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" required="" maxlength="32" type="text" name="nome" class="form-control" placeholder="Nome" value="">
                                        <span class="invalid-input" id="invalid-nome"></span>
                                    </div>
                                    <div class="form-group">
                                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" required="" maxlength="32" type="text" name="cognome" class="form-control" placeholder="Cognome" value="">
                                        <span class="invalid-input" id="invalid-cognome"></span>
                                    </div>
                                    <div class="form-group">
                                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" required="" maxlength="100" type="mail" name="mail" class="form-control" placeholder="Indirizzo mail" value="">
                                        <span class="invalid-input" id="invalid-mail"></span>
                                    </div>
                                    <div class="form-group">
                                        <textarea onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" required="" maxlength="32" class="form-control" name="descrizione" placeholder="Parlaci di te" rows="3"></textarea>
                                        <span class="invalid-input" id="invalid-descrizione"></span>
                                    </div>
                                    <div class="form-group"> 
                                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" required="" type="text" class="form-control" id="citta_completamento" name="citta_completamento" value="" placeholder="Città" list="lista_citta">
                                        <span class="invalid-input" id="invalid-citta_completamento"></span>

                                        <datalist id="lista_citta">
                                            @foreach ($citta as $c)
                                            <option>{{$c->nome}}</option>
                                            @endforeach
                                        </datalist>
                                    </div>
                                    
                                    <div class="form-group">
                                        <input onkeyup="rimuovi_stile(this); password_lunghezza(this); abilita_conferma_password(this); strong_password(this); " onmouseover="rimuovi_stile(this)" required="" maxlength="100" type="password" id="password_nuova" name="password_nuova" class="form-control" placeholder="Password">
                                        <span class="invalid-input" id="invalid-password_nuova"></span>
                                        <br>
                                        <meter max="4" min="0" optimum="4" id="password-strength-meter"></meter>
                                        <p id="password-strength-text"></p>
                                    </div>
                                    
                                    <div class="form-group">
                                        <input disabled="" onkeyup="rimuovi_stile(this); password_uguali(this);" onmouseover="rimuovi_stile(this)" required="" maxlength="100" type="password" id="password_nuova2" name="password_nuova2" class="form-control" placeholder="Conferma Password">
                                        <span class="invalid-input" id="invalid-password_nuova2"></span>
                                    </div>
                                
                                    <div class="form-group"> 
                                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" type="text" class="form-control" id="consiglio" name="consiglio" value="" placeholder="Consiglio per il recupero della password" >
                                        <span class="invalid-input" id="invalid-citta_completamento"></span>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="register-submit" class="form-control btn btn-primary" value="Registrati" onclick="event.preventDefault(); register(this);">
                                            </div>
                                        </div>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
 @endsection               
<!--    </body>
</htm>-->
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
@extends('layouts.master')

@section('titolo', 'Login')

@section('header')
<h2 class="pull-left">Recupero Password</h2>
@endsection

@section('corpo')


        
        <div class="container"> 
            <div class="row" style="margin-top: 4em;"> <!-- unica riga--> <!-- margin top lo sposta in basso -->
                <div class="col-md-6 col-md-offset-3"> <!-- offset sposta a dx di 3 -->
                    
                    <div> <!-- costruzione tab -->
                        
                        <!--tab di navigazione  -->
                        
                        
                        <!--contenuto-->
                        <div class="tab-content"> 

                            <div style="margin-bottom: 2em;" hidden="false" class="col-md-12 alert alert-danger">
                                <ul id="ul_errori">
                                </ul>
                            </div>

                            <div style="margin-bottom: 2em;" hidden="false" class="col-md-12 alert alert-success">
                                <ul id="ul_conferme">
                                </ul>
                            </div>
                            
                                <form id="recupero_password_login" action="{{ route('user.update.password.login') }}" method="get" style="margin-top: 2em;"> <!-- invoca la stessa pagina con -->
                                @csrf
                                <div class="form-group row" id="div_mail">
                                    <div>

                                        <label for="username" class="col-form-label">Il tuo username</label>

                                    </div>
                                    <div class="col-sm-10">
                                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" maxlength="100" required="" type="text" class="form-control" name="username"  placeholder="Username">
                                        <span class="invalid-input" id="invalid-username"></span>
                                    </div>
                                    <div class="col-sm-2">
                                        <btn class="btn btn-default" id="btn_valida_mail" onclick="valida_username_login(this)">Invia</btn>
                                    </div>
                                </div>

                                <div class="form-group row" id="div_codice" hidden="">
                                    <div>
                                        <label for="codice"  class="col-form-label">Codice inviato</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input onkeyup="rimuovi_stile(this);" onmouseover="rimuovi_stile(this)" maxlength="100" required="" type="text" class="form-control" name="codice" placeholder="codice">
                                        <span class="invalid-input" id="invalid-codice"></span>
                                    </div>
                                    <div class="col-sm-2">
                                        <btn class="btn btn-default" id="btn_valida_codice" onclick="valida_codice_database(this)">Conferma codice</btn>
                                    </div>
                                </div>

                                <div class="form-group row" id="div_password" hidden="">
                                    <div class=>
                                        <label for="password_nuova" class="col-form-label">Nuova password</label>

                                    </div>
                                    <div class="col-sm-10">
                                        <input onkeyup="rimuovi_stile(this); strong_password(this); password_lunghezza(this) " onmouseover="rimuovi_stile(this)" maxlength="100" required="" type="password" class="form-control" name="password_nuova" placeholder="Nuova password">
                                        <span class="invalid-input" id="invalid-password_nuova"></span>
                                        <br>
                                        <meter max="4" min="0" optimum="4" id="password-strength-meter"></meter>
                                        <p id="password-strength-text"></p>
                                    </div>
                                </div>


                                <div class="form-group" id="div_submit" hidden="">
                                    <div class="col-sm-5">
                                        <label for="mySubmit" id="label_submit" class="btn btn-primary btn-large btn-block"><span class="glyphicon glyphicon-floppy-save"></span> Save</label>
                                        <input id="mySubmit" type="submit" name="btnsubmit" value="save" class="hidden" onclick="event.preventDefault(); valida_reset_password(this)"/>
                                    </div>
                                    <div class="col-sm-5">
                                        <a href="{{route('home')}}" class="btn btn-danger btn-large btn-block"><span class="glyphicon glyphicon-log-out"></span> Cancel</a>                         
                                    </div>
                                </div>
                                <div class="form-group"style="margin-top: 2em;">
                                    
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
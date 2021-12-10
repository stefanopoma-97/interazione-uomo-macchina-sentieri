@extends('layouts.master')

@section('titolo', 'Modifica utente')

@section('navbar_home')
<a class="navbar-brand" href="{{ route('home') }}">Sentieri</a>
@endsection


@section('navbar')
<li><a class="bordo-selezione" href="{{ route('sentiero.ricerca') }}">Sentieri</a></li>
<li><a class="bordo-selezione" href="{{ route('user.elenco') }}">Utenti</a></li>

    @if($logged)

    @if($user->admin == 'y')
    <li class="nav-item avatar dropdown">
        <a disable="" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            @if($count_revisioni==0)
            <!--<span class="badge badge-danger ml-2">{{$count_revisioni}}</span>-->
            <span class="material-icons">notifications_none</span>
            @else
            <!--<span style="background-color:red" class="badge badge-danger ml-2">{{$count_revisioni}}</span>-->
            <span class="material-icons">notifications_active</span>
            @endif
        </a>
        <ul class="dropdown-menu">
            @if($count_revisioni==0)
            <li><a class="dropdown-item waves-effect waves-light" href="{{ route('esperienza.darevisionare',  ['id'=> $user_id]) }}">Non ci sono commenti da revisionare <span class="badge badge-danger ml-2">{{$count_revisioni}}</span></a></li>
            @else
            <li><a class="dropdown-item waves-effect waves-light" href="{{ route('esperienza.darevisionare',  ['id'=> $user_id]) }}">Commenti da revisionare <span class="badge badge-danger ml-2">{{$count_revisioni}}</span></a></li>
            @endif
        </ul>
    </li>
    @else
    @endif

    <?php /*<li class="dropdown" style="margin-left: 5em;">
        <a class="btnsignin dropdown-toggle" href="#" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span></a>
        <ul class="dropdown-menu">
            <li><a href="{{ route('user.dettagli', ['id'=> $user_id]) }}">{{$user->nome}}</a></li>
            <li><a href="{{ route('user.preferiti', ['id'=> $user_id]) }}">Preferiti</a></li>
            @if($user->admin == 'y')
            <li><a href="{{ route('sentiero.index') }}">Lista sentieri</a></li>
            <li><a href="{{ route('esperienza.darevisionare',  ['id'=> $user_id]) }}">Revisioni</a></li>
            @else
            @endif
            <li><a href="{{ route('user.logout') }}">Log out</a></li>
        </ul>
    </li>*/ ?>

    <li class="dropdown" style="margin-left: 5em;">
        @if ($logged)
            @if ($user->admin == 'y')
                <a class="btnsignin dropdown-toggle" href="#" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-user">Admin:{{$user->nome}}</span>
                </a>
            @else
                <a class="btnsignin dropdown-toggle" href="#" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-user">Ciao {{$user->nome}}</span>
                </a>
            @endif

            <ul class="dropdown-menu">
                <li><a href="{{ route('user.dettagli', ['id'=> $user_id]) }}">{{$user->nome}}</a></li>
                <li><a href="{{ route('user.preferiti', ['id'=> $user_id]) }}">Preferiti</a></li>
                @if($user->admin == 'y')
                <li><a href="{{ route('sentiero.index') }}">Lista sentieri</a></li>
                <li><a href="{{ route('esperienza.darevisionare',  ['id'=> $user_id]) }}">Revisioni</a></li>
                @else
                @endif
                <li><a href="{{ route('user.logout') }}">Log out</a></li>
            </ul>
        @endif
    </li>

    @else
        <li style="margin-left: 5em;"><a class="btn btnlogin" href="{{ route('user.auth.login') }}"><span class="glyphicon glyphicon-log-in"></span> Accedi</a></li>
        <li><a class="btnsignin" href="{{ route('user.auth.register') }}"><span class="glyphicon glyphicon-user"></span> Registrati</a></li>

    @endif

@endsection

@section('sfondo')
@endsection


@section('header')
<h2 class="pull-left">Modifica Account</h2>
@endsection

@section('breadcrumb')
<ul class="breadcrumb pull-right">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a href="{{ route('user.elenco') }}">Utenti</a></li>
    <li><a href="{{ route('user.dettagli',['id'=> $user->id]) }}">Account</a></li>
    <li class="active">Modifica account</li>
</ul>
@endsection

@section('corpo')




<div class="container pt-5" style="margin-top: 5em;">
    <div class="row">
        <div style="margin-bottom: 2em;" hidden="" class="col-md-12 alert alert-danger">
            <ul id="ul_errori">
           </ul>
        </div>
        <div class='col-md-12'>
            <form class="form-horizontal" id="modifica_utente" name="modifica_utente" method="post" action="{{route('user.update',['id'=> $user->id])}}">
            @csrf
                <div class="form-group">
                    <div class="col-sm-2">
                        <label  for="nome" class="col-form-label">Nome</label>
                            <div style="margin-left: 1em;" class="popup" onclick="popup(this)" >
                                 <span class="popuptext">Inserisci il tuo nome, niente caratteri speciali o numeri</span>
                                <span class="glyphicon glyphicon-info-sign" ></span>
                            </div>
                    </div>

                    <div class="col-sm-10">
                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" required="" maxlength="32" class="form-control" type="text" id="nome" name="nome" placeholder="Nome" value="{{$user->nome}}">
                        <span class="invalid-input" id="invalid-nome"></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-2">
                        <label for="cognome" class="col-form-label">Cognome</label>
                            <div style="margin-left: 1em;" class="popup" onclick="popup(this)" >
                                 <span class="popuptext">Inserisci il tuo cognome, niente caratteri speciali o numeri</span>
                                <span class="glyphicon glyphicon-info-sign" ></span>
                            </div>
                    </div>
                    <div class="col-sm-10">
                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" required="" maxlength="32" class="form-control" type="text" id="cognome" name="cognome" placeholder="Cognome" value="{{$user->cognome}}">
                        <span class="invalid-input" id="invalid-cognome"></span>

                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-2">
                        <label for="username" class="col-form-label">Username</label>
                            <div style="margin-left: 1em;" class="popup" onclick="popup(this)" >
                                 <span class="popuptext">Inserisci un username, non deve esistere un utente con lo stesso username</span>
                                <span class="glyphicon glyphicon-info-sign" ></span>
                            </div>
                    </div>

                    <div class="col-sm-10">
                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" required="" maxlength="32" class="form-control" type="text" id="username" name="username" placeholder="Username" value="{{$user->username}}">
                        <span class="invalid-input" id="invalid-username"></span>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-2">
                        <label for="mail" class="col-form-label">Email</label>
                            <div style="margin-left: 1em;" class="popup" onclick="popup(this)" >
                                 <span class="popuptext">Inserisci una mail valida</span>
                                <span class="glyphicon glyphicon-info-sign" ></span>
                            </div>
                    </div>

                    <div class="col-sm-10">
                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" required="" maxlength="100" type="mail" class="form-control" name="mail" placeholder="Mail" value="{{$user->mail}}">
                        <span class="invalid-input" id="invalid-mail"></span>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-2">
                        <label for="descrizione" class="col-form-label">Descrizione</label>
                            <div style="margin-left: 1em;" class="popup" onclick="popup(this)" >
                                 <span class="popuptext">Inserisci una tua descrizione personale: attenzione puoi inserire fino a 1000 caratteri.</span>
                                <span class="glyphicon glyphicon-info-sign" ></span>
                            </div>
                    </div>

                    <div class="col-sm-10">
                        <textarea onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" required=""  class="form-control" id="descrizione" maxlength="1000" name="descrizione" placeholder="Parlaci di te..." rows="5">{{$user->descrizione}}</textarea>
                        <span class="invalid-input" id="invalid-descrizione"></span>
                    </div>
                </div>

<!--                <div class="form-group row">
                    <label for="citta" class="col-sm-2 col-form-label">Città</label>
                    <div class="col-sm-10">
                        <select onmouseover="rimuovi_stile(this)" required="true" class="form-control" id="citta" name="citta" >
                            @foreach ($citta as $c)
                                @if($c->id == $user->citta->id)
                                    <option value="{{$c->id}}" selected="selected">{{$c->nome}}</option>
                                @else
                                    <option value="{{$c->id}}">{{$c->nome}}</option>
                                @endif

                            @endforeach
                        </select>
                        <span class="invalid-input" id="invalid-citta"></span>
                    </div>
                </div>-->

                <div class="form-group row">
                    <div class="col-sm-2">
                        <label for="citta_completamento" class="col-form-label">Città</label>
                            <div style="margin-left: 1em;" class="popup" onclick="popup(this)" >
                                 <span class="popuptext">Seleziona una città tra le province italiane</span>
                                <span class="glyphicon glyphicon-info-sign" ></span>
                            </div>
                    </div>

                    <div class="col-sm-10">
                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" required="" type="text" class="form-control" id="citta_completamento" name="citta_completamento" value="{{$user->citta->nome}}"placeholder="Città" list="lista_citta">

                        <datalist id="lista_citta">
                            @foreach ($citta as $c)
                                <option>{{$c->nome}}</option>
                            @endforeach
                        </datalist>


                        <span class="invalid-input" id="invalid-citta_completamento"></span>
                    </div>
                </div>



                <div class="form-group row">
                    <a href="{{route('user.edit.password',['id'=> $user->id])}}">Modifica password</a>
                </div>

                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <input type="hidden" name="id" value="{{ $user_id }}"/>
                        <label for="mySubmit" class="btn btn-primary btn-large btn-block"><span class="glyphicon glyphicon-floppy-save"></span> Save</label>
                        <input id="mySubmit" type="submit" value="save" class="hidden" onclick="event.preventDefault(); valida_modifica_utente(this);"/>

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <a href="{{ route('user.dettagli',['id'=> $user_id]) }}" class="btn btn-danger btn-large btn-block"><span class="glyphicon glyphicon-log-out"></span> Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--<script>
    $("form#modifica_utente :input").each(function(){
        $(this).removeClass("border-red");
       })
    </script>-->
@endsection

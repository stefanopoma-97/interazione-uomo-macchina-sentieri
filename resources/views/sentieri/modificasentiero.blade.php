@extends('layouts.master')

@section('titolo', 'Aggiunta Modifica sentiero')

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
@if(isset($sentiero->id))
<h2 class="pull-left">Modifica Sentiero</h2>
@else
<h2 class="pull-left">Aggiungi Sentiero</h2>
@endif
@endsection

@section('breadcrumb')
<ul class="breadcrumb pull-right">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a href="{{ route('sentiero.index') }}">Elenco sentieri</a></li>
    @if(isset($sentiero->id))
    <li class="active">Modifica sentiero</li>
    @else
    <li class="active">Nuovo sentiero</li>
    @endif
</ul>
@endsection

@section('corpo')
<div class="container" style="margin-top: 5em;">

    @if(isset($sentiero->id))
    <div class="row pull-right">
        <div class="col-md-12">
            <button class="btn" onclick="location.href='{{ route('sentiero.immagini',['id' => $sentiero->id])}}'"><span class="glyphicon glyphicon-picture"></span> Gestisci immagini</button>
            <button class="btn" onclick="location.href='{{ route('sentiero.gpx',['id' => $sentiero->id])}}'"><span class="glyphicon glyphicon-map-marker"></span> Gestisci dati GPS</button>
        </div>
    </div>
    @else
    @endif

    <div class="row" style="margin-top: 2em;">
        <div class='col-md-12'>
            <div style="margin-bottom: 2em;" hidden="" class="col-md-12 alert alert-danger">
                <ul id="ul_errori">
                </ul>
            </div>
            @if(isset($sentiero->id))
            <form class="form-horizontal" name="sentiero" method="get" action="{{ route('sentiero.update', ['id' => $sentiero->id]) }}">
            @else
            <form class="form-horizontal" name="sentiero" method="post" action="{{ route('sentiero.store') }}">
            @endif
            @csrf

                <div class="form-group">
                    <label for="titolo" class="col-md-2">Titolo</label>
                    <div class="col-sm-10">
                        @if(isset($sentiero->id))
                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" maxlength="100" class="form-control" type="text" id="titolo" name="titolo" placeholder="Titolo" required="True" value="{{$sentiero->titolo}}">
                        @else
                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" maxlength="100" class="form-control" type="text" id="titolo" name="titolo" placeholder="Titolo" required="True" value="">
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="durata" class="col-md-2">Durata</label>
                    <div class="col-sm-10">
                        @if(isset($sentiero->id))
                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" class="form-control" type="number" pattern="^\d*(\.\d{0,2})?$" id="durata" required="True" name="durata" placeholder="Durata" value="{{$sentiero->durata}}">
                        @else
                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" maxlength="32" class="form-control" type="number" pattern="^\d*(\.\d{0,2})?$" id="durata" required="True" name="durata" placeholder="Durata">
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="descrizione" class="col-md-2">Descrizione</label>
                    <div class="col-sm-10">
                        @if(isset($sentiero->id))
                        <textarea onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" class="form-control" name="descrizione" id="descrizione" required="True" rows="10" placeholder="Descrizione">{{$sentiero->descrizione}}</textarea>
                        @else
                        <textarea onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" class="form-control" name="descrizione" id="descrizione" required="True" rows="10" placeholder="Descrizione"></textarea>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="lunghezza" class="col-sm-2 col-form-label">Lunghezza (km)</label>
                    <div class="col-sm-10">
                        @if(isset($sentiero->id))
                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)"  type="number" min="1.0" max="999.0" step="0.1" pattern="/^\d+(?:\.\d{1,2})?$/" class="form-control" id="lunghezza" required="True" name="lunghezza" placeholder="Lunghezza" value="{{$sentiero->lunghezza}}">
                        @else
                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)"  type="number" min="1.0" max="999.0" step="0.1" pattern="/^\d+(?:\.\d{1,2})?$/" class="form-control" id="lunghezza" required="True" name="lunghezza" placeholder="Lunghezza">
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="salita" class="col-sm-2 col-form-label">Salita</label>
                    <div class="col-sm-10">
                        @if(isset($sentiero->id))
                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" maxlength="5" type="number" min="1" max="10000" class="form-control" name="salita" required="True" id="salita" placeholder="Salita" value="{{$sentiero->salita}}">
                        @else
                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" maxlength="5" type="number" min="1" max="10000" class="form-control" name="salita" required="True" id="salita" placeholder="Salita">
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="discesa" class="col-sm-2 col-form-label">Discesa</label>
                    <div class="col-sm-10">
                        @if(isset($sentiero->id))
                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" maxlength="5" type="number" min="1" max="10000" class="form-control" name="discesa" required="True" id="discesa" placeholder="Discesa" value="{{$sentiero->salita}}">
                        @else
                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" maxlength="5" type="number" min="1" max="10000" class="form-control" name="discesa" required="True" id="discesa" placeholder="Discesa">
                        @endif
                    </div>

                </div>

                <div class="form-group row">
                    <label for="altezza_massima" class="col-sm-2 col-form-label">Altezza Massima</label>
                    <div class="col-sm-10">
                        @if(isset($sentiero->id))
                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" maxlength="5" type="number" min="1" max="10000" class="form-control" name="altezza_massima" required="True" id="altezza_massima" placeholder="Altezza massima" value="{{$sentiero->altezza_massima}}">
                        @else
                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" maxlength="5" type="number" min="1" max="10000" class="form-control" name="altezza_massima" required="True" id="altezza_massima" placeholder="Altezza massima">
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                   <label for="altezza_minima" class="col-sm-2 col-form-label">Altezza Minima</label>
                    <div class="col-sm-10">
                        @if(isset($sentiero->id))
                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" maxlength="5" type="number" min="1" max="10000" class="form-control" name="altezza_minima" required="True" id="altezza_minima" placeholder="Altezza minima" value="{{$sentiero->altezza_massima}}">
                        @else
                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" maxlength="5" type="number" min="1" max="10000" class="form-control" name="altezza_minima" required="True" id="altezza_minima" placeholder="Altezza minima">
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="difficolta" class="col-sm-2 col-form-label">Difficoltà</label>
                    <div class="col-sm-10">
                        <select onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" class="form-control" id="difficolta" name="difficolta" >
                            @foreach ($difficolta as $c)
                                @if(isset($sentiero->id))
                                    @if($c->id == $sentiero->difficolta->id)
                                        <option value="{{$c->id}}" selected="selected">{{$c->nome}}</option>
                                    @else
                                        <option value="{{$c->id}}">{{$c->nome}}</option>
                                    @endif
                                @else
                                    <option value="{{$c->id}}">{{$c->nome}}</option>
                                @endif

                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="categoria" class="col-sm-2 col-form-label">Categoria</label>
                    <div class="col-sm-10">
                        <select onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" class="form-control" id="categoria" name="categoria" >
                            @foreach ($categoria as $c)
                                @if(isset($sentiero->id))
                                    @if($c->id == $sentiero->categoria->id)
                                    <option value="{{$c->id}}" selected="selected">{{$c->nome}}</option>
                                    @else
                                    <option value="{{$c->id}}">{{$c->nome}}</option>
                                    @endif
                                @else
                                    <option value="{{$c->id}}">{{$c->nome}}</option>
                                @endif

                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="citta" class="col-sm-2 col-form-label">Città</label>
                    <div class="col-sm-10">
                        @if(isset($sentiero->id))
                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" required="" type="text" class="form-control" id="citta" name="citta" value="{{$sentiero->citta->nome}}" placeholder="Città" list="lista_citta">
                        @else
                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" required="" type="text" class="form-control" id="citta" name="citta" value="" placeholder="Città" list="lista_citta">
                        @endif

                        <datalist id="lista_citta">
                            @foreach ($citta as $c)
                                <option>{{$c->nome}}</option>
                            @endforeach
                        </datalist>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        @if(isset($sentiero->id))
                            <input type="hidden" name="id" value="{{$sentiero->id}}"/>
                            <label for="mySubmit" class="btn btn-primary btn-large btn-block"><span class="glyphicon glyphicon-floppy-save"></span> Salva</label>
                            <input id="mySubmit" onclick="event.preventDefault(); valida_modifica_sentiero(this,true);" type="submit" value="save" class="hidden"/>
                        @else
                            <label for="mySubmit" class="btn btn-primary btn-large btn-block"><span class="glyphicon glyphicon-floppy-save"></span> Crea</label>
                            <input id="mySubmit" onclick="event.preventDefault(); valida_modifica_sentiero(this,false);" type="submit" value="save" class="hidden"/>
                        @endif

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <a href="{{route('sentiero.index')}}" class="btn btn-danger btn-large btn-block"><span class="glyphicon glyphicon-log-out"></span> Cancella</a>
                    </div>
                </div>

            </form>
        </div>





    </div>


</div>

@endsection

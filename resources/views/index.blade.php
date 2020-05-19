@extends('layouts.master')

@section('titolo', 'Sentieri APP')

@section('navbar_home')
<ul class="nav navbar-nav">
    <li class="active-soft"><a href="{{ route('home') }}">Home</a></li>
</ul>
@endsection


@section('navbar')
<li><a class="bordo-selezione" href="{{ route('sentiero.ricerca') }}">Sentieri</a></li>
<li><a class="bordo-selezione" href="{{ route('user.elenco') }}">Utenti</a></li>

    @if($logged)
    <li class="dropdown" style="margin-left: 5em;">
        <a class="btnsignin dropdown-toggle" href="#" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span></a>
        <ul class="dropdown-menu">
            <li><a href="{{ route('user.dettagli', ['id'=> $user_id]) }}">Account</a></li>
            <li><a href="{{ route('user.preferiti', ['id'=> $user_id]) }}">Preferiti</a></li>
            @if($user->admin == 'y')
            <li><a href="{{ route('user.elenco') }}">Lista utenti</a></li>
            <li><a href="{{ route('sentiero.index') }}">Lista sentieri</a></li>
            @else
            @endif
            <li><a href="{{ route('user.logout') }}">Log out</a></li>
        </ul>
    </li>
    @else
        <li style="margin-left: 5em;"><a class="btn btnlogin" href="{{ route('user.auth.login') }}"><span class="glyphicon glyphicon-log-in"></span> Accedi</a></li>
        <li><a class="btnsignin" href="{{ route('user.auth.register') }}"><span class="glyphicon glyphicon-user"></span> Registrati</a></li>

    @endif

@endsection

@section('sfondo')
    
    <!-- sfondo montagne con tasto ricerca-->
        <div class="container" style="margin-top: 5em;">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="jumbotron">
                    <h1 class="display-5 text-white text-center">Scopri la tua prossima esperienza</h1>
                    <p class="lead text-white text-center">Cerca tra i nostri percorsi per trovare quello giusto per te</p>
                    <div class="text-center col-xs-12 pb-5">
                        
                        <form class="form-inline" name="form_ricerca" method="get" action="sentieri.php">
                            <div class="form-group ">
                                <div>
                                    <input class="form-control" type="text" id="ricerca" name="ricerca" placeholder="Cerca">
                                </div>
                            </div>
                            
                            <div class="form-group pl-3">
                                <div>
                                    <button type="submit" class="btn btn-primary">Cerca</button>
                                    <input id="mySubmit" type="submit" value='Save' class="hidden"/>                         
                                </div>
                            </div>
                           
                            
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
@endsection


@section('header')
<h1>
    Esplora
</h1>
@endsection

@section('breadcrumb')
@endsection

@section('corpo')
<!-- elenco suggerimenti-->
        <div class="container">
            <div class="row">
                        
                        <div class="col-sm-12 col-xs-12">
                            
                            <div id="consigli-tab">
                                
                                <!-- tab della nav tabs-->
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab-1" data-toggle="tab">Aggiunti di recente</a></li>
                                    <li><a href="#tab-2" data-toggle="tab">I più votati</a></li>
                                    <li><a href="#tab-3" data-toggle="tab">Consigliati per te</a></li>
                                    <li><a href="#tab-4" data-toggle="tab">Preferiti</a></li>
                                </ul>
                                
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-1">
                                        <div class="container">
                                            <div class="row">
                                            @foreach($sentieri_recenti as $sentiero)
                                                <div class="col-m-3 col-sm-3 col-xs-12">
                                                    <ul class="list-group">
                                                        <li class="list-group-item "><h4>{{ $sentiero->titolo }}</h4></li>
                                                        <li class="list-group-item "><strong>{{ $sentiero->categoria->nome }}</strong></li>
                                                        <li style="height: 50px" class="list-group-item "><q>{{ $sentiero->descrizione }}</q></li>
                                                        <li class="list-group-item "><span class="glyphicon glyphicon-time"></span>   {{ $sentiero->durata }}</li>
                                                        <li class="list-group-item "><span class="glyphicon glyphicon-repeat"></span>   {{ $sentiero->lunghezza }}</li>
                                                        <li class="list-group-item "><span class="glyphicon glyphicon-chevron-up"></span>   {{ $sentiero->salita }}</li>
                                                        <li class="list-group-item "><span class="glyphicon glyphicon-chevron-down"></span>   {{ $sentiero->discesa }}</li>
                                                        <li class="list-group-item "><a class="btn btn-info btn-block btn-round-bottom" href="sentiero.html" role="button">Dettagli</a></li>
                                                    </ul>
                                                </div>
                                            @endforeach
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="tab-pane" id="tab-2">
                                        @foreach($sentieri_piu_votati as $sentiero)
                                                <div class="col-m-3 col-sm-3 col-xs-12">
                                                    <ul class="list-group">
                                                        <li class="list-group-item "><h4>{{ $sentiero->titolo }}</h4></li>
                                                        <li class="list-group-item "><strong>Media voti: {{ $sentiero->mediavoti }}</strong></li>
                                                        <li style="height: 50px" class="list-group-item "><q>{{ $sentiero->descrizione }}</q></li>
                                                        <li class="list-group-item "><span class="glyphicon glyphicon-time"></span>   {{ $sentiero->durata }}</li>
                                                        <li class="list-group-item "><span class="glyphicon glyphicon-repeat"></span>   {{ $sentiero->lunghezza }}</li>
                                                        <li class="list-group-item "><span class="glyphicon glyphicon-chevron-up"></span>   {{ $sentiero->salita }}</li>
                                                        <li class="list-group-item "><span class="glyphicon glyphicon-chevron-down"></span>   {{ $sentiero->discesa }}</li>
                                                        <li class="list-group-item "><a class="btn btn-info btn-block btn-round-bottom" href="sentiero.html" role="button">Dettagli</a></li>
                                                    </ul>
                                                </div>
                                            @endforeach
                                    </div>
                                    <div class="tab-pane" id="tab-3">
                                        @if ($logged)
                                            @if (count($sentieri_consigliati) == 0)
                                                <p><h3 class="text-center">Sembra ci siano ancora sentieri nella tua città</h3></p>
                                            @else

                                                @foreach($sentieri_consigliati as $sentiero)
                                                    <div class="col-m-3 col-sm-3 col-xs-12">
                                                        <ul class="list-group">
                                                            <li class="list-group-item "><h4>{{ $sentiero->titolo }}</h4></li>
                                                            <li class="list-group-item "><strong>Città: {{ $sentiero->citta->nome }}</strong></li>
                                                            <li style="height: 50px" class="list-group-item "><q>{{ $sentiero->descrizione }}</q></li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-time"></span>   {{ $sentiero->durata }}</li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-repeat"></span>   {{ $sentiero->lunghezza }}</li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-chevron-up"></span>   {{ $sentiero->salita }}</li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-chevron-down"></span>   {{ $sentiero->discesa }}</li>
                                                            <li class="list-group-item "><a class="btn btn-info btn-block btn-round-bottom" href="sentiero.html" role="button">Dettagli</a></li>
                                                        </ul>
                                                    </div>
                                                @endforeach
                                            @endif
                                        @else
                                        <p><h3 class="text-center">Effettua il login per visualizzare questa sezione</h3></p>

                                        @endif
                                    </div>
                                    <div class="tab-pane" id="tab-4">
                                        @if ($logged)
                                            @if (count($sentieri_preferiti) == 0)
                                                <p><h3 class="text-center">Sembra che tu non abbia selezionato nessun preferito</h3></p>
                                            @else
                                                @foreach($sentieri_preferiti as $sentiero)
                                                    <div class="col-m-3 col-sm-3 col-xs-12">
                                                        <ul class="list-group">
                                                            <li class="list-group-item "><h4>{{ $sentiero->titolo }}</h4></li>
                                                            <li class="list-group-item "><strong>{{ $sentiero->categoria->nome }}</strong></li>
                                                            <li style="height: 50px" class="list-group-item "><q>{{ $sentiero->descrizione }}</q></li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-time"></span>   {{ $sentiero->durata }}</li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-repeat"></span>   {{ $sentiero->lunghezza }}</li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-chevron-up"></span>   {{ $sentiero->salita }}</li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-chevron-down"></span>   {{ $sentiero->discesa }}</li>
                                                            <li class="list-group-item "><a class="btn btn-info btn-block btn-round-bottom" href="sentiero.html" role="button">Dettagli</a></li>
                                                        </ul>
                                                    </div>
                                                @endforeach
                                            @endif
                                        @else
                                        <p><h3 class="text-center">Effettua il login per visualizzare questa sezione</h3></p>

                                        @endif
                                        
                                    </div>
                            </div>
                        </div><!-- /.col-sm-7 -->
                    </div><!-- /.row -->
            </div>
        </div>
@endsection
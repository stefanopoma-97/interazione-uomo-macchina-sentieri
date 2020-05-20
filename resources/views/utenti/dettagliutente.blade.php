@extends('layouts.master')

@section('titolo', 'Elenco utenti')

@section('navbar_home')
<a class="navbar-brand" href="{{ route('home') }}">Sentieri</a>
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
@endsection


@section('header')
<h2 class="pull-left">Dettagli utente: {{$user_dettagli->username}}</h2>
@endsection

@section('breadcrumb')
<ul class="breadcrumb pull-right">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a href="{{ route('user.elenco') }}">Utenti</a></li>
    <li class="active">Utente</li>
</ul>
@endsection

@section('corpo')
<div class="container pt-5" style="margin-top: 2em;">

    <div class="row">

        <div class="col-md-5">
            <div>                            
                <img alt="image" height="120px"class="img-circle" src="https://bootdey.com/img/Content/avatar/avatar1.png">
                <h3><strong>{{ $user_dettagli->username }}</strong>
                    
                </h3>
                
                <div class="col-m-12 col-sm-12">
                    <ul class="list-group ">
                        <li class="list-group-item"><q>Nome: {{ $user_dettagli->nome }}</q></li>
                        <li class="list-group-item ">Cognome: {{ $user_dettagli->cognome }}</li>
                        @if($user->id == $user_dettagli->id)
                        <li class="list-group-item ">Città: {{ $user_dettagli->citta->nome }}</li>
                        <li class="list-group-item ">Mail: {{ $user_dettagli->mail }}</li>
                        @else
                        @endif
                        <li class="list-group-item ">Percorsi effettuati: {{ count($user_dettagli->esperienze) }}</li>
                        <li class="list-group-item ">Preferiti: <a href="sentieri.html">{{ count($user_dettagli->preferiti) }}</a></li>
                        <li class="list-group-item ">{{$user_dettagli->descrizione}}</li>
                        @if ($user_dettagli->id == $user_id)
                            <li class="list-group-item "><a class="btn btn-info btn-block btn-round-bottom" href="{{ route('user.edit', ['id'=> $user_id]) }}" role="button">Modifica</a></li>
                        @endif

                    </ul>
                </div>

            </div>
        </div>

        <div class="col-md-6 ">
            <h3 style="margin-bottom: 2em;">Ultimi percorsi effettuati:</h3>
            @foreach ($sentieri_effettuati as $sentiero)
            <div class="card" style="margin-bottom: 1em;">

                <div class="card-header text-center">
                    <h4 class="card-title">{{ $sentiero->titolo }}<span style="margin-left: 1em;"class="badge badge-secondary">{{ $sentiero->durata }} h</span></h4> 
                </div>

                <div class="card-body text_padding_card" style="margin-top: 1em;">
                    <h5 class="card-subtitle text-muted pb-3 overflow-text">{{ $sentiero->descrizione }}</h5>
                    <div style="margin-top: 1em;">
                        <div style="margin-top: 1em;" class="d-inline"><span class="glyphicon glyphicon-repeat"></span>   {{ $sentiero->lunghezza }} km</div>
                        <div style="margin-top: 1em;" class="d-inline"><span class="glyphicon glyphicon-chevron-down"></span>   {{ $sentiero->discesa }}</div>
                        <div style="margin-top: 1em;" class="d-inline"><span class="glyphicon glyphicon-chevron-up"></span>   {{ $sentiero->salita }}</div>
                    </div>
                    <div class=" pull-right ">
                        <a class="card-link" href="{{route('sentiero.show',['sentiero'=>$sentiero->id])}}">Scopri</a>
                    </div>

                </div>
            </div>
            @endforeach

        </div>

    </div>
</div>




<div class="container">
    <div class="row" style="margin-bottom: 3em;">
        <div class="col-md-3">
            <div class="header-sezione">
                <h3 class="pull-left">Esperienze personali</h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="container horizontal-scrollable">
                <div class="row">
                    @foreach ($sentieri_effettuati as $sentiero)
                    <div class="col-m-3 col-sm-3">
                        <ul class="list-group ">
                            <li class="list-group-item "><h4>{{ $sentiero->titolo }}</h4></li>
                            <li style="height: 100px" class="list-group-item"><q>{{ $sentiero->descrizione }}</q></li>
                            <li class="list-group-item ">Difficoltà:   {{ ($sentiero->esperienze->where('utente_id', $user_dettagli->id)->first())->difficolta }}</li>
                            <li class="list-group-item ">Voto:   {{ ($sentiero->esperienze->where('utente_id', $user_dettagli->id)->first())->voto }}</li>
                            <li class="list-group-item "><a class="btn btn-info btn-block btn-round-bottom" href="{{route('sentiero.show',['sentiero'=>$sentiero->id])}}" role="button">Dettagli</a></li>
                        </ul>
                    </div>
                    @endforeach
                    
                </div>
                <div class="row">
                    <div class="col-md-3 pull-right">
                        <ul class="pagination">
                            <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
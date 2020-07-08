
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
    
    <li class="dropdown" style="margin-left: 5em;">
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
    </li>
    
    
    
    @else
        <li style="margin-left: 5em;"><a class="btn btnlogin" href="{{ route('user.auth.login') }}"><span class="glyphicon glyphicon-log-in"></span> Accedi</a></li>
        <li><a class="btnsignin" href="{{ route('user.auth.register') }}"><span class="glyphicon glyphicon-user"></span> Registrati</a></li>

    @endif
    

    
          
<!--    <li><a href="{{ route('home', ['lang' => 'en']) }}" class="nav-link"><img src="{{ url('/') }}/img/flags/en.png" width="40"/></a></li>
    <li><a href="{{ route('home', ['lang' => 'it']) }}" class="nav-link"><img src="{{ url('/') }}/img/flags/it.png" width="40"/></a></li>-->

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
                        
                        <form class="form-inline" name="form_ricerca" method="get" action="{{route('sentiero.ricercafiltrahome')}}">
                            <div class="form-group ">
                                <div>
                                    <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" class="form-control" type="text" id="ricerca" name="ricerca" placeholder="Cerca">
                                </div>
                            </div>
                            
                            <div class="form-group pl-3">
                                <div>
                                    <button type="submit"onclick="event.preventDefault(); valida_ricerca_home(this);"  class="btn btn-primary">Cerca</button>
                                    <input id="mySubmit" onclick="event.preventDefault(); valida_ricerca_home(this);" type="submit" value='Save' class="hidden"/>                         
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
                                            @if (count($sentieri_recenti) == 0)
                                                <p><h3 class="text-center">Non sono ancora stati inseriti sentieri</h3></p>
                                            @else
                                                @foreach($sentieri_recenti as $sentiero)
                                                    <div class="col-m-3 col-sm-3 col-xs-12">
                                                        <ul class="list-group">
                                                            <li class="list-group-item "><h4>{{ $sentiero->titolo }}</h4></li>
                                                            <li class="list-group-item "><strong>{{ $sentiero->categoria->nome }}</strong></li>
                                                            <li style="height: 50px" class="list-group-item "><q>{{ $sentiero->descrizione }}</q></li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-time"></span>   {{ $sentiero->durata }} ore</li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-repeat"></span>   {{ $sentiero->lunghezza }} Km</li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-chevron-up"></span>   {{ $sentiero->salita }} m</li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-chevron-down"></span>   {{ $sentiero->discesa }} m</li>
                                                            <li class="list-group-item "><a class="btn btn-info btn-block btn-round-bottom" href="{{route('sentiero.show',['sentiero'=>$sentiero->id])}}" role="button">Dettagli</a></li>
                                                        </ul>
                                                    </div>
                                                @endforeach
                                            @endif
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="tab-pane" id="tab-2">
                                        @if (count($sentieri_piu_votati) == 0)
                                                <p><h3 class="text-center">Sembra nessuno abbia ancora lasciato dei voti</h3></p>
                                        @else
                                            @foreach($sentieri_piu_votati as $sentiero)
                                                    <div class="col-m-3 col-sm-3 col-xs-12">
                                                        <ul class="list-group">
                                                            <li class="list-group-item "><h4>{{ $sentiero->titolo }}</h4></li>
                                                            <li class="list-group-item "><strong>Media voti: {{ $sentiero->mediavoti }}</strong></li>
                                                            <li style="height: 50px" class="list-group-item "><q>{{ $sentiero->descrizione }}</q></li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-time"></span>   {{ $sentiero->durata }} ore</li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-repeat"></span>   {{ $sentiero->lunghezza }}Km</li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-chevron-up"></span>   {{ $sentiero->salita }}m</li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-chevron-down"></span>   {{ $sentiero->discesa }}m</li>
                                                            <li class="list-group-item "><a class="btn btn-info btn-block btn-round-bottom" href="{{route('sentiero.show',['sentiero'=>$sentiero->id])}}" role="button">Dettagli</a></li>
                                                        </ul>
                                                    </div>
                                                @endforeach
                                        @endif
                                    </div>
                                    <div class="tab-pane" id="tab-3">
                                        @if ($logged)
                                            @if (count($sentieri_consigliati) == 0)
                                                <p><h3 class="text-center">Sembra non ci siano ancora sentieri nella tua città</h3></p>
                                            @else

                                                @foreach($sentieri_consigliati as $sentiero)
                                                    <div class="col-m-3 col-sm-3 col-xs-12">
                                                        <ul class="list-group">
                                                            <li class="list-group-item "><h4>{{ $sentiero->titolo }}</h4></li>
                                                            <li class="list-group-item "><strong>Città: {{ $sentiero->citta->nome }}</strong></li>
                                                            <li style="height: 50px" class="list-group-item "><q>{{ $sentiero->descrizione }}</q></li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-time"></span>   {{ $sentiero->durata }} ore</li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-repeat"></span>   {{ $sentiero->lunghezza }} Km</li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-chevron-up"></span>   {{ $sentiero->salita }} m</li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-chevron-down"></span>   {{ $sentiero->discesa }} m</li>
                                                            <li class="list-group-item "><a class="btn btn-info btn-block btn-round-bottom" href="{{route('sentiero.show',['sentiero'=>$sentiero->id])}}" role="button">Dettagli</a></li>
                                                        </ul>
                                                    </div>
                                                @endforeach
                                            @endif
                                        @else
                                        <p><h3 class="text-center">Effettua il <a href="{{ route('user.auth.login') }}">login</a> per visualizzare questa sezione</h3></p>

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
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-time"></span>   {{ $sentiero->durata }} ore</li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-repeat"></span>   {{ $sentiero->lunghezza }} Km</li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-chevron-up"></span>   {{ $sentiero->salita }} m</li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-chevron-down"></span>   {{ $sentiero->discesa }} m</li>
                                                            <li class="list-group-item "><a class="btn btn-info btn-block btn-round-bottom" href="{{route('sentiero.show',['sentiero'=>$sentiero->id])}}" role="button">Dettagli</a></li>
                                                        </ul>
                                                    </div>
                                                @endforeach
                                            @endif
                                        @else
                                        <p><h3 class="text-center">Effettua il <a href="{{ route('user.auth.login') }}">login</a> per visualizzare questa sezione</h3></p>

                                        @endif
                                        
                                    </div>
                            </div>
                        </div><!-- /.col-sm-7 -->
                    </div><!-- /.row -->
            </div>
        </div>
<!--<div class="container">
    @foreach ($users as $user)
    <div class="row">{{ $user->titolo }}</div>
    @endforeach
</div>




<!--<iframe frameBorder="0" scrolling="no" src="https://www.wikiloc.com/wikiloc/spatialArtifacts.do?event=view&id=1547196&measures=on&title=off&near=on&images=off&maptype=H" width="500" height="400"></iframe>
<div style="color:#777;font-size:11px;line-height:16px;"></div>-->
<!--
<div style="max-width:60em;" id="map"></div>

<div class="container" >
    <div class="row">
        <div class="col-md-5 col-md-offset-1">
            <div class="col-md-12" id="elevation-div"></div>
        </div>
    </div>
</div>
<script>
    mappa("map", "elevation-div", "http://localhost:8000/storage/gpx/11", true);
</script>-->

@endsection
@extends('layouts.master')

@section('titolo', 'Esperienzesentiero')

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
    

@endsection

@section('sfondo')
@endsection


@section('header')
<h2 class="pull-left">Esperienze Sentiero: {{$sentiero->titolo}}</h2>
@endsection

@section('breadcrumb')
<ul class="breadcrumb pull-right">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a href="{{ route('sentiero.ricerca') }}">Sentieri</a></li>
    <li><a href="{{route('sentiero.show',['sentiero'=>$sentiero->id])}}">Sentiero</a></li>
    <li class="active">Esperienze</li>
</ul>
@endsection

@section('corpo')
<div class="container" style="margin-top: 3em;">
    <div class="row">
        <div class="col-md-12 col-s-12">
            
            @php
            include(app_path().'/funzioni.php');
            @endphp
            @foreach ($esperienze as $esperienza)
            
            <div class="col-md-12" style="margin-bottom: 2em">
                <h3>
                    @php
                    $url = getFotoProfilo($esperienza->utente->id);
                    echo '<span style="display:inline-block;margin-right:5px; "><img alt="image" style="height: 35px; width:35px;"class="img-circle img-responsive " src="'.$url.'"></span>';
                    @endphp
                    
                    <span style="display:inline-block; align-content: center"><a style="color:inherit; text-decoration: none;" href="{{ route('user.dettagli',['id'=> $esperienza->utente->id]) }}">{{$esperienza->utente->username}}</a></span>
                </h3>
                    
                
                <div class="wrap">
                    <?php 
                        for ($i=0; $i<$esperienza->voto; $i++)
                        {
                            echo '<i class="fa fa-star" aria-hidden="true"></i>';
                        }
                        $vuote=10-$esperienza->voto;
                        for ($i=0; $i<$vuote; $i++){
                            echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
                        }
                    
                    ?>
                  </div>
                <br>
                <p style="font-size: small">Sentiero percorso il: {{$esperienza->data}}</p>
                <blockquote>
                    <p style="font-size: medium">{{$esperienza->commento}}</p>
                    <small><cite title="Source Title">Difficoltà: {{$esperienza->difficolta}}</cite></small>
                    <small><cite title="Source Title">Voto: {{$esperienza->voto}}</cite></small>
                </blockquote>
            </div>

            @endforeach
            {{ $esperienze->links() }}
        </div>
        
    </div>

<!--    <div class="row">
        <div class="col-md-3 pull-right">
            <ul class="pagination">
                <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </div>

    </div>-->
</div>
                 
@endsection
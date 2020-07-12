@extends('layouts.master')

@section('titolo', 'Elenco utenti')

@section('navbar_home')
<a class="navbar-brand" href="{{ route('home') }}">Gpx</a>
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
<h2 class="pull-left">Aggiunta immagini: {{$sentiero->titolo}}</h2>
@endsection

@section('breadcrumb')
<ul class="breadcrumb pull-right">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a href="{{ route('sentiero.index')  }}">Elenco sentieri</a></li>
    <li><a href="{{ route('sentiero.edit', ['sentiero'=> $sentiero->id]) }}">Modifica sentiero</a></li>
    <li class="active">Utente</li>
</ul>
@endsection

@section('corpo')

<div class="row col-md-12">
        <div class="col-md-1 col-md-offset-9">
            <button class="btn" onclick="location.href='{{ route('sentiero.edit', ['sentiero'=> $sentiero->id]) }}'"><span class="glyphicon glyphicon-save"></span> Salva e torna alle modifiche</button>
        </div>
</div>
 <div style="margin-top: 3em;" class="container">
     <div class="row display-flex">
         
         <div class="col-xs-6 col-sm-4 col-sm-offset-4">
             <div class="text-center box-progetto">
                 <h5 for="gpx" class="col-form-label"><strong>File GPX</strong>
                     <div style="margin-left: 1em;" class="popup" onclick="popup(this)" >
                         <span class="popuptext">Filie .gpx, Masssimo 2 MB</span>
                         <span class="glyphicon glyphicon-info-sign" ></span>
                     </div>
                 </h5>


                 <form action="{{route('sentiero.aggiungigpx',['id'=> $sentiero->id])}}" id="aggiungi_gpx" name="aggiungi_gpx" method="POST" enctype="multipart/form-data"> {{ csrf_field() }}

                     <div class="form-group">
                         <div style="margin-top: 1em; margin-bottom: 1em" class="col-sm-12">
                             <input onchange="size_immagine(this)"; onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)"class="form-control" type="file" id="gpx" name="gpx" placeholder="gpx">
                             <span class="invalid-input" id="invalid-gpx"></span>
                         </div>
                         <div class="col-sm-2 col-sm-offset-2">
                             <input type="hidden" name="nome_input" value="gpx"/>
                             <input type="hidden" name="nome_file" value="gpx"/>
                             <label for="mySubmit" class="btn btn-primary btn-large btn-info"><span class="glyphicon glyphicon-floppy-save"></span> Carica</label>
                             <input onclick="event.preventDefault(); check_gpx(this);"  id="mySubmit" type="submit" value="save" class="hidden"/>
                         </div>


                     </div>

                 </form>
                 @if($gpx!="")
                 <button class="btn btn-danger" onclick="location.href='{{route('sentiero.rimuovigpx',['id'=> $sentiero->id])}}'"><span class="glyphicon glyphicon-trash"></span</button>
                 @else
                 <button disabled="" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span</button>
                 @endif


             </div>
         </div><!-- /.col-sm-3 -->
</div><!-- /.row -->
     <div style="margin-top: 2em;" class="row">
         <div  hidden="" class="col-md-12 alert alert-danger">
             <ul id="messaggi_errore">
             </ul>
         </div>
         <div  hidden="" class="col-md-12 alert alert-success">
             <ul id="messaggi_conferma">
             </ul>
         </div>
     </div>

 </div>

@if($gpx!="")
<p></p>
@else
<h3 class="text-center" >Non sono presenti dati</h3>
@endif
<div class="container" id="map"></div>

<br>
<br>


<script>
    mappa("map", "elevation-div", '{{$gpx}}', false);
</script>

<!--<div style="margin-top: 3em;" class="container">
    <div class="row">
        <div class="col-md-10">
            <button class="btn btn-info"><span class="glyphicon glyphicon-save">Salva</span</button>
        </div>
    </div>
</div>-->





@endsection

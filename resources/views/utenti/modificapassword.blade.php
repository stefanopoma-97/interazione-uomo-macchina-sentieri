@extends('layouts.master')

@section('titolo', 'Modifica utente')

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
<h2 class="pull-left">Modifica Password</h2>
@endsection

@section('breadcrumb')
<ul class="breadcrumb pull-right">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a href="{{ route('user.elenco') }}">Utenti</a></li>
    <li class="active">Modifica password</li>
</ul>
@endsection

@section('corpo')
<div class="container pt-5" style="margin-top: 5em;">
    <div class="row">
        <div class='col-md-12'>
            <form class="form-horizontal" id="modifica_password" name="modifica_password" method="post" action="{{route('user.update',['id'=> $user->id])}}">
            @csrf
                <div class="form-group row">
                    <a href="#">Modifica password</a>
                </div>
                <div class="form-group row">
                    <label for="password_precedente" class="col-sm-2 col-form-label">Password precedente</label>
                    <div class="col-sm-10">
                        <input maxlength="100" type="password" class="form-control"  placeholder="Password attuale">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password_nuova" class="col-sm-2 col-form-label">Nuova password</label>
                    <div class="col-sm-10">
                        <input maxlength="100" type="password" class="form-control" placeholder="Nuova password">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password_nuova2" class="col-sm-2 col-form-label">Ripeti la password</label>
                    <div class="col-sm-10">
                        <input maxlength="100" type="password" class="form-control" placeholder="Ripeti la password">
                    </div>
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
                        <a href="{{route('user.elenco')}}" class="btn btn-danger btn-large btn-block"><span class="glyphicon glyphicon-log-out"></span> Cancel</a>                         
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

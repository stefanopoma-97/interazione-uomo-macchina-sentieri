@extends('layouts.master')

@section('titolo', 'Elenco utenti')

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

    {{--<li class="dropdown" style="margin-left: 5em;">
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
    </li>--}}

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
<h2 class="pull-left">Elenco utenti</h2>
@endsection

@section('breadcrumb')
<ul class="breadcrumb pull-right">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li class="active">Utenti</li>
</ul>
@endsection

@section('corpo')
<!-- tabella utenti-->
<div class="container" style="margin-top: 3em;">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <table id="tabella_elenco_utenti" class="table table-striped table-hover table-responsive  table-sm" style="width:100%" data-toggle="table" data-search="true" data-show-columns="true" >
                <col width='30%'>
                <col width='30%'>
                <col width='30%'>
                <col width='10%'>
                <thead>
                    <tr class="table-bordered">
                        <th data-sortable="true" class="th-sm ">Username</th>
                        <th data-sortable="true" class="th-sm ">Nome</th>
                        <th data-sortable="true" class="th-sm ">Cognome</th>
                        <th class="th-sm" data-sortable="false"></th>
                    </tr>
                </thead>

                <tbody>
                     @foreach($users as $user)
                    <tr>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->nome }}</td>
                        <td>{{ $user->cognome }}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('user.dettagli',['id'=> $user->id]) }}"><span class="glyphicon glyphicon-info-sign"></span> Info</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th class="th-sm table-bordered">Username</th>
                        <th class="th-sm table-bordered">Nome</th>
                        <th class="th-sm table-bordered">Cognome</th>
                        <th class="th-sm table-bordered"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>
@endsection

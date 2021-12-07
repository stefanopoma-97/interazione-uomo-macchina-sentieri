@extends('layouts.master')

@section('titolo', 'Esperienze utente')

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
<h2 class="pull-left">Esperienze personali</h2>
@endsection

@section('breadcrumb')
<ul class="breadcrumb pull-right">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a class="bordo-selezione" href="{{ route('user.elenco') }}">Utenti</a></li>
    <li><a href="{{ route('user.dettagli', ['id'=> $utente_id]) }}">Account</a></li>
    <li class="active">Esperienze</li>
</ul>
@endsection

@section('corpo')
<!-- tabella utenti-->
<div class="container" style="margin-top: 3em;">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <table id="tabella_elenco_utenti" class="table table-striped table-hover table-responsive  table-sm" style="width:100%" data-toggle="table" data-search="true" data-show-columns="true" >
                <col width='20%'>
                <col width='20%'>
                <col width='10%'>
                <col width='35%'>
                <col width='15%'>
                <thead>
                    <tr class="table-bordered">
                        <th data-sortable="true" class="th-sm ">Sentiero</th>
                        <th data-sortable="true" class="th-sm ">Data</th>
                        <th data-sortable="true" class="th-sm ">Voto</th>
                        <th data-sortable="true" class="th-sm ">Commento</th>
                        <th data-sortable="true" class="th-sm ">Stato</th>
                    </tr>
                </thead>

                <tbody>
                     @foreach($esperienze as $esperienze)
                    <tr>
                        <td><a style="color:inherit; text-decoration: none;" href="{{route('sentiero.show',['sentiero'=>$esperienze->sentiero->id])}}">{{ $esperienze->sentiero->titolo }}</a></td>
                        <td>{{ $esperienze->data }}</td>
                        <td>{{ $esperienze->voto }}</td>
                        <td>{{ $esperienze->commento }}</td>
                        @if($esperienze->stato=='rifiutato')
                        <td style="color:#da0000"><strong>{{ $esperienze->stato }}</strong>
                            <div style="margin-left: 1em;" class="popup" onclick="popup(this)">
                                @if($esperienze->nota == "")
                                <span class="popuptext">Non è stata inserita nessuna nota dal moderatore</span>
                                @else
                                <span class="popuptext">{{$esperienze->nota}}</span>
                                @endif

                                <span class="glyphicon glyphicon-info-sign" ></span>
                            </div>
                        </td>
                        @else
                            @if($esperienze->stato=='approvato')
                            <td style="color:green"><strong>{{ $esperienze->stato }}</strong>
                            @else
                            <td>{{ $esperienze->stato }}</td>
                            @endif

                        @endif
                    </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th data-sortable="true" class="th-sm ">Sentiero</th>
                        <th data-sortable="true" class="th-sm ">Data</th>
                        <th data-sortable="true" class="th-sm ">Voto</th>
                        <th data-sortable="true" class="th-sm ">Commento</th>
                        <th data-sortable="true" class="th-sm ">Stato</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>
@endsection

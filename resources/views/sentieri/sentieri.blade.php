@extends('layouts.master')

@section('titolo', 'Elenco sentieri')

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
<h2 class="pull-left">Elenco Sentieri</h2>
@endsection

@section('breadcrumb')
<ul class="breadcrumb pull-right">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li class="active">Elenco sentieri</li>
</ul>
@endsection

@section('corpo')
 <!-- tabella utenti-->
        <div class="container" style="margin-top: 3em;">
            <div class="row">
                <div hidden="" class="col-md-offset-10 col-xs-6">
                    <p>
                        <a class="btn btn-success" href="{{ route('sentiero.create') }}"><span class="glyphicon glyphicon-new-window"></span> Nuovo</a>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <table id="tabella_elenco_sentieri" class="table table-striped table-hover table-responsive  table-sm" style="width:100%" data-toggle="table" data-search="true" data-show-columns="true" >
                        <col width='50%'>
                        <col width='30%'>
                        <col width='10%'>
                        <col width='10%'>

                        <thead>
                            <tr>
                                <th>Titolo</th>
                                <th>Creatore</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($sentieri as $sentiero)
                            <tr>
                                <td><a style="color:inherit; text-decoration: none;" href="{{route('sentiero.show',['sentiero'=>$sentiero->id])}}">{{ $sentiero->titolo }}</a></td>
                                <td><a style="color:inherit; text-decoration: none;" href="{{route('user.dettagli', ['id'=> $sentiero->autore->id])}}">{{ $sentiero->autore->nome }}</a></td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('sentiero.edit', ['sentiero'=> $sentiero->id]) }}"><span class="glyphicon glyphicon-pencil"></span> Modifica</a>
                                </td>
                                <td>
                                    <a class="btn btn-danger" href="{{ route('sentiero.destroy.confirm', ['id'=> $sentiero->id]) }}"><span class="glyphicon glyphicon-trash"></span> Cancella</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                        <tr>
                            <td colspan="4">
                                <button class="btn" onclick="location.href='{{ route('sentiero.create') }}'"><i class="fa fa-plus"></i> Nuovo</button>
                            </td>
                        </tr>

                    </table>
                </div>
            </div>

        </div>
@endsection

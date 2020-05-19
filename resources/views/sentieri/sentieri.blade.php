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
<h2 class="pull-left">Elenco Sentieri</h2>
@endsection

@section('breadcrumb')
<ul class="breadcrumb pull-right">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li class="active">Sentieri</li>
</ul>
@endsection

@section('corpo')
 <!-- tabella utenti-->
        <div class="container" style="margin-top: 3em;">
            <div class="row">
                <div class="col-md-offset-10 col-xs-6">
                    <p>
                        <a class="btn btn-success" href="{{ route('sentiero.create') }}"><span class="glyphicon glyphicon-new-window"></span> Nuovo</a>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <table class="table table-striped table-hover table-responsive  table-sm" style="width:100%" data-toggle="table" data-search="true" data-show-columns="true" >
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
                                <td>{{ $sentiero->titolo }}</td>
                                <td><a href="{{route('user.dettagli', ['id'=> $sentiero->autore->id])}}">{{ $sentiero->autore->nome }}</a></td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('sentiero.edit', ['sentiero'=> $sentiero->id]) }}"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                                </td>
                                <td>
                                    <a class="btn btn-danger" href="{{ route('sentiero.destroy.confirm', ['id'=> $sentiero->id]) }}"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                       
                    </table>
                </div>
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
@endsection
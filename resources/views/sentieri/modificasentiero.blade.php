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
@if(isset($sentiero->id))
<h2 class="pull-left">Modifica Sentiero</h2>
@else
<h2 class="pull-left">Aggiungi Sentiero</h2>
@endif
@endsection

@section('breadcrumb')
<ul class="breadcrumb pull-right">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a href="{{ route('sentiero.index') }}">Sentieri</a></li>
    @if(isset($sentiero->id))
    <li class="active">Modifica sentiero</li>
    @else
    <li class="active">Nuovo sentiero</li>
    @endif
</ul>
@endsection

@section('corpo')
<div class="container" style="margin-top: 5em;">
    <div class="row">
        <div class='col-md-12'>
            @if(isset($sentiero->id))
            <form class="form-horizontal" name="sentiero" method="get" action="{{ route('sentiero.update', ['id' => $sentiero->id]) }}">
            @else
            <form class="form-horizontal" name="sentiero" method="post" action="{{ route('sentiero.store') }}">
            @endif
            @csrf
            
                <div class="form-group">
                    <label for="titolo" class="col-md-2">Titolo</label>
                    <div class="col-sm-10">
                        @if(isset($sentiero->id))
                        <input class="form-control" type="text" id="titolo" name="titolo" placeholder="Titolo" required="True" value="{{$sentiero->titolo}}">
                        @else
                        <input class="form-control" type="text" id="titolo" name="titolo" placeholder="Titolo" required="True" value="">
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="durata" class="col-md-2">Durata</label>
                    <div class="col-sm-10">
                        @if(isset($sentiero->id))
                        <input class="form-control" type="number" pattern="^\d*(\.\d{0,2})?$" id="durata" required="True" name="durata" value="{{$sentiero->durata}}">
                        @else
                        <input class="form-control" type="number" pattern="^\d*(\.\d{0,2})?$" id="durata" required="True" name="durata">
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="descrizione" class="col-md-2">Descrizione</label>
                    <div class="col-sm-10">
                        @if(isset($sentiero->id))
                        <textarea class="form-control" name="descrizione" id="descrizione" required="True" rows="10">{{$sentiero->descrizione}}</textarea>
                        @else
                        <textarea class="form-control" name="descrizione" id="descrizione" required="True" rows="10"></textarea>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="lunghezza" class="col-sm-2 col-form-label">Lunghezza (km)</label>
                    <div class="col-sm-10">
                        @if(isset($sentiero->id))
                        <input type="number" min="1.0" max="999.0" step="0.1" pattern="/^\d+(?:\.\d{1,2})?$/" class="form-control" id="lunghezza" required="True" name="lunghezza" placeholder="lunghezza" value="{{$sentiero->lunghezza}}">
                        @else
                        <input type="number" min="1.0" max="999.0" step="0.1" pattern="/^\d+(?:\.\d{1,2})?$/" class="form-control" id="lunghezza" required="True" name="lunghezza" placeholder="lunghezza">
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="salita" class="col-sm-2 col-form-label">Salita</label>
                    <div class="col-sm-10">
                        @if(isset($sentiero->id))
                        <input type="number" min="1" max="10000" class="form-control" name="salita" required="True" id="salita" placeholder="salita" value="{{$sentiero->salita}}">
                        @else
                        <input type="number" min="1" max="10000" class="form-control" name="salita" required="True" id="salita" placeholder="salita">
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="discesa" class="col-sm-2 col-form-label">Discesa</label>
                    <div class="col-sm-10">
                        @if(isset($sentiero->id))
                        <input type="number" min="1" max="10000" class="form-control" name="discesa" required="True" id="discesa" placeholder="discesa" value="{{$sentiero->salita}}">
                        @else
                        <input type="number" min="1" max="10000" class="form-control" name="discesa" required="True" id="discesa" placeholder="discesa">
                        @endif                    
                    </div>
                    
                </div>

                <div class="form-group row">
                    <label for="altezza_massima" class="col-sm-2 col-form-label">Altezza Massima</label>
                    <div class="col-sm-10">
                        @if(isset($sentiero->id))
                        <input type="number" min="1" max="10000" class="form-control" name="altezza_massima" required="True" id="altezza_massima" placeholder="altezza_massima" value="{{$sentiero->altezza_massima}}">
                        @else
                        <input type="number" min="1" max="10000" class="form-control" name="altezza_massima" required="True" id="altezza_massima" placeholder="altezza_massima">
                        @endif                      
                    </div>
                </div>

                <div class="form-group row">
                   <label for="altezza_minima" class="col-sm-2 col-form-label">Altezza Minima</label>
                    <div class="col-sm-10">
                        @if(isset($sentiero->id))
                        <input type="number" min="1" max="10000" class="form-control" name="altezza_minima" required="True" id="altezza_massima" placeholder="altezza_minima" value="{{$sentiero->altezza_massima}}">
                        @else
                        <input type="number" min="1" max="10000" class="form-control" name="altezza_minima" required="True" id="altezza_massima" placeholder="altezza_minima">
                        @endif                      
                    </div>
                </div>

                <div class="form-group row">
                    <label for="difficolta" class="col-sm-2 col-form-label">Difficoltà</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="difficolta" name="difficolta" >
                            @foreach ($difficolta as $c)
                                @if(isset($sentiero->id))
                                    @if($c->id == $sentiero->difficolta->id)
                                        <option value="{{$c->id}}" selected="selected">{{$c->nome}}</option>
                                    @else
                                        <option value="{{$c->id}}">{{$c->nome}}</option>
                                    @endif
                                @else
                                    <option value="{{$c->id}}">{{$c->nome}}</option>
                                @endif
                            
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="categoria" class="col-sm-2 col-form-label">Categoria</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="categoria" name="categoria" >
                            @foreach ($categoria as $c)
                                @if(isset($sentiero->id))
                                    @if($c->id == $sentiero->categoria->id)
                                    <option value="{{$c->id}}" selected="selected">{{$c->nome}}</option>
                                    @else
                                    <option value="{{$c->id}}">{{$c->nome}}</option>
                                    @endif
                                @else
                                    <option value="{{$c->id}}">{{$c->nome}}</option>
                                @endif

                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="citta" class="col-sm-2 col-form-label">Città</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="citta" name="citta" >
                            @foreach ($citta as $c)
                                @if(isset($sentiero->id))
                                    @if($c->id == $sentiero->citta->id)
                                        <option value="{{$c->id}}" selected="selected">{{$c->nome}}</option>
                                    @else
                                        <option value="{{$c->id}}">{{$c->nome}}</option>
                                    @endif
                                @else
                                    <option value="{{$c->id}}">{{$c->nome}}</option>
                                @endif
                            
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        @if(isset($sentiero->id))
                            <input type="hidden" name="id" value="{{$sentiero->id}}"/>
                            <label for="mySubmit" class="btn btn-primary btn-large btn-block"><span class="glyphicon glyphicon-floppy-save"></span> Save</label>
                            <input id="mySubmit" type="submit" value="save" class="hidden"/>
                        @else
                            <label for="mySubmit" class="btn btn-primary btn-large btn-block"><span class="glyphicon glyphicon-floppy-save"></span> Save</label>
                            <input id="mySubmit" type="submit" value="save" class="hidden"/>
                        @endif

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <a href="{{route('sentiero.index')}}" class="btn btn-danger btn-large btn-block"><span class="glyphicon glyphicon-log-out"></span> Cancel</a>                         
                    </div>
                </div> 

            </form>
        </div>





    </div>


</div>

@endsection
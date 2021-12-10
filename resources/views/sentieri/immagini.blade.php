@extends('layouts.master')

@section('titolo', 'Immagini sentiero')

@section('navbar_home')
<a class="navbar-brand" href="{{ route('home') }}">Immagini</a>
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

    <?php /*<li class="dropdown" style="margin-left: 5em;">
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
    </li>*/ ?>

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
<h2 class="pull-left">Gestione immagini: {{$sentiero->titolo}}</h2>
@endsection

@section('breadcrumb')
<ul class="breadcrumb pull-right">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a href="{{ route('sentiero.index')  }}">Elenco sentieri</a></li>
    <li><a href="{{ route('sentiero.edit', ['sentiero'=> $sentiero->id]) }}">Modifica sentiero</a></li>
    <li class="active">Immagini</li>
</ul>
@endsection

@section('corpo')
<style>
    .row.display-flex {
  display: flex;
  flex-wrap: wrap;
}
.thumbnail {
  height: 300px;
  width: 100%;
}
</style>
<div class="row col-md-12">
        <div class="col-md-1 col-md-offset-9">
            <button class="btn" onclick="location.href='{{ route('sentiero.edit', ['sentiero'=> $sentiero->id]) }}'"><span class="glyphicon glyphicon-save"></span> Salva e torna alle modifiche</button>
        </div>
    </div>
 <div style="margin-top: 3em;" class="container">
             <div class="row display-flex">

                <div class="col-xs-6 col-sm-4">
                    <div class="text-center box-progetto">
                        <h5 for="immagine" class="col-form-label"><strong>IMMAGINE 1</strong>
                        <div style="margin-left: 1em;" class="popup" onclick="popup(this)" >
                            <span class="popuptext">JPEG, PNG, JPG, SVG, Masssimo 2 MB</span>
                            <span class="glyphicon glyphicon-info-sign" ></span>
                        </div>
                        </h5>

                        <img class="thumbnail img-responsive" src="{{$link1}}" alt="Libri">
                        <form action="{{route('sentiero.aggiungiimmagine',['id'=> $sentiero->id])}}" id="aggiungi_immagine_1" name="aggiungi_immagine_1" method="POST" enctype="multipart/form-data"> {{ csrf_field() }}
                            <!--<h4>{{$link1}}</h4>-->
                            <div class="form-group">
                                <div style="margin-top: 1em; margin-bottom: 1em" class="col-sm-12">
                                    <input onchange="size_immagine(this)"; onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)"class="form-control" type="file" id="immagine1" name="immagine" placeholder="immagine">
                                    <span class="invalid-input" id="invalid-immagine_1"></span>
                                </div>
                                <div class="col-sm-2 col-sm-offset-2">
                                    <input type="hidden" name="nome_input" value="immagine1"/>
                                    <input type="hidden" name="nome_file" value="1"/>
                                    <label for="mySubmit1" class="btn btn-primary btn-large btn-info"><span class="glyphicon glyphicon-floppy-save"></span> Carica</label>
                                    <input onclick="event.preventDefault(); check_immagine(this);"  id="mySubmit1" type="submit" value="save" class="hidden"/>
                                </div>

                                <div class="col-sm-2 col-sm-offset-2">
                                    @if($link1!="http://localhost:8000/storage/fotosentieri/default")
                                    <a class="btn btn-danger" href="{{route('sentiero.rimuoviimmagine',['id'=> $sentiero->id, 'nome'=> '1'])}}">
                                        <span class="glyphicon glyphicon-trash"></span></a>
                                    <!--<button class="btn btn-danger" onclick="location.href='{{route('sentiero.rimuoviimmagine',['id'=> $sentiero->id, 'nome'=> '1'])}}'">
                                    <span class="glyphicon glyphicon-trash"></span</button>-->

                                    @else
                                    <button disabled="" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span</button>
                                    @endif
                                </div>
                            </div>

                        </form>
                    </div>
                </div><!-- /.col-sm-3 -->

                <div class="col-xs-6 col-sm-4">
                    <div class="text-center box-progetto">
                        <h5 for="immagine" class="col-form-label"><strong>IMMAGINE 2</strong>
                        <div style="margin-left: 1em;" class="popup" onclick="popup(this)" >
                            <span class="popuptext">JPEG, PNG, JPG, SVG, Masssimo 2 MB</span>
                            <span class="glyphicon glyphicon-info-sign" ></span>
                        </div>
                        </h5>

                        <img class="thumbnail img-responsive" src="{{$link2}}" alt="Libri">
                        <form action="{{route('sentiero.aggiungiimmagine',['id'=> $sentiero->id])}}" id="aggiungi_immagine_2" name="aggiungi_immagine_2" method="POST" enctype="multipart/form-data"> {{ csrf_field() }}
                            <!--<h4>{{$link2}}</h4>-->
                            <div class="form-group">
                                <div style="margin-top: 1em; margin-bottom: 1em" class="col-sm-12">
                                    <input onchange="size_immagine(this)"; onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)"class="form-control" type="file" id="immagine2" name="immagine" placeholder="immagine">
                                    <span class="invalid-input" id="invalid-immagine_1"></span>
                                </div>
                                <div class="col-sm-2 col-sm-offset-2">
                                    <input type="hidden" name="nome_input" value="immagine2"/>
                                    <input type="hidden" name="nome_file" value="2"/>
                                    <label for="mySubmit2" class="btn btn-primary btn-large btn-info"><span class="glyphicon glyphicon-floppy-save"></span> Carica</label>
                                    <input onclick="event.preventDefault(); check_immagine(this);"  id="mySubmit2" type="submit" value="save" class="hidden"/>
                                </div>

                                <div class="col-sm-2 col-sm-offset-2">
                                    @if($link2!="http://localhost:8000/storage/fotosentieri/default")
                                    <a class="btn btn-danger" href="{{route('sentiero.rimuoviimmagine',['id'=> $sentiero->id, 'nome'=> '2'])}}">
                                        <span class="glyphicon glyphicon-trash"></span></a>
                                    <!--<button class="btn btn-danger" onclick="location.href='{{route('sentiero.rimuoviimmagine',['id'=> $sentiero->id, 'nome'=> '1'])}}'">
                                    <span class="glyphicon glyphicon-trash"></span</button>-->
                                    @else
                                    <button disabled="" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span</button>
                                    @endif
                                </div>
                            </div>

                        </form>
                    </div>
                </div>


                <div class="col-xs-6 col-sm-4">
                    <div class="text-center box-progetto">
                        <h5 for="immagine" class="col-form-label"><strong>IMMAGINE 3</strong>
                        <div style="margin-left: 1em;" class="popup" onclick="popup(this)" >
                            <span class="popuptext">JPEG, PNG, JPG, SVG, Masssimo 2 MB</span>
                            <span class="glyphicon glyphicon-info-sign" ></span>
                        </div>
                        </h5>

                        <img class="thumbnail img-responsive" src="{{$link3}}" alt="Immagine 3">
                        <form action="{{route('sentiero.aggiungiimmagine',['id'=> $sentiero->id])}}" id="aggiungi_immagine_3" name="aggiungi_immagine_3" method="POST" enctype="multipart/form-data"> {{ csrf_field() }}
                            <!--<h4>{{$link3}}</h4>-->
                            <div class="form-group">
                                <div style="margin-top: 1em; margin-bottom: 1em" class="col-sm-12">
                                    <input onchange="size_immagine(this)"; onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)"class="form-control" type="file" id="immagine3" name="immagine" placeholder="immagine">
                                    <span class="invalid-input" id="invalid-immagine_1"></span>
                                </div>

                                <div class="col-sm-2 col-sm-offset-2">
                                    <input type="hidden" name="nome_input" value="immagine3"/>
                                    <input type="hidden" name="nome_file" value="3"/>
                                    <label for="mySubmit3" class="btn btn-primary btn-large btn-info"><span class="glyphicon glyphicon-floppy-save"></span> Carica</label>
                                    <input onclick="event.preventDefault(); check_immagine(this);"  id="mySubmit3" type="submit" value="save" class="hidden"/>
                                </div>

                                <div class="col-sm-2 col-sm-offset-2">
                                    @if($link3!="http://localhost:8000/storage/fotosentieri/default")
                                    <a class="btn btn-danger" href="{{route('sentiero.rimuoviimmagine',['id'=> $sentiero->id, 'nome'=> '3'])}}">
                                        <span class="glyphicon glyphicon-trash"></span></a>
                                    <!--<button class="btn btn-danger" onclick="location.href='{{route('sentiero.rimuoviimmagine',['id'=> $sentiero->id, 'nome'=> '1'])}}'">
                                    <span class="glyphicon glyphicon-trash"></span</button>-->
                                    @else
                                    <button disabled="" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span</button>
                                    @endif
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

                <!--<h5> id: {{$sentiero->id}}, nome: 3</h5>-->

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

<!--<div style="margin-top: 3em;" class="container">
    <div class="row">
        <div class="col-md-10">
            <button class="btn btn-info"><span class="glyphicon glyphicon-save">Salva</span</button>
        </div>
    </div>
</div>-->





@endsection

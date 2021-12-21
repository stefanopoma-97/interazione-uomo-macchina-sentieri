@extends('layouts.master2')

@section('titolo', 'Modifica utente')



@section('sfondo')
@endsection


@section('header')
<h2 class="pull-left" onclick="close_popup()">Modifica Account</h2>
@endsection

@section('breadcrumb')
<ul class="breadcrumb pull-right">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a href="{{ route('user.elenco') }}">Utenti</a></li>
    <li><a href="{{ route('user.dettagli',['id'=> $user->id]) }}">Account</a></li>
    <li class="active">Modifica account</li>
</ul>
@endsection

@section('corpo')

<div class="container pt-5" style="margin-top: 5em;" onclick="close_popup()">

    <div class="row">
        <div style="margin-bottom: 2em;" hidden="" class="col-md-12 alert alert-danger">
            <ul id="ul_errori">
           </ul>
        </div>
        <div class='col-md-1'></div>
        <div class='col-md-10'>
            <form class="form-horizontal" id="modifica_utente" name="modifica_utente" method="post" action="{{route('user.update',['id'=> $user->id])}}">
            @csrf
                <div class="form-group">
                    <div class="col-sm-2" onclick="event.stopPropagation()">
                        <div class="popup" onclick="popup2(this)" >
                            <span class="popuptext">Inserisci il tuo nome, niente caratteri speciali o numeri</span>
                            <span class="glyphicon glyphicon-info-sign" ></span>
                        </div>
                        <label  for="nome" class="col-form-label">Nome</label>
                    </div>

                    <div class="col-sm-10">
                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" required="" maxlength="32" class="form-control" type="text" id="nome" name="nome" placeholder="Inserisci il tuo nome" value="{{$user->nome}}">
                        <span class="invalid-input" id="invalid-nome"></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-2" onclick="event.stopPropagation()">
                        <div class="popup" onclick="popup2(this)" >
                            <span class="popuptext">Inserisci il tuo cognome, niente caratteri speciali o numeri</span>
                            <span class="glyphicon glyphicon-info-sign" ></span>
                        </div>
                        <label for="cognome" class="col-form-label">Cognome</label>
                    </div>
                    <div class="col-sm-10">
                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" required="" maxlength="32" class="form-control" type="text" id="cognome" name="cognome" placeholder="Inserisci il tuo cognome" value="{{$user->cognome}}">
                        <span class="invalid-input" id="invalid-cognome"></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-2" onclick="event.stopPropagation()">
                        <div class="popup" onclick="popup2(this)" >
                            <span class="popuptext">Inserisci un username, non deve esistere un utente con lo stesso username</span>
                            <span class="glyphicon glyphicon-info-sign" ></span>
                        </div>
                        <label for="username" class="col-form-label">Username</label>
                    </div>

                    <div class="col-sm-10">
                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" required="" maxlength="32" class="form-control" type="text" id="username" name="username" placeholder="Inserisci il tuo username" value="{{$user->username}}">
                        <span class="invalid-input" id="invalid-username"></span>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-2" onclick="event.stopPropagation()">
                        <div class="popup" onclick="popup2(this)" >
                           <span class="popuptext">Inserisci una mail valida</span>
                           <span class="glyphicon glyphicon-info-sign" ></span>
                        </div>
                        <label for="mail" class="col-form-label">Email</label>
                    </div>

                    <div class="col-sm-10">
                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" required="" maxlength="100" type="mail" class="form-control" name="mail" placeholder="Inserisci la tua mail" value="{{$user->mail}}">
                        <span class="invalid-input" id="invalid-mail"></span>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-2" onclick="event.stopPropagation()">
                        <div class="popup" onclick="popup2(this)" >
                           <span class="popuptext">Inserisci una tua descrizione personale: attenzione puoi inserire fino a 1000 caratteri.</span>
                           <span class="glyphicon glyphicon-info-sign" ></span>
                        </div>
                        <label for="descrizione" class="col-form-label">Descrizione</label>
                    </div>

                    <div class="col-sm-10">
                        <textarea onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" required=""  class="form-control" id="descrizione" maxlength="1000" name="descrizione" placeholder="Parlaci di te..." rows="5">{{$user->descrizione}}</textarea>
                        <span class="invalid-input" id="invalid-descrizione"></span>
                    </div>
                </div>

<!--                <div class="form-group row">
                    <label for="citta" class="col-sm-2 col-form-label">Città</label>
                    <div class="col-sm-10">
                        <select onmouseover="rimuovi_stile(this)" required="true" class="form-control" id="citta" name="citta" >
                            @foreach ($citta as $c)
                                @if($c->id == $user->citta->id)
                                    <option value="{{$c->id}}" selected="selected">{{$c->nome}}</option>
                                @else
                                    <option value="{{$c->id}}">{{$c->nome}}</option>
                                @endif

                            @endforeach
                        </select>
                        <span class="invalid-input" id="invalid-citta"></span>
                    </div>
                </div>-->

                <div class="form-group row">
                    <div class="col-sm-2" onclick="event.stopPropagation()">
                        <div class="popup" onclick="popup2(this)" >
                           <span class="popuptext">Seleziona una città tra le province italiane</span>
                           <span class="glyphicon glyphicon-info-sign" ></span>
                        </div>
                        <label for="citta_completamento" class="col-form-label">Città</label>
                    </div>

                    <div class="col-sm-10">
                        <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" required="" type="text" class="form-control" id="citta_completamento" name="citta_completamento" value="{{$user->citta->nome}}"placeholder="Inserisci la città dove abiti" list="lista_citta">

                        <datalist id="lista_citta">
                            @foreach ($citta as $c)
                                <option>{{$c->nome}}</option>
                            @endforeach
                        </datalist>


                        <span class="invalid-input" id="invalid-citta_completamento"></span>
                    </div>
                </div>



                <div class="form-group row">
                    <div class="col-sm-10 col-sm-offset-2">
                        <a role="button" class="btn btn-primary" href="{{route('user.edit.password',['id'=> $user->id])}}">
                            Modifica password
                        </a>
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
                        <a href="{{ route('user.dettagli',['id'=> $user_id]) }}" class="btn btn-danger btn-large btn-block"><span class="glyphicon glyphicon-log-out"></span> Cancel</a>
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

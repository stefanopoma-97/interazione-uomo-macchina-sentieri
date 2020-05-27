@extends('layouts.master')

@section('titolo', 'Elenco utenti')

@section('javascript')
function attributi(obj)
{
    var attr = obj.attributes;
    var msg = "";
    for (var i = 0; i < attr.length; i++)
    {
    msg += attr[i].nodeName + ": " + attr[i].nodeValue + "\n";
            }
    alert(msg);
}
function nas(obj) {
obj.style.visibility = "hidden";
}
function preferito(nodo)
{
var attr = nodo.attributes["class"];
if(attr.nodeValue == "fa fa-star checked-star")
    attr.nodeValue = "fa fa-star";
else
    attr.nodeValue = "fa fa-star checked-star";
}
@endsection

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
<h2 class="pull-left">Sentiero</h2>
@endsection

@section('breadcrumb')
<ul class="breadcrumb pull-right">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a href="{{ route('sentiero.ricerca') }}">Sentieri</a></li>
    <li class="active">Sentiero</li>
</ul>
@endsection

@section('corpo')
<div class="container" style="margin-top: 3em;">
    <div class="row pt-5">
        <div class="col-m-6 col-sm-6 col-xs-12">
            <ul class="list-group ">
                <li class="list-group-item text-center"><strong>{{ $sentiero->titolo}}</strong></li>
                <li class="list-group-item"><strong>Categoria: {{ $sentiero->categoria->nome}}</strong></li>
                <li class="list-group-item " ><strong>Difficoltà: {{ $sentiero->difficolta->nome}}</strong></li>
                <li class="list-group-item "><span class="glyphicon glyphicon-time"></span>  Città:   {{ $sentiero->citta->nome}}</li>
                <li class="list-group-item "><span class="glyphicon glyphicon-time"></span>  Durata:   {{ $sentiero->durata}} ore</li>
                <li class="list-group-item "><span class="glyphicon glyphicon-repeat"></span>  Lunghezza(Km):   {{ $sentiero->lunghezza}} km</li>
                <li class="list-group-item "><span class="glyphicon glyphicon-chevron-up"></span>  Salita:   {{ $sentiero->salita}}</li>
                <li class="list-group-item "><span class="glyphicon glyphicon-chevron-down"></span>  Discesa:   {{ $sentiero->discesa}}</li>
                <li class="list-group-item "><span class="glyphicon glyphicon-chevron-down"></span>  Altezza massima:   {{ $sentiero->altezza_massima}}</li>
                <li class="list-group-item "><span class="glyphicon glyphicon-chevron-down"></span>  Altezza minima:   {{ $sentiero->altezza_minima}}</li>
                <li class="list-group-item "><span class="glyphicon glyphicon-resize-vertical"></span>  Dislivello   {{ ($sentiero->altezza_massima) - ($sentiero->altezza_minima)}}</li>
            </ul>

            <form method="POST">
                @csfr
                <input type="submit" class="btn btn-primary" value="- Preferito" name="remove_preferito" id="">
                <input type="submit" class="btn btn-outline-dark" value="+ Preferito" name="add_preferito" id="">
            </form>
            <span class="fa fa-star checked-star" onclick="preferito(this);"></span>
        </div>


        <div class="col-md-6">
            <div>            
                <img src="../img/mappa.png" class="img-fluid rounded mx-auto d-block" alt="Responsive image">
                <h3><strong>Community:</strong></h3>
                <div class="col-m-10 col-sm-10">
                    <ul class="list-group ">
                        <li class="list-group-item ">Quante volte è stato percorso: {{count($sentiero->esperienze)}}</li>
                        <li class="list-group-item ">Media voti: {{$dati_sentiero->mediavoti}}</li>
                        <li class="list-group-item ">Difficoltà percepita: {{$dati_sentiero->difficoltamedia}}</li>
                        <li class="list-group-item "><q>Aggiunto ai preferiti: {{count($sentiero->preferiti)}}</q></li>
                        <li class="list-group-item "><q>Numero di commenti: {{count($sentiero->esperienze)}} </q></li>
                    </ul>
                </div>


            </div>
        </div>
    </div>




    <div class="row">
        <div class="col-md-12">
            <div>
                <h3>Descrizione</h3>
                <p>{{$sentiero->descrizione}}</p>
                <blockquote>
                    <p>{{$sentiero->autore->descrizione}}</p>
                    <small>{{$sentiero->autore->nome}} {{$sentiero->autore->cognome}}    <cite title="Source Title">({{$sentiero->autore->username}})</cite></small>
                </blockquote>
            </div>
        </div>
    </div>

    <div class="row pb-4 pt-4">
        <div class="col-md-3">
            <div class="header-sezione">
                <h3 class="pull-right">Ultime volte che è stato percorso</h3>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 2em;">
        <div class="col-md-12">
            <div class="container horizontal-scrollable">
                <div class="row">
                    @foreach($esperienze as $esperienza)
                    <div class="col-m-3 col-sm-3">
                        <ul class="list-group ">
                            <li class="list-group-item "><h4><a href="{{route('user.dettagli',['id'=>$esperienza->utente_id])}}">{{$esperienza->utente->username}}</a></h4></li>
                            <li style="height: 50px" class="list-group-item">
                                <q>{{$esperienza->commento}}</q>
                            </li>
                            <li class="list-group-item ">Difficoltà:   {{$esperienza->difficolta}}</li>
                            <li class="list-group-item ">Voto:   {{$esperienza->voto}}</li>
                        </ul>
                    </div>
                    @endforeach
                    
                </div>

            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 3em;">
        <div class="col-md-10 col-md-offset-1">
            <ul class="list-group">
                <li class="list-group-item text-center" style="background-color: #357ebd; font-size: 14px; font-weight: bold; text-transform: uppercase; color: #333333;"><h3><strong>Raccontaci della tua esperienza</strong></h3></li>
                <li class="list-group-item ">
                    <form id="aggiungiesperienza" action="{{route('esperienza.store',['id'=>$sentiero->id])}}" method="get" style="margin-top: 2em;">
                    @csrf

                        <div class="form-group">
                            <label for="data">Data</label>
                            <input class="form-control" type="date" id="data" name="data" required>
                        </div>

                        <div class="form-group">
                            <label for="voto">Voto</label>
                            <select class="form-control" id="voto" name="voto" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="difficolta">Difficoltà percepita</label>
                            <select class="form-control" id="difficolta" name="difficolta" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="descrizione">Descrizione</label>
                            <textarea class="form-control" id="descrizione" name="descrizione" rows="3" required></textarea>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <input type="hidden" name="user_id" value="{{$user_id}}"/>
                                <label for="mySubmit" class="btn btn-primary btn-large btn-block"><span class="glyphicon glyphicon-floppy-save"></span> Invia</label>
                                <input id="mySubmit" type="submit" value="save" class="hidden"/>
                            </div>
                        </div>

                    </form>
                </li>

            </ul>
        </div>
    </div>

</div>
@endsection
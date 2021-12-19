@extends('layouts.master2')

@section('titolo', 'Ricerca sentieri')



@section('sfondo')
@endsection

@section('header')
<h2 class="pull-left">Cerca sentieri</h2>
@endsection

@section('breadcrumb')
<ul class="breadcrumb pull-right">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li class="active">Sentieri</li>
</ul>
@endsection

@section('corpo')

<div class="container">
    
    
        <div class="row">
            <div id="div_filtro" class="paginasx col-md-5 col-s-5 col-m-push-7">
                
                <div class="row elementoSticky">
                    <h2 class="text-center filtro">Filtro  <span onclick="hide_show_filtri()" class="glyphicon glyphicon glyphicon-filter"></span></h2>
                    <form id="form_filtro" name="form_filtro" method="get" action="{{route('sentiero.ricercafiltra')}}">

                    @csrf
                    <div class="col-md-12">
                        <div class="col-sm-6 text-center">
                            <button onclick="event.preventDefault(); valida_filtra_sentieri(this);" type="submit" class="btn btn-info btn-toolbar">Filtra</button>
                            <input  id="mySubmit" type="submit" value='Save' class="hidden"/>
                        </div>
                        <div class="col-sm-6 text-center">
                            <button onclick="event.preventDefault();" type="" class="btn btn-info btn-toolbar">Azzera</button>
                        </div>
                    </div>
                </div>
                    <div class="form-group row">
                        <label class="col-sm-10" for="testo_titolo">Titolo</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="testo_titolo" name="testo_titolo" placeholder="Parola contenuta nel titolo">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-10" for="testo_descrizione">Descrizione</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="testo_descrizione" name="testo_descrizione" placeholder="Parola contenuta nella descrizione">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="citta" class="col-sm-10">Città</label>
                        <div class="col-sm-12">
                            <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" type="text" class="form-control" id="citta" name="citta" value="" placeholder="Città" list="lista_citta">
                            <datalist id="lista_citta">
                                @foreach ($citta as $c)
                                    <option>{{$c->nome}}</option>
                                @endforeach
                            </datalist>
                        </div>
                        <span class="invalid-input" id="invalid_citta"></span>

                    </div>
                    <div class="form-group">
                        <label for="difficolta">Difficoltà</label>
                        <select class="form-control" id="difficolta" name="difficolta" >
                            <option value=""></option>
                            @foreach ($difficolta as $c)
                            <option value="{{$c->id}}">{{$c->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="categoria">Categoria</label>
                        <select class="form-control" id="categoria" name="categoria" >
                            <option value=""></option>
                            @foreach ($categorie as $c)
                            <option value="{{$c->id}}">{{$c->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="lunghezza">Lunghezza massima (km)</label>
                        <input class="form-control" onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" type="number" id="lunghezza" name="lunghezza" min="0" max="50">
                        <span class="invalid-input" id="invalid_lunghezza"></span>
                    </div>
                    <div class="form-group">
                        <label for="dislivello">Dislivello massimo (m)</label>
                        <input class="form-control" onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" type="number" id="dislivello" name="dislivello" min="0" max="10000">
                        <span class="invalid-input" id="invalid_dislivello"></span>
                    </div>
                    <div class="form-group">
                        <label for="durata">Durata massima</label>
                        <input class="form-control" onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" type="number" pattern="^\d*(\.\d{0,2})?$" id="durata" name="durata">
                        <span class="invalid-input" id="invalid_durata"></span>
                    </div>
                </form>
            </div>
            
            
            <div class="paginadx col-md-7 col-s-7 col-m-pull-5">
                @foreach ($sentieri as $key => $sentiero)
                <div class="carta2">
                    <div class="carta2-img">
                        @if($immagini[$key]==null)
                        <img class="carta2-immagine" src="{{ url('/') }}/img/foto1.jpg">
                        @else
                        <img class="carta2-immagine" src="{{$immagini[$key]}}">
                        @endif
                        <div class="carta2-middle">
                            <a href="{{route('sentiero.show',['sentiero'=>$sentiero->id])}}">Leggi di più</a>
                        </div>
                    </div>
                    <div class="carta2-content">
                        <h5 class="carta2-title">{{ $sentiero->titolo }}</h5>
                        <div class="carta2-info">
                            <div class="carta2-panel-sx">
                                <div class="carta2-stats"><span class="material-icons">report</span>   {{ $sentiero->difficolta->descrizione }}</div>
                                <div class="carta2-stats"><span class="material-icons">landscape</span>   {{ $sentiero->categoria->nome }}</div>
                                <div class="carta2-stats"><span class="material-icons">location_city</span>   {{ $sentiero->citta->nome }}</div>
                            </div>
                            <div class="carta2-panel-dx">
                                <div class="carta2-stats"><span class="material-icons">chat</span>   {{$dati_sentieri[$key]->partecipanti}} commenti</div>
                                <div class="carta2-stats"><span class="material-icons">star</span>   {{$dati_sentieri[$key]->mediavoti}}/10</div>
                                <div class="carta2-stats"><span class="material-icons">history</span>   {{ $sentiero->durata }} ore</div>

                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                {{ $sentieri->links() }}
            </div>
        </div>    
    
    

 

<!--    <div class="row">
        <div class="col-md-3 pull-right">
            <ul class="pagination">
                <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </div>

    </div>-->
</div>

@endsection

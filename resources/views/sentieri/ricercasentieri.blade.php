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
                    <h2 class="text-center filtro">Filtro  <span class="glyphicon glyphicon glyphicon-filter"></span></h2>
                    <form id="form_filtro" name="form_filtro" method="get" action="{{route('sentiero.ricercafiltra')}}">

                    @csrf
                    <div class="col-md-12">
                        <div class="col-sm-6 text-center">
                            <button onclick="event.preventDefault(); valida_filtra_sentieri(this);" type="submit" class="btn btn-info btn-toolbar">Filtra</button>
                            <input  id="mySubmit" type="submit" value='Save' class="hidden"/>
                        </div>
                        <div class="col-sm-6 text-center">
                            <button onclick="location.href='{{route('sentiero.ricerca')}}'" type="button" class="btn btn-info btn-toolbar">Azzera</button>
                        </div>
                    </div>
                </div>
                    <div class="form-group row">
                        <label class="col-sm-10" for="testo_titolo">Titolo</label>
                        <div class="col-sm-12">
                            @if(!empty($titolo))
                                @if($titolo!="")
                                <input value="{{$titolo}}" type="text" class="form-control" id="testo_titolo" name="testo_titolo" placeholder="Inserisci una frase contenuta nel titolo">
                                @else
                                <input type="text" class="form-control" id="testo_titolo" name="testo_titolo" placeholder="Inserisci una frase contenuta nel titolo">
                                @endif
                            @else
                                <input type="text" class="form-control" id="testo_titolo" name="testo_titolo" placeholder="Inserisci una frase contenuta nel titolo">
                            @endif

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-10" for="testo_descrizione">Descrizione</label>
                        <div class="col-sm-12">
                            @if(!empty($descrizione))
                                @if($descrizione!="")
                                <input value="{{$descrizione}}" type="text" class="form-control" id="testo_descrizione" name="testo_descrizione" placeholder="Inserisci una frase contenuta nella descrizione">
                                @else
                                <input type="text" class="form-control" id="testo_descrizione" name="testo_descrizione" placeholder="Inserisci una frase contenuta nella descrizione">
                                @endif
                            @else
                                <input type="text" class="form-control" id="testo_descrizione" name="testo_descrizione" placeholder="Inserisci una frase contenuta nella descrizione">
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="citta" class="col-sm-10">Città</label>
                        <div class="col-sm-12">
                            @if(!empty($citta_valore))
                                @if($citta_valore!="")
                                    <input value="{{$citta_valore}}" onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" type="text" class="form-control" id="citta" name="citta" value="" placeholder="Inserisci una città" list="lista_citta">
                                    <datalist id="lista_citta">
                                        <option selected="true">{{$citta_valore}}</option>
                                        @foreach ($citta as $c)
                                            <option>{{$c->nome}}</option>
                                        @endforeach
                                    </datalist>                                
                                @else
                                    <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" type="text" class="form-control" id="citta" name="citta" value="" placeholder="Inserisci una città" list="lista_citta">
                                    <datalist id="lista_citta">
                                        @foreach ($citta as $c)
                                            <option>{{$c->nome}}</option>
                                        @endforeach
                                    </datalist>                                  
                                @endif
                            @else
                                    <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" type="text" class="form-control" id="citta" name="citta" value="" placeholder="Inserisci una città" list="lista_citta">
                                    <datalist id="lista_citta">
                                        @foreach ($citta as $c)
                                            <option>{{$c->nome}}</option>
                                        @endforeach
                                    </datalist>                              
                            @endif
                            
                        </div>
                        <span class="invalid-input" id="invalid_citta"></span>

                    </div>
                    <div class="form-group">
                        <label for="difficolta">Difficoltà</label>
                            @if(!empty($difficolta_valore))
                                @if($difficolta_valore!="")
                                    <select class="form-control" id="difficolta" name="difficolta" placeholder="Inserisci un livello di difficoltà">
                                        <option value=""></option>
                                        @foreach ($difficolta as $c)
                                            @if($difficolta_valore==($c->id))
                                                <option selected value="{{$c->id}}">{{$c->nome}}: {{$c->descrizione}}</option>
                                            @else
                                                <option value="{{$c->id}}">{{$c->nome}}: {{$c->descrizione}}</option>
                                            @endif
                                        @endforeach
                                    </select>                                  
                                @else
                                    <select class="form-control" id="difficolta" name="difficolta" placeholder="Inserisci un livello di difficoltà">
                                        <option value=""></option>
                                        <option style="color:lightgray" value="" disabled selected hidden>Inserisci un livello di difficoltà</option>
                                        @foreach ($difficolta as $c)
                                        <option value="{{$c->id}}">{{$c->nome}}: {{$c->descrizione}}</option>
                                        @endforeach
                                    </select>                                    
                                @endif
                            @else
                                <select class="form-control" id="difficolta" name="difficolta" placeholder="Inserisci un livello di difficoltà">
                                    <option value=""></option>
                                    <option style="color:lightgray" value="" disabled selected hidden>Inserisci un livello di difficoltà</option>
                                    @foreach ($difficolta as $c)
                                    <option value="{{$c->id}}">{{$c->nome}}: {{$c->descrizione}}</option>
                                    @endforeach
                                </select>                             
                            @endif
                        
                        
                        

                    </div>
                    <div class="form-group">
                        <label for="categoria">Categoria</label>
                        
                            @if(!empty($categoria_valore))
                                @if($categoria_valore!="")
                                    <select class="form-control" id="categoria" name="categoria" placeholder="Inserisci una categoria">
                                        <option value=""></option>
                                        <option style="color:lightgray" value="" disabled selected hidden>Inserisci una categoria</option>
                                        @foreach ($categorie as $c)
                                            @if($categoria_valore==$c->id)
                                            <option selected="" value="{{$c->id}}">{{$c->nome}}</option>
                                            @else
                                            <option selected="" value="{{$c->id}}">{{$c->nome}}</option>
                                            @endif
                                        @endforeach
                                    </select>                                       
                                @else
                                    <select class="form-control" id="categoria" name="categoria" placeholder="Inserisci una categoria">
                                        <option value=""></option>
                                        <option style="color:lightgray" value="" disabled selected hidden>Inserisci una categoria</option>
                                        @foreach ($categorie as $c)
                                        <option value="{{$c->id}}">{{$c->nome}}</option>
                                        @endforeach
                                    </select>                                  
                                @endif
                            @else
                                <select class="form-control" id="categoria" name="categoria" placeholder="Inserisci una categoria">
                                    <option value=""></option>
                                    <option style="color:lightgray" value="" disabled selected hidden>Inserisci una categoria</option>
                                    @foreach ($categorie as $c)
                                    <option value="{{$c->id}}">{{$c->nome}}</option>
                                    @endforeach
                                </select>                            
                            @endif
                            
                            

                    </div>
                    <div class="form-group">
                        <label for="lunghezza">Lunghezza massima (km)</label>
                            @if(!empty($lunghezza_massima))
                                @if($lunghezza_massima!="")
                                <input value="{{$lunghezza_massima}}" class="form-control" onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" type="number" id="lunghezza" name="lunghezza" min="0" max="50" placeholder="Inserisci la lunghezza massima (0-50 km)">
                                @else
                                    <input class="form-control" onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" type="number" id="lunghezza" name="lunghezza" min="0" max="50" placeholder="Inserisci la lunghezza massima (0-50 km)">
                                @endif
                            @else
                                <input class="form-control" onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" type="number" id="lunghezza" name="lunghezza" min="0" max="50" placeholder="Inserisci la lunghezza massima (0-50 km)">
                            @endif                        
                        <span class="invalid-input" id="invalid_lunghezza"></span>
                    </div>
                    <div class="form-group">
                        <label for="dislivello">Dislivello massimo (m)</label>
                            @if(!empty($dislivello_massimo))
                                @if($dislivello_massimo!="")
                                    <input value="{{$dislivello_massimo}}" class="form-control" onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" type="number" id="dislivello" name="dislivello" min="0" max="10000" placeholder="Inserisci il displivello massimo (0-10000 m)">
                                @else
                                    <input class="form-control" onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" type="number" id="dislivello" name="dislivello" min="0" max="10000" placeholder="Inserisci il displivello massimo (0-10000 m)">
                                @endif
                            @else
                                <input class="form-control" onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" type="number" id="dislivello" name="dislivello" min="0" max="10000" placeholder="Inserisci il displivello massimo (0-10000 m)">
                            @endif                        
                        
                        <span class="invalid-input" id="invalid_dislivello"></span>
                    </div>
                    <div class="form-group">
                        <label for="durata">Durata massima</label>
                            @if(!empty($durata_massima))
                                @if($durata_massima!="")
                                    <input value="{{$durata_massima}}" class="form-control" onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" type="number" pattern="^\d*(\.\d{0,2})?$" min="0" id="durata" name="durata" placeholder="Inserisci la durata massima (espressa in ore)">
                                @else
                                    <input class="form-control" onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" type="number" pattern="^\d*(\.\d{0,2})?$" min="0" id="durata" name="durata" placeholder="Inserisci la durata massima (espressa in ore)">
                                @endif
                            @else
                                <input class="form-control" onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" type="number" pattern="^\d*(\.\d{0,2})?$" min="0" id="durata" name="durata" placeholder="Inserisci la durata massima (espressa in ore)">
                            @endif                         
                        
                        <span class="invalid-input" id="invalid_durata"></span>
                    </div>
                
                    <!--<div class="form-group">
                        <div class="slidecontainer">
                            <input type="range" min="0" max="24" value="50" class="slider" id="myRange">
                         </div>
                    </div>-->
                </form>
            </div>
            
            <div class="col-md-7 col-s-7 col-m-pull-5 ">
                <h4 class="text-right">{{$sentieri->total()}} risultati trovati</h4>
            </div>
            <div class="paginadx col-md-7 col-s-7 col-m-pull-5">
                @if(count($sentieri)==0)
                <h3>Non sono stati trovati sentieri con questi criteri di ricerca</h3>
                @else
                
                
                    @foreach ($sentieri as $key => $sentiero)
                    <div class="carta2">
                        <div class="carta2-img">
                            @if($immagini[$key]==null)
                            <img class="carta2-immagine-test" src="{{ url('/') }}/img/foto1.jpg">
                            @else
                            <img class="carta2-immagine-test" src="{{$immagini[$key]}}">
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
                                    <div class="carta2-stats"><span class="material-icons">chat</span>   {{$partecipanti[$key]}} commenti</div>
                                    <div class="carta2-stats"><span class="material-icons">star</span>   {{$media_voti[$key]}}/10</div>
                                    <div class="carta2-stats"><span class="material-icons">history</span>   {{ $sentiero->durata }} ore</div>

                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    {{ $sentieri->links() }}
                @endif
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

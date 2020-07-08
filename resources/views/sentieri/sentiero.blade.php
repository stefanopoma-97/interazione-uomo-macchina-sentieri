@extends('layouts.master')

@section('titolo', 'Elenco utenti')

@section('javascript')
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

<div class="container" style="margin-top: 3em;">
    <div class="row" style="margin-bottom: 1em;">
        <form class="inline-form" id="aggiungipreferito" action="{{route('sentiero.preferito',['id'=>$sentiero->id])}}" method="POST" >
            @csrf
            @if($preferito)
            <button class="btn" type="submit" value="False" name="preferito" onclick="window.location.reload();">
                <span  class="fa fa-star checked-star"></span> Rimuovi preferito
            </button>
            <a type="sumbmit" id="link1" onclick="lancia_form(); window.location.reload();">Rimuovi dai preferiti</a>
            @else
            <button class="btn" type="submit" value="True" name="preferito" onclick="window.location.reload();">
                <span class="fa fa-star"></span> Aggiungi preferito
            </button>

            @endif
        </form>
    </div>
    
    <div class="row pt-5">
        
        <div class="col-m-6 col-sm-6 col-xs-12">
            <ul class="list-group">
                <li class="list-group-item text-center">
                    
                        <h3><strong  >{{ $sentiero->titolo}}</strong></h3>
                    </li>
                <li class="list-group-item"><strong>Categoria: {{ $sentiero->categoria->nome}}</strong></li>
                <li class="list-group-item " ><strong>Difficoltà: {{ $sentiero->difficolta->nome}}</strong></li>
                <li class="list-group-item "><span class="glyphicon glyphicon-road"></span> Città:   {{ $sentiero->citta->nome}}</li>
                <li class="list-group-item "><span class="glyphicon glyphicon-time"></span>  Durata:   {{ $sentiero->durata}} ore</li>
                <li class="list-group-item "><span class="glyphicon glyphicon-repeat"></span>  Lunghezza(Km):   {{ $sentiero->lunghezza}} km</li>
                <li class="list-group-item "><span class="glyphicon glyphicon-chevron-up"></span>  Salita:   {{ $sentiero->salita}}</li>
                <li class="list-group-item "><span class="glyphicon glyphicon-chevron-down"></span>  Discesa:   {{ $sentiero->discesa}}</li>
                <li class="list-group-item "><span class="glyphicon glyphicon-arrow-up"></span>  Altezza massima:   {{ $sentiero->altezza_massima}}</li>
                <li class="list-group-item "><span class="glyphicon glyphicon-arrow-down"></span>  Altezza minima:   {{ $sentiero->altezza_minima}}</li>
                <li class="list-group-item "><span class="glyphicon glyphicon-resize-vertical"></span>  Dislivello   {{ ($sentiero->altezza_massima) - ($sentiero->altezza_minima)}}</li>
            </ul>
            
            <div class="container" style="margin-bottom: 3em">
                <h4>Cerca altre informazioni:</h4>
            <a target=”_blank” href={{$link_google}}>
                <img width="30px" class="img responsive" src="{{ url('/') }}/img/google.png">
            </a>
            </div>
            

            
                        
            <script>
                $(document).ready(function(){
                  $("#preferito").click(function(){
                    $(this).removeClass("checked-star");
                  });
                });
            </script>
        </div>


        <div  class="col-md-6">
            <div> 
                @if($immagini=="")
                <div class="row">
                    <div class="col-md-12">
                        <img  src="{{ url('/') }}/img/no-image.png" class="thumbnail img-responsive" style="width:90%; height: 350px" id="im_default" alt="logo"/>
                    </div>
                </div>
                @else
                <div class="row">
                    <div class="col-md-12">
                        <img  src="{{$immagini[2]}}" class="thumbnail img-responsive" style="max-height: 400px; width:100%; height: auto;" id="im_5" alt="logo"/>
                    </div>
                </div>
                @endif
                <!--<img src="../img/mappa.png" class="img-fluid rounded mx-auto d-block" alt="Responsive image">-->
                <h3><strong>Community:</strong></h3>
                <div align="center" class="col-m-10 col-sm-10">
                    <ul class="list-group ">
                        <li class="list-group-item ">Quante volte è stato percorso: {{$dati_sentiero->partecipanti}}</li>
                        <li class="list-group-item ">Media voti: {{$dati_sentiero->mediavoti}}</li>
                        <li class="list-group-item ">Difficoltà percepita: {{$dati_sentiero->difficoltamedia}}</li>
                        <li class="list-group-item "><q>Aggiunto ai preferiti: {{($dati_sentiero->preferiti)}}</q></li>
                    </ul>
                </div>


            </div>
        </div>
    </div>
</div>


    <div class="container">
    <div class="row" style="margin-top: 5em; margin-bottom: 3em;">
        <div class="col-md-3">
            <div class="header-sezione">
                <h3 class="pull-left">
                    Mappa
                </h3>

            </div>
        </div>
    </div>
</div>

@if($gpx=="")
NON CI SONO DATI
@else
<div style="max-width:100em;" id="map"></div>
<br>
<div class="container" >
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="col-md-12" id="elevation-div"></div>
        </div>
    </div>
</div>
@endif
     
    
    
    
    


<div class="container">
    <div class="row" style="margin-top: 5em; margin-bottom: 3em;">
        <div class="col-md-3">
            <div class="header-sezione">
                <h3 class="pull-left">
                    Esperienze personali
                    <br>
                    <button style="margin-top: 1em;" class="btn"data-toggle="modal" data-target="#modalForm"><i class="fa fa-plus"></i> Ho percorso questo sentiero</button>

                </h3>

            </div>
        </div>
    </div>
</div>

@if(($dati_sentiero->partecipanti) == 0)

<h3 class="text-center">Nessuno ha ancora percorso questo sentiero</h3>

@else

<div class="container">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
<!--        Indicators 
        <ol class="carousel-indicators" >
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>-->

        
        <div class="carousel-inner">

            <?php $pos = 1 ?>
            @foreach ($esperienze->chunk(1) as $esperienze4)


            <?php
            if ($pos == 1)
                echo '<div class="item active">';
            else
                echo '<div class="item">';
            $pos++
            ?>

            <div class="row col-md-10 col-md-offset-1">
                @foreach($esperienze4 as $esperienza)

                <div class="col-m-12 col-sm-12">
                    <ul align='center' class="list-group ">
                        <li class="list-group-item "><h4>{{ $esperienza->utente->username }}</h4></li>
                        <li style="height: 100px" class="list-group-item"><q>"{{ $esperienza->commento }}"</q></li>
                        <li class="list-group-item "><strong>Difficoltà:</strong>   {{ $esperienza->difficolta}}</li>
                        <li class="list-group-item "><strong>Voto:</strong>   {{ $esperienza->voto }}</li>
                        <li class="list-group-item "><strong>Data:</strong>   {{ $esperienza->data }}</li>
                    </ul>
                </div>

                @endforeach
            </div>
        </div>
        @endforeach

    </div>

    <div class="container">
    <a class="left carousel-control" style="background-image: none;" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" style="background-image: none;" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
    </a>
    </div>
</div>

@endif




<script type="text/javascript">
function image(img) {
    var src = img.src;
    window.open(src);
}

function sostituisci_immagine(img){
    var src = img.src;
    document.getElementById('im_4').src=src;
    document.getElementById('im_5').src=src;
}
 </script>

@if($immagini!=null)
             <div class="container" style="margin-top: 3em;">
                 <div class="row display-flexcol-md-12">
                     <div class="row display-flex">
                         <div class="col-md-4 col-xs-4">
                             <img src="{{$immagini[0]}}" class="thumbnail img-responsive" style="max-height: 300px; width:100%; height: auto;" onclick="sostituisci_immagine(this)" id="im_1" alt="logo"/>
                         </div>
                         <div class="col-md-4 col-xs-4">
                             <img src="{{$immagini[1]}}" class="thumbnail img-responsive" style="max-height: 300px; width:100%; height: auto;" onclick="sostituisci_immagine(this)" id="im_2" alt="logo"/>
                         </div>
                         <div class="col-md-4 col-xs-4">
                             <img src="{{$immagini[2]}}" class="thumbnail img-responsive" style="max-height: 300px; width:100%; height: auto;" onclick="sostituisci_immagine(this)" id="im_3" alt="logo"/>
                         </div>
                     </div>
                     <div class="row" style="margin-top: 1em;">
                         <div class="col-md-12">
                             <img src="{{$immagini[0]}}" class="thumbnail img-responsive" onclick="image(this)" style="width:100%;height:auto;" id="im_4" alt="logo"/>
                         </div>
                     </div>
                 </div>
             </div>
@endif


<div class="container">
     
@if(count($revisioni)==0)
@else
<div class="row" style="margin-top: 5em; margin-bottom: 3em;">
        <div class="col-md-3">
            <div class="header-sezione">
                <h3 class="pull-left">
                    Le tue esperienze in attesa di revisione
                </h3>

            </div>
        </div>
    </div>
<div class="container" style="margin-top: 3em;">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <table id="tabella_revisioni_sentiero" class="table table-striped table-hover table-responsive  table-sm" style="width:100%" data-toggle="table" data-search="true" data-show-columns="true" >
                <col width='20%'>
                <col width='10%'>
                <col width='35%'>
                <col width='15%'>
                
                <thead>
                    <tr class="table-bordered">
                        <th data-sortable="true" class="th-sm ">Data</th>
                        <th data-sortable="true" class="th-sm ">Voto</th>
                        <th data-sortable="true" class="th-sm ">Commento</th>
                        <th data-sortable="false" class="th-sm ">Stato</th>
                    </tr>
                </thead>

                <tbody>
                     @foreach($revisioni as $revisione)
                     <tr>
                        <td>{{ $revisione->data }}</td>
                        <td>{{ $revisione->voto }}</td>
                        <td>"{{ $revisione->commento }}"</td>
                        @if($revisione->stato == 'rifiutato')
                        <td style="color: red"><strong>{{$revisione->stato}}</strong></td>
                        @else
                        <td style="color: blue"><strong>In {{$revisione->stato}}...</strong></td>
                        @endif
                        
                    </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th class="th-sm table-bordered">Data</th>
                        <th class="th-sm table-bordered">Voto</th>
                        <th class="th-sm table-bordered">Commento</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    
</div>

@endif
</div>



<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   
    
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Inserisci una nota</h1>
            </div>
            <div class="modal-body">
                <form id="aggiungies_perienza" action="{{route('esperienza.store',['id'=>$sentiero->id])}}" method="get" style="margin-top: 2em;">
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
                            <button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>

                        </div>

                    </form>
                
            </div>
        </div> /.modal-content 
    </div> /.modal-dialog 
  
</div>

<script>
data.max = new Date().toISOString().split("T")[0];
</script>

<style>
    html, body, #map, #elevation-div { height: 100%; width: 100%; padding: 0; margin: 0; } 
#map { height: 75%; margin-left: auto; margin-right: auto; } 
#elevation-div {	height: 25%; font: 12px/1.5 "Helvetica Neue", Arial, Helvetica, sans-serif; }
</style>

<script>
    mappa("map", "elevation-div", '{{$gpx}}', true);
</script>
@endsection
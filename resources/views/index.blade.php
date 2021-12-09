
@extends('layouts.master2')

@section('titolo', 'Sentieri APP')



@section('sfondo')

    <!-- sfondo montagne con tasto ricerca-->
        <div class="container" style="margin-top: 5em;">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="jumbotron">
                    <h1 class="text-white text-center">Scopri la tua prossima esperienza</h1>
                    <h3 class="text-white text-center">Cerca tra i nostri sentieri per trovare quello giusto per te</h3>
                    <div class="text-center col-xs-12 pb-5">

                        <form style="padding-bottom:3em;" class="form-inline" name="form_ricerca" method="get" action="{{route('sentiero.ricercafiltrahome')}}">
                            <div class="form-group ">
                                <div>
                                    <input onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)" class="form-control" type="text" id="ricerca" name="ricerca" placeholder="Cerca">
                                </div>
                            </div>

                            <div class="form-group pl-3">
                                <div>
                                    <button type="submit"onclick="event.preventDefault(); valida_ricerca_home(this);"  class="btn btn-primary">Cerca</button>
                                    <input id="mySubmit" onclick="event.preventDefault(); valida_ricerca_home(this);" type="submit" value='Save' class="hidden"/>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
@endsection


@section('header')
<h1>
    Esplora
</h1>
@endsection

@section('breadcrumb')
@endsection

@section('corpo')
<div class="container">
        <div class="container">
            <div class="row">

                        <div class="col-sm-12 col-xs-12">

                            <div id="consigli-tab">

                                <!-- tab della nav tabs-->
                                <div>
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab-1" data-toggle="tab">Aggiunti di recente</a></li>
                                    <li><a href="#tab-2" data-toggle="tab">I più votati</a></li>
                                    <li><a href="#tab-3" data-toggle="tab">Consigliati per te</a></li>
                                    <li><a href="#tab-4" data-toggle="tab">Preferiti</a></li>
                                </ul>
                                </div>

                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-1">
                                        <div class="container">
                                            <div class="row">
                                            @if (count($sentieri_recenti) == 0)
                                                <p><h3 class="text-center">Non sono ancora stati inseriti sentieri</h3></p>
                                            @else
                                                @foreach($sentieri_recenti as $sentiero)
                                                    <div class="col-m-3 col-sm-3 col-xs-12">
                                                        <ul class="list-group">
                                                            <li class="list-group-item "><h4>{{ $sentiero->titolo }}</h4></li>
                                                            <li class="list-group-item "><strong>{{ $sentiero->categoria->nome }}</strong></li>
                                                            <li style="height: 50px" class="list-group-item "><q>{{ $sentiero->descrizione }}</q></li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-time"></span>   {{ $sentiero->durata }} ore</li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-repeat"></span>   {{ $sentiero->lunghezza }} Km</li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-chevron-up"></span>   {{ $sentiero->salita }} m</li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-chevron-down"></span>   {{ $sentiero->discesa }} m</li>
                                                            <li class="list-group-item "><a class="btn btn-info btn-block btn-round-bottom" href="{{route('sentiero.show',['sentiero'=>$sentiero->id])}}" role="button">Dettagli</a></li>
                                                        </ul>
                                                    </div>
                                                @endforeach
                                            @endif
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane" id="tab-2">
                                        @if (count($sentieri_piu_votati) == 0)
                                                <p><h3 class="text-center">Sembra nessuno abbia ancora lasciato dei voti</h3></p>
                                        @else
                                            @foreach($sentieri_piu_votati as $sentiero)
                                                    <div class="col-m-3 col-sm-3 col-xs-12">
                                                        <ul class="list-group">
                                                            <li class="list-group-item "><h4>{{ $sentiero->titolo }}</h4></li>
                                                            <li class="list-group-item "><strong>Media voti: {{ $sentiero->mediavoti }}</strong></li>
                                                            <li style="height: 50px" class="list-group-item "><q>{{ $sentiero->descrizione }}</q></li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-time"></span>   {{ $sentiero->durata }} ore</li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-repeat"></span>   {{ $sentiero->lunghezza }}Km</li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-chevron-up"></span>   {{ $sentiero->salita }}m</li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-chevron-down"></span>   {{ $sentiero->discesa }}m</li>
                                                            <li class="list-group-item "><a class="btn btn-info btn-block btn-round-bottom" href="{{route('sentiero.show',['sentiero'=>$sentiero->id])}}" role="button">Dettagli</a></li>
                                                        </ul>
                                                    </div>
                                                @endforeach
                                        @endif
                                    </div>
                                    <div class="tab-pane" id="tab-3">
                                        @if ($logged)
                                            @if (count($sentieri_consigliati) == 0)
                                                <p><h3 class="text-center">Sembra non ci siano ancora sentieri nella tua città</h3></p>
                                            @else

                                                @foreach($sentieri_consigliati as $sentiero)
                                                    <div class="col-m-3 col-sm-3 col-xs-12">
                                                        <ul class="list-group">
                                                            <li class="list-group-item "><h4>{{ $sentiero->titolo }}</h4></li>
                                                            <li class="list-group-item "><strong>Città: {{ $sentiero->citta->nome }}</strong></li>
                                                            <li style="height: 50px" class="list-group-item "><q>{{ $sentiero->descrizione }}</q></li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-time"></span>   {{ $sentiero->durata }} ore</li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-repeat"></span>   {{ $sentiero->lunghezza }} Km</li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-chevron-up"></span>   {{ $sentiero->salita }} m</li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-chevron-down"></span>   {{ $sentiero->discesa }} m</li>
                                                            <li class="list-group-item "><a class="btn btn-info btn-block btn-round-bottom" href="{{route('sentiero.show',['sentiero'=>$sentiero->id])}}" role="button">Dettagli</a></li>
                                                        </ul>
                                                    </div>
                                                @endforeach
                                            @endif
                                        @else
                                        <p><h3 class="text-center">Effettua il <a href="{{ route('user.auth.login') }}">login</a> per visualizzare questa sezione</h3></p>

                                        @endif
                                    </div>
                                    <div class="tab-pane" id="tab-4">
                                        @if ($logged)
                                            @if (count($sentieri_preferiti) == 0)
                                                <p><h3 class="text-center">Sembra che tu non abbia selezionato nessun preferito</h3></p>
                                            @else
                                                @foreach($sentieri_preferiti as $sentiero)
                                                    <div class="col-m-3 col-sm-3 col-xs-12">
                                                        <ul class="list-group">
                                                            <li class="list-group-item "><h4>{{ $sentiero->titolo }}</h4></li>
                                                            <li class="list-group-item ">{{ $sentiero->categoria->nome }}</li>
                                                            <li style="height: 50px" class="list-group-item "><q>{{ $sentiero->descrizione }}</q></li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-time"></span>   {{ $sentiero->durata }} ore</li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-repeat"></span>   {{ $sentiero->lunghezza }} Km</li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-chevron-up"></span>   {{ $sentiero->salita }} m</li>
                                                            <li class="list-group-item "><span class="glyphicon glyphicon-chevron-down"></span>   {{ $sentiero->discesa }} m</li>
                                                            <li class="list-group-item "><a class="btn btn-info btn-block btn-round-bottom" href="{{route('sentiero.show',['sentiero'=>$sentiero->id])}}" role="button">Dettagli</a></li>
                                                        </ul>
                                                    </div>
                                                @endforeach
                                            @endif
                                        @else
                                        <p><h3 class="text-center">Effettua il <a href="{{ route('user.auth.login') }}">login</a> per visualizzare questa sezione</h3></p>

                                        @endif

                                    </div>
                            </div>
                        </div><!-- /.col-sm-7 -->
                    </div><!-- /.row -->
            </div>


        </div>


</div>
<!--<div class="container">
    <div class="row">
        <div class="col-md-12">
            POLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO
        </div>
    </div>
</div>-->

@endsection

@extends('layouts.master2')

@section('titolo', 'Utente')


@section('sfondo')
@endsection


@section('header')
<h2 class="pull-left">Dettagli utente</h2>
@endsection

@section('breadcrumb')
<ul class="breadcrumb pull-right">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a href="{{ route('user.elenco') }}">Utenti</a></li>
    <li class="active">Account</li>
</ul>
@endsection

@section('corpo')
<div class="container pt-5" style="margin-top: 2em;" onclick="close_popup()">


    <div class="row">

        <div align="center" class="col-md-12">
                <div class="col-md-2 col-md-offset-5 col-m-2 col-sm-4 col-sm-offset-4" style="position:relative">
                    <img alt="image" style="max-height: 200px; width:100%; height: auto;"class="img-circle img-responsive " src="{{$url}}">
                    <div class="row col-md-12 col-m-12 col-sm-12">
                        <h3><strong style="margin-right: 0em">{{ $user_dettagli->username }}  </strong></h3>
                        <button class="btn" onclick="location.href='{{ route('user.edit', ['id'=> $user_id]) }}'">Modifica  <span class="glyphicon glyphicon glyphicon-cog"></span></button>
                    </div>
                </div>

                <div align="center" class="col-md-8 col-md-offset-3 col-sm-12" style="margin-bottom: 3em">

                        <div >
                            @if ($user_dettagli->id == $user_id)
                            <br>
                                 <form  action="{{route('user.fotoprofilo',['id'=> $user->id])}}" id="modifica_foto_profilo" style="margin-top: 2em" name="modifica_foto_profilo" method="POST" enctype="multipart/form-data"> {{ csrf_field() }}

                                    <div class="form-group"  >
                                        <div class="col-sm-12">
                                            <input style="display:none; visibility:hidden" onchange="check_foto_profilo(this);" onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)"class="form-control" type="file" id="foto_profilo" name="foto_profilo" placeholder="foto_profilo">
                                            <span class="invalid-input" id="invalid-foto_profilo"></span>
                                        </div>
                                        <div class="col-sm-4" onclick="event.stopPropagation()">

                                            <div style="margin-left: 1em;" class="popup" onclick="popup2(this)" >
                                                <span class="popuptext">JPEG, PNG, JPG, SVG, Masssimo 2 MB</span>
                                                <span class="glyphicon glyphicon-info-sign" ></span>
                                            </div>
                                            <label for="foto_profilo" class="col-form-label">Foto profilo</label>
                                        </div>

                                        <div class="col-sm-2">
                                            <input type="hidden" name="id" value="{{ $user_id }}"/>
                                            <label for="mySubmit" class="btn btn-primary btn-large btn-info"><span class="glyphicon glyphicon-floppy-save"></span> Carica</label>
                                            <input onclick="event.preventDefault(); load_file(this); " id="mySubmit" type="submit" value="save" class="hidden"/>

                                        </div>

                                        <div class="col-sm-2">
                                            @if($url!="http://127.0.0.1:8000/storage/fotoprofilo/default" )
                                            <button  type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#modalFormRimuoviFoto"> Rimuovi immagine</button>
                                            @else
                                            <button disabled="" type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#modalFormRimuoviFoto"> Rimuovi immagine</button>
                                            @endif
                                        </div>


                                    </div>

                                    <div class="form-group">

                                    </div>
                                </form>
                                @endif
                        </div>


                    </div>





                <div class="col-md-8 col-md-offset-2 col-sm-12" >


                    <div class="col-md-12" >
                    <ul class="list-group">
                        <li class="list-group-item"><q>Nome: {{ $user_dettagli->nome }}</q></li>
                        <li class="list-group-item ">Cognome: {{ $user_dettagli->cognome }}</li>
                        @if($user->id == $user_dettagli->id)
                        <li class="list-group-item ">Città: {{ $user_dettagli->citta->nome }}</li>
                        <li class="list-group-item ">Mail: {{ $user_dettagli->mail }}</li>
                        <li class="list-group-item "><a href="{{route('esperienza.mieesperienze',['id'=> $user->id])}}">Le mie esperienze</a></li>
                        @if(count($user_dettagli->preferiti)==0)
                        <li class="list-group-item ">Preferiti: {{ count($user_dettagli->preferiti) }}</a></li>
                        @else
                        <li class="list-group-item ">Preferiti: <a href="{{ route('user.preferiti', ['id'=> $user_id]) }}">{{ count($user_dettagli->preferiti) }}</a></li>
                        @endif
                        @else
                        <li class="list-group-item "><a href="{{route('esperienza.esperienzeutente',['id'=> $user_dettagli->id])}}">Esperienze personali</a></li>
                        @endif
                        <li class="list-group-item ">Percorsi effettuati: {{ count($sentieri_effettuati) }}</li>

                        <li class="list-group-item all_text"><q>"{{$user_dettagli->descrizione}}"</q></li>
                    </ul>


                    </div>
                </div>

        </div>
    </div>

    @if ($user_dettagli->id == $user_id)
    <!--action="{{route('user.update',['id'=> $user->id])}}"-->


    @endif

        <div class="row" style="margin-top: 5em; margin-bottom: 3em;">
        <div class="col-md-3">
            <div class="header-sezione">
                <h3 class="pull-left">Percorsi effettuati</h3>
            </div>
        </div>
        </div>
        <div class="row">

                <div class="col-md-10 col-md-offset-1">
                    <table id="tabella_elenco_sentieri_effettuati" class="table table-striped table-hover table-responsive  table-sm" style="width:100%" data-toggle="table" data-search="true" data-show-columns="true" >
                        <col width='40%'>
                        <col width='20%'>
                        <col width='20%'>
                        <col width='10%'>

                        <thead>
                            <tr class="table-bordered">
                                <th data-sortable="true" class="th-sm ">Titolo</th>
                                <th data-sortable="true" class="th-sm ">Categoria</th>
                                <th data-sortable="true" class="th-sm ">Città</th>
                                <th class="th-sm" data-sortable="false"></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($sentieri_effettuati as $sentiero)
                            <tr>
                                <td><a style="color:inherit; text-decoration: none;" href="{{route('sentiero.show',['sentiero'=>$sentiero->id])}}">{{ $sentiero->titolo }}</a></td>
                                <td>{{ $sentiero->categoria->nome }}</td>
                                <td>{{ $sentiero->citta->nome }}</td>
                                <td>
                                    <a class="btn btn-info" href="{{route('sentiero.show',['sentiero'=>$sentiero->id])}}"><span class="glyphicon glyphicon-info"></span> Info</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>


    </div>

@if(count($esperienze) == 0)
@else

<div class="container">
    <div class="row" style="margin-top: 5em; margin-bottom: 3em;">
        <div class="col-md-3">
            <div class="header-sezione">
                <h3 class="pull-left">Esperienze personali</h3>
            </div>
        </div>
    </div>


<div id="myCarousel" class="carousel slide container" data-ride="carousel">
  <!-- Indicators -->
<!--  <ol class="carousel-indicators" >
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>-->

  <!-- Wrapper for slides -->
  <div class="carousel-inner">

      <?php $pos = 1 ?>
      @foreach ($esperienze->chunk(4) as $esperienze4)


      <?php
      if ($pos == 1)
          echo '<div class="item active">';
      else
          echo '<div class="item">';
      $pos++
      ?>

      <div class="row col-md-10 col-md-offset-1">
          @foreach($esperienze4 as $esperienza)

          <div class="col-m-3 col-sm-3">
              <ul class="list-group ">
                  <li align='center' class="list-group-item "><h4>{{ $esperienza->sentiero->titolo }}</h4></li>
                  <li style="height: 80px" class="list-group-item"><q>{{ $esperienza->sentiero->descrizione }}</q></li>
                  <li class="list-group-item ">Difficoltà:   {{ $esperienza->difficolta}}</li>
                  <li class="list-group-item ">Voto:   {{ $esperienza->voto }}</li>
                  <li class="list-group-item "><a class="btn btn-info btn-block btn-round-bottom" href="{{route('sentiero.show',['sentiero'=>$sentiero->id])}}" role="button">Dettagli sentiero</a></li>
              </ul>
          </div>

          @endforeach
      </div>
  </div>
  @endforeach

  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" style="background-image: none;" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" style="background-image: none;" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>


</div>
<br>
<br>
<br>
@endif
@endsection


<div class="modal" id="modalFormRimuoviFoto" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title">Vuoi eliminare la foto profilo?</h1>

        </div>
        <div class="modal-body">
          <p>La tua foto profilo verrà eliminata</p>
        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-primary btn-danger" onclick="location.href='{{route('user.rimuovifotoprofilo',['id'=> $user->id])}}'">Elimina</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
        </div>
      </div>
    </div>
</div>

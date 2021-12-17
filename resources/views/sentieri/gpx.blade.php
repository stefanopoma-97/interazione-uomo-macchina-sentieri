@extends('layouts.master2')

@section('titolo', 'GPS sentiero')



@section('sfondo')
@endsection


@section('header')
<h2 class="pull-left">Gestione dati GPS: {{$sentiero->titolo}}</h2>
@endsection

@section('breadcrumb')
<ul class="breadcrumb pull-right">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a href="{{ route('sentiero.index')  }}">Elenco sentieri</a></li>
    <li><a href="{{ route('sentiero.edit', ['sentiero'=> $sentiero->id]) }}">Modifica sentiero</a></li>
    <li class="active">Dati GPS</li>
</ul>
@endsection

@section('corpo')
<div class="row col-md-12" onclick="close_popup()">
        <div class="col-md-1 col-md-offset-9">
            <button class="btn" onclick="location.href='{{ route('sentiero.edit', ['sentiero'=> $sentiero->id]) }}'"><span class="glyphicon glyphicon-save"></span> Salva e torna alle modifiche</button>
        </div>
</div>
 <div style="margin-top: 3em;" class="container" onclick="close_popup()">
     <div class="row display-flex">

         <div class="col-xs-6 col-sm-4 col-sm-offset-4">
             <div class="text-center box-progetto">
                 <h5 for="gpx" class="col-form-label" onclick="event.stopPropagation()"><strong>File GPX</strong>
                     <div style="margin-left: 1em;" class="popup" onclick="popup2(this)" >
                         <span class="popuptext">Filie .gpx, Masssimo 2 MB</span>
                         <span class="glyphicon glyphicon-info-sign" ></span>
                     </div>
                 </h5>


                 <form action="{{route('sentiero.aggiungigpx',['id'=> $sentiero->id])}}" id="aggiungi_gpx" name="aggiungi_gpx" method="POST" enctype="multipart/form-data"> {{ csrf_field() }}

                     <div class="form-group">
                         <div style="margin-bottom: 1em" class="col-sm-12">
                             <input style="display:none;" onchange="check_gpx2(this)"; onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)"class="form-control" type="file" id="gpx" name="gpx" placeholder="gpx">
                             <span class="invalid-input" id="invalid-gpx"></span>
                         </div>
                         <div class="col-sm-2 col-sm-offset-2">
                             <input type="hidden" name="nome_input" value="gpx"/>
                             <input type="hidden" name="nome_file" value="gpx"/>
                             <label for="mySubmit" class="btn btn-primary btn-large btn-info"><span class="glyphicon glyphicon-floppy-save"></span> Carica</label>
                             <input onclick="event.preventDefault(); load_gpx(this);"  id="mySubmit" type="submit" value="save" class="hidden"/>
                         </div>


                     </div>

                 </form>
                 @if($gpx!="")
                 <button class="btn btn-danger" onclick="location.href='{{route('sentiero.rimuovigpx',['id'=> $sentiero->id])}}'"><span class="glyphicon glyphicon-trash"></span</button>
                 @else
                 <button disabled="" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span</button>
                 @endif


             </div>
         </div><!-- /.col-sm-3 -->
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

@if($gpx!="")
<p></p>
@else
<h3 class="text-center" >Non sono presenti dati</h3>
@endif
<div class="container" id="map"></div>

<br>
<br>


<script>
    mappa("map", "elevation-div", '{{$gpx}}', false);
</script>

<!--<div style="margin-top: 3em;" class="container">
    <div class="row">
        <div class="col-md-10">
            <button class="btn btn-info"><span class="glyphicon glyphicon-save">Salva</span</button>
        </div>
    </div>
</div>-->




@endsection

@extends('layouts.master2')

@section('titolo', 'Immagini sentiero')



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
<div class="row col-md-12" onclick="close_popup()">
        <div class="col-md-1 col-md-offset-9">
            <button class="btn" onclick="location.href='{{ route('sentiero.edit', ['sentiero'=> $sentiero->id]) }}'"><span class="glyphicon glyphicon-save"></span> Salva e torna alle modifiche</button>
        </div>
    </div>
 <div style="margin-top: 3em;" class="container">
             <div class="row display-flex">

                <div class="col-xs-6 col-sm-4">
                    <div class="text-center box-progetto">
                        <div onclick="event.stopPropagation()">
                            <h5 for="immagine" class="col-form-label"><strong>IMMAGINE 1</strong>
                            <div style="margin-left: 1em;" class="popup" onclick="popup2(this)" >
                                <span class="popuptext">JPEG, PNG, JPG, SVG, Masssimo 2 MB</span>
                                <span class="glyphicon glyphicon-info-sign" ></span>
                            </div>
                            </h5>
                        </div>

                        <img class="thumbnail img-responsive" src="{{$link1}}" alt="Libri">
                        <form action="{{route('sentiero.aggiungiimmagine',['id'=> $sentiero->id])}}" id="aggiungi_immagine_1" name="aggiungi_immagine_1" method="POST" enctype="multipart/form-data"> {{ csrf_field() }}
                            <!--<h4>{{$link1}}</h4>-->
                            <div class="form-group">
                                <div style="margin-top: 1em; margin-bottom: 1em" class="col-sm-12">
                                    <input style="display:none;" onchange="check_immagine2(this)"; onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)"class="form-control" type="file" id="immagine1" name="immagine" placeholder="immagine">
                                    <span class="invalid-input" id="invalid-immagine_1"></span>
                                </div>
                                <div class="col-sm-2 col-sm-offset-2">
                                    <input type="hidden" name="nome_input" value="immagine1"/>
                                    <input type="hidden" name="nome_file" value="1"/>
                                    <label for="mySubmit1" class="btn btn-primary btn-large btn-info"><span class="glyphicon glyphicon-floppy-save"></span> Carica</label>
                                    <input onclick="event.preventDefault(); load_immagine1(this)"  id="mySubmit1" type="submit" value="save" class="hidden"/>
                                </div>

                                <div class="col-sm-2 col-sm-offset-2">
                                    @if($link1=="http://127.0.0.1:8000/storage/fotosentieri/default")
                                    <a class="btn btn-disabled" href="{{route('sentiero.rimuoviimmagine',['id'=> $sentiero->id, 'nome'=> '1'])}}">
                                        <span class="glyphicon glyphicon-trash"></span></a>

                                    @elseif ($link1=="http://localhost:8000/storage/fotosentieri/default")
                                    <a class="btn btn-disabled" href="{{route('sentiero.rimuoviimmagine',['id'=> $sentiero->id, 'nome'=> '1'])}}">
                                        <span class="glyphicon glyphicon-trash"></span></a>
                                    @else
                                    <a class="btn btn-danger" href="{{route('sentiero.rimuoviimmagine',['id'=> $sentiero->id, 'nome'=> '1'])}}">
                                        <span class="glyphicon glyphicon-trash"></span></a>
                                    @endif
                                </div>
                            </div>

                        </form>
                    </div>
                </div><!-- /.col-sm-3 -->

                <div class="col-xs-6 col-sm-4">
                    <div class="text-center box-progetto">
                        <div onclick="event.stopPropagation()">
                            <h5 for="immagine" class="col-form-label"><strong>IMMAGINE 2</strong>
                            <div style="margin-left: 1em;" class="popup" onclick="popup2(this)" >
                            <span class="popuptext">JPEG, PNG, JPG, SVG, Masssimo 2 MB</span>
                            <span class="glyphicon glyphicon-info-sign" ></span>
                            </div>
                            </h5>
                        </div>

                        <img class="thumbnail img-responsive" src="{{$link2}}" alt="Libri">
                        <form action="{{route('sentiero.aggiungiimmagine',['id'=> $sentiero->id])}}" id="aggiungi_immagine_2" name="aggiungi_immagine_2" method="POST" enctype="multipart/form-data"> {{ csrf_field() }}
                            <!--<h4>{{$link2}}</h4>-->
                            <div class="form-group">
                                <div style="margin-top: 1em; margin-bottom: 1em" class="col-sm-12">
                                    <input style="display:none;" onchange="check_immagine2(this)"; onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)"class="form-control" type="file" id="immagine2" name="immagine" placeholder="immagine">
                                    <span class="invalid-input" id="invalid-immagine_1"></span>
                                </div>
                                <div class="col-sm-2 col-sm-offset-2">
                                    <input type="hidden" name="nome_input" value="immagine2"/>
                                    <input type="hidden" name="nome_file" value="2"/>
                                    <label for="mySubmit2" class="btn btn-primary btn-large btn-info"><span class="glyphicon glyphicon-floppy-save"></span> Carica</label>
                                    <input onclick="event.preventDefault(); load_immagine2(this);"  id="mySubmit2" type="submit" value="save" class="hidden"/>
                                </div>

                                <div class="col-sm-2 col-sm-offset-2">
                                    @if($link2=="http://127.0.0.1:8000/storage/fotosentieri/default")
                                    <a class="btn btn-disabled" href="{{route('sentiero.rimuoviimmagine',['id'=> $sentiero->id, 'nome'=> '2'])}}">
                                        <span class="glyphicon glyphicon-trash"></span></a>

                                    @elseif ($link2=="http://localhost:8000/storage/fotosentieri/default")
                                    <a class="btn btn-disabled" href="{{route('sentiero.rimuoviimmagine',['id'=> $sentiero->id, 'nome'=> '2'])}}">
                                        <span class="glyphicon glyphicon-trash"></span></a>
                                    @else
                                    <a class="btn btn-danger" href="{{route('sentiero.rimuoviimmagine',['id'=> $sentiero->id, 'nome'=> '2'])}}">
                                        <span class="glyphicon glyphicon-trash"></span></a>
                                    @endif
                                </div>
                            </div>

                        </form>
                    </div>
                </div>


                <div class="col-xs-6 col-sm-4">
                    <div class="text-center box-progetto" onclick="event.stopPropagation()">
                        <div onclick="event.stopPropagation()">
                            <h5 for="immagine" class="col-form-label"><strong>IMMAGINE 3</strong>
                            <div style="margin-left: 1em;" class="popup" onclick="popup2(this)" >
                                <span class="popuptext">JPEG, PNG, JPG, SVG, Masssimo 2 MB</span>
                                <span class="glyphicon glyphicon-info-sign" ></span>
                            </div>
                            </h5>
                        </div><!-- comment -->


                        <img class="thumbnail img-responsive" src="{{$link3}}" alt="Immagine 3">
                        <form action="{{route('sentiero.aggiungiimmagine',['id'=> $sentiero->id])}}" id="aggiungi_immagine_3" name="aggiungi_immagine_3" method="POST" enctype="multipart/form-data"> {{ csrf_field() }}
                            <!--<h4>{{$link3}}</h4>-->
                            <div class="form-group">
                                <div style="margin-top: 1em; margin-bottom: 1em" class="col-sm-12">
                                    <input style="display:none;" onchange="check_immagine2(this)"; onkeyup="rimuovi_stile(this)" onmouseover="rimuovi_stile(this)"class="form-control" type="file" id="immagine3" name="immagine" placeholder="immagine">
                                    <span class="invalid-input" id="invalid-immagine_1"></span>
                                </div>

                                <div class="col-sm-2 col-sm-offset-2">
                                    <input type="hidden" name="nome_input" value="immagine3"/>
                                    <input type="hidden" name="nome_file" value="3"/>
                                    <label for="mySubmit3" class="btn btn-primary btn-large btn-info"><span class="glyphicon glyphicon-floppy-save"></span> Carica</label>
                                    <input onclick="event.preventDefault(); load_immagine3(this);"  id="mySubmit3" type="submit" value="save" class="hidden"/>
                                </div>

                                <div class="col-sm-2 col-sm-offset-2">
                                    @if($link3=="http://127.0.0.1:8000/storage/fotosentieri/default")
                                    <a class="btn btn-disabled" href="{{route('sentiero.rimuoviimmagine',['id'=> $sentiero->id, 'nome'=> '3'])}}">
                                        <span class="glyphicon glyphicon-trash"></span></a>

                                    @elseif ($link3=="http://localhost:8000/storage/fotosentieri/default")
                                    <a class="btn btn-disabled" href="{{route('sentiero.rimuoviimmagine',['id'=> $sentiero->id, 'nome'=> '3'])}}">
                                        <span class="glyphicon glyphicon-trash"></span></a>
                                    @else
                                    <a class="btn btn-danger" href="{{route('sentiero.rimuoviimmagine',['id'=> $sentiero->id, 'nome'=> '3'])}}">
                                        <span class="glyphicon glyphicon-trash"></span></a>
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

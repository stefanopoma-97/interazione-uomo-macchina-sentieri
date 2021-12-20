@extends('layouts.master2')

@section('titolo', 'Elenco sentieri')



@section('sfondo')
@endsection


@section('header')
<h2 class="pull-left">Elenco Sentieri</h2>
@endsection

@section('breadcrumb')
<ul class="breadcrumb pull-right">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li class="active">Elenco sentieri</li>
</ul>
@endsection

@section('corpo')
 <!-- tabella utenti-->
        <div class="container" style="margin-top: 3em;">
            <div class="row">
                <div class="col-md-10 col-md-offset-1" style="margin-bottom: 2em">
                    <button class="btn btn-primary" onclick="location.href='{{ route('sentiero.create') }}'">
                        <span class="fa fa-plus"></span> Nuovo Sentiero
                    </button>
                </div>
            </div>

            <div class="row">
                <div hidden="" class="col-md-offset-10 col-xs-6">
                    <p>
                        <a class="btn btn-success" href="{{ route('sentiero.create') }}"><span class="glyphicon glyphicon-new-window"></span> Nuovo</a>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <table id="tabella_elenco_sentieri" class="table table-striped table-hover table-responsive  table-sm" style="width:100%" data-toggle="table" data-search="true" data-show-columns="true" >
                        <col width='50%'>
                        <col width='30%'>
                        <col width='10%'>
                        <col width='10%'>

                        <thead>
                            <tr>
                                <th>Titolo</th>
                                <th>Creatore</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($sentieri as $sentiero)
                            <tr>
                                <td><a style="color:inherit; text-decoration: none;" href="{{route('sentiero.show',['sentiero'=>$sentiero->id])}}">{{ $sentiero->titolo }}</a></td>
                                <td><a style="color:inherit; text-decoration: none;" href="{{route('user.dettagli', ['id'=> $sentiero->autore->id])}}">{{ $sentiero->autore->nome }}</a></td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('sentiero.edit', ['sentiero'=> $sentiero->id]) }}"><span class="glyphicon glyphicon-pencil"></span> Modifica</a>
                                </td>
                                <td>
                                    <a class="btn btn-danger" href="{{ route('sentiero.destroy.confirm', ['id'=> $sentiero->id]) }}"><span class="glyphicon glyphicon-trash"></span> Cancella</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                        <?php /*<tr>
                            <td colspan="4">
                                <button class="btn" onclick="location.href='{{ route('sentiero.create') }}'"><i class="fa fa-plus"></i> Nuovo</button>
                            </td>
                        </tr>*/ ?>

                    </table>
                </div>
            </div>

        </div>
@endsection

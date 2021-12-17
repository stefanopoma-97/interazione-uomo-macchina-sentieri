@extends('layouts.master2')

@section('titolo', 'Preferiti')



@section('sfondo')
@endsection


@section('header')
<h2 class="pull-left">Sentieri Preferiti</h2>
@endsection

@section('breadcrumb')
<ul class="breadcrumb pull-right">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a class="bordo-selezione" href="{{ route('user.elenco') }}">Utenti</a></li>
    <li><a href="{{ route('user.dettagli', ['id'=> $user_id]) }}">Account</a></li>
    <li class="active">Sentieri Preferiti</li>
</ul>
@endsection

@section('corpo')
 <!-- tabella utenti-->
        <div class="container" style="margin-top: 3em;">
            <div class="row">
                <div hidden="" class="col-md-offset-10 col-xs-6">
                    <p>
                        <a class="btn btn-success" href="{{ route('sentiero.create') }}"><span class="glyphicon glyphicon-new-window"></span> Nuovo</a>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <table id="tabella_elenco_preferiti" class="table table-striped table-hover table-responsive  table-sm" style="width:100%" data-toggle="table" data-search="true" data-show-columns="true" >
                        <col width='50%'>
                        <col width='20%'>
                        <col width='20%'>
                        <col width='10%'>

                        <thead>
                            <tr>
                                <th>Titolo</th>
                                <th>CIttà</th>
                                <th>Categoria</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($preferiti as $sentiero)
                            <tr>
                                <td><a style="color:inherit; text-decoration: none;" href="{{route('sentiero.show',['sentiero'=>$sentiero->id])}}">{{ $sentiero->titolo }}</a></td>
                                <td>{{ $sentiero->citta->nome }}</td>
                                <td>
                                    {{$sentiero->categoria->nome}}
                                </td>
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
 <br>
 <br>
 <br>
@endsection

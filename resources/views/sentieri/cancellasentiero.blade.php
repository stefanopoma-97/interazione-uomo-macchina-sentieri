@extends('layouts.master')

@section('titolo', 'Cancella sentiero')

@section('navbar_home')
@endsection


@section('navbar')
@endsection

@section('sfondo')
@endsection


@section('header')
@endsection

@section('breadcrumb')
@endsection

@section('corpo')
<div class="container text-center">
    <div class="row">
        <div class="col-md-12">
            <header>
                <h1>
                    Cancella il sentiero
                </h1>
            </header>
            <p class='lead'>
                Confermi?
            </p>
        </div>
    </div>
</div>

<div class="container text-center">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class='panel-heading'>
                    Annulla
                </div>
                <div class='panel-body'>
                    <h4><p>Il sentiero <strong>non sarà rimosso</strong> dal database</p></h4>
                    <p><a class="btn btn-default" href="{{route('sentiero.index')}}"><span class='glyphicon glyphicon-log-out'></span> Annulla</a></p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class='panel-heading'>
                    Conferma
                </div>
                <div class='panel-body'>
                    <h4><p>Il sentiero <strong>sarà rimosso</strong> dal database</p></h4>
                    <p>Saranno rimosse anche tutte le esperienze associate a questo sentiero</p>
                    <p>e le relazioni di "preferito"</p>
                    <p><a class="btn btn-danger" href="{{route('sentiero.destroy',['id'=> $sentiero->id]) }}" ><span class='glyphicon glyphicon-trash'></span> Cancella</a></p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
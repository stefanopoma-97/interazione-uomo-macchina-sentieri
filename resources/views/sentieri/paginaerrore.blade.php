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
            <div class="panel panel-danger">
                <div class='panel-heading'>
                    Accesso non consentito
                </div>
                <div class='panel-body'>
                    <p>Something <strong>wrong</strong> happened while accessing this page</p>
                    <p><a class="btn btn-default" href="{{ route('home') }}"><span class='glyphicon glyphicon-log-out'></span> Home </a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
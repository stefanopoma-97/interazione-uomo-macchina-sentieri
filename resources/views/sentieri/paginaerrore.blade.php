@extends('layouts.master2')

@section('titolo', 'Errore')



@section('sfondo')
@endsection


@section('header')
@endsection

@section('breadcrumb')
@endsection

@section('corpo')
<br>
<br>
<br>
<div class="container text-center">
   
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-danger">
                <div class='panel-heading'>
                    Accesso non consentito
                </div>
                <div class='panel-body'>
                    <p>Qualcosa <strong>è andato storto</strong> cercando di accedere a questa pagina</p>
                    <p><a class="btn btn-default" href="{{ route('home') }}"><span class='glyphicon glyphicon-log-out'></span> Home </a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
@endsection
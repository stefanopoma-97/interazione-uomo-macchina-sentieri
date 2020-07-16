@extends('layouts.master')

@section('titolo', 'Revisionare')

@section('navbar_home')
<a class="navbar-brand" href="{{ route('home') }}">Sentieri</a>
@endsection


@section('navbar')
<li><a class="bordo-selezione" href="{{ route('sentiero.ricerca') }}">Sentieri</a></li>
<li><a class="bordo-selezione" href="{{ route('user.elenco') }}">Utenti</a></li>

    @if($logged)
    
    @if($user->admin == 'y')
    <li class="nav-item avatar dropdown">
        <a disable="" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            @if($count_revisioni==0)
            <!--<span class="badge badge-danger ml-2">{{$count_revisioni}}</span>-->
            <span class="material-icons">notifications_none</span> 
            @else
            <!--<span style="background-color:red" class="badge badge-danger ml-2">{{$count_revisioni}}</span>-->
            <span class="material-icons">notifications_active</span> 
            @endif
        </a>
        <ul class="dropdown-menu">
            @if($count_revisioni==0)
            <li><a class="dropdown-item waves-effect waves-light" href="{{ route('esperienza.darevisionare',  ['id'=> $user_id]) }}">Non ci sono commenti da revisionare <span class="badge badge-danger ml-2">{{$count_revisioni}}</span></a></li>
            @else
            <li><a class="dropdown-item waves-effect waves-light" href="{{ route('esperienza.darevisionare',  ['id'=> $user_id]) }}">Commenti da revisionare <span class="badge badge-danger ml-2">{{$count_revisioni}}</span></a></li>
            @endif
        </ul>
    </li>
    @else
    @endif
    
    <li class="dropdown" style="margin-left: 5em;">
        <a class="btnsignin dropdown-toggle" href="#" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span></a>
        <ul class="dropdown-menu">
            <li><a href="{{ route('user.dettagli', ['id'=> $user_id]) }}">{{$user->nome}}</a></li>
            <li><a href="{{ route('user.preferiti', ['id'=> $user_id]) }}">Preferiti</a></li>
            @if($user->admin == 'y')
            <li><a href="{{ route('sentiero.index') }}">Lista sentieri</a></li>
            <li><a href="{{ route('esperienza.darevisionare',  ['id'=> $user_id]) }}">Revisioni</a></li>
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
<h2 class="pull-left">Esperienze da revisionare</h2>
@endsection

@section('breadcrumb')
<ul class="breadcrumb pull-right">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a href="{{ route('user.dettagli', ['id'=> $user_id]) }}">Account</a></li>
    <li class="active">Esperienze da revisionare</li>
</ul>
@endsection

@section('corpo')
<!-- tabella utenti-->
<div class="container" style="margin-top: 3em;">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <table id="tabella_elenco_utenti" class="table table-striped table-hover table-responsive  table-sm" style="width:100%" data-toggle="table" data-search="true" data-show-columns="true" >
                <col width='20%'>
                <col width='20%'>
                <col width='40%'>
                <col width='10%'>
                <col width='10%'>
                <thead>
                    <tr class="table-bordered">
                        <th data-sortable="true" class="th-sm ">Sentiero</th>
                        <th data-sortable="true" class="th-sm ">Data</th>
                        <th data-sortable="true" class="th-sm ">Commento</th>
                        <th data-sortable="false" class="th-sm "></th>
                        <th data-sortable="false" class="th-sm "></th>
                    </tr>
                </thead>
                
               

                <tbody>
                     @foreach($esperienze as $esperienza)
                    <tr>
                        <td><a style="color:inherit; text-decoration: none;" href="{{route('sentiero.show',['sentiero'=>$esperienza->sentiero->id])}}">{{ $esperienza->sentiero->titolo }}</a></td>
                        <td>{{ $esperienza->data }}</td>
                        <td>{{ $esperienza->commento }}</td>
                        <td>
                            <a class="btn btn-success" href="{{ route('esperienza.approvato',['id'=> $esperienza->id]) }}"><span class="glyphicon glyphicon-thumbs-up"></span></a>
                        </td>
                        <td>
                            <a class="btn btn-danger" data-idexp="{{$esperienza->id}}" data-toggle="modal" data-target="#modalForm"><span class="glyphicon glyphicon-thumbs-down"></span></a>
                            
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th data-sortable="true" class="th-sm ">Sentiero</th>
                        <th data-sortable="true" class="th-sm ">Data</th>
                        <th data-sortable="true" class="th-sm ">Commento</th>
                        <th data-sortable="false" class="th-sm "></th>
                        <th data-sortable="false" class="th-sm "></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    
</div>
@if(empty($esperienze))
@else
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   
    
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Inserisci una nota</h1>
            </div>
            <div class="modal-body">
                <form role="form" id="form_nota" method="get" action="action">
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <div class="form-group">
                        <label class="control-label">Nota:</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="nota" value="">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-danger">Invia</button>
 
                            <button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
                        </div>
                    </div>
                </form>
                
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  
</div>
<script>
$('#modalForm').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget); // Button that triggered the modal
  var recipient = button.data('idexp'); // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this);
//  window.confirm(recipient);
//  window.confirm($('#form_nota').attr('action'));
//  modal.find('.modal-title').text('New message to ' + recipient);
  $('#form_nota').attr('action',"http://localhost:8000/utente/revisioni/"+recipient+"/rifiutato");
//  window.confirm($('#form_nota').attr('action'));
  //modal.find('.modal-title').text($('#form_nota')attr('action'));
  
});
</script>
@endif


<!--<div class="text-center">
  <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalForm">Launch
    Modal Login Form</a>
</div>-->

@endsection
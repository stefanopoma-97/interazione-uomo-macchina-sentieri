@extends('layouts.master2')

@section('titolo', 'Esperienze utente')



@section('sfondo')
@endsection


@section('header')
<h2 class="pull-left">Esperienze personali</h2>
@endsection

@section('breadcrumb')
<ul class="breadcrumb pull-right">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a class="bordo-selezione" href="{{ route('user.elenco') }}">Utenti</a></li>
    <li><a href="{{ route('user.dettagli', ['id'=> $utente_id]) }}">Account</a></li>
    <li class="active">Esperienze</li>
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
                <col width='10%'>
                <col width='35%'>
                <col width='15%'>
                <thead>
                    <tr class="table-bordered">
                        <th data-sortable="true" class="th-sm ">Sentiero</th>
                        <th data-sortable="true" class="th-sm ">Data</th>
                        <th data-sortable="true" class="th-sm ">Voto</th>
                        <th data-sortable="true" class="th-sm ">Commento</th>
                        <th data-sortable="true" class="th-sm ">Stato</th>
                    </tr>
                </thead>

                <tbody>
                     @foreach($esperienze as $esperienze)
                    <tr>
                        <td><a style="" href="{{route('sentiero.show',['sentiero'=>$esperienze->sentiero->id])}}">{{ $esperienze->sentiero->titolo }}</a></td>
                        <td>{{ $esperienze->data }}</td>
                        <td>{{ $esperienze->voto }}</td>
                        <td>{{ $esperienze->commento }}</td>
                        @if($esperienze->stato=='rifiutato')
                        <td style="color:#da0000"><strong>{{ $esperienze->stato }}</strong>
                            <div style="margin-left: 1em;" class="popup" onclick="popup(this)">
                                @if($esperienze->nota == "")
                                <span class="popuptext">Non è stata inserita nessuna nota dal moderatore</span>
                                @else
                                <span class="popuptext">{{$esperienze->nota}}</span>
                                @endif

                                <span class="glyphicon glyphicon-info-sign" ></span>
                            </div>
                        </td>
                        @else
                            @if($esperienze->stato=='approvato')
                            <td style="color:green"><strong>{{ $esperienze->stato }}</strong>
                            @else
                            <td>{{ $esperienze->stato }}</td>
                            @endif

                        @endif
                    </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th data-sortable="true" class="th-sm ">Sentiero</th>
                        <th data-sortable="true" class="th-sm ">Data</th>
                        <th data-sortable="true" class="th-sm ">Voto</th>
                        <th data-sortable="true" class="th-sm ">Commento</th>
                        <th data-sortable="true" class="th-sm ">Stato</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>
@endsection

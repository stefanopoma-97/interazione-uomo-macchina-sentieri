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
<div class="container" style="margin-top: 3em;">
    <div class="row">
        <div class="col-md-12 col-s-12">

            @if(count($esperienze)==0)
            <h3 style="text-align: center">Non ci sono esperienze associate a questo account</h3>
            @else



            @foreach ($esperienze as $esperienza)

            <div class="col-md-12" style="margin-bottom: 2em">
                <h3>
                    <span style="display:inline-block; align-content: center">
                        <a style="color:inherit; text-decoration: none;" href="{{route('sentiero.show',['sentiero'=>$esperienza->sentiero->id])}}">{{ $esperienza->sentiero->titolo }}</a>
                    </span>
                </h3>


                <div class="wrap">
                    <?php
                        for ($i=0; $i<$esperienza->voto; $i++)
                        {
                            echo '<i class="fa fa-star" aria-hidden="true"></i>';
                        }
                        $vuote=10-$esperienza->voto;
                        for ($i=0; $i<$vuote; $i++){
                            echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
                        }

                    ?>
                  </div>
                <br>
                <p style="font-size: small">Sentiero percorso il: {{$esperienza->data}}</p>
                <blockquote>
                    <p style="font-size: medium">{{$esperienza->commento}}</p>
                    <small><cite title="Source Title">Difficoltà: {{$esperienza->difficolta}}</cite></small>
                    <small><cite title="Source Title">Voto: {{$esperienza->voto}}</cite></small>
                </blockquote>
            </div>

            @endforeach
            {{ $esperienze->links() }}

            @endif
        </div>

    </div>


</div>
@endsection

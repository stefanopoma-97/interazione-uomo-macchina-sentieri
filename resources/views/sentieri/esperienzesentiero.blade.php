@extends('layouts.master2')

@section('titolo', 'Esperienzesentiero')



@section('sfondo')
@endsection


@section('header')
<h2 class="pull-left">Esperienze Sentiero: {{$sentiero->titolo}}</h2>
@endsection

@section('breadcrumb')
<ul class="breadcrumb pull-right">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a href="{{ route('sentiero.ricerca') }}">Sentieri</a></li>
    <li><a href="{{route('sentiero.show',['sentiero'=>$sentiero->id])}}">Sentiero</a></li>
    <li class="active">Esperienze</li>
</ul>
@endsection

@section('corpo')
<div class="container" style="margin-top: 3em;">
    <div class="row">
        <div class="col-md-12 col-s-12">

            @php
            include(app_path().'/funzioni.php');
            @endphp
            @foreach ($esperienze as $esperienza)

            <div class="col-md-12" style="margin-bottom: 2em">
                <h3>
                    @php
                    $url = getFotoProfilo($esperienza->utente->id);
                    echo '<span style="display:inline-block;margin-right:5px; "><img alt="image" style="height: 35px; width:35px;"class="img-circle img-responsive " src="'.$url.'"></span>';
                    @endphp

                    <span style="display:inline-block; align-content: center"><a style="color:inherit; text-decoration: none;" href="{{ route('user.dettagli',['id'=> $esperienza->utente->id]) }}">{{$esperienza->utente->username}}</a></span>
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
                <div class="row">
                    <p style="font-size: small">Sentiero percorso il: {{$esperienza->data}}</p>
                </div>
                <div class="row">
                    <blockquote>
                        <p style="font-size: medium">{{$esperienza->commento}}</p>
                        <small><cite title="Source Title">Difficoltà: {{$esperienza->difficolta}}</cite></small>
                        <small><cite title="Source Title">Voto: {{$esperienza->voto}}</cite></small>
                    </blockquote>
                </div>
            </div>

            @endforeach
            {{ $esperienze->links() }}
        </div>

    </div>

<!--    <div class="row">
        <div class="col-md-3 pull-right">
            <ul class="pagination">
                <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </div>

    </div>-->
</div>

@endsection

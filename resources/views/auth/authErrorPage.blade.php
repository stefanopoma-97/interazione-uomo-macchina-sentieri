<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>User authentication</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

        <!-- Fogli di stile -->
        <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ url('/') }}/css/mio_stile.css">
        <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap-theme.min.css">

        <!-- jQuery e plugin JavaScript -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="{{ url('/') }}/js/bootstrap.min.js"></script>
    </head>

    <body>
        <div class="container text-center">
            <div class="row" style="margin-top: 4em;">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-danger">

                            <div class='panel-heading'>
                                Errore di autenticazione
                            </div>
                            <div class='panel-body'>
                                <p>Le credenziali che hai inserito sono sbagliate</p>
                                <p><a class="btn btn-riprova" href="{{ route('user.auth.login') }}"><span class='glyphicon glyphicon-log-in'></span> Riprova</a>
                                <a class="btn btn-default" href="{{ route('home') }}"><span class='glyphicon glyphicon-log-out'></span> Torna alla Home</a></p>
                                <!--<p><a href="{{route('user.edit.recuperopassword.login')}}">Password dimenticata?</a></p>-->
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </body>
</html>

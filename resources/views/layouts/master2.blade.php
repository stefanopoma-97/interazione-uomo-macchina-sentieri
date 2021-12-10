<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>@yield('titolo')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

        <!-- Fogli di stile -->
        <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ url('/') }}/css/mio_stile.css">
        <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap-theme.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">


        <!-- jQuery e plugin JavaScript -->
       <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
        <!--<script src="{{ url('/') }}/js/bootstrap.min.js"></script>-->
        <script src="{{ url('/') }}/js/scriptValidazione.js"></script>
        <script src="{{ url('/') }}/js/mappa.js"></script>
        <script src="{{ url('/') }}/js/scriptValidazioneSentieri.js"></script>
        <script src="{{ url('/') }}/js/scriptPopUp.js"></script>

        <script type="text/javascript">@yield('javascript')</script>

        <script src="https://kit.fontawesome.com/63ae6a9696.js" crossorigin="anonymous"></script>

         <script src="http://code.jquery.com/jquery.js"></script>
        <script src="{{ url('/') }}/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">




        <!-- MAPPA -->
        <script src="https://unpkg.com/leaflet@1.3.2/dist/leaflet.js"></script>
        <script src="https://unpkg.com/leaflet-ui@0.2.0/dist/leaflet-ui.js"></script>

        <!-- leaflet-elevation -->
        <link rel="stylesheet" href="https://unpkg.com/@raruto/leaflet-elevation/dist/leaflet-elevation.css" />
        <script src="https://unpkg.com/@raruto/leaflet-elevation/dist/leaflet-elevation.js"></script>




        <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>

        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
        <script type="text/javascript" class="init">

            $(document).ready(function () {
                $('#tabella_elenco_utenti').DataTable();
                $('#tabella_elenco_sentieri').DataTable();
                $('#tabella_elenco_preferiti').DataTable();
                $('#tabella_revisioni_sentiero').DataTable();
                $('#tabella_elenco_sentieri_effettuati').DataTable();
            });

        </script>

    </head>

    <body>




        <!-- creazione nav-bar-->
        <nav class="navbar-default navbar-fixed-top"> <!-- nav bar fissata in alto sempre -->
            <div class="container">

                <!-- crea il bottone con le 3 linee-->
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- sostituisce il bottone home -->


                <!-- barra del menu-->
                <div class="collapse navbar-collapse navbar-responsive-collapse" id="myNavbar">

                    <a class="navbar-brand" href="{{ route('home') }}">Home</a>

                    <ul class="nav navbar-nav navbar-right navbar-login pl-5 pull-right">
                        <li><a class="bordo-selezione" href="{{ route('sentiero.ricerca') }}">Elenco sentieri</a></li>
                        <li><a class="bordo-selezione" href="{{ route('user.elenco') }}">Utenti</a></li>

                            @if($logged)

                            @if($user->admin == 'y')
                            <li>
                                <a class="bordo-selezione" href="{{ route('sentiero.index') }}">Gestione sentieri</a>
                            </li>
                            <li class="nav-item avatar dropdown">
                                <a disable="" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    @if($count_revisioni==0)
                                    <!--<span class="badge badge-danger ml-2">{{$count_revisioni}}</span>-->
                                    <span class="material-icons">notifications_none</span>
                                    @else
                                    <!--<span style="background-color:red" class="badge badge-danger ml-2">{{$count_revisioni}}</span>-->
                                    <span class="material-icons notificaAttiva">notifications_active</span>
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

                            <?php /*<li class="dropdown" style="margin-left: 5em;">
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
                            </li>*/?>

                            <li class="dropdown" style="margin-left: 5em;">
                                @if ($logged)
                                    @if ($user->admin == 'y')
                                        <a class="btnsignin dropdown-toggle" href="#" data-toggle="dropdown">
                                            <span class="glyphicon glyphicon-user"></span> Admin:{{$user->nome}}
                                        </a>
                                    @else
                                        <a class="btnsignin dropdown-toggle" href="#" data-toggle="dropdown">
                                            <span class="glyphicon glyphicon-user"></span> Ciao {{$user->nome}}
                                        </a>
                                    @endif

                                    <ul class="dropdown-menu">
                                        <li><a class="drop-a" href="{{ route('user.dettagli', ['id'=> $user_id]) }}">{{$user->nome}}</a></li>
                                        <li><a href="{{ route('user.preferiti', ['id'=> $user_id]) }}">Preferiti</a></li>
                                        @if($user->admin == 'y')
                                        <li><a href="{{ route('sentiero.index') }}">Lista sentieri</a></li>
                                        <li><a href="{{ route('esperienza.darevisionare',  ['id'=> $user_id]) }}">Revisioni</a></li>
                                        @else
                                        @endif
                                        <li><a href="{{ route('user.logout') }}">Log out</a></li>
                                    </ul>
                                @endif
                            </li>

                            @else
                                <li style="margin-left: 5em;"><a class="btn btnlogin" href="{{ route('user.auth.login') }}"><span class="glyphicon glyphicon-log-in"></span> Accedi</a></li>
                                <li><a class="btnsignin" href="{{ route('user.auth.register') }}"><span class="glyphicon glyphicon-user"></span> Registrati</a></li>

                            @endif


                    </ul>



                </div>

            </div>
        </nav>





        @yield('sfondo')


        <!-- header-->
        <div class="container" style="margin-top: 5em;">
            <header class="header-sezione">
                @yield('header')
                @yield('breadcrumb')
            </header>
        </div>

        @yield('corpo')


        <div style="margin-top: 5em" class="container">
            <div class="row">
                <footer class="page-footer font-small blue-grey lighten-5">
                    <div class="col-md-12">
                        <div style="background-color: rgba(53, 126, 189, 0.6);">
                            <br>
                            <br>

                        </div>
                    </div>

                    <br>
                    <div class="container text-center text-md-left mt-5">

                        <div class="row mt-3 dark-grey-text">

                            <div class="col-md-4 col-lg-6 col-xl-3 mb-4">

                                <h4 class="text-uppercase font-weight-bold">Il progetto</h4>
                                <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                                <p>Il sito ha lo scopo di raccogliere tutti i sentieri italiani. Dividendoli per categorie e
                                    permettendo una ricerca sulla base di molti parametri.</p>

                            </div>

                            <?php /*<div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">

                                <h4 class="text-uppercase font-weight-bold">Cerca un sentiero</h4>
                                <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">

                                <form method="get" action="{{route('sentiero.ricercafiltrahome')}}" class="form-inline">
                                    <input class="form-control form-control-sm mr-3 w-75" type="text" placeholder="Cerca"
                                           aria-label="Search" name="ricerca">
                                    <!--<i class="fas fa-search" aria-hidden="true"></i>-->
                                </form>

                            </div>*/?>

                            <div class="col-md-4 col-lg-3 col-xl-2 mx-auto mb-4">


                                <h4 class="text-uppercase font-weight-bold">Links utili</h4>
                                <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                                <p>
                                    @if($logged)
                                    <a class="dark-grey-text" href="{{ route('user.dettagli', ['id'=> $user_id]) }}">Il tuo account</a>
                                    @else
                                    <a class="dark-grey-text" href="{{ route('user.auth.login') }}">Login</a>
                                    @endif
                                </p>
                                <p>
                                    <a class="dark-grey-text" href="{{ route('sentiero.ricerca') }}">Sentieri</a>
                                </p>
                                <p>
                                    <a class="dark-grey-text" href="{{ route('user.elenco') }}">Utenti</a>
                                </p>
                                <p>
                                    <a class="dark-grey-text" href="{{ route('home') }}">Home</a>
                                </p>

                            </div>

                            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">


                                <h4 class="text-uppercase font-weight-bold">Contatti</h4>
                                <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                                <p>
                                    <i class="fas fa-home mr-3"></i> Brescia UNIBS</p>
                                <p>
                                    <i class="fas fa-envelope mr-3"></i> info@sentieri.com</p>
                                <p>
                                    <i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
                                <p>
                                    <i class="fas fa-print mr-3"></i> + 01 234 567 89</p>

                            </div>

                        </div>

                    </div>

                    <hr>
                    <div class="footer-copyright text-center text-black-50 py-3">© 2020 Copyright:
                        <a class="dark-grey-text"  href="{{ route('home') }}"> Sentieri.it</a>
                    </div>
                    <br>

                </footer>
            </div>
        </div>

    </body>
</html>

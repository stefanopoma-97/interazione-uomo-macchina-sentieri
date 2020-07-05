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
        <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

        
        <!-- jQuery e plugin JavaScript -->
       <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
        <!--<script src="{{ url('/') }}/js/bootstrap.min.js"></script>-->
        <script src="{{ url('/') }}/js/scriptValidazione.js"></script>
        <script src="{{ url('/') }}/js/scriptValidazioneSentieri.js"></script>
        <script src="{{ url('/') }}/js/scriptPopUp.js"></script>
        <script type="text/javascript">@yield('javascript')</script>
         <script src="http://code.jquery.com/jquery.js"></script>
        <script src="{{ url('/') }}/js/bootstrap.min.js"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>
        
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
        <script type="text/javascript" class="init">

            $(document).ready(function () {
                $('#tabella_elenco_utenti').DataTable();
                $('#tabella_elenco_sentieri').DataTable();
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
                    
                    @yield('navbar_home')
                    
                    <ul class="nav navbar-nav navbar-right navbar-login pl-5 pull-right">
                        @yield('navbar')
                       
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
    </body>
</html>
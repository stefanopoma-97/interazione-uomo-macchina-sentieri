<!DOCTYPE html>
<htm>
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
        
        <div class="container"> 
            <div class="row" style="margin-top: 4em;"> <!-- unica riga--> <!-- margin top lo sposta in basso -->
                <div class="col-md-6 col-md-offset-3"> <!-- offset sposta a dx di 3 -->
                    
                    <div> <!-- costruzione tab -->
                        
                        <!--tab di navigazione  -->
                        <ul class="nav nav-tabs">  <!-- intestazione del tab -->
                            @if ($login)
                                <li class="active"><a href="#login-form" data-toggle="tab">Login</a></li> <!--due tab che puntano a due form diverse Login e Register -->
                                <li><a href="#register-form" data-toggle="tab">Register</a></li> <!-- registern non è attivo, Login si-->
                            @else
                                <li><a href="#login-form" data-toggle="tab">Login</a></li> <!--due tab che puntano a due form diverse Login e Register -->
                                <li class='active'><a href="#register-form" data-toggle="tab">Register</a></li>
                            @endif
                            <!--data-toggle lo trasforma in un vero e proprio tab -->
                        </ul>
                        
                        <!--contenuto-->
                        <div class="tab-content"> 

                            <!--tab di login-->
                            
                            
                            
                            @if ($login) 
                            <div class="tab-pane active" id="login-form"> <!-- id serve ad essere richimato dai tab  -->
                            @else
                            <div class="tab-pane" id="login-form"> <!-- id serve ad essere richimato dai tab  -->
                            @endif
                                <form id="login-form" action="{{ route('user.login') }}" method="post" style="margin-top: 2em;"> <!-- margine per distanziare -->
                                @csrf
                                    <div class="form-group"> <!-- form-group contiene i campi -->
                                        <input type="text" name="username" class="form-control" placeholder="Username" value=""> <!-- se il cookie è settato scrivo valore -->
                                    </div> <!-- form-control da lo stile --> <!-- POST[name] -->
                                    
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                    </div><!-- type password non fa capire cosa si sta inserendo-->
                                    
                                    <div class="form-group text-center"> <!-- messo al centro -->
                                        <input type="checkbox" name="remember"> <!-- lascia flag se cookie settato -->
                                        <label for="remember"> Remember Me</label>
                                    </div> <!-- text box + label -->
                                    
                                    <div class="form-group"> <!-- pulsante -->
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3"> <!-- messo al centro -->
                                                <input type="submit" name="login-submit" class="form-control btn btn-primary" value="Log In">
                                                <!-- login-sumbit per capire se POST ha passato qualcosa -->
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="text-center"> <!-- metterlo al centro -->
                                            <a href="#" class="forgot-password">Forgot Password?</a> <!-- per ora link vuoto -->
                                        </div>
                                    </div>
                                    
                                </form>
                            </div>

                            <!--tab di registrazione-->
                            @if(!$login)
                            <div class="tab-pane active" id="register-form">
                            @else
                            <div class="tab-pane" id="register-form">
                            @endif
                            
                                <form id="register-form" action="{{ route('user.register') }}" method="post" style="margin-top: 2em;"> <!-- invoca la stessa pagina con -->
                                @csrf
                                    <div class="form-group">
                                        <input type="text" name="username" class="form-control" placeholder="Username" value="">
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="text" name="nome" class="form-control" placeholder="nome" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="cognome" class="form-control" placeholder="cognome" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="email" class="form-control" placeholder="Email Address" value="">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" name="descrizione" rows="3"></textarea>
                                    </div>
                                    <div class="form-group"> <select class="form-control" name="citta" id="citta">
                                            <option value="Brescia">Brescia</option>
                                            <option value="Bergamo">Bergamo</option>
                                            <option value="Milano">Milano</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="password" name="confirm-password" class="form-control" placeholder="Confirm Password">
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="register-submit" class="form-control btn btn-primary" value="Register Now">
                                            </div>
                                        </div>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
                
    </body>
</htm>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
        <h2>Attenzione la password associata a questo account è stata modificata in data: {{$data}}</h2>
        <h3>Account: {{$username}}</h3>
        <h3>Mail: {{$mail}}</h3>
           
    </body>
</html>

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function rimuovi_stile(elemento){
    $(elemento).removeAttr("style");
}

function hide_show_filtri(){
  var x = document.getElementById("form_filtro");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}


function valida_ricerca_home(button){
    ricerca = (button.form.ricerca.value).trim();
    
    if (ricerca ===""){
        button.form.ricerca.focus();
        $(button.form.ricerca).css('border-color','red');
        button.form.ricerca.placeholder="Inserisci qualcosa";
    }
    else {
        button.form.submit();
    }
}

function valida_modifica_sentiero(button, modifica){
    //DIV contenente gli errori
    $('#ul_errori').parent().hide(); //lo nascondo
    $('#ul_errori').empty(); //svuoto la lista
    
    if(modifica)
        id=button.form.id.value;// id utente recuperato dalla form
    
    titolo = (button.form.titolo.value).trim();
    
    durata = (button.form.durata.value).trim();
    var pattern_durata= /(^(20|21|22|23|[0-1]?\d).[0-5]?\d$)|(^(20|21|22|23|[0-1]?\d)$)/g;
    
    descrizione = (button.form.descrizione.value).trim();
    
    lunghezza = (button.form.lunghezza.value).trim();
    var pattern_lunghezza = /^\d+(?:\.\d{1})?$/g;
    
    salita = (button.form.salita.value).trim();
    
    discesa = (button.form.discesa.value).trim();
    
    altezza_massima = (button.form.altezza_massima.value).trim();
    
    
    altezza_minima = (button.form.altezza_minima.value).trim();
    
    difficolta = (button.form.difficolta.value).trim();
    
    categoria = (button.form.categoria.value).trim();
    
    citta = (button.form.citta.value).trim();
    
    
    var errori = false;
    
    if(titolo === ""){
        errori=true;
        button.form.titolo.focus();
        $(button.form.titolo).css('border-color','red');
        var li = $("<li></li>");
        li.text("Compila il campo titolo");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
        
    }
    else if(durata === ""){
        errori=true;
        button.form.durata.focus();
        $(button.form.durata).css('border-color','red');
        var li = $("<li></li>");
        li.text("Compila il campo durata");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
        
    }
    else if(!pattern_durata.test(durata)){
    //else if (true){
        errori=true;
        button.form.durata.focus();
        $(button.form.durata).css('border-color','red');
        var li = $("<li></li>");
        li.text("Il durata deve essere nel formato: 7.30 ");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
    }
    else if(descrizione === ""){
        errori=true;
        button.form.descrizione.focus();
        $(button.form.descrizione).css('border-color','red');
        var li = $("<li></li>");
        li.text("Compila il campo descrizione");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
        
    }
    else if(lunghezza === ""){
        errori=true;
        button.form.lunghezza.focus();
        $(button.form.lunghezza).css('border-color','red');
        var li = $("<li></li>");
        li.text("Compila il campo lunghezza");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
    }
    else if(!pattern_lunghezza.test(lunghezza)){
        errori=true;
        button.form.lunghezza.focus();
        $(button.form.lunghezza).css('border-color','red');
        var li = $("<li></li>");
        li.text("Il lunghezza deve essere nel formato: 15,6 km ");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
    }
    else if(lunghezza < 1.0 || lunghezza > 999.0){
        errori=true;
        button.form.lunghezza.focus();
        $(button.form.lunghezza).css('border-color','red');
        var li = $("<li></li>");
        li.text("Campo lunghezza compreso tra 1 e 999");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
    }
    else if(salita === ""){
        errori=true;
        button.form.salita.focus();
        $(button.form.salita).css('border-color','red');
        var li = $("<li></li>");
        li.text("Compila il campo salita");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
    }
    else if(salita < 0 || salita > 10000){
        errori=true;
        button.form.salita.focus();
        $(button.form.salita).css('border-color','red');
        var li = $("<li></li>");
        li.text("Campo salita compreso tra 0 e 10000");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
    }
    
    else if(discesa === ""){
        errori=true;
        button.form.discesa.focus();
        $(button.form.discesa).css('border-color','red');
        var li = $("<li></li>");
        li.text("Compila il campo discesa");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
    }
    else if(discesa < 0 || discesa > 10000){
        errori=true;
        button.form.discesa.focus();
        $(button.form.discesa).css('border-color','red');
        var li = $("<li></li>");
        li.text("Campo discesa compreso tra 0 e 10000");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
    }
    else if(altezza_massima === ""){
        errori=true;
        button.form.altezza_massima.focus();
        $(button.form.altezza_massima).css('border-color','red');
        var li = $("<li></li>");
        li.text("Compila il campo altezza massima");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
    }
    else if(altezza_massima < 0 || altezza_massima > 10000){
        errori=true;
        button.form.altezza_massima.focus();
        $(button.form.altezza_massima).css('border-color','red');
        var li = $("<li></li>");
        li.text("Campo altezza massima compreso tra 1 e 10000");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
    }
    
    else if(altezza_minima === ""){
        errori=true;
        button.form.altezza_minima.focus();
        $(button.form.altezza_minima).css('border-color','red');
        var li = $("<li></li>");
        li.text("Compila il campo altezza minima");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
    }
    else if(altezza_minima < 0 || altezza_minima > 10000){
        errori=true;
        button.form.altezza_minima.focus();
        $(button.form.altezza_minima).css('border-color','red');
        var li = $("<li></li>");
        li.text("Campo altezza minima compreso tra 1 e 10000");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
    }
    else if(citta === ""){
        errori=true;
        button.form.citta.focus();
        $(button.form.citta).css('border-color','red');
        var li = $("<li></li>");
        li.text("Compila il campo città");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
    }
    else if(true){
        dislivello=altezza_massima - altezza_minima;
        if (salita < dislivello && discesa < dislivello){
            errori=true;
            button.form.salita.focus();
            button.form.discesa.focus();
            $(button.form.discesa).css('border-color','red');
            $(button.form.salita).css('border-color','red');
            var li = $("<li></li>");
            li.text("Valori di salita/discesa troppo bassi per il dislivello del percorso");
            $('#ul_errori').parent().show();
            $('#ul_errori').append(li);
        }
    }
    
    
    //window.confirm("città: "+citta);
    if(!errori)
    
    {
        //window.confirm("ajax controllo città");
        //window.confirm("NON ci sono errori. ID="+id+" username="+username)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({

                type: 'GET',

                url: '/ajaxCittaSentiero',

                data: {citta:citta},
                //data: {username:username, citta:citta},
                
                dataType: "json",

                success: function (data) {

                    if (!data.citta) {
                        errori=true;
                        button.form.citta.focus();
                        $(button.form.citta).css('border-color','red');
                        var li = $("<li></li>");
                        li.text("Inserisci una città esistente");
                        $('#ul_errori').parent().show();
                        $('#ul_errori').append(li);
                    }
                    else{
                        button.form.submit();
                    }
                },
                
                error: function(data){
                    alert("fail");
                }

            });
    }
    
    
    
    
   
}


 function valida_filtra_sentieri(button){
        
    
    //window.confirm("valida filtro");
    
    durata = (button.form.durata.value).trim();
    var pattern_durata= /(^(20|21|22|23|[0-1]?\d).[0-5]?\d$)|(^(20|21|22|23|[0-1]?\d)$)/g;
    durata_msg = document.getElementById("invalid_durata");
    durata_msg.innerHTML="";
        
    lunghezza = (button.form.lunghezza.value).trim();
    var pattern_lunghezza = /^\d+(?:\.\d{1})?$/g;
    lunghezza_msg = document.getElementById("invalid_lunghezza");
    lunghezza_msg.innerHTML="";
    
    dislivello = (button.form.dislivello.value).trim();
    dislivello_msg = document.getElementById("invalid_dislivello");
    dislivello_msg.innerHTML="";
    
    citta = (button.form.citta.value).trim();
    citta_msg = document.getElementById("invalid_citta");
    citta_msg.innerHTML="";
    
    var errori = false;
    //if(/^\d\d$/g.test(durata))
    durta=durata+".00";
    if(durata!=="" && !pattern_durata.test(durata)){
        errori=true;
        button.form.durata.focus();
        $(button.form.durata).css('border-color','red');
        durata_msg.innerHTML="La durata deve essere nel formato: 12.35";
        
    }
    if(lunghezza!=="" && !pattern_lunghezza.test(lunghezza)){
        errori=true;
        button.form.lunghezza.focus();
        $(button.form.lunghezza).css('border-color','red');
        lunghezza_msg.innerHTML="Il lunghezza deve essere nel formato: 15,6 km ";
    }
    if(lunghezza!=="" && (lunghezza < 0.1 || lunghezza > 50.0)){
        errori=true;
        button.form.lunghezza.focus();
        $(button.form.lunghezza).css('border-color','red');
        lunghezza_msg.innerHTML="Il campo lunghezza deve essere compreso tra i valori 0.1 e 50";
    }
    if(dislivello!=="" && (dislivello < 0 || dislivello > 10000)){
        errori=true;
        button.form.dislivello.focus();
        $(button.form.dislivello).css('border-color','red');
        dislivello_msg.innerHTML="Il campo lunghezza deve essere compreso tra i valori 0 e 10000";
    }

    if(citta!=="")
    
    {
        //window.confirm("ajax controllo città");
        //window.confirm("NON ci sono errori. ID="+id+" username="+username)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({

                type: 'GET',

                url: '/ajaxCittaSentiero',

                data: {citta:citta},
                //data: {username:username, citta:citta},
                
                dataType: "json",

                success: function (data) {

                    if (!data.citta) {
                        errori=true;
                        button.form.citta.focus();
                        $(button.form.citta).css('border-color','red');
                        citta_msg.innerHTML="Inserisci una città esistente";
                    }
                    else{
                            button.form.submit();
                        }
                    
                },
                
                error: function(data){
                    alert("fail");
                }

            });
    }
    else if (errori==false){
        button.form.submit();
    }
    }
 
function load_file(button){
    document.getElementById('foto_profilo').click();
}


 function check_foto_profilo(button){
        file=button.form.foto_profilo.value;
        file_msg=document.getElementById("invalid-foto_profilo");
        file_msg.innerHTML="";
        
        var sFileName = file;
        //window.confirm("nome: "+sFileName+" lunghezza: "+sFileName.length);
         if(sFileName===""){
            file_msg.innerHTML="Non hai inserito un file"; 
        }
        else {
            //file_msg.innerHTML="Estensione"; 
            var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();
        //var iFileSize = button.form.foto_profilo.size;
       
        /// OR together the accepted extensions and NOT it. Then OR the size cond.
        /// It's easier to see this way, but just a suggestion - no requirement.
            //file_msg.innerHTML="Estensione: "+sFileExtension;
       
        if (!(sFileExtension === "jpeg" ||
              sFileExtension === "png" ||
              sFileExtension === "jpg" ||
              sFileExtension === "svg")) { 
           file_msg.innerHTML="file non supportato"; 
           //button.form.submit();
        }
        else{
                file_msg=document.getElementById("invalid-foto_profilo");
                //file_msg.innerHTML="";
                let size = button.files[0].size;
                size_mb=size/1024/1024;
                //file_msg.innerHTML=size_mb;

                if (size > 2000000) {
                    file_msg.innerHTML="Il file inserito è più grande di 2MB ( "+size_mb+"MB )";
                }
                else{
                    //file_msg.innerHTML="CARICO";
                    button.form.submit();
                }
            }
            
        }
        
    }
    
    function load_immagine1(button){
    document.getElementById('immagine1').click();
    }

    function load_immagine2(button){
        document.getElementById('immagine2').click();
    }

    function load_immagine3(button){
        document.getElementById('immagine3').click();
    }
 
    
    
    function check_immagine(button){
        //window.confirm("check");
        nome_input=button.form.nome_input.value;
        file=button.form.immagine.value;
        //window.confirm(file);
        $('#messaggi_errore').parent().hide();
        $('#messaggi_errore').empty();
        $('#messaggi_conferma').parent().hide();
        $('#messaggi_conferma').empty();
        
        
        var sFileName = file;
        //window.confirm("nome: "+sFileName+" lunghezza: "+sFileName.length);
         if(sFileName===""){
            var li = $("<li></li>");
            li.text("Non hai inserito un file");
            $('#messaggi_errore').parent().show();
            $('#messaggi_errore').append(li);
        }
        else {
            var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();
       
        if (!(sFileExtension === "jpeg" ||
              sFileExtension === "png" ||
              sFileExtension === "jpg" ||
              sFileExtension === "svg")) { /// 10 mb
           var li = $("<li></li>");
            li.text("File non supportato");
            $('#messaggi_errore').parent().show();
            $('#messaggi_errore').append(li);
        }
        else{
            
            button.form.submit();
            
        }
        
            
        }
        
    }
    
       
    function check_immagine2(button){
        //window.confirm("check");
        nome_input=button.form.nome_input.value;
        file=button.form.immagine.value;
        //window.confirm(file);
        $('#messaggi_errore').parent().hide();
        $('#messaggi_errore').empty();
        $('#messaggi_conferma').parent().hide();
        $('#messaggi_conferma').empty();
        
        
        var sFileName = file;
        //window.confirm("nome: "+sFileName+" lunghezza: "+sFileName.length);
         if(sFileName===""){
            var li = $("<li></li>");
            li.text("Non hai inserito un file");
            $('#messaggi_errore').parent().show();
            $('#messaggi_errore').append(li);
        }
        else {
            var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();
       
        if (!(sFileExtension === "jpeg" ||
              sFileExtension === "png" ||
              sFileExtension === "jpg" ||
              sFileExtension === "svg")) { /// 10 mb
           var li = $("<li></li>");
            li.text("File non supportato");
            $('#messaggi_errore').parent().show();
            $('#messaggi_errore').append(li);
        }
        else{
            $('#messaggi_errore').parent().hide();
            $('#messaggi_errore').empty();
            let size = button.files[0].size;
            size_mb=size/1024/1024;
            //window.confirm("SIZE: "+size_mb);

            if (size > 2000000) {
                //window.confirm("maggiore");
                var li = $("<li></li>");
                li.text("Il file inserito è più grande di 2MB ( "+size_mb+"MB )");
                $('#messaggi_errore').parent().show();
                $('#messaggi_errore').append(li);
                button.value="";
            }
            else {
                button.form.submit();
            }
            
            
        }
        
            
        }
        
    }
 
    function size_immagine(e) {
        //window.confirm("SIZE CHECK");
        $('#messaggi_errore').parent().hide();
        $('#messaggi_errore').empty();
        let size = e.files[0].size;
        size_mb=size/1024/1024;
        //window.confirm("SIZE: "+size_mb);
        
        if (size > 2000000) {
            //window.confirm("maggiore");
            var li = $("<li></li>");
            li.text("Il file inserito è più grande di 2MB ( "+size_mb+"MB )");
            $('#messaggi_errore').parent().show();
            $('#messaggi_errore').append(li);
            e.value="";
        }
    }
    
    
    
    function check_gpx(button){
        //window.confirm("check");
        //nome_input=button.form.nome_input.value;
        file=button.form.gpx.value;
        //window.confirm("check"+file);
        $('#messaggi_errore').parent().hide();
        $('#messaggi_errore').empty();
        $('#messaggi_conferma').parent().hide();
        $('#messaggi_conferma').empty();
        
        
        var sFileName = file;
        //window.confirm("nome: "+sFileName+" lunghezza: "+sFileName.length);
         if(sFileName===""){
            var li = $("<li></li>");
            li.text("Non hai inserito un file");
            $('#messaggi_errore').parent().show();
            $('#messaggi_errore').append(li);
        }
        else {
            var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();
       
        if (!(sFileExtension === "gpx")) { /// 10 mb
           var li = $("<li></li>");
            li.text("File non supportato");
            $('#messaggi_errore').parent().show();
            $('#messaggi_errore').append(li);
        }
        else{
            
            button.form.submit();
            
        }
        
            
        }
        
    }
    
    function check_gpx2(button){
        //window.confirm("check");
        //nome_input=button.form.nome_input.value;
        file=button.form.gpx.value;
        //window.confirm("check"+file);
        $('#messaggi_errore').parent().hide();
        $('#messaggi_errore').empty();
        $('#messaggi_conferma').parent().hide();
        $('#messaggi_conferma').empty();
        
        
        var sFileName = file;
        //window.confirm("nome: "+sFileName+" lunghezza: "+sFileName.length);
         if(sFileName===""){
            var li = $("<li></li>");
            li.text("Non hai inserito un file");
            $('#messaggi_errore').parent().show();
            $('#messaggi_errore').append(li);
        }
        else {
            var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();
       
        if (!(sFileExtension === "gpx")) { /// 10 mb
           var li = $("<li></li>");
            li.text("File non supportato");
            $('#messaggi_errore').parent().show();
            $('#messaggi_errore').append(li);
        }
        else{
            
            button.form.submit();
            
        }
        
            
        }
        
    }
    
    function load_gpx(button){
        document.getElementById('gpx').click();
    }
    
    function sizee(e) {
        file_msg=document.getElementById("invalid-foto_profilo");
        file_msg.innerHTML="";
        let size = e.files[0].size;
        size_mb=size/1024/1024;
        
        if (size > 2000000) {
            file_msg.innerHTML="Il file inserito è più grande di 2MB ( "+size_mb+"MB )";
            e.value="";
        }
    }
    
    
    function lancia_form(button){
        window.confirm("lancia form");
        $('#aggiungipreferito').submit();
        }
        
        
        
function openForm() {
    window.confirm("open form");
  document.getElementById("form_nota").style.display = "block";
}

function closeForm() {
  document.getElementById("form_nota").style.display = "none";
}
    


 
var index = 0; 
function scorri_immagini(){
    //window.confirm("scorri");
    var foto=new Array();
    foto[0]=document.getElementById('im_1').src;
    foto[1]=document.getElementById('im_2').src;
    foto[2]=document.getElementById('im_3').src;

    
    //window.confirm("indice: "+index);
    if (index > 2)
        index = 0;
    var img = document.getElementById("im_5");
    img.src = foto[index];
    //window.confirm("nuovo src: "+img.src);

    
    index++;
    setTimeout("scorri_immagini()", 5000);

}
    
 
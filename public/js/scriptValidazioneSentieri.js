/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function rimuovi_stile(elemento){
    $(elemento).removeAttr("style");
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
    var pattern_durata= /^(20|21|22|23|[0-1]?\d).[0-5]?\d$/g;
    
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
    else if(altezza_massima < 1 || altezza_massima > 10000){
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
    else if(altezza_minima < 1 || altezza_minima > 10000){
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
        if (salita < dislivello || discesa < dislivello){
            errori=true;
            button.form.salita.focus();
            button.form.discesa.focus();
            $(button.form.discesa).css('border-color','red');
            $(button.form.salita).css('border-color','red');
            var li = $("<li></li>");
            li.text("Valori di salita/discesa troppo bassi per il displivello del percorso");
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
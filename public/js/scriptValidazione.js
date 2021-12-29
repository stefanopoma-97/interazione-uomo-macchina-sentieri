/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function rimuovi_stile(elemento){
    $(elemento).removeAttr("style");
}

function login(button){
    $('#ul_errori').parent().hide(); //lo nascondo
    $('#ul_errori').empty(); //svuoto la lista

    username = (button.form.username.value).trim();

    password = (button.form.password.value).trim();

    var errori = false;

    if(username === ""){
        errori=true;
        button.form.username.focus();
        $(button.form.username).css('border-color','red');
        var li = $("<li></li>");
        li.text("Compila il campo username");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
    }
    else if (password === ""){
        errori=true;
        button.form.password.focus();
        $(button.form.password).css('border-color','red');
        var li = $("<li></li>");
        li.text("Compila il campo password");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
    }
    else {
        button.form.submit();
    }


}

function login2(button){
    //$('#ul_errori').parent().hide(); //lo nascondo
    //$('#ul_errori').empty(); //svuoto la lista

    username = (button.form.username.value).trim();

    password = (button.form.password.value).trim();
    
    username_msg=document.getElementById("invalid-username-empty");
    username_msg.innerHTML="";
    password_msg=document.getElementById("invalid-password-empty");
    password_msg.innerHTML="";

    var errori = false;

    if(username === ""){
        errori=true;
        button.form.username.focus();
        $(button.form.username).css('border-color','red');
        username_msg.innerHTML="Compila il campo username";
        //var li = $("<li></li>");
        //li.text("Compila il campo username");
        //$('#ul_errori').parent().show();
        //$('#ul_errori').append(li);
    }
    if (password === ""){
        errori=true;
        button.form.password.focus();
        $(button.form.password).css('border-color','red');
        password_msg.innerHTML="Compila il campo password";
        //var li = $("<li></li>");
        //li.text("Compila il campo password");
        //$('#ul_errori').parent().show();
        //$('#ul_errori').append(li);
    }
    if(errori==false) {
        button.form.submit();
    }

}

function register(button){

    //DIV contenente gli errori
    $('#ul_errori_registrazione').parent().hide(); //lo nascondo
    $('#ul_errori_registrazione').empty(); //svuoto la lista


    nome = (button.form.nome.value).trim();
    nome_msg=document.getElementById("invalid-nome");
    nome_msg.innerHTML="";
    var nome_exp = new RegExp("^([a-zA-Z]+)$", "g");


    cognome = (button.form.cognome.value).trim();
    cognome_msg=document.getElementById("invalid-cognome");
    cognome_msg.innerHTML="";
    var cognome_exp = new RegExp("^([a-zA-Z]+)$", "g");

    username = (button.form.username.value).trim();
    username_msg=document.getElementById("invalid-username");
    username_msg.innerHTML="";


    mail = (button.form.mail.value).trim();
    mail_msg=document.getElementById("invalid-mail");
    mail_msg.innerHTML="";
    var mail_exp = RegExp("^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-]{2,})+.)+[.]([a-zA-Z0-9]{2,})+$", "g");

    descrizione = (button.form.descrizione.value).trim();
    descrizione_msg=document.getElementById("invalid-descrizione");
    descrizione_msg.innerHTML="";

    citta = (button.form.citta_completamento.value).trim();
    citta_msg=document.getElementById("invalid-citta_completamento");
    citta_msg.innerHTML="";

    password = (button.form.password_nuova.value).trim();
    password_msg=document.getElementById("invalid-password_nuova");
    password_msg.innerHTML="";


    password_conferma = (button.form.password_nuova2.value).trim();
    password_conferma_msg=document.getElementById("invalid-password_nuova2");
    password_conferma_msg.innerHTML="";


    var errori = false;


    if(username === ""){
        errori=true;
        username_msg.innerHTML="Compila il campo username";
        button.form.username.focus();
        $(button.form.username).css('border-color','red');
        var li = $("<li></li>");
        li.text("Compila il campo username");
        $('#ul_errori_registrazione').parent().show();
        $('#ul_errori_registrazione').append(li);
    }
    else if(nome === ""){
        errori=true;
        nome_msg.innerHTML="Compila il campo nome";
        button.form.nome.focus({preventScroll:false});
        $(button.form.nome).css('border-color','red');
        var li = $("<li></li>");
        li.text("Compila il campo nome");
        $('#ul_errori_registrazione').parent().show();
        $('#ul_errori_registrazione').append(li);

    }
    else if(!nome.match(nome_exp)){
        errori=true;
        nome_msg.innerHTML="Il campo nome può contenere solo lettere";
        button.form.nome.focus();
        $(button.form.nome).css('border-color','red');
        var li = $("<li></li>");
        li.text("Il campo nome può contenere solo lettere");
        $('#ul_errori_registrazione').parent().show();
        $('#ul_errori_registrazione').append(li);
    }

    else if(cognome === ""){
        errori=true;
        cognome_msg.innerHTML="Compila il campo cognome";
        button.form.cognome.focus();
        $(button.form.cognome).css('border-color','red');
        var li = $("<li></li>");
        li.text("Compila il campo cognome");
        $('#ul_errori_registrazione').parent().show();
        $('#ul_errori_registrazione').append(li);
    }
    else if(!cognome.match(cognome_exp)){
        errori=true;
        cognome_msg.innerHTML="Il campo cognome può contenere solo lettere";
        button.form.cognome.focus();
        $(button.form.cognome).css('border-color','red');
        var li = $("<li></li>");
        li.text("Il campo cognome può contenere solo lettere");
        $('#ul_errori_registrazione').parent().show();
        $('#ul_errori_registrazione').append(li);
    }


    else if(mail === ""){
        errori=true;
        mail_msg.innerHTML="Compila il campo mail";
        button.form.mail.focus();
        $(button.form.mail).css('border-color','red');
        var li = $("<li></li>");
        li.text("Compila il campo mail");
        $('#ul_errori_registrazione').parent().show();
        $('#ul_errori_registrazione').append(li);
    }
    else if(!mail.match(mail_exp)){
        errori=true;
        mail_msg.innerHTML="Inserisci una mail valida";
        button.form.mail.focus();
        $(button.form.mail).css('border-color','red');
        var li = $("<li></li>");
        li.text("Inserisci una mail valida");
        $('#ul_errori_registrazione').parent().show();
        $('#ul_errori_registrazione').append(li);
    }

    else if(descrizione === ""){
        errori=true;
        descrizione_msg.innerHTML="Compila il campo descrizione";
        button.form.descrizione.focus();
        $(button.form.descrizione).css('border-color','red');
        var li = $("<li></li>");
        li.text("Compila il campo descrizione");
        $('#ul_errori_registrazione').parent().show();
        $('#ul_errori_registrazione').append(li);
    }

    else if(citta === ""){
        errori=true;
        citta_msg.innerHTML="Compila il campo città";
        button.form.citta_completamento.focus();
        $(button.form.citta_completamento).css('border-color','red');
        var li = $("<li></li>");
        li.text("Compila il campo città");
        $('#ul_errori_registrazione').parent().show();
        $('#ul_errori_registrazione').append(li);
    }

    else if(password === ""){
        errori=true;
        password_msg.innerHTML="Inserisci la password";
        button.form.password_nuova.focus({preventScroll:false});
        $(button.form.password_nuova).css('border-color','red');
        var li = $("<li></li>");
        li.text("Inserisci la password");
        $('#ul_errori_registrazione').parent().show();
        $('#ul_errori_registrazione').append(li);

    }

    else if(password.length <  8){
        errori=true;
        password_msg.innerHTML="La password deve essere più lunga di 8 caratteri";
        button.form.password_nuova.focus({preventScroll:false});
        $(button.form.password_nuova).css('border-color','red');
        var li = $("<li></li>");
        li.text("La password deve essere più lunga di 8 caratteri");
        $('#ul_errori_registrazione').parent().show();
        $('#ul_errori_registrazione').append(li);

    }

    else if(password_conferma === ""){
        errori=true;
        password_conferma_msg.innerHTML="Inserisci ancora la password";
        button.form.password_nuova2.focus({preventScroll:false});
        $(button.form.password_nuova2).css('border-color','red');
        var li = $("<li></li>");
        li.text("Inserisci ancora la password");
        $('#ul_errori_registrazione').parent().show();
        $('#ul_errori_registrazione').append(li);

    }

    else if(password !== password_conferma){
        errori=true;
        password_conferma_msg.innerHTML="Le due password non corrispondono";
        button.form.password_nuova2.focus({preventScroll:false});
        button.form.password_nuova2.innerHTML="";
        $(button.form.password_nuova2).css('border-color','red');
        var li = $("<li></li>");
        li.text("Le due password non corrispondono");
        $('#ul_errori_registrazione').parent().show();
        $('#ul_errori_registrazione').append(li);

    }


    if(!errori)
    //window.confirm("SONO entrato nel ciclo errori= "+errori);
    {
        //window.confirm("AJAX. citta="+citta);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({

                type: 'POST',

                //url: '/ajaxCitta',
                url: '/ajaxNewUsernameCitta',

                //data: {citta:citta},
                data: {citta:citta, username:username},

                dataType: "json",

                success: function (data) {

                    //window.confirm("HO RICEVUTO: citta:"+data.citta);
                    if (!data.citta){
                        errori = true;
                        citta_msg.innerHTML="Inserisci una città corretta";
                        button.form.citta_completamento.focus();
                        $(button.form.citta_completamento).css('border-color','red');
                        var li = $("<li></li>");
                        li.text("Inserisci una città corretta");
                        $('#ul_errori_registrazione').parent().show();
                        $('#ul_errori_registrazione').append(li);
                    }
                    if (!data.username)
                    {
                        errori = true;
                        username_msg.innerHTML="Esiste già un altro utente con questo username";
                        button.form.username.focus();
                        $(button.form.username).css('border-color','red');
                        var li = $("<li></li>");
                        li.text("Esiste già un altro utente con questo username");
                        $('#ul_errori_registrazione').parent().show();
                        $('#ul_errori_registrazione').append(li);

                    }

                    if (!errori){
                        button.form.submit();
                    }
                },

                error: function(data){
                    //window.confirm("fail, citta="+data.citta);
                    alert("fail");
                }

            });
    }
}

function register2(button){

    //DIV contenente gli errori
    //$('#ul_errori_registrazione').parent().hide(); //lo nascondo
    //$('#ul_errori_registrazione').empty(); //svuoto la lista


    nome = (button.form.nome.value).trim();
    nome_msg=document.getElementById("invalid-nome");
    nome_msg.innerHTML="";
    var nome_exp = new RegExp("^([a-zA-Z]+)$", "g");


    cognome = (button.form.cognome.value).trim();
    cognome_msg=document.getElementById("invalid-cognome");
    cognome_msg.innerHTML="";
    var cognome_exp = new RegExp("^([a-zA-Z]+)$", "g");

    username = (button.form.username.value).trim();
    username_msg=document.getElementById("invalid-username");
    username_msg.innerHTML="";


    mail = (button.form.mail.value).trim();
    mail_msg=document.getElementById("invalid-mail");
    mail_msg.innerHTML="";
    var mail_exp = RegExp("^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-]{2,})+.)+[.]([a-zA-Z0-9]{2,})+$", "g");

    descrizione = (button.form.descrizione.value).trim();
    descrizione_msg=document.getElementById("invalid-descrizione");
    descrizione_msg.innerHTML="";

    citta = (button.form.citta_completamento.value).trim();
    citta_msg=document.getElementById("invalid-citta_completamento");
    citta_msg.innerHTML="";

    password = (button.form.password_nuova.value).trim();
    password_msg=document.getElementById("invalid-password_nuova");
    password_msg.innerHTML="";


    password_conferma = (button.form.password_nuova2.value).trim();
    password_conferma_msg=document.getElementById("invalid-password_nuova2");
    password_conferma_msg.innerHTML="";


    var errori = false;


    if(username === ""){
        errori=true;
        username_msg.innerHTML="Compila il campo username";
        button.form.username.focus();
        $(button.form.username).css('border-color','red');
        var li = $("<li></li>");
        li.text("Compila il campo username");
        //$('#ul_errori_registrazione').parent().show();
        $('#ul_errori_registrazione').append(li);
    }
    if(nome === ""){
        errori=true;
        nome_msg.innerHTML="Compila il campo nome";
        button.form.nome.focus({preventScroll:false});
        $(button.form.nome).css('border-color','red');
        var li = $("<li></li>");
        li.text("Compila il campo nome");
        //$('#ul_errori_registrazione').parent().show();
        $('#ul_errori_registrazione').append(li);

    }
    else if(!nome.match(nome_exp)){
        errori=true;
        nome_msg.innerHTML="Il campo nome può contenere solo lettere";
        button.form.nome.focus();
        $(button.form.nome).css('border-color','red');
        var li = $("<li></li>");
        li.text("Il campo nome può contenere solo lettere");
        //$('#ul_errori_registrazione').parent().show();
        $('#ul_errori_registrazione').append(li);
    }
    if(cognome === ""){
        errori=true;
        cognome_msg.innerHTML="Compila il campo cognome";
        button.form.cognome.focus();
        $(button.form.cognome).css('border-color','red');
        var li = $("<li></li>");
        li.text("Compila il campo cognome");
        //$('#ul_errori_registrazione').parent().show();
        $('#ul_errori_registrazione').append(li);
    }
    else if(!cognome.match(cognome_exp)){
        errori=true;
        cognome_msg.innerHTML="Il campo cognome può contenere solo lettere";
        button.form.cognome.focus();
        $(button.form.cognome).css('border-color','red');
        var li = $("<li></li>");
        li.text("Il campo cognome può contenere solo lettere");
        //$('#ul_errori_registrazione').parent().show();
        $('#ul_errori_registrazione').append(li);
    }
    if(mail === ""){
        errori=true;
        mail_msg.innerHTML="Compila il campo mail";
        button.form.mail.focus();
        $(button.form.mail).css('border-color','red');
        var li = $("<li></li>");
        li.text("Compila il campo mail");
        //$('#ul_errori_registrazione').parent().show();
        $('#ul_errori_registrazione').append(li);
    }
    else if(!mail.match(mail_exp)){
        errori=true;
        mail_msg.innerHTML="Inserisci una mail valida";
        button.form.mail.focus();
        $(button.form.mail).css('border-color','red');
        var li = $("<li></li>");
        li.text("Inserisci una mail valida");
        //$('#ul_errori_registrazione').parent().show();
        $('#ul_errori_registrazione').append(li);
    }
    if(descrizione === ""){
        errori=true;
        descrizione_msg.innerHTML="Compila il campo descrizione";
        button.form.descrizione.focus();
        $(button.form.descrizione).css('border-color','red');
        var li = $("<li></li>");
        li.text("Compila il campo descrizione");
        //$('#ul_errori_registrazione').parent().show();
        $('#ul_errori_registrazione').append(li);
    }
    if(citta === ""){
        errori=true;
        citta_msg.innerHTML="Compila il campo città";
        button.form.citta_completamento.focus();
        $(button.form.citta_completamento).css('border-color','red');
        var li = $("<li></li>");
        li.text("Compila il campo città");
        //$('#ul_errori_registrazione').parent().show();
        $('#ul_errori_registrazione').append(li);
    }
    if(password === ""){
        errori=true;
        password_msg.innerHTML="Inserisci la password";
        button.form.password_nuova.focus({preventScroll:false});
        $(button.form.password_nuova).css('border-color','red');
        var li = $("<li></li>");
        li.text("Inserisci la password");
        //$('#ul_errori_registrazione').parent().show();
        $('#ul_errori_registrazione').append(li);

    }
    else if(password.length <  8){
        errori=true;
        password_msg.innerHTML="La password deve essere più lunga di 8 caratteri";
        button.form.password_nuova.focus({preventScroll:false});
        $(button.form.password_nuova).css('border-color','red');
        var li = $("<li></li>");
        li.text("La password deve essere più lunga di 8 caratteri");
        //$('#ul_errori_registrazione').parent().show();
        $('#ul_errori_registrazione').append(li);

    }
    if(password_conferma === ""){
        errori=true;
        password_conferma_msg.innerHTML="Inserisci ancora la password";
        button.form.password_nuova2.focus({preventScroll:false});
        $(button.form.password_nuova2).css('border-color','red');
        var li = $("<li></li>");
        li.text("Inserisci ancora la password");
        //$('#ul_errori_registrazione').parent().show();
        $('#ul_errori_registrazione').append(li);

    }
    else if(password !== password_conferma){
        errori=true;
        password_conferma_msg.innerHTML="Le due password non corrispondono";
        button.form.password_nuova2.focus({preventScroll:false});
        button.form.password_nuova2.innerHTML="";
        $(button.form.password_nuova2).css('border-color','red');
        var li = $("<li></li>");
        li.text("Le due password non corrispondono");
        //$('#ul_errori_registrazione').parent().show();
        $('#ul_errori_registrazione').append(li);
    }


    if(!errori)
    //window.confirm("SONO entrato nel ciclo errori= "+errori);
    {
        //window.confirm("AJAX. citta="+citta);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({

                type: 'POST',

                //url: '/ajaxCitta',
                url: '/ajaxNewUsernameCitta',

                //data: {citta:citta},
                data: {citta:citta, username:username},

                dataType: "json",

                success: function (data) {

                    //window.confirm("HO RICEVUTO: citta:"+data.citta);
                    if (!data.citta){
                        errori = true;
                        citta_msg.innerHTML="Inserisci una città corretta";
                        button.form.citta_completamento.focus();
                        $(button.form.citta_completamento).css('border-color','red');
                        var li = $("<li></li>");
                        li.text("Inserisci una città corretta");
                        //$('#ul_errori_registrazione').parent().show();
                        $('#ul_errori_registrazione').append(li);
                    }
                    if (!data.username)
                    {
                        errori = true;
                        username_msg.innerHTML="Esiste già un altro utente con questo username";
                        button.form.username.focus();
                        $(button.form.username).css('border-color','red');
                        var li = $("<li></li>");
                        li.text("Esiste già un altro utente con questo username");
                        //$('#ul_errori_registrazione').parent().show();
                        $('#ul_errori_registrazione').append(li);

                    }

                    if (!errori){
                        button.form.submit();
                    }
                },

                error: function(data){
                    //window.confirm("fail, citta="+data.citta);
                    alert("fail");
                }

            });
    }
}

function valida_modifica_utente(button){

    //window.confirm("valida_modifica_utente")

    //DIV contenente gli errori
    $('#ul_errori').parent().hide(); //lo nascondo
    $('#ul_errori').empty(); //svuoto la lista

    id=button.form.id.value;// id utente recuperato dalla form

    nome = (button.form.nome.value).trim();
    nome_msg=document.getElementById("invalid-nome");
    nome_msg.innerHTML="";
    var nome_exp = new RegExp("^([a-zA-Z]+)$", "g");


    cognome = (button.form.cognome.value).trim();
    cognome_msg=document.getElementById("invalid-cognome");
    cognome_msg.innerHTML="";
    var cognome_exp = new RegExp("^([a-zA-Z]+)$", "g");

    username = (button.form.username.value).trim();
    username_msg=document.getElementById("invalid-username");
    username_msg.innerHTML="";


    mail = (button.form.mail.value).trim();
    mail_msg=document.getElementById("invalid-mail");
    mail_msg.innerHTML="";
    var mail_exp = RegExp("^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-]{2,})+.)+[.]([a-zA-Z0-9]{2,})+$", "g");

    descrizione = (button.form.descrizione.value).trim();
    descrizione_msg=document.getElementById("invalid-descrizione");
    descrizione_msg.innerHTML="";

    citta = (button.form.citta_completamento.value).trim();
    citta_msg=document.getElementById("invalid-citta_completamento");
    citta_msg.innerHTML="";

    var errori = false;

    if(nome === ""){
        errori=true;
        nome_msg.innerHTML="Compila il campo nome";
        button.form.nome.focus({preventScroll:false});
        $(button.form.nome).css('border-color','red');
        var li = $("<li></li>");
        li.text("Compila il campo nome");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);

    }
    else if(!nome.match(nome_exp)){
        errori=true;
        nome_msg.innerHTML="Il campo nome può contenere solo lettere";
        button.form.nome.focus();
        $(button.form.nome).css('border-color','red');
        var li = $("<li></li>");
        li.text("Il campo nome può contenere solo lettere");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
    }



    if(cognome === ""){
        errori=true;
        cognome_msg.innerHTML="Compila il campo cognome";
        button.form.cognome.focus();
        $(button.form.cognome).css('border-color','red');
        var li = $("<li></li>");
        li.text("Compila il campo cognome");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
    }
    else if(!cognome.match(cognome_exp)){
        errori=true;
        cognome_msg.innerHTML="Il campo cognome può contenere solo lettere";
        button.form.cognome.focus();
        $(button.form.cognome).css('border-color','red');
        var li = $("<li></li>");
        li.text("Il campo cognome può contenere solo lettere");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
    }


    if(username === ""){
        errori=true;
        username_msg.innerHTML="Compila il campo username";
        button.form.username.focus();
        $(button.form.username).css('border-color','red');
        var li = $("<li></li>");
        li.text("Compila il campo username");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
    }


    if(mail === ""){
        errori=true;
        mail_msg.innerHTML="Compila il campo mail";
        button.form.mail.focus();
        $(button.form.mail).css('border-color','red');
        var li = $("<li></li>");
        li.text("Compila il campo mail");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
    }
    else if(!mail.match(mail_exp)){
        errori=true;
        mail_msg.innerHTML="Inserisci una mail valida";
        button.form.mail.focus();
        $(button.form.mail).css('border-color','red');
        var li = $("<li></li>");
        li.text("Inserisci una mail valida");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
    }

    if(descrizione === ""){
        errori=true;
        descrizione_msg.innerHTML="Compila il campo descrizione";
        button.form.descrizione.focus();
        $(button.form.descrizione).css('border-color','red');
        var li = $("<li></li>");
        li.text("Compila il campo descrizione");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
    }

    if(citta === ""){
        errori=true;
        citta_msg.innerHTML="Compila il campo città";
        button.form.citta_completamento.focus();
        $(button.form.citta_completamento).css('border-color','red');
        var li = $("<li></li>");
        li.text("Compila il campo città");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
    }


    if(!errori)
    //window.confirm("SONO entrato nel ciclo errori= "+errori);
    {
        //window.confirm("NON ci sono errori. ID="+id+" username="+username)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({

                type: 'GET',

                url: '/ajaxUsernameCitta',
                //url: '/ajaxNewUsernameCitta',

                data: {username:username, id:id, citta:citta},
                //data: {username:username, citta:citta},

                dataType: "json",

                success: function (data) {

                    if (!data.username)
                    {
                        errori = true;
                        username_msg.innerHTML="Esiste già un altro utente con questo username";
                        button.form.username.focus();
                        $(button.form.username).css('border-color','red');
                        var li = $("<li></li>");
                        li.text("Esiste già un altro utente con questo username");
                        $('#ul_errori').parent().show();
                        $('#ul_errori').append(li);

                    } else if (!data.citta) {
                        errori=true;
                        citta_msg.innerHTML="Inserisci una città esistente";
                        button.form.citta_completamento.focus();
                        $(button.form.citta_completamento).css('border-color','red');
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

function valida_mail(button){
    $('#div_codice').hide();
    $('#ul_errori').parent().hide(); //lo nascondo
    $('#ul_errori').empty(); //svuoto la lista
    $('#ul_conferme').parent().hide(); //lo nascondo
    $('#ul_conferme').empty(); //svuoto la lista
    //window.confirm(button.parentNode.parentNode.parentNode.nodeName);
    id=button.parentNode.parentNode.parentNode.id.value;// id utente recuperato dalla form

    mail = (button.parentNode.parentNode.parentNode.mail.value).trim();
    mail_msg=document.getElementById("invalid-mail");
    mail_msg.innerHTML="";
    var mail_exp = RegExp("^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-]{2,})+.)+[.]([a-zA-Z0-9]{2,})+$", "g");

    var errori = false;

    if(mail === ""){
        errori=true;
        mail_msg.innerHTML="Compila il campo mail";
        button.parentNode.parentNode.parentNode.mail.focus();
        $(button.parentNode.parentNode.parentNode.mail).css('border-color','red');
        var li = $("<li></li>");
        li.text("Compila il campo mail");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
    }
    else if(!mail.match(mail_exp)){
        errori=true;
        mail_msg.innerHTML="Inserisci una mail valida";
        button.parentNode.parentNode.parentNode.mail.focus();
        $(button.parentNode.parentNode.parentNode.mail).css('border-color','red');
        var li = $("<li></li>");
        li.text("Inserisci una mail valida");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
    }

    if(!errori)
    //window.confirm("SONO entrato nel ciclo errori= "+errori);
    {
        //window.confirm("NON ci sono errori. ID="+id+" mail="+mail);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({

                type: 'POST',

                url: '/ajaxMail',

                data: {mail:mail, id:id},

                dataType: "json",

                success: function (data) {

                    if (!data.mail)
                    {
                        errori = true;
                        mail_msg.innerHTML="La mail inserita non corrisponde a quella associata al tuo account";
                        button.parentNode.parentNode.parentNode.mail.focus();
                        $(button.parentNode.parentNode.parentNode.mail).css('border-color','red');
                        var li = $("<li></li>");
                        li.text("La mail inserita non corrisponde a quella associata al tuo account");
                        $('#ul_errori').parent().show();
                        $('#ul_errori').append(li);

                    } else {
                        var li = $("<li></li>");
                        li.text("Mail inviata. Controlla la tua casella di posta e copia qua sotto il codice per il ripristino");
                        li.ready(send_reset_mail());

                        $('#ul_conferme').parent().show();
                        $('#ul_conferme').append(li);

                        //cambiamenti alla pagina
                        $('#btn_valida_mail').text("Invia ancora");
                        $('#div_codice').show();

                    }

                },

                error: function(data){
                    alert("fail");
                }

            });
    }
}

function valida_username_login(button){
    //window.confirm("1- valida Username login login");
    $('#div_codice').hide();
    $('#ul_errori').parent().hide(); //lo nascondo
    $('#ul_errori').empty(); //svuoto la lista
    $('#ul_conferme').parent().hide(); //lo nascondo
    $('#ul_conferme').empty(); //svuoto la lista
    //window.confirm(button.parentNode.parentNode.parentNode.nodeName);

    username = (button.parentNode.parentNode.parentNode.username.value).trim();
    username_msg=document.getElementById("invalid-username");
    username_msg.innerHTML="";

    var errori = false;

    if(username === ""){
        errori=true;
        username_msg.innerHTML="Compila il campo username";
        button.parentNode.parentNode.parentNode.username.focus();
        $(button.parentNode.parentNode.parentNode.username).css('border-color','red');
        var li = $("<li></li>");
        li.text("Compila il campo username");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
    }


    if(!errori)
    {
        //window.confirm("2- mando controllo utente ad ajax: ajaxUsernameInDatabase");
        //window.confirm("NON ci sono errori. ID="+id+" mail="+mail);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({

                type: 'POST',

                url: '/ajaxUsernameInDatabase',

                data: {username:username},

                dataType: "json",

                success: function (data) {

                    if (!data.username)
                    {
                        errori = true;
                        username_msg.innerHTML="L'username inserito non corrisponde a nessun account";
                        button.parentNode.parentNode.parentNode.username.focus();
                        $(button.parentNode.parentNode.parentNode.username).css('border-color','red');
                        var li = $("<li></li>");
                        li.text("L'username inserito non corrisponde a nessun account");
                        $('#ul_errori').parent().show();
                        $('#ul_errori').append(li);

                    } else {
                        var li = $("<li></li>");
                        li.text("Mail inviata a "+data.mail+". Controlla la tua casella di posta e copia qua sotto il codice per il ripristino");
                        li.ready(send_reset_mail_database());
                        //window.confirm("3- ajax ha risposto");

                        $('#ul_conferme').parent().show();
                        $('#ul_conferme').append(li);

                        $('#div_mail').hide();

                        //cambiamenti alla pagina
                        $('#btn_valida_mail').text("Invia ancora");
                        $('#div_codice').show();

                    }

                },

                error: function(data){
                    alert("fail");
                }

            });
    }
}

function send_reset_mail(){
    //window.confirm("STO EFFETTIVAMENTE mandando la mail di reset");


    mail = document.forms.recupero_password.mail.value;
    id = document.forms.recupero_password.id.value;

    //window.confirm("RIASSUNTO DATI: id="+id+" mail="+mail);

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({

                type: 'POST',

                url: '/ajaxSendResetMail',

                data: {mail:mail, id:id},

                dataType: "json",

                success: function (data) {

                    if (data.ok)
                    {
                        //window.confirm("7.1 - CODICE IMPOSTATO A: "+data.codice);
                       $('#ul_errori').append(li);

                    } else {
                        $('#div_codice').show();

                    }

                },

                error: function(data){
                    alert("fail");
                }

            });
}

function send_reset_mail_database(){
    //window.confirm("4 - parte funzione on ready per mandare mail");


    username = document.forms.recupero_password_login.username.value;

    //window.confirm("5 - RIASSUNTO DATI: username="+username);
    //window.confirm("6 - mando ad ajax richiesta invio mail ajaxSendResetMailDatabase");

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({

                type: 'GET',

                url: '/ajaxSendResetMailDatabase',

                data: {username:username},

                dataType: "json",

                success: function (data) {
                    //window.confirm("7- success ajax send reset mail database, data:"+data.ok+" codice settato=: "+data.codice);

                    if (data.ok)
                    {
                        //window.confirm("7.1 - CODICE IMPOSTATO A: "+data.codice);
                        $('#ul_errori').append(li);


                    } else {
                        window.confirm("7.1 - errore su data.ok");
                        $('#div_codice').show();

                    }

                },

                error: function(data){
                    window.confirm("7- failure ajax send reset mail database, data: "+data.ok);
                    alert("fail");
                }

            });
}

function valida_codice(button){
    //window.confirm("8- valida codice");
    $('#ul_errori').parent().hide(); //lo nascondo
    $('#ul_errori').empty(); //svuoto la lista
    $('#ul_conferme').parent().hide(); //lo nascondo
    $('#ul_conferme').empty(); //svuoto la lista

    //id=button.parentNode.parentNode.parentNode.id.value;// id utente recuperato dalla form

    codice = (button.parentNode.parentNode.parentNode.codice.value).trim();
    codice_msg=document.getElementById("invalid-codice");
    codice_msg.innerHTML="";

    //window.confirm("codice: "+codice);

    if(true)
    //window.confirm("9 - ajax per mandare codice al sistema codice: "+codice);
    {
        //window.confirm("NON ci sono errori. ID="+id+" mail="+mail);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({

                type: 'POST',

                url: '/ajaxCodice',

                data: {codice:codice},

                dataType: "json",

                success: function (data) {

                    if (!data.codice)
                    {
                        //window.confirm("10 - il codice non corrisponde, codice: "+data.value);
                        codice_msg.innerHTML="Il codice non corrisponde a quello inviato";
                        button.parentNode.parentNode.parentNode.codice.focus();
                        $(button.parentNode.parentNode.parentNode.codice).css('border-color','red');
                        var li = $("<li></li>");
                        li.text("Il codice non corrisponde a quello inviato");
                        $('#ul_errori').parent().show();
                        $('#ul_errori').append(li);

                    } else {
                        var li = $("<li></li>");
                        li.text("Codice corretto");
                        $('#ul_conferme').parent().show();
                        $('#ul_conferme').append(li);

                        //cambiamenti alla pagina
                        $('#div_mail').hide();
                        $('#div_codice').hide();
                        $('#div_password').show();
                        $('#div_consiglio').show();
                        $('#div_submit').show();

                    }

                },

                error: function(data){
                    alert("fail");
                }

            });
    }
}


function valida_codice_database(button){
    //window.confirm("8- valida codice");
    $('#ul_errori').parent().hide(); //lo nascondo
    $('#ul_errori').empty(); //svuoto la lista
    $('#ul_conferme').parent().hide(); //lo nascondo
    $('#ul_conferme').empty(); //svuoto la lista

    //id=button.parentNode.parentNode.parentNode.id.value;// id utente recuperato dalla form

    codice = (button.parentNode.parentNode.parentNode.codice.value).trim();
    codice_msg=document.getElementById("invalid-codice");
    codice_msg.innerHTML="";

    username = (button.parentNode.parentNode.parentNode.username.value).trim();

    //window.confirm("codice: "+codice);

    if(true)
    //window.confirm("9 - ajax per mandare codice al sistema codice: "+codice+" username: "+username);
    {
        //window.confirm("NON ci sono errori. ID="+id+" mail="+mail);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({

                type: 'POST',

                url: '/ajaxCodiceDatabase',

                data: {codice:codice, username:username},

                dataType: "json",

                success: function (data) {

                    if (!data.codice)
                    {
                        //window.confirm("10 - il codice non corrisponde, codice: "+data.value);
                        codice_msg.innerHTML="Il codice non corrisponde a quello inviato";
                        button.parentNode.parentNode.parentNode.codice.focus();
                        $(button.parentNode.parentNode.parentNode.codice).css('border-color','red');
                        var li = $("<li></li>");
                        li.text("Il codice non corrisponde a quello inviato");
                        $('#ul_errori').parent().show();
                        $('#ul_errori').append(li);

                    } else {
                        var li = $("<li></li>");
                        li.text("Codice corretto");
                        $('#ul_conferme').parent().show();
                        $('#ul_conferme').append(li);

                        //cambiamenti alla pagina
                        $('#div_mail').hide();
                        $('#div_codice').hide();
                        $('#div_password').show();
                        $('#div_consiglio').show();
                        $('#div_submit').show();

                    }

                },

                error: function(data){
                    alert("fail");
                }

            });
    }
}

function valida_reset_password(button){
    $('#ul_errori').parent().hide(); //lo nascondo
    $('#ul_errori').empty();

    $('#ul_conferme').parent().hide(); //lo nascondo
    $('#ul_conferme').empty();

    id=button.form.id.value;

    password_nuova = (button.form.password_nuova.value).trim();
    password_nuova_msg=document.getElementById("invalid-password_nuova");
    password_nuova_msg.innerHTML="";

    var errori=false;

    if(password_nuova === ""){
        errori=true;
        password_nuova_msg.innerHTML="Inserisci la nuova password";
        button.form.password_nuova.focus({preventScroll:false});
        $(button.form.password_nuova).css('border-color','red');
        var li = $("<li></li>");
        li.text("Inserisci la nuova password");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
    }

    else if(password_nuova.length < 8){
        errori=true;
        password_nuova_msg.innerHTML="La password è più corta di 8 caratteri";
        button.form.password_nuova.focus({preventScroll:false});
        $(button.form.password_nuova).css('border-color','red');
        var li = $("<li></li>");
        li.text("La password è più corta di 8 caratteri");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
    }

    if(!errori){
        //window.confirm("faccio partire form: "+button.form.nodeName);
        button.form.submit();
    }

    //DOPO AVER LANCIATO LA FORM

}

function valida_modifica_password(button){

    //window.confirm("valida_modifica_utente")

    //DIV contenente gli errori
    $('#ul_errori').parent().hide(); //lo nascondo
    $('#ul_errori').empty(); //svuoto la lista

    consiglio=$('#consiglio_password');

    id=button.form.id.value;// id utente recuperato dalla form

    password_precedente = (button.form.password_precedente.value).trim();
    password_precedente_msg=document.getElementById("invalid-password_precedente");
    password_precedente_msg.innerHTML="";


    password_nuova = (button.form.password_nuova.value).trim();
    password_nuova_msg=document.getElementById("invalid-password_nuova");
    password_nuova_msg.innerHTML="";

    password_nuova2 = (button.form.password_nuova2.value).trim();
    password_nuova2_msg=document.getElementById("invalid-password_nuova2");
    password_nuova2_msg.innerHTML="";


    var errori = false;

    if(password_precedente === ""){
        errori=true;
        password_precedente_msg.innerHTML="Inserisci la tua attuale password";
        button.form.password_precedente.focus({preventScroll:false});
        $(button.form.password_precedente).css('border-color','red');
        var li = $("<li></li>");
        li.text("Inserisci la tua attuale password");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
        consiglio.text(0);
        consiglio.hide();

    }

    else if(password_nuova === ""){
        errori=true;
        password_nuova_msg.innerHTML="Inserisci la nuova password";
        button.form.password_nuova.focus({preventScroll:false});
        $(button.form.password_nuova).css('border-color','red');
        var li = $("<li></li>");
        li.text("Inserisci la nuova password");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
        consiglio.text(0);
        consiglio.hide();
    }

    else if(password_nuova.length < 8){
        errori=true;
        password_nuova_msg.innerHTML="La password è più corta di 8 caratteri";
        button.form.password_nuova.focus({preventScroll:false});
        $(button.form.password_nuova).css('border-color','red');
        var li = $("<li></li>");
        li.text("La password è più corta di 8 caratteri");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
        consiglio.text(0);
        consiglio.hide();
    }

    else if(password_nuova2 === ""){
        errori=true;
        password_nuova2_msg.innerHTML="Inserisci nuovamente la nuova password";
        button.form.password_nuova2.focus({preventScroll:false});
        $(button.form.password_nuova2).css('border-color','red');
        var li = $("<li></li>");
        li.text("Inserisci nuovamente la nuova password");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
        consiglio.text(0);
        consiglio.hide();
    }

    else if(password_nuova2 !== password_nuova){
        errori=true;
        password_nuova2_msg.innerHTML="Le due password non corrispondono";
        button.form.password_nuova2.focus({preventScroll:false});
        button.form.password_nuova2.innerHTML="";
        $(button.form.password_nuova2).css('border-color','red');
        var li = $("<li></li>");
        li.text("Le due password non corrispondono");
        $('#ul_errori').parent().show();
        $('#ul_errori').append(li);
        consiglio.text(0);
        consiglio.hide();
    }


    if(!errori)
    //window.confirm("SONO entrato nel ciclo errori= "+errori);
    {
        //window.confirm("NON ci sono errori. ID="+id+" username="+username)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({

                type: 'POST',

                url: '/ajaxCheckPassword',

                data: {password:password_precedente, id:id},

                dataType: "json",

                success: function (data) {

                    if (!data.check)
                    {
                        errori = true;
                        password_precedente_msg.innerHTML="La password che hai inserito non è corretta";
                        button.form.password_precedente.focus();
                        $(button.form.password_precedente).css('border-color','red');
                        var li = $("<li></li>");
                        li.text("La password che hai inserito non è corretta");
                        $('#ul_errori').parent().show();
                        $('#ul_errori').append(li);

                        if(consiglio.text().length == 1){

                            valore = parseInt(consiglio.text());
                            if(valore>=3){
                                if(data.consiglio == null || data.consiglio===""){
                                    consiglio.text("Non hai inserito nessun consiglio per il recupero della password");
                                    consiglio.show();
                                }
                                else {
                                    consiglio.text("Consiglio: "+data.consiglio);
                                    consiglio.show();
                                }

                            }
                            else{
                                valore ++;
                                consiglio.text(valore);
                                consiglio.hide();
                            }

                        }


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

//se le due password non sono uguali stampa un messaggio di errore
function password_uguali(button){
    password_nuova = (button.form.password_nuova.value).trim();
    password_nuova_msg=document.getElementById("invalid-password_nuova");
    //password_nuova_msg.innerHTML="";

    password_nuova2 = (button.form.password_nuova2.value).trim();
    password_nuova2_msg=document.getElementById("invalid-password_nuova2");
    password_nuova2_msg.innerHTML="";

    if(password_nuova2 !== password_nuova && password_nuova2!==""){
        password_nuova2_msg.innerHTML="Le due password non corrispondono";

    }
}

//controlla la lunghezza della password deve essere >=8
function password_lunghezza(button){
    password_nuova = (button.form.password_nuova.value).trim();
    password_nuova_msg=document.getElementById("invalid-password_nuova");
    password_nuova2_msg=document.getElementById("invalid-password_nuova2");
    password_nuova2 = button.form.password_nuova2;

    password_nuova_msg.innerHTML="";

    if(password_nuova.length < 8){

        if(password_nuova.length > 0){
            password_nuova_msg.innerHTML="La password è più corta di 8 caratteri";
        }
        else{
            password_nuova2_msg.innerHTML="";
            password_nuova2.innerHTML="";
        }


    }
}

//se inizio a scrivere la prima password si abilita la possibilità di inserire la seconda
function abilita_conferma_password(button){
    password_nuova = (button.form.password_nuova.value).trim();
    password_nuova2 = button.form.password_nuova2;
    if(password_nuova!==""){

        password_nuova2.removeAttribute('disabled');
    }

    else{
        password_nuova2.value="";
        password_nuova2.setAttribute('disabled','true');
    }

}

function strong_password(button){
    var strength = {
        0: "Pessima ☹",
        1: "Troppo debole ☹",
        2: "Debole ☹",
        3: "Buona ☺",
        4: "Forte ☻"
        };

    password_nuova = button.form.password_nuova;
    meter = document.getElementById('password-strength-meter');
    text = document.getElementById('password-strength-text');
    val = (password_nuova.value).trim();

    var result = zxcvbn(val);

    // This updates the password strength meter
    meter.value = result.score;

    // This updates the password meter text
    if (val !== "") {
        text.innerHTML = "Password: " + strength[result.score];
    } else {
        text.innerHTML = "";
    }


}


function massimo_1000_caratteri(f) {
    //window.confirm("check lunghezza");
        if (f.form.descrizione.value.length > 1000) {
                    f.form.descrizione.value = f.form.descrizione.value.substring(0,1000);

            }

    }

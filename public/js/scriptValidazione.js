/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function rimuovi_stile(elemento){
    $(elemento).removeAttr("style");
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

                data: {username:username, id:id, citta:citta},
                
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
        text.innerHTML = "Resistenza della password: " + strength[result.score]; 
    } else {
        text.innerHTML = "";
    }

//    if(val.length<8){
//        meter.value = "4";
//        //meter.style.background = "red";
//        text.innerHTML="Debole";
//    }
//    else if (val.lenght>=8){
//        meter.value = "4";
//        text.innerHTML="Accettabile";
//    }

}
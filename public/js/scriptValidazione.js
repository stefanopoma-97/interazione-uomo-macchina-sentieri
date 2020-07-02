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
    
    id=button.form.id.value;
    
    
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
    
    
    if(!nome.match(nome_exp)){
        errori=true;
        nome_msg.innerHTML="Il campo nome può contenere solo lettere";
        button.form.nome.focus();
        $(button.form.nome).css('border-color','red');
    }
    
    if(nome === ""){
        errori=true;
        nome_msg.innerHTML="Compila il campo nome";
        button.form.nome.focus({preventScroll:false});
        $(button.form.nome).css('border-color','red');
        
    }
    
    if(!cognome.match(cognome_exp)){
        errori=true;
        cognome_msg.innerHTML="Il campo cognome può contenere solo lettere";
        button.form.cognome.focus();
        $(button.form.cognome).css('border-color','red');
    }
    
    if(cognome === ""){
        errori=true;
        cognome_msg.innerHTML="Compila il campo cognome";
        button.form.cognome.focus();
        $(button.form.cognome).css('border-color','red');
    }
    
    if(username === ""){
        errori=true;
        username_msg.innerHTML="Compila il campo username";
        button.form.username.focus();
        $(button.form.username).css('border-color','red');
    }
    
    if(mail === ""){
        errori=true;
        mail_msg.innerHTML="Compila il campo mail";
        button.form.mail.focus();
        $(button.form.mail).css('border-color','red');
    }
    
    if(!mail.match(mail_exp)){
        errori=true;
        mail_msg.innerHTML="Inserisci una mail valida";
        button.form.mail.focus();
        $(button.form.mail).css('border-color','red');
    }
    
    if(descrizione === ""){
        errori=true;
        descrizione_msg.innerHTML="Compila il campo descrizione";
        button.form.descrizione.focus();
        $(button.form.descrizione).css('border-color','red');
    }
    
    if(citta === ""){
        errori=true;
        citta_msg.innerHTML="Compila il campo città";
        button.form.citta_completamento.focus();
        $(button.form.citta_completamento).css('border-color','red');
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

                    } else if (!data.citta) {
                        errori=true;
                        citta_msg.innerHTML="Inserisci una città esistente";
                        button.form.citta_completamento.focus();
                        $(button.form.citta_completamento).css('border-color','red');
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
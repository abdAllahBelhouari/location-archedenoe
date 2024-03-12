function showMdp(id){
    let champ=document.getElementById(id);
    champ.type=champ.type==="password"?"text":"password";
}
function VerifCasse(evt,type) {
    if ( evt.keyCode != 13 ) {
            switch(type) {
                    case "number":
                            var accept = "0123456789";
                            var txt = "En chiffres uniquement !";
                            break;
                    case "decimal":
                            var accept = "0123456789.-";
                            var txt = "Chiffres . et - acceptés !";
                            break;
                    case "time":
                            var accept = "0123456789:";
                            var txt = "Heure au format :\n         00:00";
                            break;  
                    case "phone":
                            var accept = "+ 0123456789";
                            var txt = "Chiffres, + et espace uniquement !";
                            break;  
                    case "tarif":
                            var accept = " 0123456789,.";
                            var txt = "Chiffres, point ou virgule uniquement !";
                            break;   
                    case "float":
                            var accept = "0123456789.";
                            var txt = "Chiffres et point uniquement !";
                            break;  
            }
            var keyCode = evt.which ? evt.which : evt.keyCode;
            if ( (accept.indexOf(String.fromCharCode(keyCode)) >= 0) ) {
                    return true;
            } else {
                    alert(txt);
                    return false;
            }
    }
}
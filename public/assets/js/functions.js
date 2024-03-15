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


function sweetAlert(titre, message, url, icon = 'question') {
	const swalWithBootstrapButtons = Swal.mixin({
		customClass: {
			confirmButton: "btn btn-success",
			cancelButton: "btn btn-danger",
		},
		buttonsStyling: false,
	});
	swalWithBootstrapButtons
	.fire({
		title: titre,
		text: message,
		icon: icon,
		showCancelButton: true,
		confirmButtonText: "Confirmer",
		cancelButtonText: "Annuler",
		reverseButtons: true,
	})
	.then((result) => {
		if (result.isConfirmed) {
			swalWithBootstrapButtons.fire({
			title: "Confirmation",
			text: "Votre demande est en cours de traitement...",
			icon: "success",
			showConfirmButton: false,
			timer: 2500
			});
			setTimeout(() => { window.location.href = url; }, "2500");
		} else if (
			/* Read more about handling dismissals below */
			result.dismiss === Swal.DismissReason.cancel
			) {
				swalWithBootstrapButtons.fire({
				title: "Annulation !",
				text: "Traitement en cours...",
				icon: "error",
				showConfirmButton: false,
				timer: 2000
			});
		}
	});
}
function Processing() {
	document.getElementById("page-wrapper").style.display = "none";
	document.getElementById("Wait").style.display = "block";
}
function showImgLoading(event, id) {
	document.getElementById(id).src = URL.createObjectURL(event.target.files[0]);
}

//Conferma logout
function logout(){
	swal({
		icon: "warning",
        title: "Sei sicuro di voler uscire?",
        buttons: {
            confirm: {
            	text: "Si",
                className:"confirm-button",
                value: "confirm",
			},
            cancel: "Annulla",
		},
	}).then((value) => {
		switch (value) {
            case "confirm":
                window.location.href = "index.php";
                break;
			default:
                break;
            }
	});
}
//ACCESSO
function showAlertLogin(){
	swal({
      title: 'Accesso Effettuato!',
      icon: 'success',
      timer: 2000,
      buttons: false,
	})
	.then(() => {
    	window.location.href = "homepage-logged.php";
	})
}
//REGISTRAZIONE
function showAlertRegistration(){
	swal({
      title: 'Registrazione Effettuata!',
      icon: 'success',
      timer: 2000,
      buttons: false,
	})
	.then(() => {
    	//Magari passiamo all'area riservata dopo la registrazione
    	window.location.href = "homepage-logged.php";
	})
}
//ALERT CAMBIO ALLEGATO
function checkAttachment(object, number){
	let id1="checkColor";
    let id2="checkImage";
    let id3="button";
    let id4="favcolor";
    let id5="imageP";
    let id6="colorP";
    let id7="clickHint";
    let elementId1=id1 + number;
    let elementId2=id2 + number;
    let elementId3=id3 + number;
    let elementId4=id4 + number;
    let elementId5=id5 + number;
    let elementId6=id6 + number;
    let elementId7=id7 + number;
	if(object.id===elementId5 && document.getElementById(elementId1).classList.contains("checkState")){
      swal({
		icon: "warning",
        text: "Per questo paragrafo risulta già un colore salvato, vuoi sostituirlo con un'immagine?",
        buttons: {
            confirm: {
            	text: "Si",
                className:"confirm-button",
                value: "confirm",
			},
        	cancel: "Annulla",
		},
      }).then((value) => {
      	switch (value) {
           	case "confirm":
        	    document.getElementById(elementId4).value='#92A8D1';
                document.getElementById(elementId1).classList.remove("checkState");
                document.getElementById(elementId7).style.display="inline";
                openImage(number);
                break;
            default:
                break;
            }
      });
    }else if(object.id===elementId6 && document.getElementById(elementId2).classList.contains("checkState")){
      swal({
        icon: "warning",
        text: "Per questo paragrafo risulta già un'immagine salvata, vuoi sostituirla con un colore?",
        buttons: {
          confirm: {
            text: "Si",
            className:"confirm-button",
            value: "confirm",
          },
          cancel: "Annulla",
        },
		  }).then((value) => {
        switch (value) {
          case "confirm":
          	document.getElementById(elementId3).value= '';
            document.getElementById(elementId2).classList.remove("checkState");
            openColor(number);
            break;
          default:
            break;
        }
		  });
    } else if(object.id===elementId6){
    	openColor(number);    
    }else if(object.id===elementId5){
    	openImage(number); 
    }
}
function showAlertStory(){
	swal({
		icon: "success",
        title: "Storia inviata!",
        text: "Grazie per il vostro contributo!\n Appena disponibile, un amministratore eseguirà un controllo sul materiale inviato per accertarsi che la storia sia coerente e soprattutto priva di contenuti inappropriati.",
        buttons: {
            confirm: {
            	text: "Ho capito",
                className:"confirm-button",
                value: "confirm",
			},
            cancel:false,
		},
	}).then((value) => {
		switch (value) {
            case "confirm":
                window.location.href = "homepage-logged.php";
                break;
			default:
                break;
            }
	});

}
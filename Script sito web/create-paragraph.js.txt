//Funzione per creare programmaticamente dei paragrafi indicizzabili
var data,p_nav;
var counter=2;

function createParagraph(){
    	data="<div id='paragraph"+counter+"' class='paragraph'>"
        	+"<div class='top-paragraph-card'>"
    			+"<div class='top-paragraph-card-left'>"
        			+"<h3>Paragrafo "+counter+"</h3>"
        			+"<i id='par"+counter+"' onclick='openParagraph(this,"+counter+")' class='fas fa-chevron-down'> </i>"
    			+"</div>"
    			+"<div class='top-paragraph-card-right'>"
        			+"<i id='imageP"+counter+"' onclick='checkAttachment(this,"+counter+")' name='imageIcon' class='fas fa-image'>"
        			+"<i id='checkImage"+counter+"' class='fas fa-check default'></i></i>"
        			+"<i id='colorP"+counter+"' onclick='checkAttachment(this,"+counter+")' class='fas fa-palette'>"
        			+"<i id='checkColor"+counter+"' class='fas fa-check default'></i></i>"
        			+"<label id='pepperP"+counter+"' onclick='openPepper("+counter+")' class='pepper-text'>pepper"
        			+"<i id='checkPepper"+counter+"' class='fas fa-check default'></i></label>"
    			+"</div>"
			+"</div><!--Chiude top-paragraph-card-->"
			+"<textarea id='textArea"+counter+"' name='paragraph[]' class='form-control' onfocus='openParagraph(this,"+counter+")' placeholder='Testo qui...' required='required'></textarea>"
			+"<div id='imageSelector"+counter+"' class='itemSel'>"
    			+"<h3>Allega immagine al paragrafo</h3>"
                +"<div id='image-link"+counter+"' style='display:none;'></div>"
    			+"<div class='item-container'>"
        			+"<div class='fix-close-pos'>"
            			+"<input id='button"+counter+"' name='images[]' class='uploadBox' type='file' onchange='getFileData(this,"+counter+")'>"
            			+"<i id='remove-image"+counter+"' class='fas fa-times timesDefault' onclick='removeInput(this,"+counter+")'></i>"
        			+"</div>"
    			+"</div>"
    			+"<input type='button' id='close"+counter+"' class='buttonClose' value='Chiudi' onclick='closeAttachment("+counter+")'>"
			+"</div><!--Chiude Selettore immagine-->"
			+"<div id='colorSelector"+counter+"' class='itemSel'>"
            	+"<h3>Scegli un colore per il paragrafo</h3>"
                +"<div class='item-container'>"
                    +"<div id='colorDiv"+counter+"' class='favColor' onclick='disableHint("+counter+")'>"
                        +"<div class='fix-close-pos'>"
                            +"<input type='color' id='favcolor"+counter+"' class='customColor' name='colors[]' value='#92A8D2' onchange='getColorData(this,"+counter+")'>"
                            +"<i id='remove-color"+counter+"' class='fas fa-times timesDefaultColor' onclick='removeInput(this,"+counter+")'></i>"
                        +"</div>"
                    +"</div>"                   
                +"</div>"
                +"<input type='button' id='close"+counter+"' class='buttonClose' value='Chiudi' onclick='closeAttachment("+counter+")'>"
                +"<div class='span-area'>"
                	+"<span id='clickHint"+counter+"'>Clicca nell'area</span>"
                  	+"<span id='feedbackHint"+counter+"' style='display:none;'>Colore salvato!</span>"
                  	+"<span id='deleteColor"+counter+"' style='display:none;'>Colore rimosso!</span>"
                +"</div>"                 
            +"</div><!--Chiude selettore colore-->"
            +"<div id='pepperSelector"+counter+"' class='itemSel'>"
                +"<h3 class='imageHeader'>Reazioni per Pepper</h3>"
                +"<div id='animMain"+counter+"' class='animMain'>"
                    +"<div id='animTop"+counter+"' class='animTop'>"
                        +"<i id='Apaw"+counter+"' class='fas fa-paw' onclick='changeAnim(this,"+counter+")'></i>"
                        +"<i id='Asmile"+counter+"' class='fas fa-smile' onclick='changeAnim(this,"+counter+")'></i>"
                        +"<i id='Ameh"+counter+"' class='fas fa-meh' onclick='changeAnim(this,"+counter+")'></i>"
                        +"<i id='Afrown"+counter+"' class='fas fa-frown-open' onclick='changeAnim(this,"+counter+")'></i>"
                        +"<i id='Aangry"+counter+"' class='fas fa-angry' onclick='changeAnim(this,"+counter+")'></i>"
                    +"</div>"                              
                    +"<div id='anim1Content"+counter+"' class='animContent'>"
                        +"<!--Animali-->"
                        +"<label id='anim1animal"+counter+"' onclick='animSelected(this,"+counter+")'>Elefante</label>"
                        +"<label id='anim2animal"+counter+"' onclick='animSelected(this,"+counter+")'>Gorilla</label>"
                        +"<label id='anim3animal"+counter+"' onclick='animSelected(this,"+counter+")'>Topo</label>"
                        +"<label id='anim4animal"+counter+"' onclick='animSelected(this,"+counter+")'>Lupo</label>"
                    +"</div>"
                    +"<div id='anim2Content"+counter+"' class='animContent'>"
                        +"<!--Smile-->"
                        +"<label id='anim1smile"+counter+"' onclick='animSelected(this,"+counter+")'>Nonno d'avanti al cantiere</label>"
                        +"<label id='anim2smile"+counter+"' onclick='animSelected(this,"+counter+")'>Ballo contento</label>"
                        +"<label id='anim3smile"+counter+"' onclick='animSelected(this,"+counter+")'>Curioso</label>"
                        +"<label id='anim4smile"+counter+"' onclick='animSelected(this,"+counter+")'>Batte le mani</label>"
                        +"<label id='anim5smile"+counter+"' onclick='animSelected(this,"+counter+")'>Camminata</label>"
                        +"<label id='anim6smile"+counter+"' onclick='animSelected(this,"+counter+")'>Manda i baci</label>"
                        +"<label id='anim7smile"+counter+"' onclick='animSelected(this,"+counter+")'>Lapo Elkann</label>"
                        +"<label id='anim8smile"+counter+"' onclick='animSelected(this,"+counter+")'>Giudice</label>"
                    +"</div>"
                    +"<div id='anim3Content"+counter+"' class='animContent'>"
                        +"<!--Meh-->"
                        +"<label id='anim1meh"+counter+"' onclick='animSelected(this,"+counter+")'>Sbadiglio</label>"
                        +"<label id='anim2meh"+counter+"' onclick='animSelected(this,"+counter+")'>Confuso (Goku)</label>"
                        +"<label id='anim3meh"+counter+"' onclick='animSelected(this,"+counter+")'>Si gratta la testa col braccio lontano</label>"
                        +"<label id='anim4meh"+counter+"' onclick='animSelected(this,"+counter+")'>No con la testa</label>"
                   +"</div>"
                   +"<div id='anim4Content"+counter+"' class='animContent'>"                                  
                        +"<!--Sad-->"
                        +"<label id='anim1sad"+counter+"' onclick='animSelected(this,"+counter+")'>Disorientato</label>"
                        +"<label id='anim2sad"+counter+"' onclick='animSelected(this,"+counter+")'>Sconsolato/Triste</label>"
                        +"<label id='anim3sad"+counter+"' onclick='animSelected(this,"+counter+")'>Spaventato</label>"
                        +"<label id='anim4sad"+counter+"' onclick='animSelected(this,"+counter+")'>Paura (Si copre gli occhi)</label>"
                        +"<label id='anim5sad"+counter+"' onclick='animSelected(this,"+counter+")'>Alza le mani (paura)</label>"
                    +"</div>"
                    +"<div id='anim5Content"+counter+"' class='animContent'>"                                   
                        +"<!--Angry-->"
                        +"<label id='anim1angry"+counter+"' onclick='animSelected(this,"+counter+")'>Mr burns che si mangia un panino alla fine</label>"
                        +"<label id='anim2angry"+counter+"' onclick='animSelected(this,"+counter+")'>Sbatte pugni sul tavolo</label>"
                        +"<label id='anim3angry"+counter+"' onclick='animSelected(this,"+counter+")'>Arrabbiato</label>"    
                    +"</div>"
                +"</div>"
                +"<div class='chosenAnimStyle'>"
                    +"<div class='inlinegoddammit'>"
                        +"<h5 style='white-space: nowrap;'>Animazione scelta  :&nbsp&nbsp</h5>"
                        +"<h5 id='chosenAnim"+counter+"' name='animations[]'></h5>"
                    +"</div>"
                    +"<i id='remove-pepper"+counter+"' class='fas fa-times timesPepper' onclick='removeInput(this,"+counter+")'></i>"
                +"</div>"
                +"<input type='button' id='close"+counter+"' class='buttonClose' value='Chiudi' onclick='closeAttachment("+counter+")'>"
            +"</div>"
            +"</div>"
         +"</div>";
        p_nav="<a id='pointer"+counter+"' href='#paragraph"+counter+"'>Paragrafo "+counter+"</a>";
		document.getElementById("container").insertAdjacentHTML("beforeend",data);
        document.getElementById("paragraph-navigator").insertAdjacentHTML("beforeend",p_nav);
       	counter++;
}

//Comando per cancellare l'ultimo paragrafo
function deleteParagraph() {
    if(counter>2){
        counter=counter-1;
		var obj1 = document.getElementById("paragraph"+counter);
        var obj2 = document.getElementById("pointer"+counter);
  		obj1.remove();
        obj2.remove();
    }
}

function toggle_moral(state){
	if(state.value=="+")
    	document.getElementById("moral-container").style.display="flex";
    else if(state.value=="-")
    	document.getElementById("moral-container").style.display="none";	
}



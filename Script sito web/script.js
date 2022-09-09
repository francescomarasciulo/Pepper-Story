function openImage(number){
	let id1="imageSelector";
    let id2="textArea";
    let id3="imageP";
    let id4="colorP";
    let id5="pepperP";
    let id6="par";
    let elementId6 = id6 + number;
    let elementId1 = id1 + number;
    let elementId2 = id2 + number;
    let elementId3 = id3 + number;
    let elementId4 = id4 + number;
    let elementId5 = id5 + number;
    if(document.getElementById(elementId4).classList.contains("active")){
    	openColor(number);
        document.getElementById(elementId1).classList.toggle("showICSelector");
    	document.getElementById(elementId2).classList.toggle("hideTextArea");
    	document.getElementById(elementId3).classList.toggle("active");
    }
    else if(document.getElementById(elementId5).classList.contains("active")){
        openPepper(number);
        document.getElementById(elementId1).classList.toggle("showICSelector");
    	document.getElementById(elementId2).classList.toggle("hideTextArea");
    	document.getElementById(elementId3).classList.toggle("active");
    }else{
        document.getElementById(elementId1).classList.toggle("showICSelector");
    	document.getElementById(elementId2).classList.toggle("hideTextArea");
    	document.getElementById(elementId3).classList.toggle("active");
    }
    if(document.getElementById(elementId2).classList.contains("isFocused")){
    	document.getElementById(elementId6).classList.toggle("rotate");
    	document.getElementById(elementId2).classList.remove("isFocused");
    }
    if(document.getElementById(elementId6).style.display!="none"){
    	document.getElementById(elementId6).style.display="none";
    }else
    	document.getElementById(elementId6).style.display="inline";
    	
}
function openColor(number){
	let id1="colorSelector";
    let id2="textArea";
    let id3="colorP";
    let id4="imageP";
    let id5="pepperP";
    let id6="par";
    let id7="feedbackHint";
    let id8="deleteColor";
    let elementId1 = id1 + number;
    let elementId2 = id2 + number;
    let elementId3 = id3 + number;
    let elementId4 = id4 + number;
    let elementId5 = id5 + number;
    let elementId6 = id6 + number;
    let elementId7 = id7 + number;
    let elementId8 = id8 + number;
    if(document.getElementById(elementId4).classList.contains("active")){
    	openImage(number);
        document.getElementById(elementId1).classList.toggle("showICSelector");
    	document.getElementById(elementId2).classList.toggle("hideTextArea");
    	document.getElementById(elementId3).classList.toggle("active");
    }
    else if(document.getElementById(elementId5).classList.contains("active")){
        openPepper(number);
        document.getElementById(elementId1).classList.toggle("showICSelector");
    	document.getElementById(elementId2).classList.toggle("hideTextArea");
    	document.getElementById(elementId3).classList.toggle("active");
    }else{
        document.getElementById(elementId1).classList.toggle("showICSelector");
    	document.getElementById(elementId2).classList.toggle("hideTextArea");
    	document.getElementById(elementId3).classList.toggle("active");
    }
    if(document.getElementById(elementId2).classList.contains("isFocused")){
    	document.getElementById(elementId6).classList.toggle("rotate");
    	document.getElementById(elementId2).classList.remove("isFocused");
    }
    if(document.getElementById(elementId6).style.display!="none"){
    	document.getElementById(elementId6).style.display="none";
    }else
    	document.getElementById(elementId6).style.display="inline";
}

function openPepper(number){
	let id1="pepperSelector";
    let id2="textArea";
    let id3="colorP";
    let id4="imageP";
    let id5="pepperP";
    let id6="par";
    let elementId6 = id6 + number;
    let elementId1 = id1 + number;
    let elementId2 = id2 + number;
    let elementId3 = id3 + number;
    let elementId4 = id4 + number;
    let elementId5 = id5 + number;
    if(document.getElementById(elementId3).classList.contains("active")){
    	openColor(number);
        document.getElementById(elementId1).classList.toggle("showICSelector");
    	document.getElementById(elementId2).classList.toggle("hideTextArea");
    	document.getElementById(elementId5).classList.toggle("active");
    }
    else if(document.getElementById(elementId4).classList.contains("active")){
        openImage(number);
        document.getElementById(elementId1).classList.toggle("showICSelector");
    	document.getElementById(elementId2).classList.toggle("hideTextArea");
    	document.getElementById(elementId5).classList.toggle("active");
    }else{
        document.getElementById(elementId1).classList.toggle("showICSelector");
    	document.getElementById(elementId2).classList.toggle("hideTextArea");
    	document.getElementById(elementId5).classList.toggle("active");
    }
    if(document.getElementById(elementId2).classList.contains("isFocused")){
    	document.getElementById(elementId6).classList.toggle("rotate");
    	document.getElementById(elementId2).classList.remove("isFocused");
    }
    if(document.getElementById(elementId6).style.display!="none"){
    	document.getElementById(elementId6).style.display="none";
    }else
    	document.getElementById(elementId6).style.display="inline";
}
function openParagraph(object,number){
    let id1="par";
    let id2="textArea";
    let elementId1 = id1 + number;
    let elementId2 = id2 + number;
    if(object.id!=elementId2){
    	document.getElementById(elementId1).classList.toggle("rotate");
    	document.getElementById(elementId2).classList.toggle("isFocused");
    }
    else if(document.getElementById(elementId2).classList.contains("isFocused")==false){
    	document.getElementById(elementId1).classList.toggle("rotate");
    	document.getElementById(elementId2).classList.toggle("isFocused");
    }
}

function closeAttachment(number){
	let id1="textArea";
    let id2="colorP";
    let id3="imageP";
    let id4="pepperP";
    let id5="par";
    let elementId1 = id1 + number;
    let elementId2 = id2 + number;
    let elementId3 = id3 + number;
    let elementId4 = id4 + number;
    let elementId5 = id5 + number;
    if(document.getElementById(elementId1).classList.contains("hideTextArea")){
    	if(document.getElementById(elementId2).classList.contains("active"))	openColor(number);
        else if(document.getElementById(elementId3).classList.contains("active"))	openImage(number);
        else if(document.getElementById(elementId4).classList.contains("active"))	openPepper(number);
    }
    document.getElementById(elementId5).style.display="inline";
}

function getFileData(object, number){
	let id1="checkImage";
    let elementId1 = id1 + number;
	var file = object.files[0];
    console.log("Valore in Object: "+object.files[0].name);
	document.getElementById(elementId1).classList.add("checkState");
}

function getColorData(object, number){
	let id1="checkColor";
    let id2="feedbackHint"; 
    let elementId1 = id1 + number;
    let elementId2 = id2 + number;
	document.getElementById(elementId1).classList.add("checkState");
    document.getElementById(elementId2).style.display="inline";
    setTimeout(function(){
    	document.getElementById(elementId2).style.display="none";
    }, 2000);
    
}
function disableHint(number){
    let id1="clickHint";
    let elementId1=id1 + number;
    setTimeout(function(){ 
    	document.getElementById(elementId1).style.display="none";
    }, 900);
}

function removeInput(object,number){
	let id1="button";
    let id2="checkImage";
    let id3="favcolor";
    let id4="checkColor";
    let id5="chosenAnim";
    let id6="checkPepper";
    let id7="deleteColor";
    let id8="remove-image";
    let id9="remove-color";
    let id10="remove-pepper";
    let elementId1=id1 + number;
    let elementId2=id2 + number;
    let elementId3=id3 + number;
    let elementId4=id4 + number;
    let elementId5=id5 + number;
    let elementId6=id6 + number;
    let elementId7=id7 + number;
    let elementId8=id8 + number;
    let elementId9=id9 + number;
    let elementId10=id10 + number;
    if(object.id===elementId8){
        if(document.getElementById(elementId1).value!=null)
    		document.getElementById(elementId1).value= '';
    	if(document.getElementById(elementId2).classList.contains("checkState"))
    		document.getElementById(elementId2).classList.remove("checkState");
    
    }else if(object.id===elementId9){
   		if(document.getElementById(elementId3).value!=null){
    		document.getElementById(elementId3).value= '#92A8D1';
        	document.getElementById(elementId7).style.display="inline";
    		setTimeout(function(){
    			document.getElementById(elementId7).style.display="none";
    		}, 1500);
    	}
    	if(document.getElementById(elementId4).classList.contains("checkState"))
    		document.getElementById(elementId4).classList.remove("checkState"); 
    }else if(object.id===elementId10){
        if(document.getElementById(elementId5).value!=null){
			document.getElementById(elementId5).value= '';
        	document.getElementById(elementId5).textContent= '';
    	}
    	if(document.getElementById(elementId6).classList.contains("checkStateText"))
    		document.getElementById(elementId6).classList.remove("checkStateText");
    }
}
function changeAnim(object ,number){
	let id1="Apaw";
    let id2="Asmile";
    let id3="Ameh";
    let id4="Afrown";
    let id5="Aangry";
    let id11="anim1Content";
    let id12="anim2Content";
    let id13="anim3Content";
    let id14="anim4Content";
    let id15="anim5Content";
    let elementId1=id1 + number;
    let elementId2=id2 + number;
    let elementId3=id3 + number;
    let elementId4=id4 + number;
    let elementId5=id5 + number;
    let elementId11=id11 + number;
    let elementId12=id12 + number;
    let elementId13=id13 + number;
    let elementId14=id14 + number;
    let elementId15=id15 + number;
    
    //Funzione che controlla tutte le icone delle animazioni e disattiva quella sostituita 
    function whosGonnaDie(notHim){
    	if(document.getElementById(elementId1).classList.contains("animActive")==true && elementId1!=notHim ){
        	document.getElementById(elementId11).style.display="none";
    		document.getElementById(elementId1).classList.toggle("animActive");
        }
        if(document.getElementById(elementId2).classList.contains("animActive")==true && elementId2!=notHim ){
        	document.getElementById(elementId12).style.display="none";
    		document.getElementById(elementId2).classList.toggle("animActive");
        }
        if(document.getElementById(elementId3).classList.contains("animActive")==true && elementId3!=notHim ){
        	document.getElementById(elementId13).style.display="none";
    		document.getElementById(elementId3).classList.toggle("animActive");
        }
        if(document.getElementById(elementId4).classList.contains("animActive")==true && elementId4!=notHim ){
        	document.getElementById(elementId14).style.display="none";
    		document.getElementById(elementId4).classList.toggle("animActive");
        }
        if(document.getElementById(elementId5).classList.contains("animActive")==true && elementId5!=notHim ){
        	document.getElementById(elementId15).style.display="none";
    		document.getElementById(elementId5).classList.toggle("animActive");
        }
    }
    
    if(object.id===elementId1){
    	document.getElementById(elementId11).style.display="flex";
        if(document.getElementById(elementId1).classList.contains("animActive")!=true)
    		document.getElementById(elementId1).classList.toggle("animActive");
        whosGonnaDie(object.id);
    }else if(object.id===elementId2){
    	document.getElementById(elementId12).style.display="flex";
        if(document.getElementById(elementId2).classList.contains("animActive")!=true)
    		document.getElementById(elementId2).classList.toggle("animActive");
        whosGonnaDie(object.id);
    }else if(object.id===elementId3){
    	document.getElementById(elementId13).style.display="flex";
        if(document.getElementById(elementId3).classList.contains("animActive")!=true)
    		document.getElementById(elementId3).classList.toggle("animActive");
        whosGonnaDie(object.id);
    }else if(object.id===elementId4){
    	document.getElementById(elementId14).style.display="flex";
        if(document.getElementById(elementId4).classList.contains("animActive")!=true)
    		document.getElementById(elementId4).classList.toggle("animActive");
        whosGonnaDie(object.id);
    }else if(object.id===elementId5){
    	document.getElementById(elementId15).style.display="flex";
        if(document.getElementById(elementId5).classList.contains("animActive")!=true)
    		document.getElementById(elementId5).classList.toggle("animActive");
        whosGonnaDie(object.id);
    }

}
function animSelected(object, number){
	let id1="chosenAnim";
    let id2="checkPepper";
    let elementId1=id1 + number;
    let elementId2=id2 + number;
    document.getElementById(elementId1).value=object.textContent;
    document.getElementById(elementId1).textContent=object.textContent;
    if(document.getElementById(elementId2).classList.contains("checkStateText")==false)
    	document.getElementById(elementId2).classList.add("checkStateText");
}


function enableButton(){
	let title=document.getElementById("title-text").value;
    let text=document.getElementById("textArea1").value;
    if(title.length>0 && text.length>5){
    	document.getElementById("upload-story").classList.toggle("disabled");
    }else if(text.length<5){
    	if(document.getElementById("upload-story").classList.contains("disabled")==false){
        	document.getElementById("upload-story").classList.toggle("disabled");
        }
    }else if(title.length<1){
    	if(document.getElementById("upload-story").classList.contains("disabled")==false){
        	document.getElementById("upload-story").classList.toggle("disabled");
        }    
    }
}

function closePane(){
	document.getElementById("help-panel").classList.toggle("closed");
    document.getElementById("btn-container1").classList.toggle("closed");
    document.getElementById("btn-container2").classList.toggle("closed");
    document.getElementById("help-text1").classList.toggle("closed");
    document.getElementById("help-text2").classList.toggle("closed");
    document.getElementById("help-text3").classList.toggle("closed");
    document.getElementById("paragraph-navigator").classList.toggle("closed");
    document.getElementById("container").classList.toggle("expand");
    document.getElementById("toggle-icon").classList.toggle("close-pane");
}

function enable_port_navbar(){
        document.getElementById("navbar-title").classList.toggle("remove-title");
	if(document.getElementById("nav-portrait").classList.contains("nav-switch")==true){
    	document.getElementById("nav-portrait").classList.toggle("anim-out");
		setTimeout(function(){ 
    		document.getElementById("nav-portrait").classList.toggle("nav-switch");
    	}, 1000);   
    }else{
    	if(document.getElementById("nav-portrait").classList.contains("anim-out")==true)
        	document.getElementById("nav-portrait").classList.toggle("anim-out");
    	document.getElementById("nav-portrait").classList.toggle("nav-switch");
    }
}

function userStories(is_admin) {
	var data;
    var data_admin;
    var counter=0;
    var counter_admin=0;
    	$.ajax({
            type: 'GET',
            url: 'user_stories.php',
    		success: function(userStoriesResult) {
        		var jsonData = JSON.parse(userStoriesResult);
                var str = JSON.stringify(jsonData);
				var obj = JSON.parse(str);
                if(obj[0]==null){
                	document.getElementById("if-no-stories").style.display="flex";
                }
                for(let story in obj){
                	data="<div id='grid-item"+counter+"' class='grid-item' onclick='open_story(this)'>"
                            +"<div class='grid-item-overlay'>"
                            	+"<label id='text-label"+counter+"' class='grid-item-title'></label>"
                            +"</div>"
                        +"</div>";
                        document.getElementById("story-container").insertAdjacentHTML("beforeend",data);
                        document.getElementById("grid-item"+counter).name=obj[counter].Titolo;
                        document.getElementById("text-label"+counter).textContent=obj[counter].Titolo;
                        addImageBackground(counter);   
                        counter++;
                }
    		}
		});
        if(is_admin=="SI"){
        	document.getElementById("admin-function").style.display="flex";
        	$.ajax({
            	type: 'GET',
            	url: 'validate_stories.php',
    			success: function(storiesResult) {
        			var jsonDataA = JSON.parse(storiesResult);
                	var str_A = JSON.stringify(jsonDataA);
					var obj_admin = JSON.parse(str_A);
                    if(obj_admin[0]==null){
                		document.getElementById("no-story-to-validate").style.display="flex";
                	}
                	for(let story_A in obj_admin){
                		data_admin="<div id='admin-grid-item"+counter_admin+"' class='grid-item'onclick='validate_story(this);'>"
                            +"<div class='grid-item-overlay'>"
                            	+"<label id='admin-text-label"+counter_admin+"' class='grid-item-title'></label>"
                            +"</div>"
                        +"</div>";
                        document.getElementById("story-tovalidate-container").insertAdjacentHTML("beforeend",data_admin);
                        document.getElementById("admin-grid-item"+counter_admin).name=obj_admin[counter_admin].Titolo;
                        document.getElementById("admin-text-label"+counter_admin).textContent=obj_admin[counter_admin].Titolo;
                        //addImageBackground(counter_admin);   
                        counter_admin++;
                	}
    			}
			});
        }else document.getElementById("admin-function").style.display="none";
}

function addImageBackground(counter){
	var background_story = new Image();
	$.ajax({
		type: 'GET',
        url: 'get_image_web.php',
    	success: function(base64) {
            background_story.src = base64;
        	document.getElementById("grid-item"+counter).style.backgroundImage ='url('+background_story.src+')';
       }
    });
}

function switch_function(object){
	if(object.id=="user-function"){
    	if(document.getElementById("user-function").classList.contains("active")==false){
        	document.getElementById("user-function").classList.toggle("active");
            document.getElementById("admin-function").classList.toggle("active");
        }
        document.getElementById("story-container").style.display="grid";
        document.getElementById("story-tovalidate-container").style.display="none";
        
        
    }else if(object.id=="admin-function"){
    	if(document.getElementById("admin-function").classList.contains("active")==false){
        	document.getElementById("admin-function").classList.toggle("active");
            document.getElementById("user-function").classList.toggle("active");
        }        
        document.getElementById("story-container").style.display="none";
        document.getElementById("story-tovalidate-container").style.display="grid";
    }
    
}
function validate_story(story){
   	sessionStorage.setItem("validate_story", story.name);
    sessionStorage.setItem("is-homepage","NO");
	location.href="load_v_story.php";

}
function open_story(story){
   	sessionStorage.setItem("story", story.name);
    sessionStorage.setItem("is-homepage","NO");
	location.href="load_story.php";
}
function open_story_homepage(story){
   	sessionStorage.setItem("story", story.name);
    sessionStorage.setItem("is-homepage","YES");
	location.href="load_story.php";
}
function open_paragraph(admin){
	var data;
    let is_homepage=sessionStorage.getItem("is-homepage");
    if(is_homepage=="YES"){
        document.getElementById("go-to").textContent="TORNA ALLA HOMEPAGE";
        document.getElementById("go-to").href="homepage-logged.php";
        document.getElementById("go-to-port").textContent="TORNA ALLA HOMEPAGE";
        document.getElementById("go-to-port").href="homepage-logged.php";
    }else if(is_homepage=="NO"){
        document.getElementById("go-to").textContent="TORNA AL PROFILO";
        document.getElementById("go-to").href="profile.php";
        document.getElementById("go-to-port").textContent="TORNA AL PROFILO";
        document.getElementById("go-to-port").href="profile.php";
    }
    if(admin=="admin"){
    	let get_current_story= sessionStorage.getItem("validate_story");
        var temp=0;
    	$.ajax({
          type: 'GET',
          data: {"name": get_current_story},
          url: 'load_story_paragraph.php',
          success: function(result) {
              var jsonData = JSON.parse(result);
              var str = JSON.stringify(jsonData);
              var obj = JSON.parse(str);   
              //Title
              document.getElementById("story_name").textContent= sessionStorage.getItem("validate_story");
              document.getElementById("story_title").value= sessionStorage.getItem("validate_story");
              //Paragraph-block
              for(let i=0;i<obj.length;i++){
                  data="<div class='paragraph-block'>"
                      +"<label class='head-par-style'>Paragrafo "+(i+1)+"</label>"
                      +"<div class='text-to-image'>"
                          +"<label id='story-paragraph"+i+"' class='paragraph-style'></label>"
                          +"<div class='image-style'>"
                                  +"<img id='paragraph-image"+i+"' width='450px' height='450px'>"
                          +"</div>"
                      +"</div>"
                  +"</div>";
              document.getElementById("paragraph-container").insertAdjacentHTML("beforeend",data);
              document.getElementById("story-paragraph"+i).textContent= obj[i][0];

              //Immagine
              let background_story= new Image();
              background_story.src = obj[i][1];
              console.log("Immagine "+(i+1)+"\n--width : "+background_story.width+"\n--height : "+background_story.height);
              //Resize immagine
              var ratio;
              if(background_story.width>background_story.height){
                  ratio=background_story.height/background_story.width;
                  //Extra ratio scale
                  ratio= ratio*1.1;
                  background_story.width=400;
                  background_story.height=background_story.width*ratio;
                  document.getElementById("paragraph-image"+i).style.width =background_story.width+"px";
                  document.getElementById("paragraph-image"+i).style.height =background_story.height+"px";
              }else if(background_story.width<background_story.height){
                  ratio=background_story.width/background_story.height;
                  //Extra ratio scale
                  ratio= ratio*0.8;
                  background_story.height=450;
                  background_story.width=background_story.height*ratio;
                  document.getElementById("paragraph-image"+i).style.width =background_story.width+"px";
                  document.getElementById("paragraph-image"+i).style.height =background_story.height+"px";
              }else{
                  ratio=background_story.width/background_story.height;
                  background_story.height=350;
                  background_story.width=350;
                  document.getElementById("paragraph-image"+i).style.width ="400px";
                  document.getElementById("paragraph-image"+i).style.height ="400px";
              }
              //Caricamento immagine
              document.getElementById("paragraph-image"+i).style.backgroundImage='url('+background_story.src+')';
              }
          }
      });
    }else{
    	let get_current_story= sessionStorage.getItem("story");
    	$.ajax({
          type: 'GET',
          data: {"name": get_current_story},
          url: 'load_story_paragraph.php',
          success: function(result) {
              var jsonData = JSON.parse(result);
              var str = JSON.stringify(jsonData);
              var obj = JSON.parse(str);   
              //Title
              document.getElementById("story_name").textContent= sessionStorage.getItem("story");
              document.getElementById("edit-button").name= sessionStorage.getItem("story");
              document.getElementById("delete-button").name= sessionStorage.getItem("story");
              //Paragraph-block
              for(let i=0;i<obj.length;i++){
                  data="<div class='paragraph-block'>"
                      +"<label class='head-par-style'>Paragrafo "+(i+1)+"</label>"
                      +"<div class='text-to-image'>"
                          +"<label id='story-paragraph"+i+"' class='paragraph-style'></label>"
                          +"<div class='image-style'>"
                                  +"<img id='paragraph-image"+i+"' width='450px' height='450px'>"
                          +"</div>"
                      +"</div>"
                  +"</div>";
              	document.getElementById("paragraph-container").insertAdjacentHTML("beforeend",data);
              	document.getElementById("story-paragraph"+i).textContent= obj[i][0];

              	//Immagine
              	let background_story= new Image();
              	background_story.src = obj[i][1];
              	console.log("IMMAGINE "+(i+1)+" ha WIDTH : "+background_story.width+" e HEIGHT : "+background_story.height);
              	if(obj[i][1]!=null){
              		//Resize immagine
              		var ratio;
              		if(background_story.width>background_story.height){
                		ratio=background_story.height/background_story.width;
                        //Extra ratio scale
                        ratio= ratio*1.1;
                        background_story.width=400;
                        background_story.height=background_story.width*ratio;
                        document.getElementById("paragraph-image"+i).style.width =background_story.width+"px";
                        document.getElementById("paragraph-image"+i).style.height =background_story.height+"px";
                    }else if(background_story.width<background_story.height){
                        ratio=background_story.width/background_story.height;
                        //Extra ratio scale
                        ratio= ratio*0.8;
                        background_story.height=450;
                        background_story.width=background_story.height*ratio;
                        document.getElementById("paragraph-image"+i).style.width =background_story.width+"px";
                        document.getElementById("paragraph-image"+i).style.height =background_story.height+"px";
                    }else{
                        ratio=background_story.width/background_story.height;
                        background_story.height=350;
                        background_story.width=350;
                        document.getElementById("paragraph-image"+i).style.width ="400px";
                        document.getElementById("paragraph-image"+i).style.height ="400px";
                    }
                	//Caricamento immagine
              		document.getElementById("paragraph-image"+i).style.backgroundImage='url('+background_story.src+')';
				}else{
                	console.log("Significa che l'immagine non c'Ã¨");
                    document.getElementById("paragraph-image"+i).style.display="none";
                    document.getElementById("story-paragraph"+i).style.width="90%";
                    
                }	
			}
		}
      });
    }
    setTimeout(function(){ document.getElementById("loading-ring").style.display="none"; }, 8000);
}

function load_all_stories(){
	var is_index= sessionStorage.getItem("read-from-index");
    if(is_index=="YES"){
        document.getElementById("nav-item1").style.display="none";
        document.getElementById("nav-item2").style.display="none";
        document.getElementById("nav-item3").style.display="none";
        document.getElementById("nav-item4").style.display="none";
    	document.getElementById("index-option").style.display="block";
    }else{
        document.getElementById("nav-item1").style.display="flex";
        document.getElementById("nav-item2").style.display="flex";
        document.getElementById("nav-item3").style.display="flex";
        document.getElementById("nav-item4").style.display="flex";
    	document.getElementById("index-option").style.display="none";	    	
    }
	sessionStorage.setItem("read-from-index","NO");
	let counter=0;
	$.ajax({
            type: 'GET',
            url: 'all_stories.php',
    		success: function(userStoriesResult) {
        		var jsonData = JSON.parse(userStoriesResult);
                var str = JSON.stringify(jsonData);
				var obj = JSON.parse(str);
                for(let story in obj){
                	data="<div id='story-item"+counter+"' class='story-item' onclick='open_story_homepage(this)'><h3 id='story-name"+counter+"'></h3></div>";
                        document.getElementById("container").insertAdjacentHTML("beforeend",data);
                        document.getElementById("story-item"+counter).name= obj[counter].Titolo;  
                        document.getElementById("story-name"+counter).textContent=obj[counter].Titolo;  
                        counter++;
                }
    		}
		});

}

function show_popUp(){
	if(document.getElementById("delete-message").style.display=="none")
		document.getElementById("delete-message").style.display="flex";
    else
    	document.getElementById("delete-message").style.display="none";

}

function goto_stories(){
	sessionStorage.setItem("read-from-index","YES");
    location.href="homepage-logged.php";
}


function edit_story(current_story){
	sessionStorage.setItem("story-to-edit",current_story.name);
	location.href="edit-story.php";
}
function access_story_to_edit(){
	let story= sessionStorage.getItem("story-to-edit");
    $.ajax({
          type: 'GET',
          data: {"name": story},
          url: 'load_story_paragraph.php',
          success: function(result) {
          		var jsonData = JSON.parse(result);
              	var str = JSON.stringify(jsonData);
              	var obj = JSON.parse(str);
                for( let i=2;i<=obj.length;i++){
                	createParagraph();
                }
                document.getElementById("title_text").textContent=story;
                document.getElementById("story_title").value=story;
                for( let i=0;i<obj.length;i++){
                	document.getElementById("textArea"+(i+1)).value=obj[i][0];
                    if(	obj[i][1]!= null ){
                    	//Immagine
              			let background_story= new Image();
              			background_story.src = obj[i][1];
                    	load_edit_image(i+1, background_story);
                    }
                    document.getElementById("favcolor"+(i+1)).value=obj[i][2];
					if(obj[i][2]!="#92a8d2"){
                        let id1="checkColor";
    					let elementId1 = id1 + (i+1);
                        document.getElementById(elementId1).classList.add("checkState");
                    }
                }
          }
	});
}
function load_edit_image(num, background_story) {
    let id1="checkImage";
    let elementId1 = id1 + num;
	let data="<h3>Immagine attuale</h3><i class='fas fa-times timesDefault' onclick='remove_old_image()'; style='font-size:22px; position:relative; left:73%; bottom:14.8%; '></i>"
    		+"<img id='edit-image"+num+"' width='250px' height='250px' style=' display:flex; margin:auto; margin-top:-50px; background-position: center; background-repeat: no-repeat; background-size: cover; '>"
            +"<h5>Selezionando una nuova immagine quella attuale sarÃ  rimossa a modifica ultimata.</h5>";  
    document.getElementById("image-link"+num).innerHTML= data;
    document.getElementById("image-link"+num).style.display="block";
    document.getElementById("edit-image"+num).style.backgroundImage='url('+background_story.src+')';
	document.getElementById(elementId1).classList.add("checkState");
}

function show_button(){
	var button = document.getElementById("top-button");
    window.onscroll = function() {scrollFunction()};
    function scrollFunction() {
        if (document.body.scrollTop > 150 || document.documentElement.scrollTop > 150) {
            button.style.display = "block";
        } else {
            button.style.display = "none";
        }
    }
}
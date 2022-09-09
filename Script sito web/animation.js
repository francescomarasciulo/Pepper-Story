//Animazione da homepage a nuova storia
function animInAddStories(){
	var element1 = document.getElementById("navButton1");
    if(element1.classList=="navButton activeButton"){
    	element1.classList.remove("activeButton");
    	element1.classList.add("disableButton");
    }
}

//Animazione da nuova storia a Homepage
function animInHomepage(){
	var element1 = document.getElementById("navButton2");
    if(element1.classList=="navButton activeButton"){
    	element1.classList.remove("activeButton");
    	element1.classList.add("disableButton");
    }
}

//Animazione uscita login
function animOutLogin(){
  var element = document.getElementById("loginCard");
  if(element.classList=="mainCard animIn"){
  	  element.classList.remove("animIn");
  	  element.classList.add("animOut");
  }
  if(element.classList=="mainCard animIdle"){
  	  element.classList.remove("animIdle");
  	  element.classList.add("animOut");
  }
  	const element2 = document.querySelector('.navigation');
	element2.classList.add('animate__animated', 'animate__fadeOutUp');
	element2.addEventListener('animationend', () => {
        document.getElementById("loginCard").style.display = "none"; 
        window.open("index.php","_self");   
	});
}

//Animazione ingresso login
function animInLogin(){
  	const element2 = document.querySelector('.navigation');
	element2.classList.add('animate__animated', 'animate__fadeOutUp');
	element2.addEventListener('animationend', () => {
        window.open("login.php","_self");
	});
}
function loginAnimation(){
	var element = document.getElementById("loginCard");
    element.style.visibility = "visible";
    element.classList.add("animIn","animIdle");
    element.classList.toggle("animIdle", false);
}

//Animazione uscita registrazione
function animOutRegister(){
  var element = document.getElementById("registerCard");
  if(element.classList=="mainCard animIn"||element.classList=="mainCard animIdle"){
  	  element.classList.remove("animIn");
      element.classList.remove("animIdle");
  	  element.classList.add("animOut");
      
  }
  	const element2 = document.querySelector('.navigation');
	element2.classList.add('animate__animated', 'animate__fadeOutUp');
	element2.addEventListener('animationend', () => {
        document.getElementById("registerCard").style.display = "none"; 
        window.open("index.php","_self");   
	});
}
//Animazione ingresso registrazione
function animInRegister(){
  	const element2 = document.querySelector('.navigation');
    var element;
	element2.classList.add('animate__animated', 'animate__fadeOutUp');
	element2.addEventListener('animationend', () => {
    	sessionStorage.clickcount = 0;
        window.open("registration.php","_self");
	});
}

function registerAnimation(){
	var element = document.getElementById("registerCard");
    element.style.visibility = "visible";
    element.classList.add("animIn","animIdle");
    element.classList.toggle("animIdle", false);
    if(typeof(Storage) !== "undefined") {
    	if (sessionStorage.clickcount>0) {
            element.classList.toggle("animIn",false);
        	element.classList.toggle("animIdle", true);
    	}
    }
}

//Animazione ingresso login da registrazione
function animInLoginFromRegister(){
	var element1 = document.getElementById("registerCard");
  	if(element1.classList=="mainCard animIn"){
  		element1.classList.remove("animIn");
  		element1.classList.add("animOut");
        element1.addEventListener('animationend', () => {
        	document.getElementById("registerCard").style.display = "none";
        	window.open("login.php","_self");		
		});
  	}
}
//Animzione ingresso password dimenticata
function animInForgotPwdFromLogin(){
	var element1 = document.getElementById("loginCard");
    if(element1.classList=="mainCard animIn"){
  		element1.classList.remove("animIn");
  		element1.classList.add("animOut");
        element1.addEventListener('animationend', () => {
        	document.getElementById("loginCard").style.display = "none";
            window.open("forgot-password.php","_self");
		});
  	}
}

//Animazione uscita password dimenticata
function animOutForgotPwd(){
  var element = document.getElementById("fpasswordCard");
  if(element.classList=="mainCard animIn"){
  	  element.classList.remove("animIn");
       element.classList.add("animOut");
  }
  const element2 = document.querySelector('.navigation');
  element2.classList.add('animate__animated', 'animate__fadeOutUp');
  element2.addEventListener('animationend', () => {
        document.getElementById("fpasswordCard").style.display = "none";
        element.classList.remove("animOut");
        window.open("index.php","_self");   
	});
}



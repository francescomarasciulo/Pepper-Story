<?php

session_start();

require_once('connection.php');

//SE SEI ADMIN
if (!(isset($_SESSION["Username"]) && $_SESSION["Username"] != "")) {
	header('Refresh:1; url=https://pepper4storytelling.altervista.org/login.php');
}
else {
	if ((isset($_SESSION["Username"]) && $_SESSION["Admin"] == "SI")) { 
        
    	$mySelectStatement = $conn->prepare("SELECT * FROM `Storie Temp`");
    	$mySelectStatement->execute();
   		$storiesResult = $mySelectStatement->fetchAll(PDO::FETCH_ASSOC);
    	if (count($storiesResult) > 0) {
            //echo json_encode($storiesResult);

     	} else {
     		echo "<script type='text/javascript'>alert(\"Nessuna storia in attesa di approvazione\")</script>";           
		}
	}
	//SE NON SEI ADMIN
	else {
		//echo "Non sono admin";  
	}
}


$conn = null;
?>
<html lang="it">
    <head>
    	<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
        <link rel="stylesheet" href="navbar.css">
        <link rel="stylesheet" href="background.css"/>
        <link rel="stylesheet" href="alert-confirm.css"/>
        <link rel ="stylesheet" href="profile.css"/>
        <script src="script.js"></script>
        <script src="animation.js"></script>
        <script src="alert.js"></script>
        <title>Pepper storyteller</title>
    </head>
    <body onload = "userStories('<?php echo $_SESSION["Admin"]?>');">       
        <!--Background-->  
        <div class="parallax-profile"></div>
        <!--Background-->  
        <!--navigationBar-->   
        <div class="topPage">
            <!--navigationBar-->   
                <nav id="nav" class="navigation" style="background-color:transparent;">
                    <div class="left-nav-side">
                        <h2 id="navbar-title">pepper storyteller</h2>
                    </div>  
                    <div class="right-nav-side">
                        <a href="homepage-logged.php">HOMEPAGE</a>
                        <a href="new-story.php" >NUOVA STORIA</a>
                        <a href="profile.php" class="nav-active">PROFILO</a>
                        <a href="#" id="logoutBTN" onclick="logout()">LOGOUT</a>
                        <a id="nav-switch" href="#" onclick="enable_port_navbar();" style="border:none;"><i class="fas fa-bars nav-menu" ></i></a>
                    </div>
                </nav>
                <nav id="nav-portrait" class="navigation-portrait">
                    <div class="left-nav-side-portrait">
                        <h2>pepper storyteller</h2>
                    </div>  
                    <div class="right-nav-side-portrait">
                        <a href="homepage-logged.php">HOMEPAGE</a>
                        <a href="new-story.php" >NUOVA STORIA</a>
                        <a href="profile.php" class="nav-active">PROFILO</a>
                        <a href="#" id="logoutBTN" onclick="logout()">LOGOUT</a>
                    </div>
                </nav>
                <!--navigationBar-->
                <h1 class="head-title"> <?php echo "Benvenuto " . $_SESSION["Username"] ."!"; ?> </h1>          
              	<div class="main-container">
                	<div class="menu-container">
                        <div id="user-function" class="text-container active" onclick="switch_function(this);">
                            <h2>Le mie Storie</h2>	
                        </div>
                        <div id="admin-function" class="text-container" onclick="switch_function(this);">
                            <h2>Storie da validare</h2>	
                        </div>
                    </div>
                    <form method="post" action="load_story_paragraph.php">
                        <div id="story-container" class="grid-container">
                        	<div id="if-no-stories" style="display:none;" class="message-cont">
                                <p class="story-message">Al momento non hai nessuna storia pubblicata.</p> 
                                <a class="story-message href" href="new-story.php">Clicca qui</a>
                                <p class="story-message"> per scriverne una!</p>
                        	</div>
                        </div>
                        <div id="story-tovalidate-container" style="display:none;" class="grid-container">
                        <div id="no-story-to-validate" style="display:none;" class="message-cont"> 
                        	<p class="story-message">Al momento non ci sono storie da controllare!</p></div>
                    	</div>
                    </form>
        	</div>            
    	</div>                
    </body>
</html>

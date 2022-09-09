<?php

session_start();
require_once('connection.php');
unset($_SESSION['counter']);

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$title = $_POST['story_title'] ?? '';
    $needle= ' (Modifica)';
    if (!function_exists('str_contains')){
    	function str_contains($title, $needle){
        	header("location: homepage-logged.php"); 
    	}
    }

    $mySelectStatement = $conn->prepare("SELECT Username FROM `Storie Temp` WHERE Titolo = :title");
    $mySelectStatement->bindParam(':title', $title);
    $mySelectStatement->execute();
   	$result = $mySelectStatement->fetch(PDO::FETCH_ASSOC);
    $username = $result['Username'];
    
    $mySelectStatement = $conn->prepare("SELECT Email FROM Utenti WHERE Username = :username");
    $mySelectStatement->bindParam(':username', $username);
    $mySelectStatement->execute();
   	$result = $mySelectStatement->fetch(PDO::FETCH_ASSOC);
    $email = $result['Email'];
        
	if (isset($_POST['confirm_button'])) {
    	//CONFIRM ACTION     
		$myInsertStatement = $conn->prepare("INSERT INTO Storie (Titolo, Username) VALUES (:title, :username)");
    	$myInsertStatement->bindParam(':title', $title);
    	$myInsertStatement->bindParam(':username', $username);
    	if ($myInsertStatement->execute()) {
        	$myDeleteStatement = $conn->prepare("DELETE FROM `Storie Temp` WHERE Titolo = :title");
            $myDeleteStatement->bindParam(':title', $title);
    		if($myDeleteStatement->execute()) {          	
            //RIMOSSA DA STORIE TEMP
            //MANDARE EMAIL DI AVVENUTA PUBBLICAZIONE           	
                $str = "Ciao $username!\nLa tua storia '$title' è stata pubblicata, puoi trovarla nella sezione 'Profilo'.\nIl team Pepper4Storytelling.\n";
                $msg = utf8_decode($str);
    			//mail($email, "Storia pubblicata", "Ciao $username!\nLa tua storia '$title' è stata pubblicata, puoi trovarla nella sezione 'Profilo'.\nIl team Pepper4Storytelling.\n");
  				mail($email, "Storia pubblicata", $msg);
                //header("location: profile.php");-------------------------------SISTEMA QUI  
            } else {
            	echo "<script type='text/javascript'>alert(\"Si è verificato un errore nello spostamento della storia\")</script>";
            }
		} else {
    		echo "<script type='text/javascript'>alert(\"Si è verificato un errore nella conferma della pubblicazione\")</script>";               
		}
	} else if (isset($_POST['delete_button'])) {
		//delete action
        $myDeleteStatement = $conn->prepare("DELETE FROM `Storie Temp` WHERE Titolo = :title");
        $myDeleteStatement->bindParam(':title', $title);
    	if($myDeleteStatement->execute()) {
        	$my_Delete_Statement = $conn->prepare("DROP TABLE `$title`");
        	//$my_Delete_Statement->bindParam(':title', $title);
            if($my_Delete_Statement->execute()) {
            	$deleteReason = $_POST['message'] ?? '';
                $str = "Ciao $username!\nLa tua storia '$title' è stata rifiutata per il seguente motivo: " . "$deleteReason.\nIl team Pepper4Storytelling.\n";
				$msg = utf8_decode($str);
                mail($email, "Storia rifiutata", $msg);
                header("location: profile.php"); 
            } else {
        		echo "<script type='text/javascript'>alert(\"Si è verificato un errore nella rimozione della storia\")</script>";
        	}
        } else {
        	echo "<script type='text/javascript'>alert(\"Si è verificato un errore nella rimozione della storia\")</script>";
        }
                
	}
}

$conn = null;

?>

<!DOCTYPE html>
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
        <link rel ="stylesheet" href="load_story.css"/>
        <script src="script.js"></script>
        <script src="animation.js"></script>
    </head>
    <body onload="open_paragraph('admin')">
    <!--Background-->  
        
        <img id="full-screen-image" class="full-screen" onclick='open_fullScreen();'>
        	<!--navigationBar-->
            <div class="all">
			<!--navigationBar-->   
                <nav id="nav" class="navigation" style="background-color:#292d33; border: 0 solid #292d33; border-bottom-width:3px;">
                    <div class="left-nav-side" style="color: #F3F1E9;">
                        <h2 id="navbar-title">pepper storyteller</h2>
                    </div>  
                    <div class="right-nav-side">
  						<a id="go-to" href="profile.php" style=" font-weight:500;">TORNA AL PROFILO</a>
                        <a id="nav-switch" href="#" onclick="enable_port_navbar();" style="border:none;"><i class="fas fa-bars nav-menu" ></i></a>
                    </div>
                </nav>
                <nav id="nav-portrait" class="navigation-portrait" style="z-index:500;">
                    <div class="left-nav-side-portrait">
                        <h2 style="white-space:normal; padding:10px;">pepper storyteller</h2>
                    </div>  
                    <div class="right-nav-side-portrait">
						<a id="go-to-port" href="profile.php"  style="white-space:normal; padding:10px;">TORNA AL PROFILO</a>
                    </div>
                </nav>
                <!--navigationBar-->
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div id="paragraph-container" class="p-container">
                        <h1 id="story_name"></h1>
                        <input type="text" name="story_title" id="story_title" style="display: none;">
                    </div>
                    <div class=loader-area>
                        <div id="loading-ring" class="lds-ring"><div></div><div></div><div></div><div></div></div>
                    </div>

                    <div class="button-area">
                    	<div id="delete-message" class="del-message" style="display:none;">
                        	<i class="fas fa-times" onclick="show_popUp();"></i>
                        	<h2 class="message-title">CANCELLA STORIA</h2>
                            <p class="message-text">Motivo della rimozione</p>
                            <textarea name="message" class="message-input" placeholder="Messaggio qui..."></textarea>
                            <input type="submit" name="delete_button" value="CONFERMA">
                        </div>
                        <input type="submit" name="confirm_button" value="CONFERMA STORIA">
                        <input type="button" value="CANCELLA STORIA" onclick="show_popUp();">
                    </div>
                </form>
    		</div>
    </body>
</html>


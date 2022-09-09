<?php

session_start();

require_once('connection.php');

$title = "";
$title_err = "";

if (!(isset($_SESSION["Username"]) && $_SESSION["Username"] != "")) {
	header('Refresh:1; url=https://pepper4storytelling.altervista.org/login.php');
} else {
	// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST") {
    	$title = $_POST['title'] ?? '';
        
        $titleLenght = mb_strlen($title);
        
        $mySelectStatement = $conn->prepare("SELECT * FROM Storie WHERE Titolo = :title");
        $mySelectStatement->bindParam(':title', $title);
        $mySelectStatement->execute();
        $titleResult = $mySelectStatement->fetchAll(PDO::FETCH_ASSOC);
        if (count($titleResult) > 0) {
			$title_err = "Esiste già una storia con questo nome";
		} else if ($titleLenght < 6 || $titleLenght > 40) {
        	if ($titleLenght < 6) $title_err = "La lunghezza minima del titolo è di 6 caratteri";
        	else if ($titleLenght > 40) $title_err = "La lunghezza massima del titolo è di 40 caratteri";
        }
        else {
        	$myCreateStatement = "CREATE TABLE `$title` (
								 id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
								 Testo VARCHAR(1000) NOT NULL,
								 Immagine LONGBLOB NULL,
								 nome VARCHAR(255) NULL,
								 tipo VARCHAR(255) NULL,
                                 Colore VARCHAR(7) NULL
								 )";
            if(!$conn->exec($myCreateStatement)) {
            	$counter = 0;
    			foreach ($_POST['paragraph'] as $textArea) {
                
    				// Verifico eventuali problemi nell'upload del file
                    if (!isset($_FILES["images"]) || $_FILES["images"]["error"][$counter] != UPLOAD_ERR_OK) 
                    	console.log( "Errore nell'invio del file. Riprova!");
        			// Recupero delle informazioni sul file inviato
					$nome_file_temporaneo = $_FILES["images"]["tmp_name"][$counter];
					$nome_file_vero = $_FILES["images"]["name"][$counter];
					$tipo_file = $_FILES["images"]["type"][$counter];    
    
    				// Leggo il contenuto del file
					$dati_file = file_get_contents($nome_file_temporaneo);

					// Preparo il contenuto del file per la query sql
					//$dati_file = addslashes($dati_file);
                    
                    //PROVA INVIO COLORE
                    $color = $_POST["colors"][$counter];
             
					$my_Insert_Statement = $conn->prepare("INSERT INTO `$title` (Testo, Immagine, nome, tipo, Colore) VALUES (:paragraph, :dati_file, :nome_file_vero, :tipo_file, :color)");
                    $my_Insert_Statement->bindParam(':paragraph', $textArea);
                    $my_Insert_Statement->bindParam(':dati_file', $dati_file);
    				$my_Insert_Statement->bindParam(':nome_file_vero', $nome_file_vero);
    				$my_Insert_Statement->bindParam(':tipo_file', $tipo_file);
                    $my_Insert_Statement->bindParam(':color', $color);
    				if ($my_Insert_Statement->execute()) {
        				console.log("Paragrafo pubblicato correttamente.");
					} else {
  						console.log("Errore nella pubblicazione del paragrafo");
					}
        			$counter++;
				}
                
                $my_Insert_Statement = $conn->prepare("INSERT INTO `Storie Temp` (Titolo, Username) VALUES (:title, :username)");
            	$my_Insert_Statement->bindParam(':title', $title);
                $my_Insert_Statement->bindParam(':username', $_SESSION["Username"]);
            	if ($my_Insert_Statement->execute()) {
                	//INVIARE EMAIL PUBBLICAZIONE STORIA?
                    //OPPURE EMAIL/MESSAGGIO CHE L'ADMIN LA DEVE APPROVARE?
                    //DOVE REINDIRIZZARE L'UTENTE?
                 
					echo "<script type='text/javascript'>alert(\"La tua storia è stata inviata correttamente. Riceverai una comunicazione via email quando sarà pubblicata\")</script>";
                } else {
                    //DROP TABLE TABELLA NOMESTORIA CHE SI E' CREATA UGUALMENTE            
					echo "<script type='text/javascript'>alert(\"Si è verificato un errore nella pubblicazione della storia\")</script>";    
                }
            } else {
				echo "<script type='text/javascript'>alert(\"Si è verificato un errore nella creazione della tabella\")</script>";
            }
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="background.css">
        <link rel="stylesheet" href="navbar.css">
        <link rel="stylesheet" href="new-story.css">   
        <link rel="stylesheet" href="alert-story.css">
        <script src="script.js"></script>
        <script src="animation.js"></script>
        <script src="create-paragraph.js"></script>
        <script src="alert.js"></script>
        <title>Pepper storyteller</title>
    </head>
    <body onload="showAlertStory();">
		<!--navigationBar-->   
        <div class="topPage">
            <!--navigationBar-->   
            <nav id="nav" class="navigation">
            	<div class="left-nav-side">
                	<h2 id="navbar-title">pepper storyteller</h2>
                </div>  
                <div class="right-nav-side">
                	<a href="homepage-logged.php">HOMEPAGE</a>
                    <a href="new-story.php" class="nav-active">NUOVA STORIA</a>
                    <a href="profile.php">PROFILO</a>
                    <a href="#" id="logoutBTN" onclick="logout()">LOGOUT</a>
                    <a id="nav-switch" href="#" onclick="enable_port_navbar();" style="border:none;"><i class="fas fa-bars nav-menu" ></i></a>
                </div>
            </nav>
            <nav id="nav-portrait" class="navigation-portrait">
                <div class="left-nav-side-portrait">
                	<h2>pepper storyteller</h2>
                </div>  
                <div class="right-nav-side-portrait">
                	<a href="homepage-logged.php" >HOMEPAGE</a>
                    <a href="new-story.php" class="nav-active">NUOVA STORIA</a>
                    <a href="profile.php">PROFILO</a>
                    <a href="#" id="logoutBTN" onclick="logout()">LOGOUT</a>
                </div>
            </nav>
        </div>
            <!--navigationBar-->       
            <!--Background-->  
            <div class="parallax-short"></div>
            <!--Background-->  
    </body>
</html>
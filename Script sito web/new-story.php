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
                    $username = $_SESSION["Username"];
                    
                    $mySelectStatement = $conn->prepare("SELECT Email FROM Utenti WHERE Username = :username");
        			$mySelectStatement->bindParam(':username', $username);
    				$mySelectStatement->execute();
   					$result = $mySelectStatement->fetch(PDO::FETCH_ASSOC);
            		$email = $result['Email'];
                    
                    //NON FUNZIONA SU GMAIL DAL CELL:
                    $str = "Ciao $username!\nGrazie per il tuo contributo, un amministratore eseguirà un controllo sul materiale inviato per accertarsi che la storia sia coerente e soprattutto priva di contenuti inappropriati. Riceverai una comunicazione quando la storia sarà controllata.\nIl team Pepper4Storytelling.\n";
                    //$strconv = htmlentities($str);
                    $msg = utf8_decode($str);
                    //mail($email, "Attesa pubblicazione", "Ciao $username!\nGrazie per il tuo contributo, un amministratore eseguirà un controllo sul materiale inviato per accertarsi che la storia sia coerente e soprattutto priva di contenuti inappropriati. Riceverai una comunicazione quando la storia sarà controllata.\nIl team Pepper4Storytelling.\n");
                 	mail($email, "Attesa pubblicazione", $msg);
                    header("location: new-story-confirm.php");
					//echo "<script type='text/javascript'>alert(\"La tua storia è stata inviata correttamente. Riceverai una comunicazione via email quando sarà pubblicata\")</script>";
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
unset($_SESSION['counter']);
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
        <link rel="stylesheet" href="alert-confirm.css">
        <script src="script.js"></script>
        <script src="animation.js"></script>
        <script src="create-paragraph.js"></script>
        <script src="alert.js"></script>
        <title>Pepper storyteller</title>
    </head>
    <body>
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
            <!--navigationBar-->       
            <div class="main-page">
            <form id="formData" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"> 
                <div class="top-banner">
              	    <h2>Scrivi la tua storia</h2>
                    <div class="top-banner-left-side">
                        <input id="title-text" onchange="enableButton()" type="text" name="title" placeholder="Titolo..." class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $title; ?>" required>
                        <i class="fas fa-book"></i>
                        <span class="invalid-feedback"><?php echo $title_err; ?></span>
                    </div>
                    <div class="top-banner-right-side">
                  	    <input id="upload-story" type="submit" class="disabled" value="INVIA STORIA">
                    </div>
                </div><!-- Chiudo top-banner-->
                <div class="two-column-layout">
                    <div id="container" class="paragraph-card">
                        <div id="paragraph1" class="paragraph">
                            <div class="top-paragraph-card">
                                <div class="top-paragraph-card-left">
                                    <h3>Paragrafo 1</h3>
                                    <i id="par1" onclick="openParagraph(this,1)" class="fas fa-chevron-down"> </i>
                                </div>
                            <div class="top-paragraph-card-right">
                                <i id="imageP1" onclick="checkAttachment(this,1)" name="imageIcon" class="fas fa-image">
                                <i id="checkImage1" class="fas fa-check default"></i></i>
                                <i id="colorP1" onclick="checkAttachment(this,1)" class="fas fa-palette">
                                <i id="checkColor1" class="fas fa-check default"></i></i>
                                <label id="pepperP1" onclick="openPepper(1)" class="pepper-text">pepper
                                <i id="checkPepper1" class="fas fa-check default"></i></label>
                            </div>
                        </div>
                        <textarea id='textArea1' onchange="enableButton()" name='paragraph[]' class="form-control" onfocus="openParagraph(this,1)" placeholder='Testo qui...' required="required"></textarea>
                        <div id="imageSelector1" class="itemSel">
                            <h3>Allega immagine al paragrafo</h3>
                            <div class="item-container">
                                <div class='fix-close-pos'>
                                    <input id='button1' name='images[]' class='uploadBox' type='file' onchange='getFileData(this,1)'>
                                    <i id='remove-image1' class='fas fa-times timesDefault' onclick='removeInput(this,1)'></i>
                                </div>
                            </div>
                            <input type="button" id='close1' class='buttonClose' value="Chiudi" onclick="closeAttachment(1)">
                        </div><!--Chiude Selettore immagine-->
                        <div id="colorSelector1" class="itemSel">
                            <h3>Scegli un colore per il paragrafo</h3>
                            <div class="item-container">
                                <div id="colorDiv1" class="favColor" onclick="disableHint(1)">
                                    <div class="fix-close-pos">
                                        <input type="color" id="favcolor1" class="customColor" name="colors[]" value='#92A8D2' onchange='getColorData(this,1)'>
                                        <i id="remove-color1" class="fas fa-times timesDefaultColor" onclick="removeInput(this,1)"></i>
                                    </div>
                                </div>                      
                            </div>
                            <input type="button" id='close1' class='buttonClose' value="Chiudi" onclick="closeAttachment(1)">
                            <div class="span-area">
                                <span id="clickHint1">Clicca nell'area</span>
                                <span id="feedbackHint1" style="display:none;">Colore salvato!</span>
                                <span id="deleteColor1" style="display:none;">Colore rimosso!</span>
                            </div>                     
                        </div><!--Chiude selettore colore-->
                        <div id="pepperSelector1" class="itemSel">
                            <h3 class="imageHeader">Reazioni per Pepper</h3>
                            <div id="animMain1" class="animMain">
                                <div id="animTop1" class="animTop">
                                    <i id="Apaw1" class="fas fa-paw" onclick="changeAnim(this,1)"></i>
                                    <i id="Asmile1" class="fas fa-smile" onclick="changeAnim(this,1)"></i>
                                    <i id="Ameh1" class="fas fa-meh" onclick="changeAnim(this,1)"></i>
                                    <i id="Afrown1" class="fas fa-frown-open" onclick="changeAnim(this,1)"></i>
                                    <i id="Aangry1" class="fas fa-angry" onclick="changeAnim(this,1)"></i> 
                                </div>                               
                                <div id="anim1Content1" class="animContent">
                                    <!--Animali-->
                                    <label id="anim1animal1" onclick="animSelected(this,1)">Elefante</label>
                                    <label id="anim2animal1" onclick="animSelected(this,1)">Gorilla</label>
                                    <label id="anim3animal1" onclick="animSelected(this,1)">Topo</label>
                                    <label id="anim4animal1" onclick="animSelected(this,1)">Lupo</label>
                                </div>
                                <div id="anim2Content1" class="animContent">
                                    <!--Smile-->
                                    <label id="anim1smile1" onclick="animSelected(this,1)">Nonno d'avanti al cantiere</label>
                                    <label id="anim2smile1" onclick="animSelected(this,1)">Ballo contento</label>
                                    <label id="anim3smile1" onclick="animSelected(this,1)">Curioso</label>
                                    <label id="anim4smile1" onclick="animSelected(this,1)">Batte le mani</label>
                                    <label id="anim5smile1" onclick="animSelected(this,1)">Camminata</label>
                                    <label id="anim6smile1" onclick="animSelected(this,1)">Manda i baci</label>
                                    <label id="anim7smile1" onclick="animSelected(this,1)">Lapo Elkann</label>
                                    <label id="anim8smile1" onclick="animSelected(this,1)">Giudice</label>
                                </div>
                                <div id="anim3Content1" class="animContent">
                                    <!--Meh-->
                                    <label id="anim1meh1" onclick="animSelected(this,1)">Sbadiglio</label>
                                    <label id="anim2meh1" onclick="animSelected(this,1)">Confuso (Goku)</label>
                                    <label id="anim3meh1" onclick="animSelected(this,1)">Si gratta la testa col braccio lontano</label>
                                    <label id="anim4meh1" onclick="animSelected(this,1)">No con la testa</label>
                                </div>
                                <div id="anim4Content1" class="animContent">                                    
                                    <!--Sad-->
                                    <label id="anim1sad1" onclick="animSelected(this,1)">Disorientato</label>
                                    <label id="anim2sad1" onclick="animSelected(this,1)">Sconsolato/Triste</label>
                                    <label id="anim3sad1" onclick="animSelected(this,1)">Spaventato</label>
                                    <label id="anim4sad1" onclick="animSelected(this,1)">Paura (Si copre gli occhi)</label>
                                    <label id="anim5sad1" onclick="animSelected(this,1)">Alza le mani (paura)</label>
                                </div>
                                <div id="anim5Content1" class="animContent">                                    
                                    <!--Angry-->
                                    <label id="anim1angry1" onclick="animSelected(this,1)">Mr burns che si mangia un panino alla fine</label>
                                    <label id="anim2angry1" onclick="animSelected(this,1)">Sbatte pugni sul tavolo</label>
                                    <label id="anim3angry1" onclick="animSelected(this,1)">Arrabbiato</label>            
                                </div>
                            </div>
                            <div class="chosenAnimStyle">
                                <div class="inlinegoddammit">
                                    <h5 style="white-space: nowrap;">Animazione scelta  :&nbsp&nbsp</h5>
                                    <h5 id="chosenAnim1" name='animations[]'></h5>
                                </div>
                                <i id="remove-pepper1" class="fas fa-times timesPepper" onclick="removeInput(this,1)"></i>
                            </div>
                            <input type="button" id='close1' class='buttonClose' value="Chiudi" onclick="closeAttachment(1)">
                        </div>
                    </div>
                    <div id="moral-container" class="paragraph-card fix" style="display:none;">
                	    
                    </div>
                    <div id="help-panel" class="right-column">
                	    <h3 id="help-text1" class="help-panel-text">PARAGRAFO</h3>
                        <div id="btn-container1" class="button-container">
                  		    <input id="paragraph-button1" type="button" title="Aggiungi paragrafo" onclick="createParagraph()" value="+">
                  		    <input id="paragraph-button2" type="button" title="Rimuovi paragrafo" onclick="deleteParagraph()" value="-">
					    </div>
                        <h3 id="help-text2" class="help-panel-text">MORALE</h3>
                        <div id="btn-container2" class="button-container">
                  		    <input id="moral-button1" type="button" onclick="toggle_moral(this)" value="+">
                  		    <input id="moral-button2" type="button" onclick="toggle_moral(this)" value="-">
					    </div>
                        <h3 id="help-text3" class="navigator-text">Riepilogo</h3>
                        <div id="paragraph-navigator" class="par-navigator">
                  	        <a href="#paragraph1">Paragrafo 1</a>
                        </div>
                        <i id="toggle-icon" class="fas fa-chevron-right" onclick="closePane()"></i>
                    </div>
                </div>    
            </form>
        </div>       
        <!--mainCard-->
    </body>
</html>
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
        <link rel ="stylesheet" href="index.css"/>
        <script src="script.js"></script>
        <script src="animation.js"></script>
        <script src="alert.js"></script>
        <title>Pepper storyteller</title>
    </head>
    <body onload="show_button();">       
        <!--Background-->  
        <div class="parallax-homepage"></div>
        <!--Background-->  
        <!--navigationBar-->
        <a href="#nav" >
          <div id="top-button" class="back-to-top" style="display:none;">
              <i class="fas fa-arrow-circle-up"></i>
          </div>
        </a>
        <div class="topPage">
            <div class="overlayEffect">
            <!--navigationBar-->   
                <nav id="nav" class="navigation" style="background-color:transparent;">
                    <div class="left-nav-side">
                        <h2 id="navbar-title" style="color:transparent;">pepper storyteller</h2>
                    </div>  
                    <div class="right-nav-side">
                        <a href="login.php">ACCEDI</a>
                        <a href="registration.php">REGISTRATI</a>
                        <a id="nav-switch" href="#" onclick="enable_port_navbar();" style="border:none;"><i class="fas fa-bars nav-menu" ></i></a>
                    </div>
                </nav>
                <nav id="nav-portrait" class="navigation-portrait">
                    <div class="left-nav-side-portrait">
                        <h2>pepper storyteller</h2>
                    </div>  
                    <div class="right-nav-side-portrait">
                        <a href="login.php">ACCEDI</a>
                        <a href="registration.php">REGISTRATI</a>
                    </div>
                </nav>
                <!--navigationBar-->
                <h1>Benvenuto in Pepper Storyteller</h1>
                <h5>Scopri come accedere ai servizi offerti dal nostro sito.</h5>
                <button class="main-button"><a href="#introduction">INIZIAMO</a></button>
            </div>
        </div>
        <div class="centerPage">
            <div id="introduction" class="writeStory">
            <h2>COS'È PEPPER STORYTELLER?</h2>
                <div class="two-pane-choose">
                    <div class="left-choose-side">
                        <h4>Il sito</h4>
                        <p>Permette agli utenti di pubblicare le proprie storie ed eventualmente leggere quelle già presenti nell'archivio.
                        <br><br><a href="#create-story">Prosegui&nbsp<i class="fas fa-sign-in-alt"></i></a></p>
                    </div>
                    <div class="right-choose-side">
                    	<h4>L'applicazione</h4>
                        <p>Installata direttamente sul robot, permette di sfogliare e scegliere la storia da far raccontare a Pepper.
                    	<br><br><a href="#id-contact-us">Prosegui&nbsp<i class="fas fa-sign-in-alt"></i></a></p>
                    </div>
                </div>
            </div>
            <div id="create-story" class="writeStory">
                <h2>SCRIVI UNA STORIA!</h2>
                <div class="two-pane-text">
                    <div class="left-text-side">
                        <p><b>Nel sito</b> è presente un editor che vi permetterà di scrivere storie interattive da far raccontare a Pepper.
                            <br><br><b>Le storie</b> sono suddivise per paragrafi ed ogni paragrafo potrà avere come allegati una foto o un colore e un'animazione.
                        </p>
                    </div>
                    <div class="right-text-side">
                        <p><b>Gli allegati</b> hanno come obiettivo fornire un feedback visivo, rendendo le storie più immersive!
                        <br><br><b>La foto</b> o <b>il colore</b> saranno visualizzati sul tablet, mentre <strong>l'animazione</strong>, verrà eserguita da Pepper.
                            <br><br><br>L'accesso all'editor richiede una veloce
                            <a href="registration.php"> registrazione.&nbsp<i class="fas fa-sign-in-alt"></i></a>
                        </p>
                    </div>
                </div>
                <div class="card-footer">
                	<h3>OPPURE</h3>	
                	<button class="story-button" onclick="goto_stories();">Leggi le storie pubblicate&nbsp&nbsp<i class="fas fa-book-open"></i></button>
            	</div>
            </div>
			<div id="id-contact-us" class="writeStory">
				<h2>RICHIEDI PEPPER PER IL TUO ISTITUTO</h2>
				<div class="contact-us">
					<h3>Compila il form</h3>
                      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                      	<div class="form-box">    
                        	<input type="text" name="email" placeholder="Email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>" required="required" autocomplete="email">
                          	<span class="invalid-feedback"><?php echo $email_err; ?></span>
                          	<textarea name="message" placeholder="Messaggio qui..." class="form-control" required="required"> </textarea>
                            <input type="submit" class="button" value="INVIA MESSAGGIO">
						</div>
                      </form>
				</div>
			</div>
		</div>
	</body>
</html>
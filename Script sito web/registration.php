<?php

require_once('connection.php');

$email = $username = $password = $confirm_password = "";
$email_err = $username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['password-repeat'] ?? '';
    $admin = "NO";
    
    $isUsernameValid = filter_var(
        $username,
        FILTER_VALIDATE_REGEXP, [
            "options" => [
                "regexp" => "/^[a-z\d_]{6,20}$/i"
            ]
        ]
    );
    $emailLenght = mb_strlen($email);
    $usernameLenght = mb_strlen($username);
    $passwordLenght = mb_strlen($password);
        
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $emailLenght > 50) {
    	if ($emailLenght > 50) $email_err = "La lunghezza massima dell'email è di 50 caratteri";
		else $email_err = "'$email' non è un indirizzo email valido";              
    } else if (false === $isUsernameValid) {
    	if ($usernameLenght < 6) $username_err = "La lunghezza minima dell'username è di 6 caratteri";
        else if ($usernameLenght > 30) $username_err = "La lunghezza massima dell'username è di 30 caratteri";
        else $username_err = "L'username scelto non è valido. Sono ammessi solamente caratteri alfanumerici e l'underscore";
    } else if ($passwordLenght < 6 || $passwordLenght > 20) {
    	if ($passwordLenght < 6) $password_err = "La lunghezza minima della password è di 6 caratteri";
        else if ($passwordLenght > 20) $password_err = "La lunghezza massima della password è di 20 caratteri";
    } else if ($password != $confirmPassword) {
    	$confirm_password_err = "Le password inserite non corrispondono";
    } else {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        
        $mySelectStatement = $conn->prepare("SELECT * FROM Utenti WHERE Username = :username");
        $mySelectStatement->bindParam(':username', $username);
        $mySelectStatement->execute();
        $usernameResult = $mySelectStatement->fetchAll(PDO::FETCH_ASSOC);
        
        $mySelectStatement1 = $conn->prepare("SELECT * FROM Utenti WHERE Email = :email");
        $mySelectStatement1->bindParam(':email', $email);
        $mySelectStatement1->execute();
        $emailResult = $mySelectStatement1->fetchAll(PDO::FETCH_ASSOC);
        
        if (count($usernameResult) > 0) {
			$username_err = "Username già utilizzato, per favore scegli un altro username";
		} else if (count($emailResult) > 0) {
        	$email_err = "Email già utilizzata, per favore scegli un'altra email";
        } else {
        	$token = bin2hex(random_bytes(16));
        	$my_Insert_Statement = $conn->prepare("INSERT INTO Utenti (Username, Password, Email, Token, Admin) VALUES (:username, :password_hash, :email, :token, :admin)");
            $my_Insert_Statement->bindParam(':username', $username);
		    $my_Insert_Statement->bindParam(':password_hash', $password_hash);
			$my_Insert_Statement->bindParam(':email', $email);
            $my_Insert_Statement->bindParam(':token', $token);
            $my_Insert_Statement->bindParam(':admin', $admin);
            if ($my_Insert_Statement->execute()) {
            	mail($email, "Benvenuto", "Benvenuto $username!\n Grazie per esserti registrato in Pepper4Storytelling, ora puoi inserire le tue storie e vedere quelle che hai pubblicato nella sezione 'Profilo'.\n Il team Pepper4Storytelling.\n");
  				header("location: registration-access.php"); 
			} else {
            	echo "<script type='text/javascript'>alert(\"Si è verificato un errore nella registrazione\")</script>";               
			}
		} 
    }
}
    $conn = null;
?>


<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="registration.css">
        <link rel="stylesheet" href="background.css"/>
        <link rel="stylesheet" href="navbar.css"/>
		<script src="animation.js"></script>
        <script src="script.js"></script>
        <title>Pepper storyteller</title>
    </head>
	<body onload="registerAnimation()">
        <!--Background--> 
        <div class="parallax-short"></div>
        <!--Background-->
         <div class="all">
			<!--navigationBar-->   
            <nav id="nav" class="navigation" style="background-color:transparent;">
            	<div class="left-nav-side">
                	<h2 id="navbar-title">pepper storyteller</h2>
                </div>  
                <div class="right-nav-side">
  					<a href="#" onclick="animOutRegister()">TORNA ALLA HOMEPAGE</a>
                    <a id="nav-switch" href="#" onclick="enable_port_navbar();" style="border:none;"><i class="fas fa-bars nav-menu" ></i></a>
                </div>
            </nav>
            <nav id="nav-portrait" class="navigation-portrait" style="z-index:500;">
            	<div class="left-nav-side-portrait">
            		<h2 style="white-space:normal; padding:10px;">pepper storyteller</h2>
            	</div>  
                <div class="right-nav-side-portrait">
					<a href="#" onclick="animOutRegister()" style="white-space:normal; padding:10px;">TORNA ALLA HOMEPAGE</a>
                </div>
            </nav>
            <!--navigationBar-->
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<div id="registerCard" class="mainCard">
            	<div class="topContainer">
                	<i style="visibility:hidden;" class="fas fa-times closebtn"></i>
                	<h2 class="cardTitle">Registrazione</h2>
                    <i style="visibility:hidden;" class="fas fa-times closebtn"></i>
				</div>
  				<div class="container">
                    <div class="form-group">
                    	<i class="fas fa-paper-plane"></i>
                        <input type="text" name="email" placeholder="Email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>" required="required" autocomplete="email">
                        <span class="invalid-feedback"><?php echo $email_err; ?></span>
                    </div>  

                    <div class="form-group">
                    	<i class="fas fa-user"></i>
                        <input type="text" name="username" placeholder="Username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" required="required" autocomplete="name">
                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                    </div> 
					<div class="password-row">
                    <div class="form-group">
                      	<i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" required="required" autocomplete="password">
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group">
                      	<i class="fas fa-lock"></i>
                        <input type="password" name="password-repeat" placeholder=" Conferma Password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>" required="required" autocomplete="password">
                        <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                    </div>
                    </div>  
                    <input type="submit" class="button" value="Registrati">
                </div>
			</div>
		</form>
        </div>
        <div class="registration-footer">
           	<label>Hai gia' un account? &nbsp</label>
           	<a onclick="animInLoginFromRegister()" href="login.php">Accedi</a>
        </div>
	</body>
</html>
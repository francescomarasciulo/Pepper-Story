<?php

session_start();

require_once('connection.php');

$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';   
        
    $mySelectStatement = $conn->prepare("SELECT * FROM Utenti WHERE Username = :username");
    $mySelectStatement->bindParam(':username', $username);
    $mySelectStatement->execute();
    $usernameResult = $mySelectStatement->fetchAll(PDO::FETCH_ASSOC);
        
    if (count($usernameResult) > 0) {
		$mySelectStatement = $conn->prepare("SELECT Password FROM Utenti WHERE Username = :username");
    	$mySelectStatement->bindParam(':username', $username);
        $mySelectStatement->execute();
        $password_hash = $mySelectStatement->fetch(PDO::FETCH_OBJ);
        if (password_verify($password, $password_hash->Password)) {
        	$mySelectStatement = $conn->prepare("SELECT Admin FROM Utenti WHERE Username = :username");
    		$mySelectStatement->bindParam(':username', $username);
        	$mySelectStatement->execute();
        	//$adminResult = $mySelectStatement->fetchAll(PDO::FETCH_ASSOC);
            $adminResult = $mySelectStatement->fetch(PDO::FETCH_ASSOC);
            $result = $adminResult['Admin'];
            //$result= print_r($adminResult);
            //strcmp($adminResult['Admin'], [string]);
            
        	$_SESSION["Username"] = $username;
            $_SESSION["Admin"] = $result;
            header("location: login-access.php"); 
        } else {
        	$password_err = "Pasword errata";
    	}
     } else {
		$username_err = "Username errato";                 
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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="navbar.css">
        <link rel="stylesheet" href="login.css">
        <link rel="stylesheet" href="alert-success.css"/>
        <link rel="stylesheet" href="background.css"/>
        <script src="animation.js"></script>
        <script src="script.js"></script>
        <title>Pepper storyteller</title>
    </head>
    <body onload="loginAnimation()">
    	<!--Background-->  
        <div class="parallax-short"></div>
        	<!--navigationBar-->
            <div class="all">
			<!--navigationBar-->   
                <nav id="nav" class="navigation" style="background-color:transparent;">
                    <div class="left-nav-side">
                        <h2 id="navbar-title">pepper storyteller</h2>
                    </div>  
                    <div class="right-nav-side">
  						<a href="#" onclick="animOutLogin()">TORNA ALLA HOMEPAGE</a>
                        <a id="nav-switch" href="#" onclick="enable_port_navbar();" style="border:none;"><i class="fas fa-bars nav-menu" ></i></a>
                    </div>
                </nav>
                <nav id="nav-portrait" class="navigation-portrait" style="z-index:500;">
                    <div class="left-nav-side-portrait">
                        <h2 style="white-space:normal; padding:10px;">pepper storyteller</h2>
                    </div>  
                    <div class="right-nav-side-portrait">
						<a href="#" onclick="animOutLogin()" style="white-space:normal; padding:10px;">TORNA ALLA HOMEPAGE</a>
                    </div>
                </nav>
                <!--navigationBar-->
           <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
              <div id="loginCard" class="mainCard">
                  <div class="topContainer">
                      <i style="visibility:hidden;" class="fas fa-times closebtn"></i>
                      <label class="cardTitle">Login</label>
                      <i style="visibility:hidden;" onclick="animOutLogin()" class="fas fa-times closebtn"></i>
                  </div>
                  <div class="container">
                      <div class="form-group">
                          <i class="fas fa-user"></i>
                          <input type="text" name="username" placeholder="Username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" required="required" autocomplete="name">
                          <span class="invalid-feedback"><?php echo $username_err; ?></span>
                      </div>
                      <div class="form-group">
                          <i class="fas fa-lock"></i>
                          <input type="password" name="password" placeholder="Password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" required="required"autocomplete="password">
                          <span class="invalid-feedback"><?php echo $password_err; ?></span>
                      </div>
                      <input type="submit" class="button" value="Accedi"/>
                  </div>
              </div>
          </form>
       </div>
                         <div class="login-footer">
                      <label>Hai dimenticato la password? &nbsp</label>
                      <a onclick="animInForgotPwdFromLogin()" href="#">Clicca qui</a>
                  </div>
    </body>
</html>
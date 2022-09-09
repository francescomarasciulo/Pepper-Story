<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="registration.css">
        <link rel="stylesheet" href="background.css"/>
        <link rel="stylesheet" href="navbar.css"/>
        <link rel="stylesheet" href="alert-success.css"/>
		<script src="animation.js"></script>
        <script src="alert.js"></script>
        <title>Pepper storyteller</title>
    </head>
	<body onload="showAlertRegistration()">
        <!--Background--> 
        <div class="parallax-short"></div>
        <!--Background-->
		<!--navigationBar-->   
		<nav id="nav" class="navigation" style="background-color:transparent;">
    		<div class="left-nav-side">
        		<h2 class="title">pepper storyteller</h2>
        	</div>  
        	<div class="right-nav-side">
               	<a href="#" onclick="animOutLogin()">TORNA ALLA HOMEPAGE</a>
                <a href="#"><i class="fas fa-bars nav-menu"></i></a>
        	</div>
      	</nav>
        <!--navigationBar-->
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<div id="registerCard" class="mainCard">
            	<div class="topContainer">
                	<i style="color:whitesmoke;" class="fas fa-times closebtn"></i>
                	<h2 class="cardTitle">Registrazione</h2>
                    <i onclick="animOutRegister()" class="fas fa-times closebtn"></i>
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
					<div style="display:flex; flex-direction:row; justify-content:space-between;">
                      <div class="form-group" style="width:45%;">
                      	<i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" required="required" autocomplete="password">
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                      </div>

                      <div class="form-group" style="width:45%;">
                      	<i class="fas fa-lock"></i>
                        <input type="password" name="password-repeat" placeholder=" Conferma Password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>" required="required" autocomplete="password">
                        <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                      </div>
                    </div>  
                    <input type="submit" class="button" value="Registrati">
                </div>
                <div class="registrationFooter">
                	<label>Hai gia' un account? &nbsp</label>
                	<a onclick="animInLoginFromRegister()" href="login.php">Accedi</a>
                </div>
			</div>
		</form>
	</body>
</html>
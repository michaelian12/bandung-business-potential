<?php
	session_start();
	if (($_SESSION['alreadyLogged'] == true) && ($_SESSION['ktp_user'] != "")) {
		header("Location: index.php");
	} else {
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <title>Bandung Business Potential - Login</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
	  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700" rel="stylesheet" type="text/css">
	  <link href="css/font-awesome.min.css" rel="stylesheet">
	  <link href="css/bootstrap.min.css" rel="stylesheet">
	  <link href="css/templatemo-style.css" rel="stylesheet">

	  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	  <!--[if lt IE 9]>
	    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	  <![endif]-->

		<link rel="shortcut icon" href="images/logo-bdg.png">
	</head>
	<body class="light-gray-bg">
		<div class="templatemo-content-widget templatemo-login-widget white-bg">
			<header class="templatemo-top-nav">
        <div class="square" style="margin-left:90px;">
          <h1 style="margin-left:42px;">Bandung Business Potential</h1>
        </div>
      </header>
	    <form action="libs/login.php" method="post" class="templatemo-login-form">
	    	<div class="form-group">
	    		<div class="input-group">
		    		<div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>
		        <input type="text" class="form-control" name="noKtp" placeholder="Identity Card Number">
		      </div>
	    	</div>
	    	<div class="form-group">
	    		<div class="input-group">
		    		<div class="input-group-addon"><i class="fa fa-key fa-fw"></i></div>
		      	<input type="password" class="form-control" name="password" placeholder="******">
		    	</div>
	    	</div>
				<p style="float: right;"><strong><a href="#" class="blue-text">Forgot password?</a></strong></p>
				<div class="form-group">
					<button type="submit" class="templatemo-blue-button width-100">Login</button>
				</div>
	    </form>
		</div>
		<div class="templatemo-content-widget templatemo-login-widget templatemo-register-widget white-bg">
			<p>Not a registered user yet? <strong><a href="signup.php" class="blue-text">Sign up now!</a></strong></p>
		</div>
	</body>
</html>
<?php } ?>

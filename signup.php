<?php
	error_reporting(0);
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
	  <title>Bandung Business Potential - Sign Up</title>
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
	    <form action="libs/signup.php" class="templatemo-login-form" method="post" enctype="multipart/form-data">
				<div class="form-group">
	    		<div class="input-group">
		    		<div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>
		      	<input type="text" class="form-control" name="nama" placeholder="Full Name" required="true">
		    	</div>
	    	</div>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon"><i class="fa fa-server fa-fw"></i></div>
						<input type="text" class="form-control" name="ktp" placeholder="Identity Card Number" required="true">
					</div>
				</div>
				<div class="form-group">
	    		<div class="input-group">
		    		<div class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></div>
		        <input type="email" class="form-control" name="email" placeholder="Email" required="true">
		      </div>
	    	</div>
				<div class="form-group">
	    		<div class="input-group">
		    		<div class="input-group-addon"><i class="fa fa-key fa-fw"></i></div>
		      	<input type="password" class="form-control" name="password" placeholder="******" required="true">
		    	</div>
	    	</div>
				<div class="form-group">
	    		<div class="input-group">
		    		<div class="input-group-addon"><i class="fa fa-home fa-fw"></i></div>
		        <input type="text" class="form-control" name="alamat" placeholder="Address" required="true">
		      </div>
	    	</div>
				<div class="form-group">
	    		<div class="input-group">
		    		<div class="input-group-addon"><i class="fa fa-map-marker fa-fw" style="color: #4d4d4d;"></i></div>
		        <input type="text" class="form-control" name="tempatLahir" placeholder="Birth Place" required="true">
		      </div>
	    	</div>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></div>
		        <input type="date" class="form-control" name="tglLahir" required="true">
		      </div>
	    	</div>
				<div class="form-group">
					<label class="control-label templatemo-block">Identity Card File Image</label>
					<input id="gambarKtp" type="file" class="filestyle" name="gambarKtp" data-buttonName="btn-primary" data-buttonBefore="true" data-icon="false" required="true">
					<p>Maximum upload size is 2 MB.</p>
				</div>
				<div class="form-group">
					<button type="submit" class="templatemo-blue-button width-100">Sign Up</button><br><br>
					<button type="reset" class="templatemo-white-button width-100">Reset</button>
				</div>
	    </form>
		</div>
		<div class="templatemo-content-widget templatemo-login-widget templatemo-register-widget white-bg">
			<p>Already registered? <strong><a href="login.php" class="blue-text">Log in.</a></strong></p>
		</div>

		<!-- JS -->
		<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>        <!-- jQuery -->
		<script type="text/javascript" src="js/bootstrap-filestyle.min.js"></script>  <!-- http://markusslima.github.io/bootstrap-filestyle/ -->
		<script type="text/javascript" src="js/templatemo-script.js"></script>        <!-- Templatemo Script -->
</body>
</html>
<?php } ?>

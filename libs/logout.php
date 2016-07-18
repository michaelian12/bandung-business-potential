<?php
	session_start();
	unset($_SESSION['ktp'], $_SESSION['alreadyLogged']);
	header("Location: ../index.php");
?>

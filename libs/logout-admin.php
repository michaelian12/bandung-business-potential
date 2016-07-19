<?php
	session_start();
	unset($_SESSION['nip'], $_SESSION['adminLogged']);
	header("Location: ../admin/login.php");
?>

<?php
	include("connection.php");

	$nip = $_POST['nip'];
	$password = ($_POST['password']);

	$link = dbConnect();
	$sql = "select * from admin where nip = '$nip'";
	$res = $link->query($sql);

	// check account
	if (mysqli_num_rows($res) == 1) {
		$data = mysqli_fetch_array($res);

		// check password
		if ($data['password'] == "$password") {
			session_start();

			$_SESSION['nip'] = $data['nip'];
			$_SESSION['adminLogged'] = true;

		  mysqli_close($link);
			header("Location: ../admin/index.php");
		} else {
			// id and password didn't match
			mysqli_close($link);
			header("Location: ../admin/login-failed.php");
		}
	} else {
		// account not found in database
    mysqli_close($link);
		?><script>alert("Account not found.");</script><?php
		header("Location: ../admin/login.php");
	}
?>

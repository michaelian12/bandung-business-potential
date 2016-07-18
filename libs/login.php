<?php
	include("connection.php");

	$ktp = $_POST['noKtp'];
	$password = encryptIt($_POST['password']);

	$link = dbConnect();
	$sql = "select * from user where ktp = '$ktp'";
	$res = $link->query($sql);

	// check account
	if (mysqli_num_rows($res) == 1) {
		$data = mysqli_fetch_array($res);

		// check password
		if ($data['password'] == "$password") {
			// check account status
			if ($data['status'] == "aktif") {
				session_start();

				$_SESSION['ktp'] = $data['ktp'];
				$_SESSION['alreadyLogged'] = true;

		    mysqli_close($link);
				header("Location: ../index.php");
			} else {
				// account is'nt activated
				mysqli_close($link);
				?><script>alert("Your account is not activated yet. You will be notified via email when your account is activated.");</script><?php
				header("Location: ../index.php");
			}

		} else {
			// id and password didn't match
			mysqli_close($link);
			header("Location: ../login-failed.php");
		}
	} else {
		// account not found in database
    mysqli_close($link);
		?><script>alert("Account not found. Sign up first.");</script><?php
		header("Location: ../signup.php");
	}
?>

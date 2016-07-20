<?php
	include("connection.php");

	$ktp = $_POST['ktp'];
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
			if ($data['status'] == "Aktif") {
				session_start();

				$_SESSION['ktp'] = $data['ktp'];
				$_SESSION['alreadyLogged'] = true;

		    mysqli_close($link);
				echo '<meta http-equiv="Refresh" content="0; url=../index.php">';
			} else {
				// account is'nt activated
				mysqli_close($link);
				?><script>alert("Your account is not activated yet. You will be notified via email when your account is activated.");window.location.href = "../index.php";</script><?php
			}
		} else {
			// id and password didn't match
			mysqli_close($link);
			?><script>alert("ID and password did not match.");history.go(-1);</script><?php
		}
	} else {
		// account not found in database
    mysqli_close($link);
		?><script>alert("Account not found. Sign up first.");window.location.href = "../signup.php";</script><?php
	}
?>

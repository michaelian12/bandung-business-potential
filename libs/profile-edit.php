<?php
	include("connection.php");
	session_start();

	$ktp = $_SESSION['ktp'];

	$link = dbConnect();

	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$email = $_POST['email'];
	$password = encryptIt($_POST['password']);
	$tempat_lahir = $_POST['tempatLahir'];
	$tanggal_lahir = $_POST['tglLahir'];
	$gambarUser = $_FILES['gambarUser']['name'];
	$foto_user = "../images/user/profile-pict/".$gambarUser;
	$gambarKtp = $_FILES['gambarKtp']['name'];
	$foto_ktp = "../images/user/id/".$gambarKtp;

	// id card file check
	if (!empty($gambarUser)) {
		// check file type
		if (($_FILES["gambarUser"]["type"] != "image/jpeg") && ($_FILES["gambarUser"]["type"] != "image/png")) {
			?><script>alert('File must be in .jpg or .png extension.');history.go(-1);</script><?php
		} else {
			// check file size
			if ($_FILES["gambarUser"]["size"] >= 2000000) {
				?><script>alert('Maximum upload size is 2 MB');history.go(-1);</script><?php
			} else {
				if (move_uploaded_file($_FILES["gambarUser"]["tmp_name"], $foto_user)) {
					$sql = "update user set foto_user = '$foto_user' where ktp = '$ktp'";
					$res = $link->query($sql);

					if (!$res) {
						?><script>alert("<?php echo mysqli_error($link);?>");history.go(-1);</script><?php
					}
				} else {
					?><script>alert("Profile picture upload failed.");history.go(-1);</script><?php
				}
			}
		}
	}

	// id card file check
	if (!empty($gambarKtp)) {
		// check file type
		if (($_FILES["gambarKtp"]["type"] != "image/jpeg") && ($_FILES["gambarKtp"]["type"] != "image/png")) {
			mysqli_close($link);
			?><script>alert('File must be in .jpg or .png extension.');history.go(-1);</script><?php
		} else {
			// check file size
			if ($_FILES["gambarKtp"]["size"] >= 2000000) {
				mysqli_close($link);
				?><script>alert('Maximum upload size is 2 MB');history.go(-1);</script><?php
			} else {
				if (move_uploaded_file($_FILES["gambarKtp"]["tmp_name"], $foto_ktp)) {
					$sql = "update user set foto_ktp = '$foto_ktp' where ktp = '$ktp'";
					$res = $link->query($sql);

					if (!$res) {
						mysqli_close($link);
						?><script>alert("<?php echo mysqli_error($link);?>");history.go(-1);</script><?php
					}
				} else {
					mysqli_close($link);
					?><script>alert("ID card image upload failed.");history.go(-1);</script><?php
				}
			}
		}
	}

	$sql = "update user set nama = '$nama', email = '$email', password = '$password', alamat = '$alamat', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir' where ktp = '$ktp'";
	$res = $link->query($sql);

	if (!$res) {
		mysqli_close($link);
		?><script>alert("<?php echo mysqli_error($link);?>");history.go(-1);</script><?php
	} else {
		mysqli_close($link);
		?><script>alert("Successfully change profile data.");</script><?php
		echo '<meta http-equiv="Refresh" content="0; url=../profile.php">';
	}
?>

<?php
	include("connection.php");

	$link = dbConnect();

	$nama = $_POST['nama'];
	$ktp = $_POST['ktp'];
	$email = $_POST['email'];
	$password = encryptIt($_POST['password']);
	$alamat = $_POST['alamat'];
	$tempat_lahir = $_POST['tempatLahir'];
	$tanggal_lahir = $_POST['tglLahir'];
	$gambarKtp = $_FILES['gambarKtp']['name'];
	$foto_ktp = "../images/user/id/".$gambarKtp;

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
					$sql = "insert into user values('$ktp', '$nama', '$email', '$password', '$alamat', '$tempat_lahir', '$tanggal_lahir', '$foto_ktp', null, 'Deaktif')";
					$res = $link->query($sql);

					if (!$res) {
						mysqli_close($link);
						?><script>alert("<?php echo mysqli_error($link);?>");history.go(-1);</script><?php
					} else {
						mysqli_close($link);
						?><script>alert("You have successfully signed up. You will be notified via email when your account is activated.");</script><?php
						echo '<meta http-equiv="Refresh" content="0; url=../index.php">';
					}
				} else {
					mysqli_close($link);
					?><script>alert("ID card image upload failed");history.go(-1);</script><?php
				}
			}
		}
	}
?>

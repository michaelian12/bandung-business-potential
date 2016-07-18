<?php
	include("connection.php");

	if ($_FILES['gambarKtp']['error'] == 0) {
		$link = dbConnect();

		$nama = $_POST['nama'];
		$ktp = $_POST['noKtp'];
		$email = $_POST['email'];
		$password = encryptIt($_POST['password']);
		$alamat = $_POST['alamat'];
		$tempat_lahir = $_POST['tempatLahir'];
		$tanggal_lahir = $_POST['tglLahir'];
		$gambarKtp = $_FILES['gambarKtp']['name'];
		$foto_ktp = "../images/user/id/".$gambarKtp;

		if (move_uploaded_file($_FILES['gambarKtp']['tmp_name'], $foto_ktp) == true) {
			$sql = "insert into user values('$ktp', '$nama', '$email', '$password', '$alamat', '$tempat_lahir', '$tanggal_lahir', '$foto_ktp', null, 'deaktif')";
			$res = $link->query($sql);

			if(!$res){
				?><script>alert("<?php echo mysqli_error($link);?>");</script><?php
			} else {
				?><script>alert("You have successfully signed up. You will be notified via email when your account is activated.");</script><?php
			}
		} else {
			?><script>alert("<?php echo mysqli_error($link);?>");</script><?php
		}
	} else {
		?><script>alert("File upload failed.");</script><?php
		mysqli_close($link);
		header("Location: ../signup.php");
	}

	mysqli_close($link);
	header("Location: ../index.php");
?>

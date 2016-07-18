<?php
	include("connection.php");
	session_start();

	if (($_FILES['gambarProfil']['error'] == 0) && ($_FILES['gambarKtp']['error'] == 0)) {
		$link = dbConnect();

		$ktp = $_SESSION['ktp'];
		$nama = $_POST['nama'];
		$ktp = $_POST['noKtp'];
		$email = $_POST['email'];
		$password = encryptIt($_POST['password']);
		$alamat = $_POST['alamat'];
		$tempat_lahir = $_POST['tempatLahir'];
		$tanggal_lahir = $_POST['tglLahir'];
		$gambarKtp = $_FILES['gambarKtp'];
		$foto_ktp = "images/user/id/".$gambarKtp;
		$gambarUsaha = $_FILES['gambarUsaha'];
		$foto_usaha = "images/business/".$gambarUsaha;

		$sql = "update user set ktp = '$ktp', nama = '$nama', email = '$email', password = '$password', id_sektor = '$id_sektor', alamat = '$alamat', id_kelurahan = '$id_kelurahan', telepon = '$telepon', latitude = '$latitude', longitude = '$longitude', status = '$status', foto_usaha = '$foto_usaha' where id_usaha = '$id_usaha'";
		$res = $link->query($sql);

		if(!$res){
			?><script>alert("<?php echo mysqli_error($link);?>");</script><?php
		} else {
			?><script>alert("Successfully change business data.");</script><?php
		}
	} else {
		?><script>alert("File upload failed.");</script><?php
	}

	mysqli_close($link);
	header("Location: ../business.php");
?>

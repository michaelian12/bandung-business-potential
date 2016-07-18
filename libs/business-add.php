<?php
	include("connection.php");
	session_start();

	if ($_FILES['gambarUsaha']['error'] == 0) {
		$link = dbConnect();

		// check for id
		$sql = "select id_usaha from usaha order by id_usaha desc limit 1";
		$res = $link->query($sql);

		if (mysqli_num_rows($res) == 1) {
			$data = mysqli_fetch_array($res);
			$id_usaha = $data['id_usaha'] + 1;
		} else {
			$id_usaha = 1;
		}

		$nama_usaha = $_POST['namaUsaha'];
		$produk_utama = $_POST['produkUtama'];
		$id_skala = $_POST['skalaUsaha'];
		$id_sektor = $_POST['sektorUsaha'];
		$alamat = $_POST['alamat'];
		$id_kelurahan = $_POST['kelurahan'];
		$telepon = $_POST['telepon'];
		$latitude = $_POST['lat'];
		$longitude = $_POST['lng'];
		$status = $_POST['statusUsaha'];
		$gambarUsaha = $_FILES['gambarUsaha']['name'];
		$foto_usaha = "../images/business/".$gambarUsaha;
		$ktp = $_SESSION['ktp'];

		if (move_uploaded_file($_FILES['gambarUsaha']['tmp_name'], $foto_usaha) == true) {
			$sql = "insert into usaha values('$id_usaha', '$nama_usaha', '$produk_utama', '$id_skala', '$id_sektor', '$alamat', '$id_kelurahan', '$telepon', '$latitude', '$longitude', '$status', '$foto_usaha', '$ktp')";
			$res = $link->query($sql);

			if(!$res){
				?><script>alert("<?php echo mysqli_error($link);?>");</script><?php
			} else {
				?><script>alert("Successfully add business data.");</script><?php
			}
		} else {
			?><script>alert("<?php echo mysqli_error($link);?>");</script><?php
		}
	} else {
		?><script>alert("File upload failed.");</script><?php
	}

	mysqli_close($link);
	header("Location: ../business.php");
?>

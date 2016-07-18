<?php
	include("connection.php");

	if ($_FILES['gambarUsaha']['error'] == 0) {
		$link = dbConnect();

		$id_usaha = $_GET['id'];
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

		if (move_uploaded_file($_FILES['gambarUsaha']['tmp_name'], $foto_usaha) == true) {
			$sql = "update usaha set nama_usaha = '$nama_usaha', produk_utama = '$produk_utama', id_skala = '$id_skala', id_sektor = '$id_sektor', alamat = '$alamat', id_kelurahan = '$id_kelurahan', telepon = '$telepon', latitude = '$latitude', longitude = '$longitude', status = '$status', foto_usaha = '$foto_usaha' where id_usaha = '$id_usaha'";
			$res = $link->query($sql);

			if(!$res){
				?><script>alert("<?php echo mysqli_error($link);?>");</script><?php
			} else {
				?><script>alert("Successfully change business data.");</script><?php
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

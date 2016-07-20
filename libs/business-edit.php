<?php
	include("connection.php");

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

	// business image file check
	if (!empty($gambarUsaha)) {
		// check file type
		if (($_FILES["gambarUsaha"]["type"] != "image/jpeg") && ($_FILES["gambarUsaha"]["type"] != "image/png")) {
			?><script>alert('File must be in .jpg or .png extension.');history.go(-1);</script><?php
		} else {
			// check file size
			if ($_FILES["gambarUsaha"]["size"] >= 2000000) {
				?><script>alert('Maximum upload size is 2 MB');history.go(-1);</script><?php
			} else {
				if (move_uploaded_file($_FILES["gambarUsaha"]["tmp_name"], $foto_usaha)) {
					$sql = "update usaha set foto_usaha = '$foto_usaha' where id_usaha = '$id_usaha'";
					$res = $link->query($sql);

					if (!$res) {
						mysqli_close($link);
						?><script>alert("<?php echo mysqli_error($link);?>");history.go(-1);</script><?php
					}
				} else {
					mysqli_close($link);
					?><script>alert("Business image upload failed.");history.go(-1);</script><?php
				}
			}
		}
	}

	$sql = "update usaha set nama_usaha = '$nama_usaha', produk_utama = '$produk_utama', id_skala = '$id_skala', id_sektor = '$id_sektor', alamat = '$alamat', id_kelurahan = '$id_kelurahan', telepon = '$telepon', latitude = '$latitude', longitude = '$longitude', status = '$status' where id_usaha = '$id_usaha'";
	$res = $link->query($sql);

	if(!$res){
		mysqli_close($link);
		?><script>alert("<?php echo mysqli_error($link);?>");history.go(-1);</script><?php
	} else {
		mysqli_close($link);
		?><script>alert("Successfully change business data.");history.go(-2);</script><?php
	}
?>

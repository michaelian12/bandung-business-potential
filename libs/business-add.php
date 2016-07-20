<?php
	include("connection.php");
	session_start();

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
					$sql = "insert into usaha values('$id_usaha', '$nama_usaha', '$produk_utama', '$id_skala', '$id_sektor', '$alamat', '$id_kelurahan', '$telepon', '$latitude', '$longitude', '$status', '$foto_usaha', '$ktp')";
					$res = $link->query($sql);

					if(!$res){
						mysqli_close($link);
						?><script>alert("<?php echo mysqli_error($link);?>");history.go(-1);</script><?php
					} else {
						mysqli_close($link);
						?><script>alert("Successfully add business data.");history.go(-2);</script><?php
					}
				} else {
					mysqli_close($link);
					?><script>alert("Business image upload failed.");history.go(-1);</script><?php
				}
			}
		}
	} else {
		$sql = "insert into usaha values('$id_usaha', '$nama_usaha', '$produk_utama', '$id_skala', '$id_sektor', '$alamat', '$id_kelurahan', '$telepon', '$latitude', '$longitude', '$status', '$foto_usaha', '$ktp')";
		$res = $link->query($sql);

		if(!$res){
			mysqli_close($link);
			?><script>alert("<?php echo mysqli_error($link);?>");history.go(-1);</script><?php
		} else {
			mysqli_close($link);
			?><script>alert("Successfully add business data.");history.go(-2);</script><?php
		}
	}
?>

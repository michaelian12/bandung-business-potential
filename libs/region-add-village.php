<?php
	include("connection.php");

	$link = dbConnect();

	// check for id
	$sql = "select id_kelurahan from kelurahan order by id_kelurahan desc limit 1";
	$res = $link->query($sql);

	if (mysqli_num_rows($res) == 1) {
		$data = mysqli_fetch_array($res);
		$id_kelurahan = $data['id_kelurahan'] + 1;
	} else {
		$id_kelurahan = 1;
	}

	$nama_kelurahan = $_POST['namaKelurahan'];
	$kode_pos = $_POST['kodePos'];
	$id_kecamatan = $_POST['idKecamatan'];

	$sql = "insert into kelurahan values('$id_kelurahan', '$nama_kelurahan', '$kode_pos', '$id_kecamatan')";
	$res = $link->query($sql);

	if(!$res){
		?><script>alert("<?php echo mysqli_error($link);?>");</script><?php
	} else {
		?><script>alert("Successfully add village data.");</script><?php
	}

	mysqli_close($link);
	header("Location: ../admin/region.php#village");
?>

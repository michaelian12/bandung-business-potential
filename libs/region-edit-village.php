<?php
	include("connection.php");

	$link = dbConnect();

	$id_kelurahan = $_GET['id'];
	$nama_kelurahan = $_POST['namaKelurahan'];
	$kode_pos = $_POST['kodePos'];
	$id_kecamatan = $_POST['idKecamatan'];

	$sql = "update kelurahan set nama_kelurahan = '$nama_kelurahan', kode_pos = '$kode_pos', id_kecamatan ='$id_kecamatan' where id_kelurahan = '$id_kelurahan'";
	$res = $link->query($sql);

	if(!$res){
		?><script>alert("<?php echo mysqli_error($link);?>");</script><?php
	} else {
		?><script>alert("Successfully edit village data.");</script><?php
	}

	mysqli_close($link);
	header("Location: ../admin/region.php#village");
?>

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
		mysqli_close($link);
		?><script>alert("<?php echo mysqli_error($link);?>");history.go(-1);</script><?php
	} else {
		mysqli_close($link);
		?><script>alert("Successfully edit village data.");</script><?php
		echo '<meta http-equiv="Refresh" content="0; url=../admin/region.php#village">';
	}
?>

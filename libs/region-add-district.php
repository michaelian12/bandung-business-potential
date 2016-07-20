<?php
	include("connection.php");

	$link = dbConnect();

	// check for id
	$sql = "select id_kecamatan from kecamatan order by id_kecamatan desc limit 1";
	$res = $link->query($sql);

	if (mysqli_num_rows($res) == 1) {
		$data = mysqli_fetch_array($res);
		$id_kecamatan = $data['id_kecamatan'] + 1;
	} else {
		$id_kecamatan = 1;
	}

	$nama_kecamatan = $_POST['namaKecamatan'];

	$sql = "insert into kecamatan values('$id_kecamatan', '$nama_kecamatan')";
	$res = $link->query($sql);

	if(!$res){
		mysqli_close($link);
		?><script>alert("<?php echo mysqli_error($link);?>");history.go(-1);</script><?php
	} else {
		mysqli_close($link);
		?><script>alert("Successfully add district data.");</script><?php
		echo '<meta http-equiv="Refresh" content="0; url=../admin/region.php">';
	}
?>

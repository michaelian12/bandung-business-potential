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
		?><script>alert("<?php echo mysqli_error($link);?>");</script><?php
	} else {
		?><script>alert("Successfully add district data.");</script><?php
	}

	mysqli_close($link);
	header("Location: ../admin/region.php");
?>

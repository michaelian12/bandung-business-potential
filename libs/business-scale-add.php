<?php
	include("connection.php");

	$link = dbConnect();

	// check for id
	$sql = "select id_skala from skala_usaha order by id_skala desc limit 1";
	$res = $link->query($sql);

	if (mysqli_num_rows($res) == 1) {
		$data = mysqli_fetch_array($res);
		$id_skala = $data['id_skala'] + 1;
	} else {
		$id_skala = 1;
	}

	$nama_skala = $_POST['namaSkala'];

	$sql = "insert into skala_usaha values('$id_skala', '$nama_skala')";
	$res = $link->query($sql);

	if(!$res){
		?><script>alert("<?php echo mysqli_error($link);?>");</script><?php
	} else {
		?><script>alert("Successfully add business scale data.");</script><?php
	}

	mysqli_close($link);
	header("Location: ../admin/business-scale.php");
?>

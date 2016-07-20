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
		mysqli_close($link);
		?><script>alert("<?php echo mysqli_error($link);?>");history.go(-1);</script><?php
	} else {
		mysqli_close($link);
		?><script>alert("Successfully add business scale data.");</script><?php
		echo '<meta http-equiv="Refresh" content="0; url=../admin/business-scale.php">';
	}
?>

<?php
	header("Cache-Control: no-cache, no-store, must-validate");
	include("connection.php");

	$id_kecamatan = $_GET['id'];

	$link = dbConnect();
	$sql = "select * from kelurahan where id_kecamatan = '$id_kecamatan' order by nama_kelurahan";
	$res = $link->query($sql);
	while ($data = mysqli_fetch_array($res)) {
		echo "$data[id_kelurahan];$data[nama_kelurahan]";
	}
	mysqli_close($link);
?>

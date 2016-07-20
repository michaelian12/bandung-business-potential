<?php
	include("connection.php");

	$link = dbConnect();

	$ktp = $_GET['ktp'];
	$status = $_GET['status'];

	if ($status == "Aktif") {
		$status = "Deaktif";
	} else {
		$status = "Aktif";
	}

	$sql = "update user set status = '$status' where ktp = '$ktp'";
	$res = $link->query($sql);

	if (!$res) {
		mysqli_close($link);
		?><script>alert("<?php echo mysqli_error($link);?>");history.go(-1);</script><?php
	} else {
		mysqli_close($link);
		?><script>history.go(-1);</script><?php
	}
?>

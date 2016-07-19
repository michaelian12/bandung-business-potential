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

	if(!$res){
		?><script>alert("<?php echo mysqli_error($link);?>");</script><?php
	} else {
		?><script>alert("Successfully change user status.");</script><?php
	}

	mysqli_close($link);
	header("Location: ../admin/index.php");
?>

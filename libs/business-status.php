<?php
	include("connection.php");

	$link = dbConnect();

	$id_usaha = $_GET['id'];
	$status = $_GET['status'];

	if ($status == "Aktif") {
		$status = "Deaktif";
	} else {
		$status = "Aktif";
	}

	$sql = "update usaha set status = '$status' where id_usaha = '$id_usaha'";
	$res = $link->query($sql);

	if(!$res){
		?><script>alert("<?php echo mysqli_error($link);?>");</script><?php
	} else {
		?><script>alert("Successfully change business status.");</script><?php
	}

	mysqli_close($link);
	header("Location: ../business.php");
?>

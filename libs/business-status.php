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
		mysqli_close($link);
		?><script>alert("<?php echo mysqli_error($link);?>");history.go(-1);</script><?php
	} else {
		mysqli_close($link);
		?><script>history.go(-1);</script><?php
	}
?>

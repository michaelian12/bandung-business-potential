<?php
	include("connection.php");

	$link = dbConnect();

	$id_kelurahan = $_GET['id'];

	$sql = "delete from kelurahan where id_kelurahan = '$id_kelurahan'";
	$res = $link->query($sql);

	if(!$res){
		?><script>alert("<?php echo mysqli_error($link);?>");</script><?php
	} else {
		?><script>alert("Successfully delete village data.");</script><?php
	}

	mysqli_close($link);
	header("Location: ../admin/region.php#village");
?>

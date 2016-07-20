<?php
	include("connection.php");

	$link = dbConnect();

	$id_kelurahan = $_GET['id'];

	$sql = "delete from kelurahan where id_kelurahan = '$id_kelurahan'";
	$res = $link->query($sql);

	if(!$res){
		mysqli_close($link);
		?><script>alert("<?php echo mysqli_error($link);?>");</script><?php
	} else {
		mysqli_close($link);
		?><script>alert("Successfully delete village data.");</script><?php
		echo '<meta http-equiv="Refresh" content="0; url=../admin/region.php#village">';
	}
?>

<?php
	include("connection.php");

	$link = dbConnect();

	$id_kecamatan = $_GET['id'];

	$sql = "delete from kecamatan where id_kecamatan = '$id_kecamatan'";
	$res = $link->query($sql);

	if(!$res){
		mysqli_close($link);
		?><script>alert("<?php echo mysqli_error($link);?>");history.go(-1);</script><?php
	} else {
		mysqli_close($link);
		?><script>alert("Successfully delete district data.");</script><?php
		echo '<meta http-equiv="Refresh" content="0; url=../admin/region.php">';
	}
?>

<?php
	include("connection.php");

	$link = dbConnect();

	$id_sektor = $_GET['id'];

	$sql = "delete from sektor_usaha where id_sektor = '$id_sektor'";
	$res = $link->query($sql);

	if(!$res){
		mysqli_close($link);
		?><script>alert("<?php echo mysqli_error($link);?>");history.go(-1);</script><?php
	} else {
		mysqli_close($link);
		?><script>alert("Successfully delete business sector data.");</script><?php
		echo '<meta http-equiv="Refresh" content="0; url=../admin/business-sector.php">';
	}
?>

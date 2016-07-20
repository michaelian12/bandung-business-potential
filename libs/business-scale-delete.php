<?php
	include("connection.php");

	$link = dbConnect();

	$id_skala = $_GET['id'];

	$sql = "delete from skala_usaha where id_skala = '$id_skala'";
	$res = $link->query($sql);

	if(!$res){
		mysqli_close($link);
		?><script>alert("<?php echo mysqli_error($link);?>");history.go(-1);</script><?php
	} else {
		mysqli_close($link);
		?><script>alert("Successfully delete business scale data.");</script><?php
		echo '<meta http-equiv="Refresh" content="0; url=../admin/business-scale.php">';
	}
?>

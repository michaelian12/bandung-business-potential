<?php
	include("connection.php");

	$link = dbConnect();

	$id_usaha = $_GET['id'];

	$sql = "delete from usaha where id_usaha = '$id_usaha'";
	$res = $link->query($sql);

	if(!$res){
		mysqli_close($link);
		?><script>alert("<?php echo mysqli_error($link);?>");history.go(-1);</script><?php
	} else {
		mysqli_close($link);
		?><script>alert("Successfully delete business data.");history.go(-1);</script><?php
	}
?>

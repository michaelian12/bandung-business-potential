<?php
	include("connection.php");

	$link = dbConnect();

	$id_usaha = $_GET['id'];

	$sql = "delete from usaha where id_usaha = '$id_usaha'";
	$res = $link->query($sql);

	if(!$res){
		?><script>alert("<?php echo mysqli_error($link);?>");</script><?php
	} else {
		?><script>alert("Successfully delete business data.");</script><?php
	}

	mysqli_close($link);
	header("Location: ../business.php");
?>

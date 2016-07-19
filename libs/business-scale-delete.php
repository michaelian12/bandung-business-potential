<?php
	include("connection.php");

	$link = dbConnect();

	$id_skala = $_GET['id'];

	$sql = "delete from skala_usaha where id_skala = '$id_skala'";
	$res = $link->query($sql);

	if(!$res){
		?><script>alert("<?php echo mysqli_error($link);?>");</script><?php
	} else {
		?><script>alert("Successfully delete business scale data.");</script><?php
	}

	mysqli_close($link);
	header("Location: ../admin/business-scale.php");
?>

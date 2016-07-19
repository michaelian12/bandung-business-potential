<?php
	include("connection.php");

	$link = dbConnect();

	$id_sektor = $_GET['id'];

	$sql = "delete from sektor_usaha where id_sektor = '$id_sektor'";
	$res = $link->query($sql);

	if(!$res){
		?><script>alert("<?php echo mysqli_error($link);?>");</script><?php
	} else {
		?><script>alert("Successfully delete business sector data.");</script><?php
	}

	mysqli_close($link);
	header("Location: ../admin/business-sector.php");
?>

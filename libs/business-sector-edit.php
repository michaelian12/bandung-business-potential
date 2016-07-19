<?php
	include("connection.php");

	$link = dbConnect();

	$id_sektor = $_GET['id'];
	$nama_sektor = $_POST['namaSektor'];

	$sql = "update sektor_usaha set nama_sektor = '$nama_sektor' where id_sektor = '$id_sektor'";
	$res = $link->query($sql);

	if(!$res){
		?><script>alert("<?php echo mysqli_error($link);?>");</script><?php
	} else {
		?><script>alert("Successfully edit business sector data.");</script><?php
	}

	mysqli_close($link);
	header("Location: ../admin/business-sector.php");
?>

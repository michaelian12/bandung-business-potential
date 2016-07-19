<?php
	include("connection.php");

	$link = dbConnect();

	$id_skala = $_GET['id'];
	$nama_skala = $_POST['namaSkala'];

	$sql = "update skala_usaha set nama_skala = '$nama_skala' where id_skala = '$id_skala'";
	$res = $link->query($sql);

	if(!$res){
		?><script>alert("<?php echo mysqli_error($link);?>");</script><?php
	} else {
		?><script>alert("Successfully edit business scale data.");</script><?php
	}

	mysqli_close($link);
	header("Location: ../admin/business-scale.php");
?>

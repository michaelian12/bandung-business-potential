<?php
	include("connection.php");

	$link = dbConnect();

	$id_kecamatan = $_GET['id'];
	$nama_kecamatan = $_POST['namaKecamatan'];

	$sql = "update kecamatan set nama_kecamatan = '$nama_kecamatan' where id_kecamatan = '$id_kecamatan'";
	$res = $link->query($sql);

	if(!$res){
		?><script>alert("<?php echo mysqli_error($link);?>");</script><?php
	} else {
		?><script>alert("Successfully edit district data.");</script><?php
	}

	mysqli_close($link);
	header("Location: ../admin/region.php");
?>

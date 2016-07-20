<?php
	include("connection.php");

	$link = dbConnect();

	$id_skala = $_GET['id'];
	$nama_skala = $_POST['namaSkala'];

	$sql = "update skala_usaha set nama_skala = '$nama_skala' where id_skala = '$id_skala'";
	$res = $link->query($sql);

	if(!$res){
		mysqli_close($link);
		?><script>alert("<?php echo mysqli_error($link);?>");history.go(-1);</script><?php
	} else {
		mysqli_close($link);
		?><script>alert("Successfully edit business scale data.");</script><?php
		echo '<meta http-equiv="Refresh" content="0; url=../admin/business-scale.php">';
	}
?>

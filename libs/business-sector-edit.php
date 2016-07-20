<?php
	include("connection.php");

	$link = dbConnect();

	$id_sektor = $_GET['id'];
	$nama_sektor = $_POST['namaSektor'];

	$sql = "update sektor_usaha set nama_sektor = '$nama_sektor' where id_sektor = '$id_sektor'";
	$res = $link->query($sql);

	if(!$res){
		mysqli_close($link);
		?><script>alert("<?php echo mysqli_error($link);?>");history.go(-1);</script><?php
	} else {
		mysqli_close($link);
		?><script>alert("Successfully edit business sector data.");</script><?php
		echo '<meta http-equiv="Refresh" content="0; url=../admin/business-sector.php">';
	}
?>

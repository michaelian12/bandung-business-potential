<?php
	include("connection.php");

	$link = dbConnect();

	// check for id
	$sql = "select id_sektor from sektor_usaha order by id_sektor desc limit 1";
	$res = $link->query($sql);

	if (mysqli_num_rows($res) == 1) {
		$data = mysqli_fetch_array($res);
		$id_sektor = $data['id_sektor'] + 1;
	} else {
		$id_sektor = 1;
	}

	$nama_sektor = $_POST['namaSektor'];

	$sql = "insert into sektor_usaha values('$id_sektor', '$nama_sektor')";
	$res = $link->query($sql);

	if(!$res){
		mysqli_close($link);
		?><script>alert("<?php echo mysqli_error($link);?>");history.go(-1);</script><?php
	} else {
		mysqli_close($link);
		?><script>alert("Successfully add business sector data.");</script><?php
		echo '<meta http-equiv="Refresh" content="0; url=../admin/business-sector.php">';
	}
?>

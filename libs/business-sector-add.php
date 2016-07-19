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
		?><script>alert("<?php echo mysqli_error($link);?>");</script><?php
	} else {
		?><script>alert("Successfully add business sector data.");</script><?php
	}

	mysqli_close($link);
	header("Location: ../admin/business-sector.php");
?>

<?php
	include("connection.php");

	if ($_POST['id']) {
		$id_kecamatan = $_POST['id'];
		$link = dbConnect();

		$sql = "select * from kelurahan where id_kecamatan = '$id_kecamatan' order by nama_kelurahan";
		$res = $link->query($sql);
?>
		<option value="" disabled="true" selected="true">Select Village (Kelurahan)</option>
<?php
		while ($row = mysqli_fetch_array($res)) {
?>
			<option value="<?php echo $row['id_kelurahan']?>"><?php echo $row['nama_kelurahan']; ?></option>
<?php
		}
		mysqli_close($link);
	}
?>

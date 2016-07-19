<?php
	include("connection.php");

	$link = dbConnect();

	$ktp = $_GET['ktp'];
	$status = $_GET['status'];

	if ($status == "Aktif") {
		$status = "Deaktif";
	} else {
		$status = "Aktif";
	}

	$sql = "update user set status = '$status' where ktp = '$ktp'";
	$res = $link->query($sql);

	if(!$res){
		?><script>alert("<?php echo mysqli_error($link);?>");</script><?php
	} else {
		?><script>alert("Successfully change user status.");</script><?php
	}

	$sql = "select email from user where ktp = '$ktp'";
	$res = $link->query($sql);
	if($res) {
		$subject = 'Account Activation';
		$message = 'Your account has been activated, now you login with your email on Bandung Business Potential website.';
		$headers = 'From: webmaster@bandungbusinesspotential.azurewebsites.net' . "\r\n" .
	'Reply-To: bandungbusinesspotential.azurewebsites.net' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();
		mail($email,$subject,$message,$headers);
	}

	mysqli_close($link);
	header("Location: ../admin/index.php");
?>

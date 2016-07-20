<?php
	// database connection function
	function dbConnect(){
		$host = "ap-cdbr-azure-southeast-b.cloudapp.net";
		$user = "be443468b851a3";
		$password = "fd796b50";
		$database = "bandungbusinesspotential";

		/*$host = "localhost";
		$user = "root";
		$password = "";
		$database = "bbp";*/

		$link = mysqli_connect($host, $user, $password, $database);
		if ($link->connect_error) {
			die("Connection failed: " . $link->connect_error);
		}

		return $link;
	}

	// password encryption function
	function encryptIt($q){
	  $cryptKey = 'qJB0rGtIn5UB1xG03efyCp';
	  $qEncoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), $q, MCRYPT_MODE_CBC, md5(md5($cryptKey))));
	  return($qEncoded);
	}

	// password decryption function
	function decryptIt($q){
	  $cryptKey = 'qJB0rGtIn5UB1xG03efyCp';
	  $qDecoded = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), base64_decode($q), MCRYPT_MODE_CBC, md5(md5($cryptKey))), "\0");
	  return($qDecoded);
	}
?>

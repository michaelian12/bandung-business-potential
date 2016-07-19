<?php
	include("connection.php");

	if(isset($_POST["id"]) && !empty($_POST["id"])){
	    //Get all state data
			$db = dbConnect();
	    $query = $db->query("SELECT * FROM kelurahan WHERE id_kecamatan = ".$_POST['id']." ORDER BY nama_kelurahan");

	    //Count total number of rows
	    $rowCount = $query->num_rows;

	    //Display states list
	    if($rowCount > 0){
	        echo '<option value="">Select village</option>';
	        while($row = $query->fetch_assoc()){
	            echo '<option value="'.$row['id_kelurahan'].'">'.$row['nama_kelurahan'].'</option>';
	        }
	    }else{
	        echo '<option value="">Village not available</option>';
	    }
	}

	
?>

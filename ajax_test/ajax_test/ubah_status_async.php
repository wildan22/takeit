<?php
include 'koneksi.php';

echo "test";
	
	if (isset($_GET["id"]) && isset($_GET["status"])){
		$id = $_GET["id"];
		$status = $_GET["status"];
		echo "$status";
		if($status == "yes"){
			$query = "UPDATE test SET status='yes' WHERE id=".$id;
			mysqli_query($connect,$query);
		}
		else if($status == "no"){
			$query = "UPDATE test SET status='no' WHERE id=".$id;
			mysqli_query($connect,$query);
		}
		else{
			echo "No Chance to do that";
		}
 }
	else{
		echo "ulululu";
	}

?>
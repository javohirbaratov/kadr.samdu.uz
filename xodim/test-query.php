<?php
	include_once 'ximoya.php';
	$sql = mysqli_query($link,"SELECT * FROM changelavozim");
	while ($fetch = mysqli_fetch_assoc($sql)) {
		$braqam = $fetch['braqam'];
		$sql2 = mysqli_query($link,"SELECT * FROM buyruq WHERE braqam='$braqam'");
		$buyruq = mysqli_fetch_assoc($sql2);
		$buyruq_id = $buyruq['id'];
		$id = $fetch['id'];
		$sql3 = mysqli_query($link,"UPDATE changelavozim SET buyruq_id='$buyruq_id' WHERE id='$id'");
		if($sql3){
			echo "ok";
		}
		else{
			echo "no";	
		}	
	}

	// $sql = mysqli_query($link,"SELECT * FROM qabul");
	// while ($fetch = mysqli_fetch_assoc($sql)) {
	// 	$sana = $fetch['sana'];
	// 	$user_id = $fetch['user_id'];

	// 	$sql3 = mysqli_query($link,"UPDATE workplace SET sana='$sana' WHERE xodim_id='$user_id'");
	// 	if($sql3){
	// 		echo "ok";
	// 	}
	// 	else{
	// 		echo "no";	
	// 	}
	// }

	// $sql = mysqli_query($link,"SELECT * FROM changelavozim");
	// while ($fetch = mysqli_fetch_assoc($sql)) {
	// 	$sana = $fetch['sana'];
	// 	$user_id = $fetch['user_id'];

	// 	$sql3 = mysqli_query($link,"UPDATE workplace SET sana='$sana' WHERE xodim_id='$user_id'");
	// 	if($sql3){
	// 		echo "ok";
	// 	}
	// 	else{
	// 		echo "no";	
	// 	}
	// }
	mysqli_close($link);
?>
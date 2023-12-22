<?php
	include_once 'ximoya.php';
	$ret = [];
	

	if($_GET['action']=="lavozim"){
		$id = $_GET['id'];
		$sql = mysqli_query($link,"DELETE FROM lavozimlar WHERE id='$id'");
		if ($sql==true) {
			$ret = ["err" => 0, "msg" => "Muvaffaqqiyatli amalga oshdi"];
		}
		else{
			$ret = ["err" => 1, "msg" => "Amalga oshmadi"];
		}
	}
    if($_POST['action']=="bulimlar"){
        $id = $_POST['id'];
        $sql = mysqli_query($link,"DELETE FROM `bulimlar` WHERE id='$id'");
        if ($sql==true) {
            $ret = ["err" => 0, "msg" => "Muvaffaqqiyatli amalga oshdi"];
        }
        else{
            $ret = ["err" => 1, "msg" => "Amalga oshmadi"];
        }
    }
    if($_POST['action']=="xodim"){
        $id = $_POST['id'];
        $sql = mysqli_query($link,"DELETE FROM `xodim_temp` WHERE id='$id'");
        if ($sql==true) {
            $ret = ["err" => 0, "msg" => "Muvaffaqqiyatli amalga oshdi"];
        }
        else{
            $ret = ["err" => 1, "msg" => "Amalga oshmadi"];
        }
    }
	echo json_encode($ret);
?>
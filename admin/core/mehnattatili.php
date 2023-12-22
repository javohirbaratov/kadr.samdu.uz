<?php 
require '../model.php';
if (isset($_GET['user_id'])) {
	$ret = [];
	$id = $_GET['user_id'];
	$ret += ['id' => $id];
	$x=0;
	$qiy =Functions::getbytable("qabul","user_id=$id");
	foreach ($qiy as $key => $value) {
		$bulim = mysqli_fetch_assoc(Functions::getbyid("bulimlar",$value['bulim_id']));
		$bulimname = $bulim['name'];
		$bulim = mysqli_fetch_assoc(Functions::getbyid("kafedra",$value['kafedra_id']));
		$kafname = $bulim['name'];
		$bulim = mysqli_fetch_assoc(Functions::getbyid("lavozimlar",$value['lavozim']));
		$lav = $bulim['lavozim'];
		$bulim = mysqli_fetch_assoc(Functions::getbyid("kadrlarbulimi",$value['kadr_bulim_id']));
		$kadr_id = $bulim['name'];
		$x++;
		$ret += ['bulim_id' => $bulimname];
		$ret += ['shtat' => $value['shtat']];
		$ret += ['lavozim' => $lav];
		$ret += ['kafname' => $kafname];
		$ret += ['kadr_id' => $kadr_id];
	}
	if ($x>0) {
	echo json_encode($ret);
	}
	else{
		$ret += ['xatolik' => "Ma`lumot topilmadi!"];
		echo json_encode($ret);
	}
}else {
		$ret += ['xatolik' => "Ma`lumot topilmadi!"];
		echo json_encode($ret);
}


 ?>
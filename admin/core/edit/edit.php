<?php 
session_start();
$ret= [];
if($_POST['_csrf']!=$_SESSION['_csrf']){
	$ret += ['xatolik' => "1"];
	$ret += ['xabar' => "Taqiqlangan so'rov"];
	$ret += ['_csrf' => $_SESSION['_csrf']];
}
else{
	$haqiqiy = intval($_GET['soni']/$_SESSION['keyuser']);
	$soni = -1;
	$s1 = "";
	foreach ($_POST as $key => $value){
		$soni++;
	}
	foreach ($_FILES as $key => $value){
		$soni++;
	}

	if (true) {
		$table = str_rot13($_GET['table']);
		$obj = [];
		require_once '../../model.php';
		foreach ($_POST as $key => $value){
			if ($key != '_csrf') {
				if (strlen($value)>0) {
					$obj += [clean($key) => filter($value)];
				}
				
			}
		}
		foreach ($_FILES as $key => $value){
			
			  $file='';
			  if (isset($value)) {
		    $target_dir="../../../docs/".clean($key)."/";
		    $y=md5(time());
		    $tip = strtolower(pathinfo($value["name"],PATHINFO_EXTENSION));
		    $value["name"]=clean($key)."_".$y.".".$tip;
		    $target_file=$target_dir.basename($value["name"]);
			if (move_uploaded_file($value["tmp_name"], $target_file))
				$file=$value["name"];
			}

			if(strlen($file)>1){
				$obj += [clean($key) => filter($file)];
			}
 			
		}
		$fetch = Functions::edit($obj,$table);
			if ($fetch) {
			$ret += ['xatolik' => "0"];
			$ret += ['xabar' => "Ma'lumot kiritildi!"];
			$ret += ['_csrf' => $_SESSION['_csrf']];
			}
			else{
			$ret += ['xatolik' => "1"];
			$ret += ['xabar' => "Ma'lumotda kamchilik bor!"];
			$ret += ['_csrf' => $_SESSION['_csrf']];
			}
			
	}
	else{

		$ret += ['xatolik' => "$s1"];
		$ret += ['xabar' => "Ma'lumot Yetarli emas! "];
		$ret += ['_csrf' => $_SESSION['_csrf']];
	}

		
}
echo json_encode($ret);
 ?>
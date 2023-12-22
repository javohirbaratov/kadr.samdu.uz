<?
	session_start();
	if (isset($_GET['name'])) {
		$ret = [];

		if($_GET['_csrf']!=$_SESSION['_csrf']){
			$ret += ['xatolik' => "1"];
			$ret += ['xabar' => "Taqiqlangan so'rov"];
			$ret += ['_csrf' => $_SESSION['_csrf']];
		}
		else{
			$_SESSION['_csrf'] = md5(time());
			require '../model.php';
			$name = filter($_GET['name']);
			$soni = filter($_GET['soni']);
			$kadr_bulim_id = filter($_GET['kadr_bulim_id']);
			$bulim_id = filter($_GET['bulim_id']);
			$kafedra = filter($_GET['kafedra_id']);
			 
			$fetch = Functions::addlavozim($name,$kadr_bulim_id,$bulim_id,$kafedra,$soni);
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
		echo json_encode($ret);
	}
	else{
	$ret = [];
			$ret += ['xatolik' => "1"];
			$ret += ['xabar' => "Taqiqlangan so'rov"];
			$ret += ['_csrf' => $_SESSION['_csrf']];
			echo json_encode($ret);
		
    exit;
	}
?>
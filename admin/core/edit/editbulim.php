<?
	session_start();
	if (isset($_GET['idx']) && isset($_GET['name']) && isset($_GET['kadrbulimi_id']) &&isset($_GET['izoh'])   ) {
		$ret = [];
		if($_GET['_csrf']!=$_SESSION['_csrf']){
			$ret += ['xatolik' => "1"];
			$ret += ['xabar' => "Taqiqlangan so'rov"];
			$ret += ['_csrf' => $_SESSION['_csrf']];
		}
		else{
			$_SESSION['_csrf'] = md5(time());
			require '../../model.php';
			$id = filter($_GET['idx']);
			$name = filter($_GET['name']);
			$kadrbulimi_id = filter($_GET['kadrbulimi_id']);
			$izoh = filter($_GET['izoh']);
			$fetch = Functions::editbulim($id,$name,$kadrbulimi_id,$izoh);
			if ($fetch) {
			$ret += ['xatolik' => "0"];
			$ret += ['xabar' => "Ma'lumot taxrirlandi!"];
			$ret += ['_csrf' => $_SESSION['_csrf']];
			}else{
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
			$ret += ['xabar' => "Ma'lumot yetarli emas"];
			$ret += ['_csrf' => $_SESSION['_csrf']];
			echo json_encode($ret);
		

    exit;
	}
?>
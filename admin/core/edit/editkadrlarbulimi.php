<?
	session_start();
	if (isset($_GET['id']) && isset($_GET['newname'])) {
		$ret = [];

		if($_GET['_csrf']!=$_SESSION['_csrf']){
			$ret += ['xatolik' => "1"];
			$ret += ['xabar' => "Taqiqlangan so'rov"];
			$ret += ['_csrf' => $_SESSION['_csrf']];
		}
		else{
			$_SESSION['_csrf'] = md5(time());
			require '../../model.php';
			$id = filter($_GET['id']);
			$name = filter($_GET['newname']);
			 
			$fetch = Functions::editkadrlarbulimi($id,$name);
			if ($fetch) {
			$ret += ['xatolik' => "0"];
			$ret += ['xabar' => "Ma'lumot Taxrirlandi!"];
			$ret += ['_csrf' => $_SESSION['_csrf']];
			}
			else{
			$ret += ['xatolik' => "1"];
			$ret += ['xabar' => "Nimadur xato ketdi"];
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
		
	}
?>
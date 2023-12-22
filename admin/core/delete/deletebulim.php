<?
	session_start();
	if (isset($_GET['id'])) {
		$ret = [];

		if($_GET['_csrf']!=$_SESSION['_csrf']){
			$ret += ['xatolik' => "1"];
			$ret += ['xabar' => "Taqiqlangan so'rov"];
			$ret += ['_csrf' => $_SESSION['_csrf']];
		}
		else{
			$_SESSION['_csrf'] = md5(time());
			require '../../model.php';
			$name = filter($_GET['id']);
			 
			$fetch = Functions::deletebulim($name);
			if ($fetch) {
			$ret += ['xatolik' => "0"];
			$ret += ['xabar' => "Ma'lumot o`chirildi!"];
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
?>
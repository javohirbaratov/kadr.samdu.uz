<?
	session_start();
	if (isset($_GET['familya']) && isset($_GET['ism']) &&isset($_GET['otch']) &&isset($_GET['login']) &&isset($_GET['email']) &&isset($_GET['parol']) && isset($_GET['telefon'] ) && isset($_GET['rol'])   && isset($_GET['telegram_id'])  ) {
		$ret = [];

		if($_GET['_csrf']!=$_SESSION['_csrf']){
			$ret += ['xatolik' => "1"];
			$ret += ['xabar' => "Taqiqlangan so'rov"];
			$ret += ['_csrf' => $_SESSION['_csrf']];
		}
		else{
			$_SESSION['_csrf'] = md5(time());
			require '../model.php';
			$familya = filter($_GET['familya']);
			$ism = filter($_GET['ism']);
			$otch = filter($_GET['otch']);
			$login = filter($_GET['login']);
			$email = filter($_GET['email']);
			$parol = md5($_GET['parol']);
			$telefon = filter($_GET['telefon']);
			$rol = filter($_GET['rol']);
			$telegram_id = filter($_GET['telegram_id']);
			$fetch = Functions::addadmin($familya,$ism,$otch,$login,$email,$parol,$telefon,$rol,$telegram_id);
			if ($fetch) {
			$ret += ['xatolik' => "0"];
			$ret += ['xabar' => "Ma'lumot kiritildi!"];
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
			$ret += ['xabar' => "Taqiqlangan so'rov"];
			$ret += ['_csrf' => $_SESSION['_csrf']];
			echo json_encode($ret);
		

    exit;
	}
?>
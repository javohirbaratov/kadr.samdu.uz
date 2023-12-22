<?
	session_start();
	if (isset($_GET['teacher_id']) && isset($_GET['kadr_bulimi_id']) &&isset($_GET['lavozim_id']) &&isset($_GET['asosiy']) &&isset($_GET['ichki']) &&isset($_GET['tashqi']) && isset($_GET['soatbay'] ) && isset($_GET['sana'])   && isset($_GET['buyruqsana']) && isset($_GET['buyruqraqam'])   && isset($_GET['kontraktnomer'])  ) {
		$ret = [];

		if($_GET['_csrf']!=$_SESSION['_csrf']){
			$ret += ['xatolik' => "1"];
			$ret += ['xabar' => "Taqiqlangan so'rov"];
			$ret += ['_csrf' => $_SESSION['_csrf']];
		}
		else{
			$_SESSION['_csrf'] = md5(time());
			require '../model.php';
			$teacher_id = filter($_GET['teacher_id']);
			$kadr_bulimi_id = filter($_GET['kadr_bulimi_id']);
			$lavozim_id = filter($_GET['lavozim_id']);
			$asosiy = filter($_GET['asosiy']);
			$ichki = filter($_GET['ichki']);
			$tashqi = filter($_GET['tashqi']);
			$soatbay = filter($_GET['soatbay']);
			$sana = filter($_GET['sana']);
			$buyruqraqam = filter($_GET['buyruqraqam']);
			$kontraktnomer = filter($_GET['kontraktnomer']);
			$buyruqsana = filter($_GET['buyruqsana']);
			$fetch = Functions::addshtat($teacher_id,$kadr_bulimi_id,$lavozim_id,$asosiy,$ichki,$tashqi,$soatbay,$sana,$buyruqsana,$kontraktnomer,$buyruqraqam);
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
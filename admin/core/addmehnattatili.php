<?
	session_start();
	if (isset($_POST['user_id']) && isset($_POST['bulim_id']) && isset($_POST['shtat']) && isset($_POST['yil']) && isset($_POST['kun']) && isset($_POST['sanadan']) && isset($_POST['sanagacha']) ) {
		$ret = [];
		if($_POST['_csrf']!=$_SESSION['_csrf']){
			$ret += ['xatolik' => "1"];
			$ret += ['xabar' => "Taqiqlangan so'rov"];
			$ret += ['_csrf' => $_SESSION['_csrf']];
		}
		else{
			$_SESSION['_csrf'] = md5(time());
			require '../model.php';
			$user_id = filter($_POST['user_id']);
			$braqam = filter($_POST['braqam']);
			$bulim_id = filter($_POST['bulim_id']);
			$shtat = filter($_POST['shtat']);
			$yil = filter($_POST['yil']);
			$kun = filter($_POST['kun']);
			$sanadan = filter($_POST['sanadan']);
			$sanagacha = filter($_POST['sanagacha']);
			$sana = filter($_POST['sana']);
			  $file='';
			  if (isset($_FILES['file'])) {
		    $target_dir="../../docs/mehnattatili/";
		    $y=md5(time());
		    $tip = strtolower(pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION));
		    $_FILES["file"]["name"]="mehnattatili_".$y.".".$tip;
		    $target_file=$target_dir.basename($_FILES["file"]["name"]);
			if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file))
				$file=$_FILES["file"]["name"];
			}
 
			$fetch = Functions::addmehnattatili($braqam,$user_id,$bulim_id,$shtat,$yil,$kun,$sanadan,$sanagacha,$sana,$file);
			if ($fetch) {
			$ret += ['xatolik' => "0"];
			$ret += ['xabar' => "Ma'lumot Taxrirlandi!"];
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
			$ret += ['xabar' => "1Ma'lumot yetarli emas"];
			$ret += ['_csrf' => $_SESSION['_csrf']];
			echo json_encode($ret);
		
    exit;
	}
?>
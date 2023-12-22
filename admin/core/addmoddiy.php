<?
	session_start();
	if (isset($_POST['user_id']) && isset($_POST['sana'] ) && isset($_POST['buyruq'])  ) {
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
			$sana = filter($_POST['sana']);
			$buyruq = filter($_POST['buyruq']);
			
			  $file='';
			  if (isset($_FILES['file'])) {
		    $target_dir="../../docs/moddiy/";
		    $y=md5(time());
		    $tip = strtolower(pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION));
		    $_FILES["file"]["name"]="moddiy_".$y.".".$tip;
		    $target_file=$target_dir.basename($_FILES["file"]["name"]);
			if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file))
				$file=$_FILES["file"]["name"];
			}
 
			$fetch = Functions::addmoddiy($user_id,$sana,$buyruq,$file);
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
			$ret += ['xabar' => "Ma'lumot yetarli emas"];
			$ret += ['_csrf' => $_SESSION['_csrf']];
			echo json_encode($ret);
		
    exit;
	}
?>
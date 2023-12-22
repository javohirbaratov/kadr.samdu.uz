<?
	session_start();
	if (isset($_POST['user_id']) && isset($_POST['tur_id']) &&isset($_POST['seriya']) &&isset($_POST['berilgan']) &&isset($_POST['otm']) &&isset($_POST['talimturi']) &&isset($_POST['raqam']) &&isset($_POST['givedate']) && isset($_POST['mname'] ) && isset($_POST['mshifr'])  ) {
		$ret = [];

		if($_POST['_csrf']!=$_SESSION['_csrf']){
			$ret += ['xatolik' => "1"];
			$ret += ['xabar' => "Taqiqlangan so'rov"];
			$ret += ['_csrf' => $_SESSION['_csrf']];
		}
		else{
			$_SESSION['_csrf'] = md5(time());
			require '../../model.php';
			$user_id = filter($_POST['user_id']);
			$tur_id = filter($_POST['tur_id']);
			$seriya = filter($_POST['seriya']);
			$berilgan = filter($_POST['berilgan']);
			$raqam = filter($_POST['raqam']);
			$givedate = filter($_POST['givedate']);
			$otm = filter($_POST['otm']);
			$id = filter($_POST['id']);
			$talimturi = filter($_POST['talimturi']);
			$mname = filter($_POST['mname']);
			$mshifr = filter($_POST['mshifr']);
			
			  $file='';
			  if (isset($_FILES['file'])) {
		    $target_dir="../../../docs/diplom/";
		    $y=md5(time());
		    $tip = strtolower(pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION));
		    $_FILES["file"]["name"]="diplom_".$y.".".$tip;
		    $target_file=$target_dir.basename($_FILES["file"]["name"]);
			if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file))
				$file=$_FILES["file"]["name"];
			}

		   $ilova='';
			  if (isset($_FILES['ilova'])) {
		    $target_dir="../../../docs/ilova/";
		    $y=md5(time());
		    $tip = strtolower(pathinfo($_FILES["ilova"]["name"],PATHINFO_EXTENSION));
		    $_FILES["ilova"]["name"]="ilova_".$y.".".$tip;
		    $target_file=$target_dir.basename($_FILES["ilova"]["name"]);
			if (move_uploaded_file($_FILES["ilova"]["tmp_name"], $target_file))
				$ilova=$_FILES["ilova"]["name"];
			}
			$fetch = Functions::editdiplom($id,$user_id,$tur_id,$seriya,$berilgan,$otm,$talimturi,$raqam,$givedate,$mname,$mshifr,$ilova,$file);
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
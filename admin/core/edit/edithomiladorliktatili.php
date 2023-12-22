<?
	session_start();
	if (isset($_POST['user_id']) && isset($_POST['bulim_id']) && isset($_POST['lavozim']) && isset($_POST['sanadan']) && isset($_POST['sanagacha']) ) {
		$ret = [];
		if($_POST['_csrf']!=$_SESSION['_csrf']){
			$ret += ['xatolik' => "1"];
			$ret += ['xabar' => "Taqiqlangan so'rov"];
			$ret += ['_csrf' => $_SESSION['_csrf']];
		}
		else{
			$_SESSION['_csrf'] = md5(time());
			require '../../model.php';
			$id = filter($_POST['id']);
			$braqam = filter($_POST['braqam']);
			$user_id = filter($_POST['user_id']);
			$bulim_id = filter($_POST['bulim_id']);
			$lavozim = filter($_POST['lavozim']);
			$sanadan = filter($_POST['sanadan']);
			$sanagacha = filter($_POST['sanagacha']);
			  $file='';
			  if (isset($_FILES['file'])) {
		    $target_dir="../../../docs/mehnattatili/";
		    $y=md5(time());
		    $tip = strtolower(pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION));
		    $_FILES["file"]["name"]="mehnattatili_".$y.".".$tip;
		    $target_file=$target_dir.basename($_FILES["file"]["name"]);
			if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file))
				$file=$_FILES["file"]["name"];
			}
 
			$fetch = Functions::edithomiladorliktatili($id,$braqam,$user_id,$bulim_id,$lavozim,$sanadan,$sanagacha,$file);
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
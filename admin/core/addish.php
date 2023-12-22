<?
	session_start();
	if (isset($_POST['user_id']) && isset($_POST['malumot']) &&isset($_POST['sana']) &&isset($_POST['muddati']) &&isset($_POST['sinov']) &&isset($_POST['kadr_bulim_id']) &&isset($_POST['bulim_id']) &&isset($_POST['lavozim']) && isset($_POST['urindosh'] ) && isset($_POST['buyruq'])  ) {
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
			$malumot = filter($_POST['malumot']);
          	$shartnomaraqam = filter($_POST['shartnomaraqam']);
			$sana = filter($_POST['sana']);
			$shtat = filter($_POST['shtat']);
			$muddati = filter($_POST['muddati']);
			$muddattype = filter($_POST['muddattype']);
			$bulim_id = filter($_POST['bulim_id']);
			$kafedra_id = filter($_POST['kafedra_id']);
			$lavozim = filter($_POST['lavozim']);
			$sinov = filter($_POST['sinov']);
			$kadr_bulim_id = filter($_POST['kadr_bulim_id']);
			$urindosh = filter($_POST['urindosh']);
			$buyruq = filter($_POST['buyruq']);

			  $file='';
			  if (isset($_FILES['ariza'])) {
		    $target_dir="../../docs/ariza/";
		    $y=md5(time());
		    $tip = strtolower(pathinfo($_FILES["ariza"]["name"],PATHINFO_EXTENSION));
		    $_FILES["ariza"]["name"]="ariza_".$y.".".$tip;
		    $target_file=$target_dir.basename($_FILES["ariza"]["name"]);
			if (move_uploaded_file($_FILES["ariza"]["tmp_name"], $target_file))
				$file=$_FILES["ariza"]["name"];
			}
			$fetch = Functions::addish($user_id,$malumot,$shtat,$sana,$muddati,$muddattype,$sinov,$kadr_bulim_id,$bulim_id,$kafedra_id,$lavozim,$urindosh,$buyruq,$file,$shartnomaraqam);
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

<?

	session_start();
	if (isset($_POST['familya']) && isset($_POST['ism']) && isset($_POST['otch']) && isset($_POST['jshir']) && isset($_POST['inn']) && isset($_POST['seriya']) && isset($_POST['nomer']) && isset($_POST['pasportdate']) && isset($_POST['pasportjoy']) && isset($_POST['pasportenddate']) && isset($_POST['birthdate']) && isset($_POST['birthplace']) && isset($_POST['jinsi']) && isset($_POST['millati']) && isset($_POST['fuqaroligi']) && isset($_POST['partiyaviyligi']) && isset($_POST['xarbiy'])  && isset($_POST['tkmuddati']) && isset($_POST['manzil']) && isset($_POST['doimiy']) && isset($_POST['telefon']) && isset($_POST['telegram_id']) && isset($_POST['pochta'])  && isset($_POST['oilaviyahvoli']) && isset($_POST['viloyat_id']) && isset($_POST['tuman_id']) ){
		$ret = [];

		if($_POST['_csrf']!=$_SESSION['_csrf']){
			$ret += ['xatolik' => "1"];
			$ret += ['xabar' => "Taqiqlangan so'rov"];
			$ret += ['_csrf' => $_SESSION['_csrf']];
		}
		else{
			$_SESSION['_csrf'] = md5(time());
			require '../../model.php';
			 $familya = filter($_POST['familya']);
			 $id = filter($_POST['id']);
			 $ism = filter($_POST['ism']);
			 $otch = filter($_POST['otch']);
			 $jshir = filter($_POST['jshir']);
			 $inn = filter($_POST['inn']);
			 $seriya = filter($_POST['seriya']);
			 $nomer = filter($_POST['nomer']);
			 $pasportdate = filter($_POST['pasportdate']);
			 $pasportjoy = filter($_POST['pasportjoy']);
			 $pasportenddate = filter($_POST['pasportenddate']);
			 $birthdate = filter($_POST['birthdate']);
			 $birthplace = filter($_POST['birthplace']);
			 $jinsi = filter($_POST['jinsi']);
			 $millati = filter($_POST['millati']);
			 $fuqaroligi = filter($_POST['fuqaroligi']);
			 $partiyaviyligi = filter($_POST['partiyaviyligi']);
			 $xarbiy = filter($_POST['xarbiy']);
			 $tkmuddati = filter($_POST['tkmuddati']);
			 $doimiy = filter($_POST['doimiy']);
			 $telefon = filter($_POST['telefon']);
			 $manzil = filter($_POST['manzil']);
			 $telegram_id = filter($_POST['telegram_id']);
			 $pochta = filter($_POST['pochta']);
			 $oilaviyahvoli = filter($_POST['oilaviyahvoli']);
			 $viloyat_id = filter($_POST['viloyat_id']);
			 $tuman_id = filter($_POST['tuman_id']);
			  /*fileni tekshiramiz*/
			  $rasm='';

			  if (isset($_FILES['rasm'])) {
		    $target_dir="../../../docs/rasm/";
		    $y=md5(time());
		    $tip = strtolower(pathinfo($_FILES["rasm"]["name"],PATHINFO_EXTENSION));
		    $_FILES["rasm"]["name"]="rasm_".$y.".".$tip;
		    $target_file=$target_dir.basename($_FILES["rasm"]["name"]);
			if (move_uploaded_file($_FILES["rasm"]["tmp_name"], $target_file))
				$rasm=$_FILES["rasm"]["name"];
			}
		      $passport='';

			  if (isset($_FILES['passport'])) {
		    $target_dir="../../../docs/passport/";
		    $y=md5(time());
		    $tip = strtolower(pathinfo($_FILES["passport"]["name"],PATHINFO_EXTENSION));
		    $_FILES["passport"]["name"]="passport_".$y.".".$tip;
		    $target_file=$target_dir.basename($_FILES["passport"]["name"]);
			if (move_uploaded_file($_FILES["passport"]["tmp_name"], $target_file))
				$passport=$_FILES["passport"]["name"];
			}
		      $tkguvohnoma='';

			  if (isset($_FILES['tkguvohnoma'])) {
		    $target_dir="../../../docs/tkguvohnoma/";
		    $y=md5(time());
		    $tip = strtolower(pathinfo($_FILES["tkguvohnoma"]["name"],PATHINFO_EXTENSION));
		    $_FILES["tkguvohnoma"]["name"]="tkguvohnoma_".$y.".".$tip;
		    $target_file=$target_dir.basename($_FILES["tkguvohnoma"]["name"]);
			if (move_uploaded_file($_FILES["tkguvohnoma"]["tmp_name"], $target_file))
				$tkguvohnoma=$_FILES["tkguvohnoma"]["name"];
			}
		    
			$fetch = Functions::editxodim($id,$familya, $ism, $otch, $jshir, $inn, $seriya, $nomer, $pasportdate, $pasportjoy, $pasportenddate, $passport, $birthdate, $birthplace, $jinsi, $millati, $fuqaroligi, $partiyaviyligi, $xarbiy, $tkmuddati, $tkguvohnoma, $manzil, $doimiy, $telefon, $telegram_id, $pochta, $rasm,  $oilaviyahvoli, $viloyat_id, $tuman_id);

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
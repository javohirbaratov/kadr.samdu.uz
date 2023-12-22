<?php
error_reporting(0);
include_once 'ximoya.php';
function fileuchir($filearr){
	foreach ($filearr as $key => $value) {
		unlink("../bot/uploads/".$value);
	}
}
$ret = [];
$asli = new Cyber();
$userdata = $asli->getdata('xodim_temp',['id'=>$_SESSION['id']]);

$asli->begintranz();
$sqlpost = $asli->update('xodim_temp',[
	'familya' => $_POST['familya'],
	'ism' => $_POST['ism'],
	'otch' => $_POST['otch'],
	'jshir' => $_POST['jshir'],
	'nomer' => $_POST['nomer'],
	'pasportdate' => $_POST['pasportdate'],
	'pasportenddate' => $_POST['pasportenddate'],
	'pasportjoy' => $_POST['pasportjoy'],
	'oilaviyahvoli' => $_POST['oilaviyahvoli'],
	'viloyat_id' => $_POST['viloyat_id'],
	'tuman_id' => $_POST['tuman_id'],
	'millati' => $_POST['millati'],
	'fuqaroligi' => $_POST['fuqaroligi'],
	'partiyaviyligi' => $_POST['partiyaviyligi'],
	'xarbiy' => $_POST['xarbiy'],
	'birthdate' => $_POST['birthdate'],
	'jinsi' => $_POST['jinsi'],
	'mjshaxs' => $_POST['mjshaxs'],
	'manzil' => $_POST['manzil'],
	'doimiy' => $_POST['doimiy'],
	'telefon' => $_POST['telefon'],
	'telegram_id' => $_POST['telegram_id'],
	'pochta' => $_POST['pochta'],
	'chettili' => $_POST['chettili'],
	'davlatmukofoti' => $_POST['davlatmukofoti'],
	'idoramukofoti' => $_POST['idoramukofoti'],
	'malakatashkilot' => $_POST['malakatashkilot'],
	'malakayunalish' => $_POST['malakayunalish'],
	'malakadavr' => $_POST['malakadavr'],
	'malakadavr2' => $_POST['malakadavr2'],
	'status' => "checked",
    'update_at' => date('d-m-y h:i:s')
],['id'=>$_SESSION['id']]);

if($sqlpost){
	$path = "../bot/uploads/";
	$sizeok = true;
	$remove_file_array = array();
	$temp_file_array = array();
	foreach ($_FILES as $key => $value) {
		if(($_FILES[$key]['size']/1024/1024)>2){
			$sizeok = false;
			break;
		}
	}
	if($sizeok){		
		foreach ($_FILES as $key => $value) {
			if($_FILES[$key]['name']!=""){
				array_push($remove_file_array, $userdata[$key]);				
			}
		}
		$typefileok = true;
		$uploadfileok = true;
		$update_file_db = true;
		if($_FILES['rasm']['name']!=""){
			if($_FILES['rasm']['type']!="image/jpeg"){
				$typefileok = false;	
			}
			else{
				$rasex = pathinfo($_FILES['rasm']['name'], PATHINFO_EXTENSION);
				$rasm = 'R'.md5(time().uniqid()).'.'.$rasex;
				if(move_uploaded_file($_FILES['rasm']['tmp_name'],$path.$rasm)){
					array_push($temp_file_array,$rasm);
					$t = $asli->update('xodim_temp',[
						'rasm' => $rasm
					],['id'=>$_SESSION['id']]);
					if(!$t){
						$update_file_db = false;
					}
				}
				else{
					$uploadfileok = false;
				}				
			}
		}
		if($_FILES['obyektivka']['name']!=""){
			$obex = pathinfo($_FILES['obyektivka']['name'], PATHINFO_EXTENSION);
			if($obex!="doc" && $obex!="docx"){
				$typefileok = false;
			}
			else{
				$obex = pathinfo($_FILES['obyektivka']['name'], PATHINFO_EXTENSION);
				$obyektivka = 'O'.md5(time().uniqid()).'.'.$obex;
				if(move_uploaded_file($_FILES['obyektivka']['tmp_name'],$path.$obyektivka)){
					array_push($temp_file_array,$obyektivka);
					$t = $asli->update('xodim_temp',[
						'obyektivka' => $obyektivka
					],['id'=>$_SESSION['id']]);
					if(!$t){
						$update_file_db = false;
					}
				}
				else{
					$uploadfileok = false;
				}				
			}
		}
		if($_FILES['tarjimayi_hol']['name']!=""){
			if($_FILES['tarjimayi_hol']['type']!="application/pdf"){
				$typefileok = false;	
			}
			else{
				$tarjex = pathinfo($_FILES['tarjimayi_hol']['name'], PATHINFO_EXTENSION);
				$tarjimayi_hol = 'T'.md5(time().uniqid()).'.'.$tarjex;
				if(move_uploaded_file($_FILES['tarjimayi_hol']['tmp_name'],$path.$tarjimayi_hol)){
					array_push($temp_file_array,$tarjimayi_hol);
					$t = $asli->update('xodim_temp',[
						'tarjimayi_hol' => $tarjimayi_hol
					],['id'=>$_SESSION['id']]);
					if(!$t){
						$update_file_db = false;
					}
				}
				else{
					$uploadfileok = false;
				}				
			}
		}
		if($_FILES['xguvohnoma']['name']!=""){			
			if($_FILES['xguvohnoma']['type']!="application/pdf"){				
				$typefileok = false;
			}
			else{
				$hgex = pathinfo($_FILES['xguvohnoma']['name'], PATHINFO_EXTENSION);
				$xguvohnoma = 'H'.md5(time().uniqid()).'.'.$hgex;
				if(move_uploaded_file($_FILES['xguvohnoma']['tmp_name'],$path.$xguvohnoma)){
					array_push($temp_file_array,$xguvohnoma);
					$t = $asli->update('xodim_temp',[
							'xguvohnoma' => $xguvohnoma
						],['id'=>$_SESSION['id']]);
					if(!$t){
						$update_file_db = false;
					}
				}
				else{
					$uploadfileok = false;
				}				
			}			
		}
		if($_FILES['paspdf']['name']!=""){
			if($_FILES['paspdf']['type']!="application/pdf"){
				$typefileok = false;	
			}
			else{
				$pasex = pathinfo($_FILES['paspdf']['name'], PATHINFO_EXTENSION);
				$paspdf = 'P'.md5(time().uniqid()).'.'.$pasex;
				if(move_uploaded_file($_FILES['paspdf']['tmp_name'],$path.$paspdf)){
					array_push($temp_file_array,$paspdf);
					$t = $asli->update('xodim_temp',[
							'passport' => $paspdf
						],['id'=>$_SESSION['id']]);
					if(!$t){
						$update_file_db = false;
					}
				}
				else{
					$uploadfileok = false;
				}				
			}
		}
		for ($i=1; $i < 12; $i++) { 
			$d = "diplom".$i;
			if($_FILES[$d]['name']!=""){
				if($_FILES[$d]['type']!="application/pdf"){
					$typefileok = false;
					break;
				}
				else{
					$df = pathinfo($_FILES[$d]['name'], PATHINFO_EXTENSION);
					$df = 'D'.$i.'_'.md5(time().uniqid()).'.'.$df;
					if(move_uploaded_file($_FILES[$d]['tmp_name'],$path.$df)){
						array_push($temp_file_array,$df);
						$fupdate = $asli->update('xodim_temp',[
										'diplom'.$i => $df
									],['id'=>$_SESSION['id']]);
						if(!$fupdate){
							$update_file_db = false;
						}
					}
					else{						
						$uploadfileok = false;
					}				
				}
			}			
		}
		if($typefileok){
			if($uploadfileok){
				if($update_file_db){
					fileuchir($remove_file_array);				
					$asli->endtranz();
					$ret += ["xatolik" => 0, "xabar" => "Malumotlar muvaffaqqiyatli tahrirlandi!"];	
				}
				else{
					fileuchir($temp_file_array);
					$asli->bekor();
					$ret += ["xatolik" => 1, "xabar" => "Kechirasiz malumotlar yozishda ichki xatoli yuz berdi!"];	
				}
			}
			else{
				fileuchir($temp_file_array);
				$asli->bekor();
				$ret += ["xatolik" => 1, "xabar" => "Kechirasiz file yuklanmadi iltimos qaytadan urining!"];
			}
		}
		else{
			fileuchir($temp_file_array);
			$asli->bekor();
			$ret += ["xatolik" => 1, "xabar" => "Kechirasiz file turini to'g'ri kelmadi iltimos belgilangan turdagi fileni tanlang"];
		}		
	}
	else{
		$asli->bekor();
		$ret += ["xatolik" => 1, "xabar" => "Kechirasiz yuklayotgan fileizngiz hajmi 2Mbdan katta bo'lmasin!"];
	}
}
else{
	$asli->bekor();
	$ret += ["xatolik" => 1, "xabar" => "Kechirasiz malumot tahrirlanmadi. Adminga xabar bering!"];
}


echo json_encode($ret );

?>
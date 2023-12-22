<?php
include_once 'ximoya.php';

$ret = [];

if($_SESSION['_csrf']!=$_POST['_csrf']){
	$ret += ["xatolik" => 1, "xabar" => "Brauzerni yangilab qayatadan urinib ko'ring. Taqiqlangan harakat amalga oshirildi!!!!"];
	echo json_encode($ret);
	exit;
}
// mysqli_begin_transaction($link);
// mysqli_commit($link);
// mysqli_rollback($link);

$ret += ["_csrf" => md5(time())];

$surov = mysqli_query($link,"SELECT * FROM xodim_temp WHERE id='$id'");
$xodim = mysqli_fetch_assoc($surov);

$names = "";
$i = 0;
$id = $_POST['id'];
$n = count($_POST);
$filearr = array();
if(isset($_POST['familya'])){
	mysqli_begin_transaction($link);
	foreach ($_POST as $key => $value) {
		$i++;
		if($key == "id"){
			continue;
		}
		if($i>=$n){
			$names .= "$key";
			$names .= "='".filter($value)."'";
		}
		else{
			$names .= "$key";
			$names .= "='".filter($value)."',";
		}		
	}
	$sql = "UPDATE xodim_temp $names WHERE id='$id'";
}
else{
	$ret += ["xatolik" => 1, "xabar" => "Malumotlar mos kelmayapti barcha maydonlarni to'ldiring"];
	echo json_encode($ret);
	exit;
}
$query = mysqli_query($link,"$sql");

$path = "bot/uploads/";


if($_FILES['paspdf']['name']!=""){
	if($_FILES['paspdf']['type']!="application/pdf" || $_FILES['paspdf']['size']/(1024*1024)>2){
		$ret += ["xatolik" => 1, "xabar" => "Kechirasi passport pdf formatida bo'lishi kerak va hajmi 2MB dan oshmasin"];
		echo json_encode($ret);
		exit;
	}
	else{
		$pasex = pathinfo($_FILES['paspdf']['name'], PATHINFO_EXTENSION);
		$paspdf = 'P'.md5(time().uniqid()).'.'.$pasex;
		if(move_uploaded_file($_FILES['paspdf']['tmp_name'], $path.$paspdf)){
			$passport = $xodim['passport'];
			array_push($filearr, $xodim['passport']);
			$sql = mysqli_query($link,"UPDATE xodim_temp SET passport='$passport' WHERE id='$id'");		
		}
		else{
			mysqli_rollback($link);
			$ret += ["xatolik" => 1, "xabar" => "Kechirasiz pasport yuklanmadi. Yuklanishda xatolik."];
			echo json_encode($ret);
			exit;
		}
	}
}
if($_FILES['rasm']['name']!=""){
	if($_FILES['rasm']['type'] != "image/jpeg" || $_FILES['rasm']['size']/(1024*1024)>2){
		$ret += ["xatolik" => 1, "xabar" => "Kechirasi passport jpg formatida bo'lishi kerak va hajmi 2MB dan oshmasin"];
		echo json_encode($ret);
		exit;
	}
	else{
		$pasex = pathinfo($_FILES['rasm']['name'], PATHINFO_EXTENSION);
		$rasm = 'R'.md5(time().uniqid()).'.'.$pasex;
		if(move_uploaded_file($_FILES['rasm']['tmp_name'], $path.$rasm)){
			$rasm = $xodim['rasm'];
			array_push($filearr, $xodim['rasm']);
			$sql = mysqli_query($link,"UPDATE xodim_temp SET rasm='$rasm' WHERE id='$id'");		
		}
		else{
			mysqli_rollback($link);
			$ret += ["xatolik" => 1, "xabar" => "Kechirasiz pasport yuklanmadi. Yuklanishda xatolik."];
			echo json_encode($ret);
			exit;
		}
	}
}
if($_FILES['obyektivka']['name']!=""){
	$obex = pathinfo($_FILES['obyektivka']['name'], PATHINFO_EXTENSION);
	if(($obex!="doc" && $obex!="docx") || $_FILES['obyektivka']['size']/(1024*1024)>2){
		$ret += ["xatolik" => 1, "xabar" => "Kechirasi passport jpg formatida bo'lishi kerak va hajmi 2MB dan oshmasin"];
		echo json_encode($ret);
		exit;
	}
	else{
		$pasex = pathinfo($_FILES['obyektivka']['name'], PATHINFO_EXTENSION);
		$obyektivka = 'O'.md5(time().uniqid()).'.'.$pasex;
		if(move_uploaded_file($_FILES['obyektivka']['tmp_name'], $path.$obyektivka)){
			$obyektivka = $xodim['obyektivka'];
			array_push($filearr, $xodim['obyektivka']);
			$sql = mysqli_query($link,"UPDATE xodim_temp SET obyektivka='$obyektivka' WHERE id='$id'");		
		}
		else{
			mysqli_rollback($link);
			$ret += ["xatolik" => 1, "xabar" => "Kechirasiz pasport yuklanmadi. Yuklanishda xatolik."];
			echo json_encode($ret);
			exit;
		}
	}
}
if($_FILES['tarjimayi_hol']['name']!=""){
	if($_FILES['tarjimayi_hol']['type']!="application/pdf" || $_FILES['tarjimayi_hol']['size']/(1024*1024)>2){
		$ret += ["xatolik" => 1, "xabar" => "Kechirasi passport jpg formatida bo'lishi kerak va hajmi 2MB dan oshmasin"];
		echo json_encode($ret);
		exit;
	}
	else{
		$pasex = pathinfo($_FILES['tarjimayi_hol']['name'], PATHINFO_EXTENSION);
		$tarjimayi_hol = 'T'.md5(time().uniqid()).'.'.$pasex;
		if(move_uploaded_file($_FILES['tarjimayi_hol']['tmp_name'], $path.$tarjimayi_hol)){
			$tarjimayi_hol = $xodim['tarjimayi_hol'];
			array_push($filearr, $xodim['tarjimayi_hol']);
			$sql = mysqli_query($link,"UPDATE xodim_temp SET tarjimayi_hol='$tarjimayi_hol' WHERE id='$id'");		
		}
		else{
			mysqli_rollback($link);
			$ret += ["xatolik" => 1, "xabar" => "Kechirasiz pasport yuklanmadi. Yuklanishda xatolik."];
			echo json_encode($ret);
			exit;
		}
	}
}
if($_FILES['xguvohnoma']['name']!=""){
	if($_FILES['xguvohnoma']['type']!="application/pdf" || $_FILES['xguvohnoma']['size']/(1024*1024)>2){
		$ret += ["xatolik" => 1, "xabar" => "Kechirasi passport jpg formatida bo'lishi kerak va hajmi 2MB dan oshmasin"];
		echo json_encode($ret);
		exit;
	}
	else{
		$pasex = pathinfo($_FILES['xguvohnoma']['name'], PATHINFO_EXTENSION);
		$xguvohnoma = 'T'.md5(time().uniqid()).'.'.$pasex;
		if(move_uploaded_file($_FILES['xguvohnoma']['tmp_name'], $path.$xguvohnoma)){
			$xguvohnoma = $xodim['xguvohnoma'];
			array_push($filearr, $xodim['xguvohnoma']);
			$sql = mysqli_query($link,"UPDATE xodim_temp SET xguvohnoma='$xguvohnoma' WHERE id='$id'");		
		}
		else{
			mysqli_rollback($link);
			$ret += ["xatolik" => 1, "xabar" => "Kechirasiz pasport yuklanmadi. Yuklanishda xatolik."];
			echo json_encode($ret);
			exit;
		}
	}
}

$diplom1 = ""; $diplom2 = ""; $diplom3 = ""; $diplom4 = ""; $diplom5 = ""; $diplom6 = ""; $diplom7 = ""; $diplom8 = ""; $diplom9 = ""; $diplom10 = ""; $diplom11 = "";
$kalit == 1;

function fileuchir($filearr){
	foreach ($filearr as $key => $value) {
		unlink($value);
	}
}
for ($i=1; $i <= 11; $i++) { 
	$d = "diplom".$i;
	if($_FILES[$d]['name']!=""){
		if(($_FILES[$d]['size']/(1024*1024)>2 || $_FILES[$d]['type']!="application/pdf") && $_FILES[$d]['name']!="") {
			mysqli_rollback($link);
			$ret += ["xatolik" => 1, "xabar" => "Kechirasiz diplomlar yuklanmadi. Yuklanishda xatolik."];
			echo json_encode($ret);
			exit;
		}
		else{
			$dex = pathinfo($_FILES[$d]['name'],PATHINFO_EXTENSION);
			$diplom = 'D'.$i.md5(time().uniqid()).'.'.$dex;
			$$d = $diplom;
			if(move_uploaded_file($_FILES[$d]['tmp_name'],$path.$diplom)){
				$xguvohnoma = $xodim['xguvohnoma'];
				array_push($filearr, $xodim[$d]);
				$sql = mysqli_query($link,"UPDATE xodim_temp SET $d='$d' WHERE id='$id'");
			}
			else{
				mysqli_rollback($link);
				$ret += ["xatolik" => 1, "xabar" => "Kechirasiz diplomlar yuklanmadi. Yuklanishda xatolik."];
				echo json_encode($ret);
				exit;
			}
		}
	}	
}

if($query){
	unset($_SESSION['_csrf']);
	$ret += ["xatolik" => 0, "xabar" => "Good Job!"];
}
else{
	fileuchir($filearr);
	$ret += ["xatolik" => 1, "xabar" => "Siz avval ro'yxatdan o'tgansiz!"];
}
mysqli_close($link);
echo json_encode($ret);

?>
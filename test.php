<?php
session_start();
include'config.php';
// echo json_encode($_POST);
// exit;
$ret = [];
if($_SESSION['_csrf']!=$_POST['_csrf']){
	$ret += ["xatolik" => 1, "xabar" => "Brauzerni yangilab qayatadan urinib ko'ring. Taqiqlangan harakat amalga oshirildi!!!!"];
	echo json_encode($ret);
	exit;
}
if($_FILES['paspdf']['type']!="application/pdf"){
	$ret += ["xatolik" => 1, "xabar" => "Kechirasi passport pdf formatida bo'lishi kerak"];
	echo json_encode($ret);
	exit;
}
if($_FILES['paspdf']['size']/(1024*1024)>2){
	$ret += ["xatolik" => 1, "xabar" => "Kechirasiz pasport 2Mbdan oshmasin"];
	echo json_encode($ret);
	exit;
}
if($_FILES['rasm']['type']!="image/jpeg"){
	$ret += ["xatolik" => 1, "xabar" => "Kechirasi rasm JPG formatida bo'lishi kerak"];
	echo json_encode($ret);
	exit;
}
if($_FILES['rasm']['size']/(1024*1024)>2){
	$ret += ["xatolik" => 1, "xabar" => "Kechirasiz rasm 2Mbdan oshmasin"];
	echo json_encode($ret);
	exit;
}
$obex = pathinfo($_FILES['obyektivka']['name'], PATHINFO_EXTENSION);
if($obex!="doc" && $obex!="docx"){
	$ret += ["xatolik" => 1, "xabar" => "Kechirasi obyektivka word formatida bo'lishi kerak"];
	echo json_encode($ret);
	exit;
}
if($_FILES['obyektivka']['size']/(1024*1024)>2){
	$ret += ["xatolik" => 1, "xabar" => "Kechirasiz obyektivka hajmi 2Mbdan oshmasin"];
	echo json_encode($ret);
	exit;
}
if($_FILES['tarjimayi_hol']['type']!="application/pdf"){
	$ret += ["xatolik" => 1, "xabar" => "Kechirasiz tarjimaiy hol pdf formatida bo'lishi kerak"];
	echo json_encode($ret);
	exit;
}
if($_FILES['tarjimayi_hol']['size']/(1024*1024)>2){
	$ret += ["xatolik" => 1, "xabar" => "Kechirasiz tarjimaiy hol 2Mbdan oshmasin"];
	echo json_encode($ret);
	exit;
}
// print_r($_FILES);
// print_r($_POST);
$pasex = pathinfo($_FILES['paspdf']['name'], PATHINFO_EXTENSION);
$rasex = pathinfo($_FILES['rasm']['name'], PATHINFO_EXTENSION);
$tarjex = pathinfo($_FILES['paspdf']['name'], PATHINFO_EXTENSION);

$paspdf = 'P'.md5(time().uniqid()).'.'.$pasex;
$rasm = 'R'.md5(time().uniqid()).'.'.$rasex;
$obyektivka = 'O'.md5(time().uniqid()).'.'.$obex;
$tarjimayi_hol = 'T'.md5(time().uniqid()).'.'.$tarjex;
$path = "bot/uploads/";
$xguvohnoma = "";
/*========================================*/

if($_POST['xguvohnoma']=="Ha"){
	if($_FILES['xguvohnoma']['type']!="application/pdf"){
		$ret += ["xatolik" => 1, "xabar" => "Kechirasiz harbiy guvohnoma pdf formatida bo'lishi kerak"];
		echo json_encode($ret);
		exit;
	}
	if($_FILES['xarbiy']['size']/(1024*1024)>2){
		$ret += ["xatolik" => 1, "xabar" => "Kechirasiz harbiy guvohnoma 2Mbdan oshmasin"];
		echo json_encode($ret);
		exit;
	}
	$hgex = pathinfo($_FILES['xarbiy']['name'], PATHINFO_EXTENSION);
	$xguvohnoma = 'H'.md5(time().uniqid()).'.'.$hgex;
	if(!move_uploaded_file($_FILES['xarbiy']['tmp_name'],$path.$xguvohnoma)){
		$ret += ["xatolik" => 1, "xabar" => "Kechirasiz harbiy guvohnoma yuklanmadi"];
		echo json_encode($ret);
		exit;
	}
}

$diplom1 = ""; $diplom2 = ""; $diplom3 = ""; $diplom4 = ""; $diplom5 = ""; $diplom6 = ""; $diplom7 = ""; $diplom8 = ""; $diplom9 = ""; $diplom10 = ""; $diplom11 = "";
$kalit == 1;
$filearr = array();
function fileuchir($filearr){
	foreach ($filearr as $key => $value) {
		unlink($value);
	}
}
for ($i=1; $i <= 11; $i++) { 
	$d = "diplom".$i;
	if($_FILES[$d]['name']!=""){
		if($_FILES[$d]['size']/(1024*1024)>2 || $_FILES[$d]['type']!="application/pdf") {
			$ret += ["xatolik" => 1, "xabar" => "Fayl yuklanmadi. Barcha diplomlar ilovasi bilan pdf formatda bo'lsin va hajmi 2MB dan oshmasin"];
			fileuchir($filearr);
			echo json_encode($ret);
			exit;
		}
		else{
			$dex = pathinfo($_FILES[$d]['name'],PATHINFO_EXTENSION);
			$diplom = 'D'.$i.md5(time().uniqid()).'.'.$dex;
			$$d = $diplom;
			if(move_uploaded_file($_FILES[$d]['tmp_name'],$path.$diplom)){
				$filearr[$d] = $path.$diplom;
			}
		}
	}	
}

$n = count($_POST);
$i = 1;
if(!(move_uploaded_file($_FILES['rasm']['tmp_name'],$path.$rasm) and move_uploaded_file($_FILES['paspdf']['tmp_name'],$path.$paspdf) and move_uploaded_file($_FILES['obyektivka']['tmp_name'],$path.$obyektivka) and move_uploaded_file($_FILES['tarjimayi_hol']['tmp_name'],$path.$tarjimayi_hol))){
	$ret += ["xatolik" => 1, "xabar" => "Fayl yuklanmadi"];	
	echo json_encode($ret);
	exit;
}

$names = "passport,rasm,obyektivka,tarjimayi_hol,diplom1,diplom2,diplom3,diplom4,diplom5,diplom6,diplom7,diplom8,diplom9,diplom10,diplom11,xguvohnoma,";
$qiymatlar = "'".$paspdf."','".$rasm."','".$obyektivka."','".$tarjimayi_hol."','$diplom1','$diplom2','$diplom3','$diplom4','$diplom5','$diplom6','$diplom7','$diplom8','$diplom9','$diplom10','$diplom11','$xguvohnoma',";
if(isset($_POST['familya'])){
	foreach ($_POST as $key => $value) {
		if($i==$n){
			$names .= "$key";
			$qiymatlar .= "'".filter($value)."'";	
		}
		else{
			$names .= "$key,";
			$qiymatlar .= "'".filter($value)."',";
		}
		$i++;
		// echo "$key -> $value \n";
	}
}
$sql = "INSERT INTO `xodim_temp` ($names) VALUES ($qiymatlar)";
/*========================================*/
$query = mysqli_query($link,"$sql");
// var_dump($query);

$ret += ["_csrf" => md5(time())];

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
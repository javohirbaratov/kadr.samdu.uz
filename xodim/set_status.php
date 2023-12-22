<? 
include_once 'ximoya.php';


$ret = [];
if(isset($_POST['refuse'])){
	$xabar = filter($_POST['xabar']);
	if ($xabar == "") {
		?>
		<script>alert('Rad etilish sababi kiritilmadi!!!');</script>
		<script> window.history.back();</script>
		<?
		exit();
	}
	$xodim_id = $_POST['xodim_id'];
	$telefon = filterphone($_POST['telefon']);
	$user_id = $_POST['user_id'];

	$msg = "Sizning kadr.samdu.uz ga kiritilgan ma'lumotlaringiz qabul qilinmadi. Malumot uchun +998995995452";


	$sql = mysqli_query($link, "UPDATE xodim_temp SET xabar='$xabar',check_user_id = '$user_id',status = 'refused' WHERE id='$xodim_id'");
	if ($sql==true) {
		if(sendmsg($telefon,$msg)){
			$zapros = mysqli_query($link," INSERT INTO msg (user_id, xodim_id, mes, telefon ) VALUES ('$user_id', '$xodim_id', '$xabar', '$telefon') ");
		}
		?>

		<script>alert('Bajarildi');</script>
		<script> window.history.back();</script>
		<?
	}
	else{
		?>
		<script>alert('Bajarilmadi');</script>
		<script> window.history.back();</script>
		<?
	}
}
elseif(isset($_POST['success'])){

	$xodim_id = $_POST['xodim_id'];
	$telefon = filterphone($_POST['telefon']);
	
	$user_id = $_POST['user_id'];


		//$msg = "Sizning kadr.samdu.uz ga kiritilgan ma'lumotlaringiz qabul qilinmadi. Malumot uchun +998995995452";

	$sql = mysqli_query($link, "UPDATE xodim_temp SET check_user_id = '$user_id',status = 'success',xabar =' ' WHERE id='$xodim_id'");
	if ($sql==true) {

		$surov = mysqli_query($link,"SELECT * FROM xodim_temp WHERE  id='$xodim_id' ");
		$x = mysqli_fetch_assoc($surov);
		$jshir = $x['jshir'];
		$surov1 = mysqli_query($link,"SELECT * FROM xodimlar WHERE  jshir='$jshir' ");
		$x1 = mysqli_fetch_assoc($surov1);

		if ($x['jshir'] == $x1['jshir']) {

			?>
			<script>alert('Ushbu xodim allaqachon qabul qilingan');</script>
			<script> window.history.back();</script>
			<?
			exit();
		}

		$familya = $x['familya'];
		$ism = $x['ism'];
		$otch = $x['otch'];

		$inn = $x['inn'];
		$seriya = $x['seriya'];
		$nomer = $x['nomer'];
		$pasportdate = $x['pasportdate'];
		$pasportjoy = $x['pasportjoy'];
		$pasportenddate = $x['pasportenddate'];
		$passport =$x['passport'];
		$birthdate = $x['birthdate'];
		$birthplace = $x['birthplace'];
		$jinsi = $x['jinsi'];
		$millati = $x['millati'];
		$fuqaroligi = $x['fuqaroligi'];
		$partiyaviyligi = $x['partiyaviyligi'];
		$xarbiy = $x['xarbiy'];
		$mjshaxs = $x['mjshaxs'];
		$tkmuddati = $x['tkmuddati'];
		$tkguvohnoma = $x['tkguvohnoma'];
		$manzil = $x['manzil'];
		$doimiy = $x['doimiy'];
		$telefon = $x['telefon'];
		$telegram_id = $x['telegram_id'];
		$pochta = $x['pochta'];
		$rasm = $x['rasm'];
		$oilaviyahvoli = $x['oilaviyahvoli'];
		$viloyat_id = $x['viloyat_id'];
		$tuman_id = $x['tuman_id'];
		$malumot = $x['malumot'];
		$tamomlagan = $x['tamomlagan'];
		$mutaxasis = $x['mutaxasis'];
		$tillar = $x['tillar'];
		$obyektivka =$x['obyektivka'];

		$zapros = mysqli_query($link,"INSERT INTO `xodimlar` (`id`, `familya`, `ism`, `otch`, `jshir`, `inn`, `seriya`, `nomer`, `pasportdate`, `pasportjoy`, `pasportenddate`, `passport`, `birthdate`, `birthplace`, `jinsi`, `millati`, `fuqaroligi`, `partiyaviyligi`, `xarbiy`, `mjshaxs`, `tkmuddati`, `tkguvohnoma`, `manzil`, `doimiy`, `telefon`, `telegram_id`, `pochta`, `rasm`, `oilaviyahvoli`, `viloyat_id`, `tuman_id`, `malumot`, `tamomlagan`, `mutaxasis`, `tillar`, `obyektivka`) VALUES (NULL, '$familya', '$ism', '$otch', '$jshir', '$inn', '$seriya', '$nomer', '$pasportdate', '$pasportjoy', '$pasportenddate', '$passport', '$birthdate', '$birthplace', '$jinsi', '$millati', '$fuqaroligi', '$partiyaviyligi', '$xarbiy', '$mjshaxs', '$tkmuddati', '$tkguvohnoma', '$manzil', '$doimiy', '$telefon', '$telegram_id', '$pochta', '$rasm', '$oilaviyahvoli', '$viloyat_id', '$tuman_id', '$malumot', '$tamomlagan', '$mutaxasis', '$tillar', '$obyektivka')");
		if ($zapros = true) {
			?>
			<script>alert('Bajarildi');</script>
			<script> window.history.back();</script>
			<?
			exit();
		}else{
			$sql = mysqli_query($link, "UPDATE xodim_temp SET check_user_id = '$user_id',status = 'nochecked',xabar =' ' WHERE id='$xodim_id'");
			?>
			<script>alert('Bajarilmadi');</script>
			<script> window.history.back();</script>
			<?
			exit();
		}


	}
	else{
		?>
		<script>alert('Bajarilmadi');</script>
		<script> window.history.back();</script>
		<?
		exit();
	}
}
else{
	exit("404! Sahifa topilmadi");

}

?>
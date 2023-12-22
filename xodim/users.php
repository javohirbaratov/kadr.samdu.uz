<?
	include_once 'ximoya.php';
	$ret = [];

	if($_POST['action']=='lavozim'){
		$id = $_POST['id'];
		$kadr_bulim_id = filter($_POST['kb_id']);
		$bulim_id = filter($_POST['bulim_id']);
		$bulinma_id = filter($_POST['bulinma']);
		$lavozim = filter($_POST['lavozim_name']);
		$turi = filter($_POST['turi']);
		$razryad = filter($_POST['razryad']);
		if($razryad==""){
			$razryad=0;
		}
		$tarifkoef = filter($_POST['koef']);
		if($tarifkoef==""){
			$tarifkoef=0;
		}
		$oylik = filter($_POST['oylik']);
		$shtat = filter($_POST['shtat']);

		$sql = mysqli_query($link,"UPDATE `lavozimlar` SET `lavozim` = '$lavozim', `kadr_bulim_id` = '$kadr_bulim_id', `bulim_id` = '$bulim_id', `kafedra_id` = '$bulinma_id', `soni` = '$shtat', `turi` = '$turi', `razryad` = '$razryad', `tarifkoef` = '$tarifkoef', `oylik` = '$oylik', `shtat` = '$shtat' WHERE `lavozimlar`.`id` = '$id'");
			if ($sql) {
				?>
				<script>alert('Bajarildi');</script>
				<script> window.location.href = 'lavozim.php';</script>
				<?
			}
			else{
				?>

				<script>alert('Xatolik');</script>
				<script> window.location.href = 'lavozim.php';</script>

				<?
			}


	}
	

	if($_POST['action']=='bulim'){
		$id = $_POST['id'];
		$kadr_bulim_id = filter($_POST['kadr_bulim_id']);
		$bulim_name = filter($_POST['bulim_name']);
		$shtat = filter($_POST['shtat']);

		$sql = mysqli_query($link,"UPDATE `bulimlar` SET `name` = '$bulim_name', `kadrbulimi_id` = '$kadr_bulim_id', `izoh` = '$bulim_name', `shtat` = '$shtat' WHERE `bulimlar`.`id` = '$id'");
			if ($sql) {
				?>
				<script>alert('Bajarildi');</script>
				<script> window.history.back();</script>
				<?
			}
			else{
				?>

				<script>alert('Xatolik');</script>
				<script> window.history.back();</script>

				<?
			}


	}

	if($_POST['action']=='bulinma'){
		$id = $_POST['id'];
		$kadr_bulim_id = filter($_POST['kb_id']);
		$bulim_id = filter($_POST['bulim_id']);
		$bulim_name = filter($_POST['bulim_name']);

		$sql = mysqli_query($link,"UPDATE `kafedra` SET `name` = '$bulim_name', `bulim_id` = '$bulim_id' WHERE `kafedra`.`id` = '$id'");
			if ($sql) {
				?>
				<script>alert('Bajarildi');</script>
				<script> window.history.go(-2);</script>
				<?
			}
			else{
				?>

				<script>alert('Xatolik');</script>
				<script> window.history.back();</script>

				<?
			}


	}

	if ($_POST['action'] == 'teacher') {
		//print_r($_POST);
		$id = $_POST['id'];
		$ism = filter($_POST['ism']);
		$familya = filter($_POST['familya']);
		$birthdate = filter($_POST['birthdate']);
		$nomer = filter($_POST['nomer']);
		$jshir = filter($_POST['jshir']);
		$viloyat_id = filter($_POST['viloyat_id']);
		$tuman_id = filter($_POST['tuman_id']);
		$telefon = filter($_POST['telefon']);
		$doimiy = filter($_POST['doimiy']);
		$manzil = filter($_POST['manzil']);
		$sql = mysqli_query($link,"UPDATE `xodimlar` SET `ism` = '$ism', `familya` = '$familya' , `otch` = '$otch', `birthdate` = '$birthdate', `nomer` = '$nomer', `jshir` = '$jshir', `viloyat_id` = '$viloyat_id', `tuman_id` = '$tuman_id', `telefon` = '$telefon', `doimiy` = '$doimiy', `manzil` = '$manzil' WHERE `xodimlar`.`id` = '$id'");
			if ($sql) {
				?>
				<script>alert('Bajarildi');</script>
				<script> window.history.go(-2);</script>
				<?
			}
			else{
				?>

				<script>alert('Xatolik');</script>
				<script> window.history.back();</script>

				<?
			}
	}
	
	
	
?>
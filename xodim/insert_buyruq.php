<?php
include_once 'ximoya.php';

if (isset($_POST['insert_name'])) {
	if ($_SESSION['_csrf']!=$_POST['_csrf']) {
		$_SESSION['xatolik']=1;
		?>
		<script> window.history.back();</script>
		<?php
	}
	$name = filter($_POST['insert_name']);
	$sql = mysqli_query($link,"INSERT INTO buyruq_tur (name) VALUES ('$name')");

	if ($sql==true) {
		$_SESSION['success']=1;
		?>
		<script> window.history.back();</script>
		<?php
	}else{
		$_SESSION['xatolik']=1;
		?>
		<script> window.history.back();</script>
		<?php
	}
}
if (isset($_POST['action'])) {
	if ($_POST['action']=='delete') {
		$ret = [];
		$id=$_POST['id'];
		$sql=mysqli_query($link,"DELETE FROM `buyruq` WHERE id='$id'");
		if($sql){
			$ret = ['error' => 0, 'xabar' => "Muvaffaqqiyatli "];
		}
		else{
			$ret = ['error' => 1, 'xabar' => "Bazaga yozilmadi. Ichki xatolik. Malumotlarda kamchilik bor"];
		}
		echo json_encode($ret);
	}
	if ($_POST['action']=='buyruq_tur_delete') {
		$ret = [];
		$id=$_POST['id'];
		$sql=mysqli_query($link,"DELETE FROM `buyruq_tur` WHERE id='$id'");
		if($sql){
			$ret = ['error' => 0, 'xabar' => "Muvaffaqqiyatli "];
		}
		else{
			$ret = ['error' => 1, 'xabar' => "Bazaga yozilmadi. Ichki xatolik. Malumotlarda kamchilik bor"];
		}
		echo json_encode($ret);
	}
	if ($_POST['action']=='update') {
		$id = $_POST['id'];
		$name = filter($_POST['name']);

		$sql = mysqli_query($link,"UPDATE `buyruq_tur` SET `name` = '$name' WHERE `buyruq_tur`.`id` = '$id'");
		if($sql){
			$ret = ['error' => 0, 'xabar' => "Muvaffaqqiyatli tahrirlandi"];
		}
		else{
			$ret = ['error' => 1, 'xabar' => "Bazaga yozilmadi. Ichki xatolik. Malumotlarda kamchilik bor"];
		}
		echo json_encode($ret);
	}
	if ($_POST['action']=='buyruq_tur_update') {
		$id = $_POST['id'];
		$name = filter($_POST['name']);

		$sql = mysqli_query($link,"UPDATE `buyruq_tur` SET `name` = '$name' WHERE `buyruq_tur`.`id` = '$id'");
		if($sql){
			$ret = ['error' => 0, 'xabar' => "Muvaffaqqiyatli tahrirlandi"];
		}
		else{
			$ret = ['error' => 1, 'xabar' => "Bazaga yozilmadi. Ichki xatolik. Malumotlarda kamchilik bor"];
		}
		echo json_encode($ret);
	}

	if ($_POST['action']=='bupdate') {
		$id = $_POST['id'];
		$name = filter($_POST['name']);
		$sana = filter($_POST['sana']);

		$sql = mysqli_query($link,"UPDATE `buyruq` SET `braqam` = '$name' , `sana` = '$sana' WHERE `buyruq`.`id` = '$id'");
		if($sql){
			$ret = ['error' => 0, 'xabar' => "Muvaffaqqiyatli tahrirlandi"];
		}
		else{
			$ret = ['error' => 1, 'xabar' => "Bazaga yozilmadi. Ichki xatolik. Malumotlarda kamchilik bor"];
		}
		echo json_encode($ret);
	}
	if ($_POST['action']=='xodim_buyruq') {
		if ($_SESSION['_csrf']!=$_POST['_csrf']) {
			$_SESSION['xatolik']=1;
			?>
			<script> window.history.back();</script>
			<?php
		}
		$buyruq_tur = $_POST['buyruq_tur'];
		$buyruq = $_POST['buyruq'];
		$matn = filter($_POST['matn']);
		$asos = filter($_POST['asos']);
		$id = $_POST['id'];
		$sana = date("Y-m-d h:i:sa");
		$sql = mysqli_query($link,"INSERT INTO `buyruq_xodim` (`buyruq_id`, `buyruq_tur`, `xodim_id`, `matn`, `asos`, `sana`) VALUES ('$buyruq', '$buyruq_tur', '$id', '$matn', '$asos', '$sana')");
		if ($sql==true) {
			$_SESSION['success']=1;
			?>
			<script> window.history.go(-2);</script>
			<?php
		}else{
			$_SESSION['xatolik']=1;
			?>
			<script> window.history.back();</script>
			<?php
		}
	}
	if ($_POST['action']=='xodim_buyruq_update') {
		if ($_SESSION['_csrf']!=$_POST['_csrf']) {
			$_SESSION['xatolik']=1;
			?>
			<script> window.history.go(-2);</script>
			<?php
		}
		$buyruq_tur = $_POST['buyruq_tur'];
		$buyruq = $_POST['buyruq'];
		$matn=filter($_POST['matn']);
		$asos=filter($_POST['asos']);
		//$matn = mysqli_real_escape_string($link, $_POST['matn']);
		//$asos = mysqli_real_escape_string($link, $_POST['asos']);
		$id = $_POST['id'];
		$sana = date("Y-m-d h:i:sa");
		/*print("$buyruq_tur <br> $buyruq <br> $matn <br> $asos <br> $id <br> $sana");
		exit();*/
		$sqlcode = "UPDATE `buyruq_xodim` SET `buyruq_id` = '$buyruq', `buyruq_tur` = '$buyruq_tur',  `matn` = '$matn', `asos` = '$asos', `sana` = '$sana' WHERE `buyruq_xodim`.`id` = '$id'";
		$sql = mysqli_query($link,$sqlcode);
		if ($sql==true) {
			$_SESSION['success']=1;
			?>
			<script> window.history.go(-2);</script>
			<?php
		}else{
			$_SESSION['xatolik']=1;
			?>
			<script> window.history.back();</script>
			<?php
		}
	}
	if ($_POST['action']=='changelavozim') {
		if ($_SESSION['_csrf']!=$_POST['_csrf']) {
			$_SESSION['xatolik']=1;
			?>
			<script> window.history.back();</script>
			<?php
		}
		$id = $_POST['id'];
		$malumot = filter($_POST['malumot']);
		$shartnoma = filter($_POST['shartnoma']);
		$shtat = $_POST['shtat'];
		$sana = $_POST['sana'];
		$bulim_name_list = $_POST['bulim_name_list'];
		$bulim_id = $_POST['bulim_id'];
		$bulinma_id = $_POST['bulinma_id'];
		$lavozim_id = $_POST['lavozim_id'];
		$faoliyat = $_POST['faoliyat'];
		
		$muddattype = $_POST['muddattype'];
		$sinov = $_POST['sinov'];
		$muddati = $_POST['muddati'];

		$sql = mysqli_query($link,"UPDATE `workplace` SET `shtat` = '$shtat', `muddati` = '$muddati', `kadr_bulim_id` = '$bulim_name_list', `bulim_id` = '$bulim_id', `kafedra_id` = '$bulinma_id', `lavozim` = '$lavozim_id', `urindosh` = '$faoliyat', `shartnomaraqam` = '$shartnoma', `sinov` = '$sinov'  WHERE `workplace`.`id` = '$id'");
		

		if ($sql==true) {
			$_SESSION['success']=1;
			?>
			<script> window.history.go(-2);</script>
			<?php
		}else{
			$_SESSION['xatolik']=1;
			?>
			<script> window.history.back();</script>
			<?php
		}

	}
	if ($_POST['action']=='insertwork') {
		if ($_SESSION['_csrf']!=$_POST['_csrf']) {
			$_SESSION['xatolik']=1;
			?>
			<script> window.history.back();</script>
			<?php
		}
		$id = $_POST['id'];
		$malumot = filter($_POST['malumot']);
		$shartnoma = filter($_POST['shartnoma']);
		$shtat = $_POST['shtat'];
		$sana = $_POST['sana'];
		$bulim_name_list = $_POST['bulim_name_list'];
		$bulim_id = $_POST['bulim_id'];
		$bulinma_id = $_POST['bulinma_id'];
		$lavozim_id = $_POST['lavozim_id'];
		$faoliyat = $_POST['faoliyat'];
		
		$muddattype = $_POST['muddattype'];
		$sinov = $_POST['sinov'];
		$muddati = $_POST['muddati'];
		

		$sql = mysqli_query($link,"INSERT INTO `workplace` (`user_id`, `malumot`, `shtat`, `sana`, `muddati`, `muddattype`, `sinov`, `kadr_bulim_id`, `bulim_id`, `kafedra_id`, `lavozim`, `urindosh`, `shartnomaraqam`) VALUES ('$id', '$malumot', '$shtat', '$sana', '$muddati', '$muddattype', '$sinov', '$bulim_name_list', '$bulim_id', '$bulinma_id', '$lavozim_id', '$faoliyat',  '$shartnoma')");
		

		if ($sql==true) {
			$_SESSION['success']=1;
			?>
			<script> window.history.go(-2);</script>
			<?php
		}else{
			$_SESSION['xatolik']=1;
			?>
			<script> window.history.back();</script>
			<?php
		}

	}
	if ($_POST['action'] == 'insertbuyruq') {
		if ($_SESSION['_csrf']!=$_POST['_csrf']) {
			$_SESSION['xatolik']=1;
			?>
			<script> window.history.back();</script>
			<?php
		}
		$sana = $_POST['sana'];
		$braqam = filter($_POST['braqam']);
		$sql = mysqli_query($link,"INSERT INTO buyruq (braqam,sana) VALUES ('$braqam','$sana')");
		if ($sql==true) {
			$_SESSION['success']=1;
			?>
			<script> window.history.go(-1);</script>
			<?php
		}else{
			$_SESSION['xatolik']=1;
			?>
			<script> window.history.back();</script>
			<?php
		}
	}
}
$_SESSION['_csrf']=md5(time());
?>         



<?
	include_once 'ximoya.php';
?>
	
<?

	if (isset($_POST['saqla'])) {
		$xodim_id = $_POST['xodim'];
		$malumot = filter($_POST['malumot']);
		$shartnoma = filter($_POST['shartnoma']);
		$shtat = $_POST['shtat'];
		$sana = $_POST['sana'];
		$bulim_name_list = $_POST['bulim_name_list'];
		$bulim_id = $_POST['bulim_id'];
		$bulinma_id = $_POST['bulinma_id'];
		$lavozim_id = $_POST['lavozim_id'];
		$faoliyat = $_POST['faoliyat'];
		$buyruq = $_POST['buyruq'];
		$muddattype = $_POST['muddattype'];
		$sinov = $_POST['sinov'];
		$muddati = $_POST['muddati'];


			$sql = mysqli_query($link,"INSERT INTO `qabul` (`user_id`, `malumot`, `shtat`, `sana`, `muddati`, `muddattype`, `sinov`, `kadr_bulim_id`, `bulim_id`, `kafedra_id`, `lavozim`, `urindosh`, `ariza`, `buyruq`, `shartnomaraqam`) VALUES ('$xodim_id', '$malumot', '$shtat', '$sana', '$muddati', '$muddattype', '$sinov', '$bulim_name_list', '$bulim_id', '$bulinma_id', '$lavozim_id', '$faoliyat', '', '$buyruq', '$shartnoma')");
			if ($sql) {
				$sql2 = mysqli_query($link,"INSERT INTO `workplace` (`xodim_id`, `kadr_bulim_id`, `bulim_id`, `kafedra_id`, `buyruq_id`, `sana`, `shtat`, `faoliyat`, `lavozim_id`, `malumot`) VALUES ('$xodim_id', '$bulim_name_list', '$bulim_id', '$bulinma_id', '$buyruq', '$sana', '$shtat', '$faoliyat', '$lavozim_id', '$malumot')");
				if ($sql2) {
					$sql4 = mysqli_query($link,"UPDATE `xodimlar` SET `status` = '1' WHERE `xodimlar`.`id` = '$xodim_id'");
					?> 

					<script>alert('Bajarildi');</script>
					<script> window.location.href = 'qabul.php';</script>

					 <?
				}else{
					$sql3 = mysqli_query($link, "DELETE FROM `qabul` WHERE user_id = '$xodim_id'");
					?> 

					<script>alert('Xatolik!!! Qaytadan urining);</script>
					<script> window.location.href = 'qabul.php';</script>

					 <?
				}
			}
			else{
			    	?> 

					<script>alert('Xatolik!!! Qaytadan urining);</script>
					<script> window.location.href = 'qabul.php';</script>

					 <?
			}
		
	
	}
		
?>         
	
  
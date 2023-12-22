<?
	include_once 'ximoya.php';
?>
	<option value="0">~ Tanalang ~</option>
<?
	if(isset($_GET['kb'])){
		$kb = $_GET['kb'];
		$bulim_id = $_GET['bulim_id'];
		$sql = mysqli_query($link,"SELECT * FROM lavozimlar WHERE kadr_bulim_id='$kb' ORDER BY lavozim ASC");
		while ($f = mysqli_fetch_assoc($sql)) {
			?>
			<option value="<?=$f['id']?>"><?=$f['lavozim']?></option>
			<?
		}	
	}
	if(isset($_GET['bulim_id'])){
		$bulim_id = $_GET['bulim_id'];
		$bulinma_id = $_GET['bulinma_id'];
		$sql = mysqli_query($link,"SELECT * FROM lavozimlar WHERE bulim_id='$bulim_id' AND kafedra_id='$bulinma_id'");
		while ($f = mysqli_fetch_assoc($sql)) {
			?>
			<option value="<?=$f['id']?>"><?=$f['lavozim']?></option>
			<?
		}	
	}

	if(isset($_GET['b_id'])){
		$bulim_id = $_GET['b_id'];
		$sql = mysqli_query($link,"SELECT * FROM lavozimlar WHERE bulim_id='$bulim_id' ");
		while ($f = mysqli_fetch_assoc($sql)) {
			?>
			<option value="<?=$f['id']?>"><?=$f['lavozim']?></option>
			<?
		}	
	}
	
?>
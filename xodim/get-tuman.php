<?
	include_once 'ximoya.php';
	$vil_id = $_GET['viloyat_id'];
	$sql = mysqli_query($link,"SELECT * FROM tuman WHERE vil_id='$vil_id' ORDER BY nomi ASC");
	while ($f = mysqli_fetch_assoc($sql)) {
		?>
		<option value="<?=$f['id']?>"><?=$f['nomi']?></option>
		<?
	}
?>
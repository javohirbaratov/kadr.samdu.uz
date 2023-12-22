<?
	include_once 'ximoya.php';
?>
	<option value="0">~ Tanalang ~</option>
<?
	$kb = $_GET['kb'];
	$sql = mysqli_query($link,"SELECT * FROM kafedra WHERE bulim_id='$kb' ORDER BY name ASC");
	while ($f = mysqli_fetch_assoc($sql)) {
		?>
		<option value="<?=$f['id']?>"><?=$f['name']?></option>
		<?
	}
?>
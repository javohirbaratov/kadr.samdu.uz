<?
	include_once 'ximoya.php';
?>
	<option value="">~ Tanlang ~</option>
<?
	$kb = $_GET['kb'];
	$sql = mysqli_query($link,"SELECT * FROM buyruq ");
	while ($f = mysqli_fetch_assoc($sql)) {
		?>
		<option value="<?=$f['id']?>"><?=$f['braqam']?> ( <?=$f['sana']?> )</option>
		<?
	}
?>
<?
	include_once 'ximoya.php';
	$id = $_GET['id'];
?>
<option value="0">~ Tanlang ~</option>
<?
	$sql = mysqli_query($link,"SELECT * FROM bulimlar WHERE kadrbulimi_id='$id' ORDER BY name ASC");
	while ($f = mysqli_fetch_assoc($sql)) {
		?>
		<option value="<?=$f['id']?>"><?=$f['name']?></option>
		<?
	}
?>
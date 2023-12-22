<?php include_once 'ximoya.php'; ?>
<table class="table table-bordered">
	<tr>
		<th>No</th>
		<th>Ishlagan yillari</th>
		<th>Ish joyi</th>		
	</tr>
	<?
		$i = 0;
		$user_id = $_GET['user_id'];
		$sql = mysqli_query($link,"SELECT * FROM xodimlar WHERE id='$user_id'");
		$xodim = mysqli_fetch_assoc($sql);
		$sql = mysqli_query($link,"SELECT * FROM history WHERE user_id='$user_id'");
		while ($fetch = mysqli_fetch_assoc($sql)) {

			?>
		<tr>
			<td><?=++$i?></td>
			<td><?=date("d.m.Y", $fetch['sanadan'])?>-<?=date("d.m.Y",$fetch['sanagacha'])?> yy</td>
			<td><?=$fetch['ishjoyi']?></td>		
		</tr>
			<?	
		}
	?>
</table>
<script type="text/javascript">
	$('#exampleModalLabel').html("<?=$xodim['familya']?> <?=$xodim['ism']?> <?=$xodim['otch']?>ning mehnat faoliyati");
</script>
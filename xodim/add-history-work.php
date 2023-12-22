<?php include_once 'ximoya.php'; ?>
<?
	$user_id = $_GET['user_id'];
	$sql = mysqli_query($link,"SELECT * FROM xodimlar WHERE id='$user_id'");
	$xodim = mysqli_fetch_assoc($sql);
?>
<form id="addxodimhistorydata">
	<div class="form-group">
		<label>Kirish sanasi</label>
		<input type="date" name="sanadan" id="sana1" class="form-control">
	</div>
	<div class="form-group">
		<label>Tugash sanasi</label>
		<input type="date" name="sanagacha" id="sana2" class="form-control">
	</div>
	<div class="form-group">
		<label>Ish joyi va lavozimi</label>
		<textarea class="form-control" rows="4" placeholder="Ish joyi va lavozimni kiriting" name="ishjoyi"></textarea>
	</div>
	<input type="hidden" name="action" value="insertaddhistory">
	<input type="hidden" name="xodim_id" value="<?=$xodim['id']?>">
	<button type="button" class="btn btn-success" id="addhistorybtn"><i class="fa fa-plus"></i> Qo'shish</button>
</form>
<script type="text/javascript">
	$('#exampleModalLabel').html("<?=$xodim['familya']?> <?=$xodim['ism']?> <?=$xodim['otch']?>ning mehnat faoliyati");
	$('#addhistorybtn').click(function() {
		let data = $('#addxodimhistorydata').serialize();
		console.log(data);
		$.ajax({
			url : "insert.php",
			type: "POST",
			data:data,
			success:function(data) {
				// console.log(data);
				var obj = jQuery.parseJSON(data);
    			if (obj.error == 0) {
		            swal("Bajarildi!", obj.message, "success");
		            $('#addxodimhistorydata')[0].reset();
				}
		        else{ 
		            swal("Xatolik", obj.message, "error");
		        }				
			},
			error:function(xhr) {
				alert("Kechirasiz internetda uzilish ro'y berdi. Internet aloqasini tekshiring");
			}
		});
	});
</script>
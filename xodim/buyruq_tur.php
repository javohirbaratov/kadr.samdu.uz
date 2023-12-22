<?php
include_once 'ximoya.php';
$_SESSION['page'] = 111;
$_SESSION['_csrf']=md5(time());
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include_once 'css.php'; ?>
</head>
<body class="app sidebar-mini">
<?php include_once 'header.php'; ?>
	<main class="app-content">
		<div class="app-title">
			<div>
				<h1><i class="fa fa-th-list"></i> Buyruq turlari </h1>
				<p></p>
			</div>
			<ul class="app-breadcrumb breadcrumb side">
				<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
			</ul>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="tile">
					<div class="tile-body">
						<div class="table-responsive" id="displaytable">
							<table class="table table-hover table-bordered" id="sampleTable">
								<thead>
									<tr>
										<th>No</th>
										<th>Nomi</th>
										<th>Amallar</th>
									</tr>
								</thead>
								<tbody>
								<?php
									$sql = mysqli_query($link,"SELECT * FROM `buyruq_tur`");
									while($fetch = mysqli_fetch_assoc($sql)){
										?>
										<tr id="tr<?=$fetch['id'] ?>">
											<td><?=$fetch['id']?></td>
											<td><input type="text" class="form-control" id="name_update<?=$fetch['id']?>" readonly value="<?=$fetch['name']?>"> </td>
											<td>
												<a class="btn btn-success" href="buyruq_tur_view.php?id=<?=$fetch['id']?>">Batafsil</a>		
												<button  onclick="update(<?=$fetch['id']?>)" class="btn btn-primary">Tahrirlash</button>
												<button  onclick="udalit(<?=$fetch['id']?>)" class="btn btn-danger">O'chirish</button>
											</td>
										</tr>
									<?php }?>
									</tbody>
								</table>
								<script type="text/javascript">
									$('#sampleTable').DataTable( {
										dom: 'Bfrtip',
										lengthMenu: [
											[ 10, 25, 50, -1 ],
											[ '10 talab', '25 talab', '50 talab', 'Barchasi' ]
											],        
										buttons: [
											'copy', 'csv', 'excel', 'pdf', 'print','pageLength',
											],
										language: {
										search: 'Qidiruv', // removed the word 'search' from the left of search
										"paginate": {
											"previous": "Orqaga",
											"next": "Keyingi"
										},
										"emptyTable":     "Bu jadval bo'sh. Malumot yo'q",
										"info":           "Ko'rsatilyapti _START_ dan boshlab _END_ gacha _TOTAL_ tadan",
										"infoEmpty":      "Ko'rsatilyapti 0 ta 0  0 tadan",
										"zeroRecords":    "Bunday ma'lumot topilmadi",
									  },
									  initComplete: function() {
										$('div.dataTables_filter input').attr('placeholder', 'Kiriting') // put 'search' inside of search box
									  },
									});
							  </script>

                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
          	<div class="tile">
          		<!-- <h3 class="tile-title">Subscribe</h3> -->
          		<div class="tile-body">
          			<input type="hidden" id="name_update0">
          			<form class="row" id="filterform"  action="insert_buyruq.php" method="POST">
          				<div class="form-group col-md-8">
          					<label class="control-label">Buyruq turi</label>
          					<input type="text" name="insert_name" class="form-control">
          					<input type="hidden" name="_csrf" value="<?=$_SESSION['_csrf'] ?>">
          				</div>
          				<div class="form-group col-md-4 align-self-end">
          					<button class="btn btn-primary" type="submit" ><i class="fa fa-fw fa-lg fa-plus"></i>Qo'shish</button>
          				</div>
          			</form>
          		</div>
          	</div>
          </div>
        </div>    
      </main>
<?php include_once 'js.php'; ?>
      <script type="text/javascript">
      	function udalit(id) {
      		swal({
      			title: "O'chirishga ishonchingiz komilmi?",
      			text: "O'chirilgan malumot qayta tiklanmaydi!",
      			type: "warning",
      			showCancelButton: true,
      			confirmButtonText: "Ha, o'chir!",
      			cancelButtonText: "Yo'q, bekor qil!",
      			closeOnConfirm: false,
      			closeOnCancel: false
      		}, function(isConfirm) {
      			if (isConfirm) {
      				$.ajax({
      					url: "insert_buyruq.php",
      					type: "POST",
      					data:{
      						id:id,action:"buyruq_tur_delete",
      					},
      					success:function(data) {
      						var obj = jQuery.parseJSON(data);
      						if(obj.error==0){
      							swal("O'chirildi!", "Muvaffaqqiyatli o'chirildi", "success");
      							$('#tr'+id).remove();
      						}
      						else{
      							swal("O'chirilmadi", "Ichki xatolik, qaytadan urinib ko'ring", "error");		
      						}
      					},
      					error:function(xhr) {
      						swal("O'chirilmadi", "Internetdan uzilish ro'y berdi", "error");		
      					}
      				});      			
      			} else {
      				swal("Bekor qilindi", "Obyekt o'chirilishi bekor qilindi :)", "error");
      			}
      		});
      	}
      	function update(id) {
      		

      		if (document.getElementById("name_update"+id).readOnly == true) {
      			document.getElementById("name_update"+id).readOnly = false;
      			let name1 = $('#name_update'+id).val();
      			document.getElementById("name_update0").value = name1;
      		}else{
      			let name2 = $('#name_update'+id).val();
      			let name1 = $('#name_update0').val();
      			if (name1!=name2) {
      				$.ajax({
      					url: "insert_buyruq.php",
      					type: "POST",
      					data:{
      						id:id,name:name2,action:"buyruq_tur_update",
      					},
      					success:function(data) {
      						var obj = jQuery.parseJSON(data);
      						if(obj.error==0){
      							swal("Bajarildi!", "Muvaffaqqiyatli o'zgartirildi", "success");
      						
      						}
      						else{
      							swal("Bajarilmadi", "Ichki xatolik, qaytadan urinib ko'ring", "error");		
      						}
      					},
      					error:function(xhr) {
      						swal("Bajarilmadi", "Internetdan uzilish ro'y berdi", "error");		
      					}
      				});  
      			}
      			document.getElementById("name_update"+id).readOnly = true;
      		}
      		
      	}
      </script>
    </body>
    </html>
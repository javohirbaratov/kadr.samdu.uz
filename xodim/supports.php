<?php
	include_once 'ximoya.php';
	$_SESSION['page'] = 4.1;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <? include_once 'css.php'; ?>
  </head>
  <body class="app sidebar-mini">
    <? include_once 'header.php'; ?>
    <main class="app-content">
      <div class="app-title">
          <div>
            <h1><i class="fa fa-th-list"></i> Moliyalashtirish</h1>
            <p>Moliyalashtirishni qulay tarzda saralash va ular ustida tezkor amallarni bajarish</p>
          </div>
          <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Moliyalashtirish</li>
            <li class="breadcrumb-item active"><a href="#">Moliyalashtirishni ko'rish</a></li>
          </ul>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="tile">
              <div class="tile-body">
              	<a href="support-create.php" class="btn btn-success" style="margin-bottom: 10px;"><i class="fa fa-plus"></i> Yangi qo'shish</a>
                <div class="table-responsive">
                  <table class="table table-hover table-bordered" id="sampleTable">
                    <thead>
                      <tr>
                      	<th>#</th>
                        <th>Moliyalashtirish nomi</th>
                        <th>Amallar</th>
                      </tr>
                    </thead>
                    <tbody>
                    	<?
                    		$t=0;
                    		$sql = mysqli_query($link,"SELECT * FROM molya ORDER BY id ASC");
                    		while($fetch = mysqli_fetch_assoc($sql)){
                    			$t++;                    			
                    	?>
                    	<tr id="tr<?=$fetch['id']?>">
	                      	<td><?=$t?></td>
	                        <td><?=$fetch['nomi']?></td>
	                        <td><a href="support-update.php?id=<?=$fetch['id']?>" class="btn btn-primary"><i class="fa fa-pencil"></i> O'zgartirish</a><button class="btn btn-danger" onclick="udalit(<?=$fetch['id']?>)"><i class="fa fa-trash"></i> O'chirish</button></td>
	                    </tr>	
	                    <?}?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>    
    </main>
    <? include_once 'js.php'; ?>
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
	      				url: "user-delete.php",
	      				type: "POST",
	      				data:{
	      					molya_id:id,action:"molya",
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
    </script>
  </body>
</html>
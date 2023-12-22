<?php
	include_once 'ximoya.php';
	$_SESSION['page'] = 3.1;
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
            <h1><i class="fa fa-th-list"></i> Bo'limlar</h1>
            <p>Bo'limlar va ular tarkibidagi bo'linma/kafedralarni ko'rish va tahrirlash</p>
          </div>
          <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Kurslar</li>
            
          </ul>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="tile">
              <div class="tile-body">
              	<a href="bulim-create.php" class="btn btn-success" style="margin-bottom: 10px;"><i class="fa fa-plus"></i> Yangi qo'shish</a>
                <div class="table-responsive">
                  <table class="table table-hover table-bordered" id="sampleTable">
                    <thead>
                      <tr>
                      	<th>Nomer</th>
                        <th>Bo'lim nomi</th>
                        <th>Kadrlar bo'limi</th>
                        <th>Ichki bo'linmalari</th>
                        <th>Jami shtatlar</th>
                        <th>Amallar</th>
                      </tr>
                    </thead>
                    <tbody>
                    	<?
                    		$t=0;
                    		$sql = mysqli_query($link,"SELECT * FROM `bulimlar` ORDER BY id ASC");
                    		while($fetch = mysqli_fetch_assoc($sql)){
                    			$t++;
                    			$kadr_bulim_id = $fetch['kadrbulimi_id'];
                    			$sql2 = mysqli_query($link,"SELECT * FROM `kadrlarbulimi` WHERE id='$kadr_bulim_id'");
                    			$kb = mysqli_fetch_assoc($sql2);
                    			$id = $fetch['id'];
                    			$bb = '';
                    			$sql2 = mysqli_query($link,"SELECT * FROM `kafedra` WHERE bulim_id='$id'");
                    			while ($fetch2 = mysqli_fetch_assoc($sql2)) {
                    					$bb .= $fetch2['name']."<br>";
                    			}
                    	?>
                    	<tr id="tr<?=$fetch['id']?>">
	                      	<td><?=$t?></td>
	                        <td><?=$fetch['name']?></td>
	                        <td><?=$kb['name']?></td>
	                        <td><?=$bb?></td>	       
	                        <td><?=$fetch['shtat']?></td>                 
	                        <td><a href="bulim-update.php?id=<?=$fetch['id']?>" class="btn btn-primary"><i class="fa fa-pencil"></i> O'zgartirish</a><button class="btn btn-danger" onclick="udalit(<?=$fetch['id']?>)"><i class="fa fa-trash"></i> O'chirish</button></td>
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
	      		title: "O'chirishga ishonchingiuz komilmi?",
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
	      					id:id,action:"bulimlar",
	      				},
	      				success:function(data) {
	      					var obj = jQuery.parseJSON(data);
	      					if(obj.err == 0){
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
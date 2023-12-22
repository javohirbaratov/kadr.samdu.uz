<?php
	include_once 'ximoya.php';
	$_SESSION['page'] = 151;
	if(!isset($_GET['id'])){
      exit('Bad request 400!');
  }
  else{
    $id = filter($_GET['id']);
    $sql = mysqli_query($link,"SELECT * FROM xodimlar WHERE id='$id'");
    $fetch = mysqli_fetch_assoc($sql);
  }
  $viloyat_id = $fetch['viloyat_id'];
  $sql = mysqli_query($link,"SELECT * FROM viloyat WHERE id='$viloyat_id'");
  $viloyat = mysqli_fetch_assoc($sql);
  $tuman_id = $fetch['tuman_id'];
  $sql = mysqli_query($link,"SELECT * FROM tuman WHERE id='$tuman_id'");
  $tuman = mysqli_fetch_assoc($sql);
  $sql = mysqli_query($link,"SELECT * FROM workplace WHERE xodim_id='$id'");
  $work = mysqli_fetch_assoc($sql);

  $sql = mysqli_query($link,"SELECT * FROM workplace WHERE xodim_id='$id'");
  $work = mysqli_fetch_assoc($sql);
  $bulim_id = $work['bulim_id'];
  $sql = mysqli_query($link,"SELECT * FROM bulimlar WHERE id='$bulim_id'");
  $bulim = mysqli_fetch_assoc($sql);
  $lavozim_id = $work['lavozim_id'];
  $sql = mysqli_query($link,"SELECT * FROM lavozimlar WHERE id='$lavozim_id'");
  $lavozim = mysqli_fetch_assoc($sql);
  $buyruq_id = $work['buyruq_id'];
  $sql = mysqli_query($link,"SELECT * FROM buyruq WHERE id='$buyruq_id'");
  $buyruq = mysqli_fetch_assoc($sql);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <? include_once 'css.php'; ?>
    <style type="text/css">
    	table tr th:nth-child(1){
    		width: 20%;
    	}
    </style>
  </head>
  <body class="app sidebar-mini">
    <? include_once 'header.php'; ?>
    <main class="app-content">
      <div class="app-title">
          <div>
            <h1><i class="fa fa-th-list"></i> Xodimlar</h1>
            <p>Xodimlarni qulay tarzda saralash va ular ustida tezkor amallarni bajarish</p>
          </div>
          <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Xodimlar</li>
            <li class="breadcrumb-item active"><a href="#">Xodimlarni ko'rish</a></li>
          </ul>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="tile">
              <div class="tile-body">
                <div class="table-responsive">
                  <table class="table table-hover table-bordered table-striped">
                    <thead>
                      <tr>
                      	<th>ID</th>
                      	<th><?=$fetch['id']?></th>
                     	</tr>
                      <tr>
                        <th>F.I.O</th>
                        <th><?=$fetch['familya']?> <?=$fetch['ism']?> <?=$fetch['otch']?></th>
                      </tr>
                      <tr>  
                        <th>Tug'ilgan sana</th>
                        <th><?=date("d.m.Y",strtotime($fetch['birthdate']))?></th>
                      </tr>
                      <tr>  
                        <th>Pasport seriya va raqami</th>
                        <th><?=$fetch['seriya']?> <?=$fetch['nomer']?></th>
                      </tr>
                      <tr>  
                        <th>Jinsi</th>
                        <th><?=$fetch['jinsi']?></th>
                      </tr>
                      <tr>  
                        <th>Viloyati</th>
                        <th><?=$viloyat['nomi']?></th>
                      </tr>
                      <tr>  
                        <th>Tumani</th>
                        <th><?=$fetch['birthplace']?></th>
                      </tr>
                      <tr>  
                        <th>Telefon</th>
                        <th><?=$fetch['telefon']?></th>
                      </tr>
                      <tr>  
                        <th>Doimiy yashash manzili</th>
                        <th><?=$fetch['doimiy']?></th>
                      </tr>
                      <tr>  
                        <th>Yashash manzili</th>
                        <th><?=$fetch['manzil']?></th>
                      </tr>
                      
                      <tr>  
                        <th>Lavozim</th>
                        <th><?=$lavozim['lavozim']?></th>
                      </tr>
                      <tr>  
                        <th>Ishlash bo'limi</th>
                        <th>
                          <?=$bulim['name']?>
                        </th>
                      </tr>
                      <tr>  
                        <th>Buyruq raqami</th>
                        <th>
                          <?=$buyruq['braqam']?> Sanasi : <?=date("d.m.Y", strtotime($buyruq['sana']))?>
                        </th>
                      </tr>   
                    </thead>
                  </table>
                  <button class="btn btn-primary" onClick="print()"><i class="fa fa-print"></i> Chop etish</button>
                  <a class="btn btn-warning" href="tinglovchi-update.php?id=<?=$fetch['id']?>"><i class="fa fa-pencil"></i> Tahrirlash</a>
                  <button class="btn btn-danger" onClick="udalit()"><i class="fa fa-trash"></i> O'chirish</button>
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
	      					tinglovchi_id:id,action:"xodimlar",
	      				},
	      				success:function(data) {
	      					var obj = jQuery.parseJSON(data);
	      					if(obj.error==0){
	      						swal("O'chirildi!", "Muvaffaqqiyatli o'chirildi", "success");
	      					}
	      					else{
	      						swal("O'chirilmadi", "Ichki xatolik, qaytadan urinib ko'ring", "error");		
	      					}
	      				},
	      				error:function(xhr) {
	      					swal("O'chirilmadi", "Internetdan uzilish ro'y berdi", "error");		
	      				}
	      			});
	      			$('#tr'+id).remove();
	      			

	      		} else {
	      			swal("Bekor qilindi", "Obyekt o'chirilishi bekor qilindi :)", "error");
	      		}
	      	});
    	}
    </script>
    <?if(isset($_GET['print'])){?>
    <script type="text/javascript">
    	window.print();
    </script>
    <?}?>
  </body>
</html>
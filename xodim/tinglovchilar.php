<?php
	include_once 'ximoya.php';
	$_SESSION['page'] = 7.1;
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
            <h1><i class="fa fa-th-list"></i> Tinglovchilar</h1>
            <p>Tinglovchilarni qulay tarzda saralash va ular ustida tezkor amallarni bajarish</p>
          </div>
          <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Tinglovchilar</li>
            <li class="breadcrumb-item active"><a href="#">Tinglovchilarni ko'rish</a></li>
          </ul>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="tile">
              <div class="tile-body">
              	<a href="tinglovchi-create.php" class="btn btn-success" style="margin-bottom: 10px;"><i class="fa fa-plus"></i> Yangi qo'shish</a>
                <div class="table-responsive">
                  <table class="table table-hover table-bordered" id="sampleTable">
                    <thead>
                      <tr>
                      	<th>Amallar</th>
                      	<th>ID</th>
                        <th>F.I.O</th>
                        <th>Tug'ilgan sana</th>
                        <th>Kursga qo'shilgandagi yoshi</th>
                        <th>Jinsi</th>
                        <th>Viloyati</th>
                        <th>Tumani</th>
                        <th>Telefon</th>
                        <th>Kurs</th>
                        <th>Boshlanish vaqti-Tugash vaqti</th>
                        <th>Kurs o'tiladigan joy</th>
                        <th>Tashkilot(turi)</th>
                        <th>Lavozim</th>
                        <th>Kurslardan qanday natijaga erishilganligi</th>
                        <th>Kurslardan qanday ko’nikma/texnologiyalar/tajribalarga erishilganligi</th>
                        <th>Kurslardan keyin</th>                        
                      </tr>
                    </thead>
                    <tbody>
                    	<?
                    		$viloyat_id = $_SESSION['viloyat_id'];
                    		$sql = mysqli_query($link,"SELECT * FROM tinglovchilar WHERE viloyat_id='$viloyat_id' ORDER BY id ASC");
                    		while($fetch = mysqli_fetch_assoc($sql)){
                    			$vil_id = $fetch['viloyat_id'];
                    			$sql2 = mysqli_query($link,"SELECT * FROM viloyat WHERE id='$vil_id'");
                    			$viloyat = mysqli_fetch_assoc($sql2);
                    			$tuman_id = $fetch['tuman_id'];
                    			$sql2 = mysqli_query($link,"SELECT * FROM tuman WHERE id='$tuman_id'");
                    			$tuman = mysqli_fetch_assoc($sql2);
                    			$kurs_id = $fetch['kurs_id'];
                    			$sql2 = mysqli_query($link,"SELECT * FROM kurslar WHERE id='$kurs_id'");
                    			$kurslar = mysqli_fetch_assoc($sql2);
                    			$natija_id = $fetch['natija_id'];
                    			$sql2 = mysqli_query($link,"SELECT * FROM natijalar WHERE id='$natija_id'");
                    			$natija = mysqli_fetch_assoc($sql2);
                    			$status_id = $fetch['status_id'];
                    			$sql2 = mysqli_query($link,"SELECT * FROM statuslar WHERE id='$status_id'");
                    			$status = mysqli_fetch_assoc($sql2);
                    	?>
                    	<tr id="tr<?=$fetch['id']?>">
                    			<td><a href="tinglovchi-view.php?id=<?=$fetch['id']?>" class="btn btn-success"><i class="fa fa-eye"></i> Batafsil</a><a href="tinglovchi-view.php?id=<?=$fetch['id']?>" class="btn btn-warning"><i class="fa fa-print"></i> Pechat</a><a href="tinglovchi-update.php?id=<?=$fetch['id']?>" class="btn btn-primary"><i class="fa fa-pencil"></i> Tahrirlash</a><button class="btn btn-danger" onClick="udalit(<?=$fetch['id']?>)"><i class="fa fa-trash"></i> O'chirish</button></td>
	                      	<td><?=$fetch['id']?></td>
	                        <td><?=$fetch['fio']?></td>
	                        <td><?=date("d.m.Y",$fetch['birthsana'])?>(<?=$fetch['yoshi']?> yoshda)</td>
	                        <td><?=$fetch['yoshi']?> yoshda</td>
	                        <td><?=$fetch['jinsi']?></td>
	                        <td><?=$viloyat['nomi']?></td>
	                        <td><?=$tuman['nomi']?></td>
	                        <td><?=$fetch['telefon']?></td>
	                        <td><?=$kurslar['kurs_nomi']?></td>	
	                        <td><?=date("d.m.Y", $fetch['sana1'])?>-<?=date("d.m.Y", $fetch['sana2'])?></td>
	                        <td><?=$fetch['kursjoy']?></td>
	                        <td><?=$fetch['tashkilot']?>(<?=$fetch['tashkilottype']?>)</td>
	                        <td><?=$fetch['lavozim']?></td>
	                        <td><?
                            $tinglovchi_id = $fetch['id'];
                            $q1 = mysqli_query($link,"SELECT * FROM results WHERE tinglovchi_id='$tinglovchi_id'");
                            while ($natijas = mysqli_fetch_assoc($q1)) {
                              $natija_id = $natijas['natija_id'];
                              $q2 = mysqli_query($link,"SELECT * FROM natijalar WHERE id='$natija_id'");
                              $natija = mysqli_fetch_assoc($q2);
                              echo $natija['name']."<br>";
                            }
                          ?></td>
	                        <td><?=$fetch['tajriba']?></td>
	                        <td><?
	                            $tinglovchi_id = $fetch['id'];
	                            $q1 = mysqli_query($link,"SELECT * FROM statusresult WHERE tinglovchi_id='$tinglovchi_id'");
	                            while ($statuses = mysqli_fetch_assoc($q1)) {
	                              $status_id = $statuses['status_id'];
	                              $q2 = mysqli_query($link,"SELECT * FROM statuslar WHERE id='$status_id'");
	                              $status = mysqli_fetch_assoc($q2);
	                              echo $status['name']."<br>";
	                            }
	                          ?></td>	                        
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
	      					tinglovchi_id:id,action:"tinglovchilar",
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
  </body>
</html>
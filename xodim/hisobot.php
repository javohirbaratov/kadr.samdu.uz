<?php
	include_once 'ximoya.php';
	$_SESSION['page'] = 10;
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
        <div class="col-md-12">
          <div class="tile">
            <!-- <h3 class="tile-title">Subscribe</h3> -->
            <div class="tile-body">
              <form class="row" id="filterform">
                <div class="form-group col-md-3">
                  <label class="control-label">Viloyat</label>
                  <select class="form-control" id="viloyat_id" name="viloyat_id">
                  	<option value="-1">~ Tanlang ~</option>
                  	<?
                      $viloyat_id = $_SESSION['viloyat_id'];
                  		$sql = mysqli_query($link,"SELECT * FROM viloyat WHERE id='$viloyat_id'");
                  		while ($viloyat = mysqli_fetch_assoc($sql)) {
                  			?>
                  	<option value="<?=$viloyat['id']?>"><?=$viloyat['nomi']?></option>
                  			<?
                  		}
                  	?>
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label class="control-label">Tuman</label>
                  <select class="form-control" id="tuman_id" name="tuman_id" onchange="filter()">
                  	<option value="-1">~ Tanlang ~</option>
                  	<?                      
                  		$sql = mysqli_query($link,"SELECT * FROM tuman WHERE vil_id='$viloyat_id' ORDER BY nomi ASC");
                  		while ($viloyat = mysqli_fetch_assoc($sql)) {
                  			?>
                  	<option value="<?=$viloyat['id']?>"><?=$viloyat['nomi']?></option>
                  			<?
                  		}
                  	?>
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label class="control-label">Kurs</label>
                  <select class="form-control" id="kurs_id" name="kurs_id" onchange="filter()">
                  	<option value="-1">~ Tanlang ~</option>
                  	<?
                  		$sql = mysqli_query($link,"SELECT * FROM kurslar ORDER BY kurs_nomi ASC");
                  		while ($kurs = mysqli_fetch_assoc($sql)) {
                  			?>
                  	<option value="<?=$kurs['id']?>"><?=$kurs['kurs_nomi']?></option>
                  			<?
                  		}
                  	?>
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label class="control-label">Jinsi</label>
                  <select class="form-control" id="jins" name="jins" onchange="filter()">
                  	<option value="-1">~ Tanlang ~</option>
                  	<option value="Erkak">Erkak</option>
                  	<option value="Ayol">Ayol</option>
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label class="control-label">Boshlanish vaqti</label>
                  <input type="date" name="sana1" class="form-control" id="sana1" onchange="filter()">
                </div>
                <div class="form-group col-md-3">
                  <label class="control-label">Tugash vaqti</label>
                  <input type="date" name="sana2" class="form-control" id="sana2" onchange="filter()">
                </div>
                <div class="form-group col-md-3">
                  <label class="control-label">Kurs natijasi bo'yicha</label>
                  <select class="form-control" id="natija_id" name="natija_id[]" multiple onchange="filter()">
                  	<option value="-1" disabled>~ Tanlang ~</option>
                  	<?
                  		$sql = mysqli_query($link,"SELECT * FROM natijalar ORDER BY name ASC");
                  		while ($natija = mysqli_fetch_assoc($sql)) {
                  			?>
                  	<option value="<?=$natija['id']?>"><?=$natija['name']?></option>
                  			<?
                  		}
                  	?>
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label class="control-label">Kursdan keyingi holat bo'yicha</label>
                  <select class="form-control" id="status_id" name="status_id[]" multiple onchange="filter()">
                  	<option value="-1" disabled>~ Tanlang ~</option>
                  	<?
                  		$sql = mysqli_query($link,"SELECT * FROM statuslar ORDER BY name ASC");
                  		while ($status = mysqli_fetch_assoc($sql)) {
                  			?>
                  	<option value="<?=$status['id']?>"><?=$status['name']?></option>
                  			<?
                  		}
                  	?>
                  </select>
                </div>
                <div class="form-group col-md-4 align-self-end">
                  <button class="btn btn-primary" type="button" onclick="filter()"><i class="fa fa-fw fa-lg fa-search"></i>Filtrlash</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="tile">
            	<div class="overlay" id="loader" style="z-index: 99999999;">
	              <div class="m-loader mr-4">
	                <svg class="m-circular" viewBox="25 25 50 50">
	                	<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"/>
	                </svg>
	              </div>
	              <h3 class="l-text">Yuklanmoqda</h3>
	            </div>
              <div class="tile-body">              	
                <div class="table-responsive" id="displaytable">
              		    
                </div>
              </div>
            </div>
          </div>
        </div>    
    </main>
    <? include_once 'js.php'; ?>

    <script type="text/javascript">
    	$('#natija_id').select2();
    	$('#status_id').select2();
    	$.get("get-tinglovchi.php", function(data,status,xhr) {
    		if(xhr.status==200){
    			$('#displaytable').html(data);
    			$('#loader').css("display","none");
    		}
    		else{    			
    			$('#loader').css("display","block");
    			alert("Internetdan uzilish ro'y berdi. Internet aloqasini tekshiring.");
    		}    		
    	});
    	$('#viloyat_id').change(function() {
    		let vil_id = $(this).val();
    		filter();
    		$.ajax({
    			url: "get-tuman.php",
    			type: "GET",
    			data:{
    				viloyat_id:vil_id,
    			},
    			success:function(data) {
    				$('#tuman_id').html(data);
    			},
    			error:function(xhr) {
    				alert("Kechirasiz internetda uzilish ro'y berdi")
    			}
    		});
    	});
    	function filter(){
    		$('#loader').css("display","flex");
    		let data = $('#filterform').serialize();
    		$.ajax({
    			url: "get-tinglovchi.php",
    			type: "POST",
    			data:data,
    			success:function(data) {
    				$('#displaytable').html(data);

    				$('#loader').css("display","none");
    			},
    			error:function(xhr) {
    				alert("Kechirasiz internetda uzilish ro'y berdi. Internet aloqasini tekshiring");
    			}
    		});
    	}
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
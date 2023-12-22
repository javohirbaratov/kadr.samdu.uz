<?php
	include_once 'ximoya.php';
	$_SESSION['page'] = 10.1;
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
          <h1><i class="fa fa-th-list"></i> Xodimlar</h1>
          <p>Xodimlarni qulay tarzda saralash va ular ustida tezkor amallarni bajarish</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Xodimlar</li>
          <li class="breadcrumb-item active"><a href="#">Tinglovchilarni ko'rish</a></li>
        </ul>
      </div>
      <div class="col-md-12">
          <div class="tile">
            <!-- <h3 class="tile-title">Subscribe</h3> -->
            <div class="tile-body">
              <form class="row" id="filterform">
                <div class="form-group col-md-3">
                  <label class="control-label">Kadrlar bo'limni tanlang</label>
                  <select class="form-control" id="bulim_name_list" name="bulim_name_list" onchange="filter(1)">
                  	<option value="-1">~ Tanlang ~</option>
                  	<?
                  		$sql = mysqli_query($link,"SELECT * FROM kadrlarbulimi");
                  		while ($kb = mysqli_fetch_assoc($sql)) {
                  			?>
                  	<option value="<?=$kb['id']?>"><?=$kb['name']?></option>
                  			<?
                  		}
                  	?>
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label class="control-label">Bo'limni tanlang</label>
                  <select class="form-control" id="bulim_id" name="bulim_id" onchange="filter(2)">
                  	<option value="-1">~ Tanlang ~</option>
                  	<?
                  		if(isset($_GET['kadr_bulim_id'])){
                  			$kadr_bulim_id = $_GET['kadr_bulim_id'];
                  			$sql = mysqli_query($link,"SELECT * FROM bulimlar WHERE kadrbulimi_id='$kadr_bulim_id'");
                  		}
                      else{
                  			$sql = mysqli_query($link,"SELECT * FROM bulimlar");
                      }
                  		while ($bulim = mysqli_fetch_assoc($sql)) {
                  			?>
                  	<option value="<?=$bulim['id']?>"><?=$bulim['name']?></option>
                  			<?
                  		}
                  	?>
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label class="control-label">Lavozimni tanlang</label>
                  <select class="form-control" id="lavozim_id" name="lavozim_id" onchange="filter(3)">
                  	<option value="-1">~ Tanlang ~</option>
                  	<?
                  		$sql = mysqli_query($link, "SELECT * FROM lavozimlar");
                  		while ($lavozim = mysqli_fetch_assoc($sql)) {
                  			?>
                  	<option value="<?=$lavozim['id']?>"><?=$lavozim['lavozim']?></option>
                  			<?
                  		}
                  	?>
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label class="control-label">Faoliyat turi</label>
                  <select class="form-control" id="faoliyat" name="faoliyat" onchange="filter(3)">
                  	<option value="-1">~ Barchasi ~</option>
                  	<option value="asosiy">Asosiy</option>
                  	<option value="ichki">Ichki o'rindosh</option>
                  	<option value="tashqi">Tashqi o'rindosh</option>
                  	<option value="tashqi">Soatbay</option>                  	
                  </select>
                </div>
                <div class="form-group col-md-4 align-self-end">
                  <button class="btn btn-primary" type="button" onclick="filter(3)"><i class="fa fa-fw fa-lg fa-search"></i>Filtrlash</button>
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
      $('#bulim_name_list').select2();
      $('#lavozim_id').select2();
      $('#bulim_id').select2();
      function filter(f) {
      	$('#loader').css("display","flex");
      	let kb = $('#bulim_name_list').val();
      	let bulim_id = $('#bulim_id').val();
      	let lavozim_id = $('#lavozim_id').val();
      	let faoliyat = $('#faoliyat').val();
      	if (Number(kb)>0 && f==1){
      		$.ajax({
	      		url: "get-bulim-options.php",
	      		type: "GET",
	      		data:{
	      			kb:kb,
	      		},
	      		success:function(data){
	      			$('#loader').css("display","none");
	    				$('#bulim_id').html(data);
	      		},
	      		error:function(xhr) {
	      			alert("Kechirasiz internetda uzilish ro'y berdi. Internet aloqasini tekshiring");
	      		}
	      	});
	      	$.ajax({
	      		url: "get-lavozim-options.php",
	      		type: "GET",
	      		data:{
	      			kb:kb,
	      		},
	      		success:function(data){
	      			$('#loader').css("display","none");
	    				$('#lavozim_id').html(data);
	      		},
	      		error:function(xhr) {
	      			alert("Kechirasiz internetda uzilish ro'y berdi. Internet aloqasini tekshiring");
	      		}
	      	});
      	}
      	if (Number(bulim_id)>0 && f==2){
      		$.ajax({
	      		url: "get-lavozim-options.php",
	      		type: "GET",
	      		data:{
	      			bulim_id:bulim_id,
	      		},
	      		success:function(data){
	      			$('#loader').css("display","none");
	    				$('#lavozim_id').html(data);
	      		},
	      		error:function(xhr) {
	      			alert("Kechirasiz internetda uzilish ro'y berdi. Internet aloqasini tekshiring");
	      		}
	      	});
      	}
      	$.ajax({
      		url: "get-xodim-history.php",
      		type: "GET",
      		data:{
      			kb:kb,bulim_id:bulim_id,lavozim_id:lavozim_id,faoliyat:faoliyat,action:"filter",
      		},
      		success:function(data){
      			$('#loader').css("display","none");
    				$('#displaytable').html(data);
      		},
      		error:function(xhr) {
      			alert("Kechirasiz internetda uzilish ro'y berdi. Internet aloqasini tekshiring");
      		}
      	});
      }
    	$.get("get-xodim-history.php",function(data,status) {
				$('#loader').css("display","none");
				$('#displaytable').html(data);
			});
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
	      				type: "GET",
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
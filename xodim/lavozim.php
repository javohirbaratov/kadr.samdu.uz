<?php
	include_once 'ximoya.php';
	$_SESSION['page'] = 3.3;
?>
<!DOCTYPE html>
<html lang="uz">
  <head>
	  <?php include_once 'css.php'; ?>
  </head>
  <body class="app sidebar-mini">
  <?php include_once 'header.php'; ?>
    <main class="app-content">
      <div class="app-title">
          <div>
            <h1><i class="fa fa-th-list"></i> Lavozim</h1>
            <p>Lavozimni qulay tarzda saralash va ular ustida tezkor amallarni bajarish</p>
          </div>
          <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Lavozim</li>
            <li class="breadcrumb-item active"><a href="#">Lavozimlarni ko'rish</a></li>
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
						<?php
	                		$sql = mysqli_query($link,"SELECT * FROM kadrlarbulimi");
	                		while ($kb = mysqli_fetch_assoc($sql)) {
	                			?>
	                	<option value="<?=$kb['id']?>"><?=$kb['name']?></option>
								<?php
	                		}
	                	?>
	                </select>
	              </div>
	              <div class="form-group col-md-3">
	                <label class="control-label">Bo'limni tanlang</label>
	                <select class="form-control" id="bulim_id" name="bulim_id" onchange="filter(2)">
	                	<option value="-1">~ Tanlang ~</option>
						<?php
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
								<?php
	                		}
	                	?>
	                </select>
	              </div>
	              <div class="form-group col-md-3">
	                <label class="control-label">Bo'linma/kafedra tanlang</label>
	                <select class="form-control" id="bulinma_id" name="bulinma_id" onchange="filter(3)">
	                	<option value="0">~ Tanlang ~</option>
						<?php
	                		$sql = mysqli_query($link, "SELECT * FROM `kafedra`");
							var_dump($sql);
	                		while ($fetch = mysqli_fetch_assoc($sql)) {
	                			?>
	                				<option value="<?=$fetch['id']?>"><?=$fetch['name']?></option>
								<?php
	                		}
	                	?>
	                </select>
	              </div>
	              <div class="form-group col-md-3">
	                <label class="control-label">Yats turi</label>
	                <select class="form-control" id="turi" name="turi" onchange="filter(4)">
	                	<option value="-1">~ Barchasi ~</option>
	                	<option value="bazaviy">Bazaviy</option>
	                	<option value="razryad">Razyadli</option>
	                </select>
	              </div>
	              <div class="form-group col-md-4 align-self-end">
	                <button class="btn btn-primary" type="button" onclick="filter(5)"><i class="fa fa-fw fa-lg fa-search"></i>Filtrlash</button>
	              </div>
	            </form>
	          </div>
	        </div>
	      </div>
        <div class="row">
          <div class="col-md-12">
            <div class="tile">
              <div class="tile-body">
              	<a href="lavozim-create.php" class="btn btn-success" style="margin-bottom: 10px;"><i class="fa fa-plus"></i> Yangi qo'shish</a>
              	<div>
              		<div class="overlay" id="loader" style="z-index: 99999999;">
			              <div class="m-loader mr-4">
			                <svg class="m-circular" viewBox="25 25 50 50">
			                	<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"/>
			                </svg>
			              </div>
			              <h3 class="l-text">Yuklanmoqda</h3>
			            </div>
			            <div class="table-responsive" id="displaytable"> </div>
                  
                	</div>
              	</div>
                
              </div>
            </div>
          </div>
        </div>    
    </main>
  <?php include_once 'js.php'; ?>
    <script type="text/javascript">
        $(document).ready(function() {
    	    $.get("get-lavozim-data-table.php",function(data,status) {
				$('#loader').css("display","none");
 			    console.log(data);
				$('#displaytable').html(data);
			});
		});
			$('#bulim_name_list').select2();
            $('#bulim_id').select2();
            $('#bulinma_id').select2();
      
			$('#bulim_name_list').change(function() {
				let kb_id = $(this).val();
				$.ajax({
      		url: "get-bulim-options.php",
      		type: "GET",
      		data:{
      			kb:kb_id,
      		},
      		success:function(data){	      			
    				$('#bulim_id').html(data);
      		},
      		error:function(xhr) {
      			alert("Kechirasiz internetda uzilish ro'y berdi. Internet aloqasini tekshiring");
      		}
      	});
			})
			$('#bulim_id').change(function() {
				let kb_id = $(this).val();
				$.ajax({
      		url: "get-bulinma-options.php",
      		type: "GET",
      		data:{
      			kb:kb_id,
      		},
      		success:function(data){	      			
    				$('#bulinma_id').html(data);
      		},
      		error:function(xhr) {
      			alert("Kechirasiz internetda uzilish ro'y berdi. Internet aloqasini tekshiring");
      		}
      	});
			})
			function filter(id) {				
				$('#loader').css("display","flex");
				let kb_id = $('#bulim_name_list').val();
				let bulim_id = $('#bulim_id').val();
				let bulinma_id = $('#bulinma_id').val();
				let turi = $('#turi').val();
				let action = "action1";
				if(id==2){
					action = "action2";
				}
				if(id==3){
					action = "action3";
				}
				if(id==4){
					action = "action4";
				}
				if(id==5){
					action = "action5";
				}

				$.ajax({
	      		url: "get-lavozim-data-table.php",
	      		type: "GET",
	      		data:{
	      			kb_id:kb_id,bulim_id:bulim_id,bulinma_id:bulinma_id,turi:turi,action:action,
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
    
    </script>
  </body>
</html>
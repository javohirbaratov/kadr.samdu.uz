<?php
	include_once 'ximoya.php';
	$_SESSION['page'] = 3.2;
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
          <h1><i class="fa fa-edit"></i> Bo'lim qo'shish</h1>
          <p>Formani to'ldiring</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Bo'limlar bo'limi</li>
          <li class="breadcrumb-item"><a href="#">Bo'lim yaratish</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Bo'lim yaratish uchun maydonlarni to'ldiring</h3>
            <div class="tile-body">
              <form id="formdata1">
                <div class="form-group">
                  <label class="control-label">Bo'limni tanlang</label>
                  <select name="kadr_bulim_id" class="form-control" id="kadr_bulim_id1">
                    <option value="-1">~ Tanlang: ~</option>
                    <?php
                      $sql = mysqli_query($link,"SELECT * FROM kadrlarbulimi");
                      while ($fetch = mysqli_fetch_assoc($sql)) {
                        ?>
                        <option value="<?=$fetch['id']?>"><?=$fetch['name']?></option>
                        <?
                      }
                    ?>
                  </select>                  
                </div>
                <div class="form-group">
                  <label class="control-label">Bo'lim nomi</label>
                  <input class="form-control" type="text" placeholder="Bo'lim nomini kiriting" name="bulim_name" id="bulim_name_form1">
                </div>
                <div class="form-group">
                  <label class="control-label">Jami shtat</label>
                  <input class="form-control" type="number" placeholder="Jami shtat" name="shtat">
                </div>
                <!-- <div class="form-group">
                  <label class="control-label">YTS turi</label>
                  <select name="turi" class="form-control" id="bulimlar_id">
                    <option value="bazaviy">Bazaviy</option>
                    <option value="razryad">Razryadli</option>
                  </select>
                </div>
                <div class="form-group">
                  <label class="control-label">YaTS bo'yicha razryadi</label>
                  <input class="form-control" type="number" placeholder="Razryadini kiriting" name="razryad">
                </div>
                <div class="form-group">
                  <label class="control-label">Tarif koef.</label>
                  <input class="form-control" type="text" placeholder="Koeffitsiyentni kiriting" name="koef">
                </div> -->
                <input type="hidden" name="action" value="insertbulim">               
              </form>
            </div>
            <div class="tile-footer">
              <button class="btn btn-success" type="button" id="submitform1"><i class="fa fa-fw fa-lg fa-check-circle"></i>Qo'shish</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Bekor qilish</a>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Bo'linma/kafedra yaratish uchun maydonlarni to'ldiring</h3>
            <div class="tile-body">
              <form id="formdata2">
                <div class="form-group">
                  <label class="control-label">Kadrlar bo'limini tanlang</label>
                  <select name="kb_id" class="form-control" id="kadr_bulim_id2">
                    <option value="-1">~ Tanlang: ~</option>
                    <?php
                      $sql = mysqli_query($link,"SELECT * FROM kadrlarbulimi");
                      while ($fetch = mysqli_fetch_assoc($sql)) {
                        ?>
                        <option value="<?=$fetch['id']?>"><?=$fetch['name']?></option>
                        <?
                      }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label class="control-label">Bo'limni tanlang</label>
                  <select name="bulim_id" class="form-control" id="bulimlar_id">
                    <option value="-1">~ Tanlang: ~</option>
                    <?php
                      $sql = mysqli_query($link,"SELECT * FROM bulimlar");
                      while ($fetch = mysqli_fetch_assoc($sql)) {
                        ?>
                        <option value="<?=$fetch['id']?>"><?=$fetch['name']?></option>
                        <?
                      }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label class="control-label">Bo'linma nomi</label>
                  <input class="form-control" type="text" placeholder="Bo'linma nomini kiriting" name="bulim_name" id="bulim_name_form2">
                </div>
                <!-- <div class="form-group">
                  <label class="control-label">YTS turi</label>
                  <select name="turi" class="form-control" id="bulimlar_id">
                    <option value="bazaviy">Bazaviy</option>
                    <option value="razryad">Razryadli</option>
                  </select>
                </div>
                <div class="form-group">
                  <label class="control-label">YaTS bo'yicha razryadi</label>
                  <input class="form-control" type="number" placeholder="Razryadini kiriting" name="razryad">
                </div>
                <div class="form-group">
                  <label class="control-label">Tarif koef.</label>
                  <input class="form-control" type="text" placeholder="Koeffitsiyentni kiriting" name="koef">
                </div> -->
                <input type="hidden" name="action" value="insertbulimma">               
              </form>
            </div>
            <div class="tile-footer">
              <button class="btn btn-success" type="button" id="submitform2"><i class="fa fa-fw fa-lg fa-check-circle"></i>Qo'shish</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Bekor qilish</a>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Kadrlar bo'limini yaratish uchun maydonlarni to'ldiring</h3>
            <div class="tile-body">
              <form id="formdata3">
                <div class="form-group">
                  <label class="control-label">Kadrlar bo'limi nomi</label>
                  <input class="form-control" type="text" placeholder="Bo'lim nomini kiriting" name="bulim_name">
                </div>
                <input type="hidden" name="action" value="insertkadbulim">               
              </form>
            </div>
            <div class="tile-footer">
              <button class="btn btn-success" type="button" id="submitform3"><i class="fa fa-fw fa-lg fa-check-circle"></i>Qo'shish</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Bekor qilish</a>
            </div>
          </div>
        </div>
      </div>
    </main>
    <? include_once 'js.php'; ?>  
    <script type="text/javascript">
      $('#kadr_bulim_id1').select2();
      $('#kadr_bulim_id2').select2();
      $('#bulimlar_id').select2();
    	$('#kadr_bulim_id2').change(function() {
    		let id = $(this).val();
    		$.ajax({
    			url: "get-bulimlar-options.php",
    			type: "GET",
    			data:{
    				id:id,
    			},
    			success:function(data) {
    				$('#bulimlar_id').html(data);
    			},
    			error:function(xhr) {
    				alert("Kechirasiz internetda uzilish ro'y berdi")
    			}
    		});
    	});
    	$('#submitform1').click(function() {
    		// let dataform = $('#formdata1').serialize();
    		// console.log(dataform);
    		$.ajax({
    			url: "insert.php",
    			type: "POST",
          processData: false,
          contentType: false,
          data: new FormData($("#formdata1")[0]),    			
    			success:function(data) {
    				console.log(data);
    				var obj = jQuery.parseJSON(data);
    				if (obj.error == 0) {
	              $.notify({
	                title: "Good job : ",
	                message: obj.xabar,
	                icon: 'fa fa-check' 
	              },{
	                type: "success"
	              });
	              // setTimeout(() => {
	              //   location.href='courses.php';
	              // }, 1500);
	              //$('#formdata1')[0].reset();
                $('#bulim_name_form1').val('');
	          }
	          else{ 
	            $.notify({
	              title: "Xatolik : ",
	              message: obj.xabar,
	              icon: 'fa fa-close' 
	            },{
	              type: "danger"
	            });
	          }    				
    			},
    			error:function(xhr) {
    				alert("Kechirasiz internetda uzilish ro'y berdi")
    			}
    		})
    	})
      $('#submitform2').click(function() {
        // let dataform = $('#formdata1').serialize();
        // console.log(dataform);
        $.ajax({
          url: "insert.php",
          type: "POST",
          processData: false,
          contentType: false,
          data: new FormData($("#formdata2")[0]),         
          success:function(data) {
            console.log(data);
            var obj = jQuery.parseJSON(data);
            if (obj.error == 0) {
              $.notify({
                title: "Good job : ",
                message: obj.xabar,
                icon: 'fa fa-check' 
              },{
                type: "success"
              });
              // setTimeout(() => {
              //   location.href='courses.php';
              // }, 1500);
              //$('#formdata1')[0].reset();
              $('#bulim_name_form2').val('');
            }
            else{ 
              $.notify({
                title: "Xatolik : ",
                message: obj.xabar,
                icon: 'fa fa-close' 
              },{
                type: "danger"
              });
            }           
          },
          error:function(xhr) {
            alert("Kechirasiz internetda uzilish ro'y berdi")
          }
        })
      })
      $('#submitform3').click(function() {
        // let dataform = $('#formdata1').serialize();
        // console.log(dataform);
        $.ajax({
          url: "insert.php",
          type: "POST",
          processData: false,
          contentType: false,
          data: new FormData($("#formdata3")[0]),         
          success:function(data) {
            //console.log(data);
            var obj = jQuery.parseJSON(data);
            if (obj.error == 0) {
              $.notify({
                title: "Good job : ",
                message: obj.xabar,
                icon: 'fa fa-check' 
              },{
                type: "success"
              });
              // setTimeout(() => {
              //   location.href='courses.php';
              // }, 1500);
              //$('#formdata1')[0].reset();
              $('#bulim_name_form2').val('');
            }
            else{ 
              $.notify({
                title: "Xatolik : ",
                message: obj.xabar,
                icon: 'fa fa-close' 
              },{
                type: "danger"
              });
            }           
          },
          error:function(xhr) {
            alert("Kechirasiz internetda uzilish ro'y berdi")
          }
        })
      })
    </script>  
  </body>
</html>
<?php
	include_once 'ximoya.php';
	$_SESSION['page'] = 4.3;
  if(!isset($_GET['id'])){
      exit('Bad request 400!');
  }
  else{
    $id = filter($_GET['id']);
    $sql = mysqli_query($link,"SELECT * FROM step WHERE id='$id'");
    $fetch = mysqli_fetch_assoc($sql);
  }
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
          <h1><i class="fa fa-edit"></i> Stipendiyani tahrirlash</h1>
          <p>Formani to'ldiring</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Stipendiyalar bo'limi</li>
          <li class="breadcrumb-item"><a href="#">Stipendiyani tahrirlash</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Stipendiya malumotlarini tahrirlash</h3>
            <div class="tile-body">
              <form id="formdata">
                <div class="form-group">
                  <label class="control-label">Stipendiya nomi</label>
                  <input class="form-control" type="text" placeholder="Stipendiya nomini kiriting" value="<?=$fetch['nomi']?>" name="nomi">
                </div>
                <div class="form-group">
                  <label class="control-label">Stipendiya miqdori</label>
                  <input class="form-control" type="number" min="0" placeholder="Stipendiya miqdorini kiriting" value="<?=$fetch['miqdor']?>" name="miqdor">
                </div>
                <input type="hidden" name="action" value="updatestipendiya">   
                <input type="hidden" name="id" value="<?=$fetch['id']?>">
              </form>
            </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="button" id="submitform"><i class="fa fa-fw fa-lg fa-pencil"></i>Tahrirlash</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="stipendiyas.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Bekor qilish</a>
            </div>
          </div>
        </div>

      </div>
    </main>
    <? include_once 'js.php'; ?>  
    <script type="text/javascript">
    	$('#submitform').click(function() {
    		let dataform = $('#formdata').serialize();
    		console.log(dataform);
    		$.ajax({
    			url: "update.php",
    			type: "POST",
    			data:dataform,
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
	              setTimeout(() => {
	                location.href='stipendiyas.php';
	              }, 1500);
	              // $('#formdata')[0].reset();
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
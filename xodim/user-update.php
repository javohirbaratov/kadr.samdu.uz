<?php
	include_once 'ximoya.php';
	$_SESSION['page'] = 2.3;
  if(!isset($_GET['id'])){
      exit('Bad request 400!');
  }
  else{
    $id = filter($_GET['id']);
    $sql = mysqli_query($link,"SELECT * FROM user WHERE id='$id'");
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
          <h1><i class="fa fa-edit"></i> Foydalanuvchini tahrirlash</h1>
          <p>Formani to'ldiring</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Foydalanuvchilar bo'limi</li>
          <li class="breadcrumb-item"><a href="#">Foydalanuvchini tahrirlash</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Foydalanuvchi malumotlarini tahrirlash</h3>
            <div class="tile-body">
              <form id="formdata">
                <div class="form-group">
                  <label class="control-label">Foydalanuvchi nomi</label>
                  <input class="form-control" type="text" value="<?=$fetch['nomi']?>" name="nomi">
                </div>
                <div class="form-group">
                  <label class="control-label">Login</label>
                  <input class="form-control" type="text" value="<?=$fetch['login']?>" name="login">
                </div>
                <div class="form-group">
                  <label class="control-label">Parol</label>
                  <input class="form-control" type="password" placeholder="Parolni yangidan kiriting" name="parol">
                </div>
                <div class="form-group">
                  <label class="control-label">Telefon raqami</label>
                  <input class="form-control" type="text" value="<?=$fetch['tel_raq']?>" name="tel_raqam" id="tel_raqam">
                </div>
                <script src="https://unpkg.com/imask"></script>
						    <script type="text/javascript">
						        var phoneMask = IMask(
						          document.getElementById('tel_raqam'), {
						            mask: '+{998}(00)000-00-00'
						        });
						    </script>
						    <div class="form-group">
                  <label class="control-label">Viloyat</label>
                  <select name="vil_id" class="form-control" id="vil_id">
                  	<option value="-1">~ Tanlang ~</option>
                  	<?
                  		$sql = mysqli_query($link,"SELECT * FROM viloyat ORDER BY nomi ASC");
                  		while ($f = mysqli_fetch_assoc($sql)) {
                  			?>
                  			<option <? if($f['id']==$fetch['viloyat_id']){ echo "selected"; } ?> value="<?=$f['id']?>"><?=$f['nomi']?></option>
                  			<?
                  		}
                  	?>
                  </select>
                </div>
                <div class="form-group">
                  <label class="control-label">Tuman</label>
                  <select name="tuman_id" class="form-control" id="tuman_id">
                  	<option value="-1">~ Tanlang ~</option>
                  	<?
                  		$sql = mysqli_query($link,"SELECT * FROM tuman ORDER BY nomi ASC");
                  		while ($f = mysqli_fetch_assoc($sql)) {
                  			?>
                  			<option <? if($f['id']==$fetch['tuman_id']){ echo "selected"; } ?> value="<?=$f['id']?>"><?=$f['nomi']?></option>
                  			<?
                  		}
                  	?>
                  </select>
                </div>
                <div class="form-group">
                  <label class="control-label">Tizimdagi roli</label>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="rol" value="admin" <? if($fetch['rol']=="admin"){ echo "checked"; } ?>>Admin
                    </label>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="rol" value="user" <? if($fetch['rol']=="user"){ echo "checked"; } ?>>User
                    </label>
                  </div>
                </div>
                <input type="hidden" name="action" value="updateuser">   
                <input type="hidden" name="id" value="<?=$fetch['id']?>">            
              </form>
            </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="button" id="submitform"><i class="fa fa-fw fa-lg fa-check-circle"></i>Register</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
            </div>
          </div>
        </div>

      </div>
    </main>
    <? include_once 'js.php'; ?>  
    <script type="text/javascript">
    	$('#vil_id').change(function() {
    		let vil_id = $(this).val();
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
	                location.href='users.php';
	              }, 2500);
	              $('#formdata')[0].reset();
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
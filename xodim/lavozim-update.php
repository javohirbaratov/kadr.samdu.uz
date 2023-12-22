<?php
	include_once 'ximoya.php';
	$_SESSION['page'] = 3.4;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <? 
    include_once 'css.php'; 

    if (isset($_GET['l_id'])) {
      $id = $_GET['l_id'];

      $sql = mysqli_query($link,"SELECT * FROM lavozimlar WHERE id = '$id'");
      $l = mysqli_fetch_assoc($sql);
      $k_b_id = $l['kadr_bulim_id'];
      $bulim_id = $l['bulim_id'];

    }


    ?>

  </head>
  <body class="app sidebar-mini">
    <? include_once 'header.php'; ?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i>Lavozim tahrirlash</h1>
          <p>Formani to'ldiring</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Lavozimlar</li>
          <li class="breadcrumb-item"><a href="#">Bo'lim yaratish</a></li>
        </ul>
      </div>
      <div class="row">
        
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Lavozim ma'lumotlarini o'zgartirish</h3>
            <div class="tile-body">
              <form action="update.php" method="POST">
                <div class="form-group">
                  <label class="control-label">Kadrlar bo'limini tanlang</label>
                  <select name="kb_id" class="form-control" id="kadr_bulim_id2">
                    <option value="0">~ Tanlang: ~</option>
                    <?php
                      $sql = mysqli_query($link,"SELECT * FROM kadrlarbulimi");
                      while ($fetch = mysqli_fetch_assoc($sql)) {
                        ?>
                        <option <?php if( $k_b_id == $fetch['id'] ) echo "selected";?> value="<?=$fetch['id']?>"><?=$fetch['name']?></option>
                        <?
                      }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label class="control-label">Bo'limni tanlang</label>
                  <select name="bulim_id" class="form-control" id="bulimlar_id">
                    <option value="0">~ Tanlang: ~</option>
                    <?php
                      $sql = mysqli_query($link,"SELECT * FROM bulimlar where kadrbulimi_id = '$k_b_id'");
                      while ($fetch = mysqli_fetch_assoc($sql)) {
                        ?>
                        <option <?php if( $bulim_id == $fetch['id'] ) echo "selected";?> value="<?=$fetch['id']?>"><?=$fetch['name']?></option>
                        <?
                      }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label class="control-label">Kafedra/Bo'limni tanlang</label>
                  <select name="bulinma" class="form-control" id="bulinma">
                    <option value="0">~ Tanlang: ~</option>
                    <?php
                      $sql = mysqli_query($link,"SELECT * FROM kafedra where bulim_id = '$bulim_id' ");
                      while ($fetch = mysqli_fetch_assoc($sql)) {
                        ?>
                        <option <?php if( $l['kafedra_id'] == $fetch['id'] ) echo "selected";?> value="<?=$fetch['id']?>"><?=$fetch['name']?></option>
                        <?
                      }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label class="control-label">Lavozim nomi</label>
                  <input class="form-control" type="text" placeholder="Lavozim nomini kiriting" name="lavozim_name" id="bulim_name_form2" value="<?=$l['lavozim'] ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">YTS turi</label>
                  <select name="turi" class="form-control" id="turi">
                    <option value="0">~ Tanlang ~</option>
                    <option <?php if( $l['turi'] == 'bazaviy' ) echo "selected";?> value="bazaviy">Bazaviy</option>
                    <option <?php if( $l['turi'] == 'razryad' ) echo "selected";?> value="razryad">Razryadli</option>
                  </select>
                </div>
                <div class="form-group razryad">
                  <label class="control-label">YaTS bo'yicha razryadi</label>
                  <input class="form-control" type="number" placeholder="Razryadini kiriting" name="razryad" id="razryad" value="<?=$l['razryad'] ?>">
                </div>
                <div class="form-group razryad">
                  <label class="control-label">Tarif koef.</label>
                  <input class="form-control" type="number" placeholder="Koeffitsiyentni kiriting" id="koef" name="koef" value="<?=$l['tarifkoef'] ?>">
                </div>
                <div class="form-group bazaviy">
                  <label class="control-label">Oylik ish haqqi</label>
                  <input class="form-control" type="number" placeholder="Oylik maoshni kiriting" id="oylik" name="oylik" value="<?=$l['oylik'] ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Jami shtat</label>
                  <input class="form-control" type="number" placeholder="Jami shtatni kiriting" id="shtat" name="shtat" value="<?=$l['shtat'] ?>">
                  <input type="hidden" name="action" value="lavozim">
                  <input type="hidden" name="id" value="<?=$l['id'] ?>">
                </div>
               <button class="btn btn-success" type="submit" ><i class="fa fa-fw fa-lg fa-check-circle"></i>O'zgarishni saqlash</button>
              </form>
            </div>
            <div class="tile-footer">
              &nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Bekor qilish</a>
            </div>
          </div>
        </div>
        
      </div>
    </main>
    <? include_once 'js.php'; ?>  
    <script type="text/javascript">
      $('.razryad').css("display","none");
      $('.bazaviy').css("display","none");
      $('#kadr_bulim_id1').select2();
      $('#kadr_bulim_id2').select2();
      $('#bulimlar_id').select2();
      $('#bulinma').select2();
      $('#turi').change(function() {
        let t = $(this).val();
        if(t == "bazaviy"){
          $('.razryad').css("display","none");
          $('.bazaviy').css("display","block");
        }
        if(t == "razryad"){
          $('.bazaviy').css("display","none");
          $('.razryad').css("display","block");
        }
        if(t == 0){
          $('.razryad').css("display","none");
          $('.bazaviy').css("display","none");
        }
      })
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
      $('#bulimlar_id').change(function() {
        let id = $(this).val();
        $.ajax({
          url: "get-bulimma-options.php",
          type: "GET",
          data:{
            id:id,
          },
          success:function(data) {
            $('#bulinma').html(data);
          },
          error:function(xhr) {
            alert("Kechirasiz internetda uzilish ro'y berdi")
          }
        });
      });
    	
      
    </script>  
  </body>
</html>
<?php
 
	include_once 'ximoya.php';
	$_SESSION['page'] = 3.3;
  if(!isset($_GET['id'])){
      exit('Bad request 400!');
  }
  else{
    $id = filter($_GET['id']);
    $sql1 = mysqli_query($link,"SELECT * FROM kafedra WHERE id='$id'");
    $b = mysqli_fetch_assoc($sql1);
    $bulim_id = $b['bulim_id'];
    $sql2 = mysqli_query($link,"SELECT * FROM bulimlar WHERE id='$bulim_id'");
    $b2 = mysqli_fetch_assoc($sql2);
    $kadr_bulim_id = $b2['kadrbulimi_id'];
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
          <h1><i class="fa fa-edit"></i>Ma'lumotlarini o'zgartirish</h1>
          <p>Formani to'ldiring</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Maydonlarni to'ldiring</h3>
            <div class="tile-body">
              <form action="update.php" method="POST">
                <div class="form-group">
                  <label class="control-label">Kadrlar bo'limini tanlang</label>
                  <select name="kb_id" class="form-control" id="kadr_bulim_id2">
                    <option value="-1">~ Tanlang: ~</option>
                    <?php
                      $sql = mysqli_query($link,"SELECT * FROM kadrlarbulimi");
                      while ($fetch = mysqli_fetch_assoc($sql)) {
                        ?>
                        <option <? if($b2['kadrbulimi_id']==$fetch['id']) echo "selected"; ?> value="<?=$fetch['id']?>"><?=$fetch['name']?></option>
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
                      $sql = mysqli_query($link,"SELECT * FROM bulimlar where kadrbulimi_id = '$kadr_bulim_id' ");
                      while ($fetch = mysqli_fetch_assoc($sql)) {
                        ?>
                        <option <? if($b['bulim_id']==$fetch['id']) echo "selected"; ?> value="<?=$fetch['id']?>"><?=$fetch['name']?></option>
                        <?
                      }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label class="control-label">Bo'linma nomi</label>
                  <input class="form-control" type="text" placeholder="Bo'linma nomini kiriting" name="bulim_name" id="bulim_name_form2" value="<?=$b['name']?>">
                </div>
                <input type="hidden" name="action" value="bulinma"> 
                <input type="hidden" name="id" value="<?=$b['id']?>">  
                 <button class="btn btn-success" type="submit" ><i class="fa fa-fw fa-lg fa-check-circle"></i> O'zgarishni saqlash</button>             
              </form>
            </div>
            <div class="tile-footer">
               <button class="btn btn-secondary" onclick="history.back()" ><i class="fa fa-fw fa-lg fa-check-circle"></i> Ortga</button>       
            </div>
          </div>
        </div>
      </div>   

    </main>
    <? include_once 'js.php'; ?>  
    <script type="text/javascript">
      $('#kadr_bulim_id1').select2();
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
      
    </script>  
  </body>
</html>
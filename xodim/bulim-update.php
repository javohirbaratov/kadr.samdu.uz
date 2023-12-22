<?php
 
	include_once 'ximoya.php';
	$_SESSION['page'] = 3.3;
  if(!isset($_GET['id'])){
      exit('Bad request 400!');
  }
  else{
    $id = filter($_GET['id']);
    $sql1 = mysqli_query($link,"SELECT * FROM bulimlar WHERE id='$id'");
    $b = mysqli_fetch_assoc($sql1);
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
            <h3 class="tile-title">Bo'lim yaratish uchun maydonlarni to'ldiring</h3>
            <div class="tile-body">
              <form action="update.php" method="POST">
                <div class="form-group">
                  <label class="control-label">Bo'limni tanlang</label>
                  <select name="kadr_bulim_id" class="form-control" id="kadr_bulim_id1">
                    <option value="-1">~ Tanlang: ~</option>
                    <?php
                      $sql = mysqli_query($link,"SELECT * FROM kadrlarbulimi");
                      while ($fetch = mysqli_fetch_assoc($sql)) {
                        ?>
                        <option <? if($b['kadrbulimi_id']==$fetch['id']) echo "selected"; ?> value="<?=$fetch['id']?>"><?=$fetch['name']?></option>
                        <?
                      }
                    ?>
                  </select>                  
                </div>
                <div class="form-group">
                  <label class="control-label">Bo'lim nomi</label>
                  <input class="form-control" type="text" placeholder="Bo'lim nomini kiriting" name="bulim_name" id="bulim_name_form1" value="<?=$b['name']?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Jami shtat</label>
                  <input class="form-control" type="number" placeholder="Jami shtat" name="shtat" value="<?=$b['shtat']?>">
                </div>
              
                <input type="hidden" name="action" value="bulim"> 
                <input type="hidden" name="id" value="<?=$b['id']?>">   
                <button class="btn btn-success" type="submit" ><i class="fa fa-fw fa-lg fa-check-circle"></i> O'zgarishni saqlash</button>             
              </form>
            </div>
            <div class="tile-footer">
            </div>
          </div>
        </div>
      </div>

      <div class="row">
          <div class="col-md-12">
            <div class="tile">
              <div class="tile-body">
                <a href="bulim-create.php" class="btn btn-success" style="margin-bottom: 10px;"><i class="fa fa-plus"></i> Yangi qo'shish</a>
                <div class="table-responsive">
                  <table class="table table-hover table-bordered" id="sampleTable">
                    <thead>
                      <tr>
                        <th>Nomer</th>
                        <th>Bo'linma nomi</th>
                        <th>Bo'lim nomi</th>
                        <th>Amallar</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?
                        $t=0;
                        $sql = mysqli_query($link,"SELECT * FROM kafedra WHERE bulim_id ='$id'");
                        while($fetch = mysqli_fetch_assoc($sql)){
                          $t++;
                      ?>
                      <tr id="tr<?=$fetch['id']?>">
                          <td><?=$t?></td>
                          <td><?=$fetch['name']?></td>
                          <td><?=$b['name']?></td>
                                          
                          <td><a href="bulinma-update.php?id=<?=$fetch['id']?>" class="btn btn-primary"><i class="fa fa-pencil"></i> O'zgartirish</a><button class="btn btn-danger"><i class="fa fa-trash"></i> O'chirish</button></td>
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
      $('#kadr_bulim_id1').select2();
    </script>  
  </body>
</html>
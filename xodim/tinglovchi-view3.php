<?php
include_once 'ximoya.php';
$_SESSION['page'] = 129;
if(!isset($_GET['id'])){
  exit('Bad request 400!');
}
else{
  $id = filter($_GET['id']);
  $sql = mysqli_query($link,"SELECT * FROM xodimlar WHERE id='$id'");
  $fetch = mysqli_fetch_assoc($sql);
}
$viloyat_id = $fetch['viloyat_id'];
$sql = mysqli_query($link,"SELECT * FROM viloyat WHERE id='$viloyat_id'");
$viloyat = mysqli_fetch_assoc($sql);
$tuman_id = $fetch['tuman_id'];
$sql = mysqli_query($link,"SELECT * FROM tuman WHERE id='$tuman_id'");
$tuman = mysqli_fetch_assoc($sql);



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <? include_once 'css.php'; ?>
  <style type="text/css">
    table tr th:nth-child(1){
      width: 20%;
    }
  </style>
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
        <li class="breadcrumb-item active"><a href="#">Xodimlarni ko'rish</a></li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12 tile">
        <button class="btn btn-secondary col-md-3" onclick="history.back()"><i class="fa fa-check"></i>Ortga</button>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">

        <div class="tile">
          <h3>Shaxsiy ma'lumotlarni tahrirlash</h3>
          <div class="tile-body">
            <div class="table-responsive">
              <table class="table table-hover table-bordered table-striped">
                <thead>
                  <form action="update.php" method="POST">

                    <tr>
                      <th>Familiya</th>

                      <th>
                        <div class="form-group">
                          <input class="form-control" type="text" name="familya" value="<?=$fetch['familya']?> ">
                        </div>
                      </th>
                    </tr>
                    <tr>
                      <th>Ism</th>
                      <th>
                        <div class="form-group">
                          <input class="form-control" type="text" name="ism" value="<?=$fetch['ism']?>">
                        </div>
                      </th>
                    </tr>
                    <tr>
                      <th>Otasining ismi</th>
                      <th> 

                        <div class="form-group">
                          <input class="form-control" type="text" name="otch" value="<?=$fetch['otch']?>">
                        </div>
                      </th>
                    </tr>
                    <tr>  
                      <th>Tug'ilgan sana</th>
                      <th>
                        <div class="form-group">
                          <input class="form-control" type="text" name="birthdate" value="<?=$fetch['birthdate']?>">
                        </div>
                      </th>
                    </tr>
                    <tr>  
                      <th>Pasport seriya va raqami</th>
                      <th> 
                        <div class="form-group">
                          <input class="form-control" type="text" name="nomer" value="<?=$fetch['nomer']?>">
                        </div>
                      </th>
                    </tr>
                    <tr>  
                      <th>JSHSHIR</th>
                      <th> 
                        <div class="form-group">
                          <input class="form-control" type="text" name="jshir" value="<?=$fetch['jshir']?>">
                        </div>
                      </th>
                    </tr>
                    <tr>  
                      <th>Viloyati</th>
                      <th>

                        <div class="form-group">

                          <select class="form-control" id="viloyat_id" name="viloyat_id" onchange="tuman()">
                            <option value="-1">~ Tanlang ~</option>
                            <?
                            $viloyat = $fetch['viloyat_id'];
                            $sql = mysqli_query($link,"SELECT * FROM viloyat ");  
                            while ($viloyat = mysqli_fetch_assoc($sql)) {
                              ?>
                              <option <? if($fetch['viloyat_id']==$viloyat['id']) echo "selected"; ?> value="<?=$viloyat['id']?>"><?=$viloyat['nomi']?></option>
                              <?
                            }
                            ?>
                          </select>
                        </div>
                      </tr>
                      <tr>  
                        <th>Tumani</th>
                        <th>

                          <div class="form-group ">

                            <select class="form-control" id="tuman_id" name="tuman_id" >
                              <option value="-1">~ Tanlang ~</option>
                              <?
                              $viloyat = $fetch['viloyat_id'];
                              $sql4 = mysqli_query($link,"SELECT * FROM tuman WHERE vil_id = '$viloyat'");  
                              while ($tuman = mysqli_fetch_assoc($sql4)) {
                                ?>
                                <option <? if($fetch['tuman_id']==$tuman['id']) echo "selected"; ?> value="<?=$tuman['id']?>"><?=$tuman['nomi']?></option>
                                <?
                              }
                              ?>
                            </select>
                          </div>

                        </th>
                      </tr>
                      <tr>  
                        <th>Telefon</th>
                        <th>

                          <div class="form-group">
                            <input class="form-control" type="text" name="telefon" value="<?=$fetch['telefon']?>">
                          </div>

                        </th>
                      </tr>
                      <tr>  
                        <th>Doimiy yashash manzili</th>
                        <th>
                          <div class="form-group">
                            <input class="form-control" type="text" name="doimiy" value="<?=$fetch['doimiy']?>">
                          </div>
                        </th>
                      </tr>
                      <tr>  
                        <th>Manzili</th>
                        <th>
                          <div class="form-group">
                            <input class="form-control" type="text" name="manzil" value="<?=$fetch['manzil']?>">
                          </div>
                        </th>
                      </tr>
                      <input type="hidden" name="id" value="<?=$fetch['id']?>">
                      <input type="hidden" name="action" value="teacher">
                    </thead>
                  </table>
                  <button class="btn btn-primary" ><i class="fa fa-check"></i>O'zgarishni saqlash</button>
                </form>  
                
                
              </div>

            </div>
            <br>
            <a class="btn btn-warning" target="_blank" href="../bot/uploads/<?=$fetch['passport']?>">Pasport</a>
              <br>
            
              <h3>Rasm almashtirish</h3>
              <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped">
                  <th>Rasm</th>
                  <th><img src="../bot/uploads/<?=$fetch['rasm']?>" width="50"></th>
                  <form enctype="multipart/form-data" action="update.php" method="POST">
                    <th> <input type="file" name="rasmcha" class="form-control" >
                      <input type="hidden" name="action" value="xodimrasm">
                      <input type="hidden" name="id" value="<?=$fetch['id']?>"> 
                    </th>
                    <th>
                      <button class="btn btn-primary" type="submit">O'zgartirishni saqlash</button>
                    </th>
                  </form>
                </table>
              </div>

           
          </div>
        </div>
      </div>    
    </main>
    <? include_once 'js.php'; ?>
    <script type="text/javascript">

      function tuman() {
        let viloyat_id = $('#viloyat_id').val();
        $.ajax({
          url: "get-tuman.php",
          type: "GET",
          data:{
            viloyat_id:viloyat_id,
          },
          success:function(data){
            $('#tuman_id').html(data);
          },
          error:function(xhr) {
            alert("Kechirasiz internetda uzilish ro'y berdi. Internet aloqasini tekshiring");
          }
        });
      }

    </script>
  </body>
  </html>
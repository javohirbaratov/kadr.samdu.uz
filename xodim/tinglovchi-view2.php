  <?php
  include_once 'ximoya.php';
  $_SESSION['page'] = 151;
  if(!isset($_GET['id'])){
    exit('Bad request 400!');
  }
  else{
    $id = filter($_GET['id']);
    $sql = mysqli_query($link,"SELECT * FROM xodim_temp WHERE id='$id'");
    $fetch = mysqli_fetch_assoc($sql);
  }

  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <?php include_once 'css.php'; ?>
    <style type="text/css">
      table tr th:nth-child(1){
        width: 20%;
      }
    </style>
  </head>
  <body class="app sidebar-mini">
  <?php include_once 'header.php'; ?>
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
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped">
                  <thead>
                   <tr>
                    <th>Status</th>
                    <?php
                    if($fetch['status']=="nochecked"){
                      ?>
                      <th style="background-color: orange;" >Tekshirilmoqda</th>
                      <?php
                    }
                    elseif($fetch['status']=="success"){
                      ?>
                      <th style="background-color: green;" >Qabul qilindi</th>
                      <?php
                    }else{
                     ?>
                     <th style="background-color: red;" ><?=$fetch['xabar']?></th>
                      <?php
                   }
                   ?>
                   
                 </tr>
                 <tr>
                  <th>ID</th>
                  <th><?=$fetch['id']?></th>
                </tr>
                <tr>
                  <th>Rasm</th>
                  <th>
                    <img src="../bot/uploads/<?=$fetch['rasm']?>" width="50">

                    <a href="../bot/uploads/<?=$fetch['rasm']?>" class="btn btn-primary text-write" download="3x4-<?=$fetch['familya']?>">Yuklash</a>
                  </th>
                </tr>
                <tr>
                  <th>F.I.O</th>
                  <th><?=$fetch['familya']?> <?=$fetch['ism']?> <?=$fetch['otch']?></th>
                </tr>
                
                <tr>  
                  <th>JSHSHIR</th>
                  <th><?=$fetch['jshir']?></th>
                </tr>
                <tr>  
                  <th>Tug'ilgan sana</th>
                  <th><?=date("d.m.Y",strtotime($fetch['birthdate']))?></th>
                </tr>
                <tr>  
                  <th>Pasport seriya va raqami</th>
                  <th><?=$fetch['nomer']?></th>
                </tr>
                
                <tr>  
                  <th>Pasport file</th>
                  <th><a target="_blank" href="../bot/uploads/<?=$fetch['passport']?>">Yuklash</a></th>
                </tr>
                <tr>  
                  <th>Obyektivka</th>
                  <th><a target="_blank"  href="../bot/uploads/<?=$fetch['obyektivka']?>">Obyektivkani Yuklash</a></th>
                </tr>

                <tr>  
                  <th>Pasport berilgan sana</th>
                  <th><?=$fetch['pasportdate']?></th>
                </tr>           
                <tr>  
                  <th>Pasport berilgan joy</th>
                  <th><?=$fetch['pasportjoy']?></th>
                </tr>
                <tr>  
                  <th>Pasport amal qilish mudati</th>
                  <th><?=$fetch['pasportenddate']?></th>
                </tr>
                
                <tr>  
                  <th>Jinsi</th>
                  <th><?=$fetch['jinsi']?></th>
                </tr>




                <tr>  
                  <th>Millati</th>
                  <th><?=$fetch['millati']?></th>
                </tr>
                <tr>  
                  <th>Fuqaroligi</th>
                  <th><?=$fetch['fuqaroligi']?></th>
                </tr>
                <tr>  
                  <th>Harbiy</th>
                  <th>
                   <?php
                   if($fetch['xarbiy']=="Yo`q"){
                    ?>
                    <?=$fetch['xarbiy']?>
                     <?php
                  }
                  else{
                    ?>
                    <a target="_blank" href="../bot/uploads/<?=$fetch['xguvohnoma']?>">Yuklash</a>
                    <?php
                  }
                  ?>
                </th>
              </tr>
              <tr>  
                <th>Javobgarlik</th>
                <th><?=$fetch['mjshaxs']?></th>
              </tr>
              <tr>  
                <th>Partiyaviyligi</th>
                <th><?=$fetch['partiyaviyligi']?></th>
              </tr>
              <tr>  
                <th>Manzil</th>
                <th><?=$fetch['manzil']?></th>
              </tr>
              <tr>  
                <th>Doimiy yashash manzili</th>
                <th><?=$fetch['doimiy']?></th>
              </tr>
              <tr>  
                <th>Telefon raqami</th>
                <th><?=$fetch['telefon']?></th>
              </tr>
              <tr>  
                <th>Telegram</th>
                <th><?=$fetch['telegram_id']?></th>
              </tr>
              <tr>  
                <th>Pochta</th>
                <th><?=$fetch['pochta']?></th>
              </tr>
              <tr>  
                <th>Oilaviy ahvoli</th>
                <th><?=$fetch['oilaviyahvoli']?></th>
              </tr>
              <tr>  
                <th>Diplomlar</th>
                <th>

                  <?php
                  if($fetch['diplom1']!=""){
                    ?>
                    <a target="_blank" href="../bot/uploads/<?=$fetch['diplom1']?>">Kasb hunar</a>
                    <?php
                  }
                ?><br>
                  <?php
                if($fetch['diplom2']!=""){
                  ?>
                  <a target="_blank" href="../bot/uploads/<?=$fetch['diplom2']?>">Bakalavr yoki o'qish joyi</a>
                  <?php
                }
              ?><br>
                  <?php
              if($fetch['diplom3']!=""){
                ?>
                <a target="_blank" href="../bot/uploads/<?=$fetch['diplom3']?>">Ikkinchi mutaxasislik</a>
                <?php
              }
            ?><br>
                  <?php
            if($fetch['diplom4']!=""){
              ?>
              <a target="_blank" href="../bot/uploads/<?=$fetch['diplom4']?>">Magistrlik diplomi</a>
              <?php
            }
          ?><br>
                  <?php
          if($fetch['diplom5']!=""){
            ?>
            <a target="_blank" href="../bot/uploads/<?=$fetch['diplom5']?>">PhD diplomi</a>
            <?php
          }
        ?><br>
                  <?php
        if($fetch['diplom6']!=""){
          ?>
          <a target="_blank" href="../bot/uploads/<?=$fetch['diplom6']?>">DSc diplomi</a>
          <?php
        }
      ?><br>
                  <?php
      if($fetch['diplom7']!=""){
        ?>
        <a target="_blank" href="../bot/uploads/<?=$fetch['diplom7']?>">Katta ilmiy xodim</a>
        <?php
      }
    ?><br>
                  <?php
    if($fetch['diplom8']!=""){
      ?>
      <a target="_blank" href="../bot/uploads/<?=$fetch['diplom8']?>">Dotsentlik diplom</a>
      <?php
    }
  ?><br>
                  <?php
  if($fetch['diplom9']!=""){
    ?>
    <a target="_blank" href="../bot/uploads/<?=$fetch['diplom9']?>">Professorlik diplom</a>
    <?php
  }
  ?><br>
                  <?php
  if($fetch['diplom10']!=""){
    ?>
    <a target="_blank" href="../bot/uploads/<?=$fetch['diplom9']?>">Akademik diplom</a>
    <?php
  }
  ?><br>
  </th>
  </tr>
  </thead>
  </table>

  <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#ssModal" ><i class="fa fa-check"></i> Qabul qilish</button>
  <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#myModal">x  Rad etish</button>
  <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="udalit(<?=$fetch['id']?>)"><i class="fa fa-trash"></i>O'chirish</button>
  </div>

  </div>

  </div>
  </div>
  </div>    
  </main>


  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
         <form action="set_status.php" method="POST">
          <div class="form-group">
            <label class="control-label">Rad erish sababini ko'rsating </label>
            
            <textarea  name="xabar" class="form-control" required ="required" >
              
            </textarea>
          </div>
          <input type="hidden" name="xodim_id" value="<?=$fetch['id']?>">
          <div class="form-group">
           <input class="form-control" type="text" name="telefon" id="telefon" value="<?=$fetch['telefon']?>" readonly>
         </div>

         
         <input type="hidden" name="user_id" value="<?=$_SESSION['id'] ?>">
         <div class="form-group">
          <button type="submit" name="refuse" class="btn btn-primary" >Yuborish</button> 
        </div>
      </form>
      
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Bekor qilish</button>
    </div>
  
  </div>

  </div>
  </div>


  <div id="ssModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          
          <h4 class="modal-title">Ishonchingiz komilmi?</h4>
        </div>
        <form action="set_status.php" method="POST">
          <div class="modal-body">
            
            <input type="hidden" name="xodim_id" value="<?=$fetch['id']?>">
            <input type="hidden" name="telefon" value="<?=$fetch['telefon']?>">
            <input type="hidden" name="user_id" value="<?=$_SESSION['id'] ?>">
            <div class="form-group">
              
            </div>
            
            
          </div>
          <div class="modal-footer">
            <button  type="submit" name="success" class="btn btn-primary" >Ha</button> 
            <button type="button" class="btn btn-warning" data-dismiss="modal">Bekor qilish</button>
            
          </div>
        </form>
      </div>

    </div>
  </div>

  <?php include_once 'js.php'; ?>


  <?php if(isset($_GET['print'])){?>
    <script type="text/javascript">
      window.print();
    </script>
  <?php }?>
  <script>
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
                            id:id,action:"xodim",
                        },
                        success:function(data) {
                            var obj = jQuery.parseJSON(data);
                            if(obj.err==0){
                                swal("O'chirildi!", "Muvaffaqqiyatli o'chirildi", "success");
                                 window.location.href="recieve-data.php"
                            }
                            else{
                                swal("O'chirilmadi", "Ichki xatolik, qaytadan urinib ko'ring", "error");        
                            }
                        },
                        error:function(xhr) {
                            swal("O'chirilmadi", "Internetdan uzilish ro'y berdi", "error");        
                        }
                    });                 
                } else {
                    swal("Bekor qilindi", "Obyekt o'chirilishi bekor qilindi :)", "error");
                }
            });
        }
  </script>
  </body>
  </html>
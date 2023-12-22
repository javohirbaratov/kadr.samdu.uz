<?php
    include_once 'ximoya.php';
    $_SESSION['page'] = 151;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <?php include_once 'css.php'; ?>
  </head>
  <body class="app sidebar-mini">
  <?php include_once 'header.php'; ?>
    <main class="app-content">
      <div class="app-title">
          <div>
            <h1><i class="fa fa-th-list"></i> Kelib tushgan malumotlar</h1>
            <p>Kelib tushgan malumotlar qulay tarzda saralash va ular ustida tezkor amallarni bajarish</p>
          </div>
          <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Kelib tushgan malumotlar</li>
            <li class="breadcrumb-item active"><a href="#">Kelib tushgan malumotlarni ko'rish</a></li>
          </ul>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="tile">
              <div class="tile-body">
               
                <div class="table-responsive">
                    <div class="form-group">
                        <select name="" class="select form-control" id="statusSelect">
                            <?php
                                $arr = [
                                    "nochecked" => "Tekshirilmoqda",
                                    "success" => "Tekshirilgan",
                                    "refused" => "Rad etilgan"
                                ];
                                if (isset($_GET['status'])){
                                    ?>
                                        <option value="<?=$_GET['status']?>"><?=$arr[$_GET['status']]?></option>
                                    <?php
                                }
                            ?>
                            <option value="nochecked">Tekshirilmoqda</option>
                            <option value="success">Tekshirilgan</option>
                            <option value="refused">Rad etilgan</option>
                        </select>
                    </div>
                  <table class="table table-hover table-bordered" id="sampleTable">
                    <thead>
                      <tr>
                        <th>Nomer</th>
                        <th>Rasm</th>
                        <th>F.I.SH</th>
                        <th>Pasport SN</th>
                        <th>Jshshir</th>
                        <th>Telefon</th>
                        <th>Status</th>
                        <th>Amallar</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                            $status =
                            $t=0;
                            $sql = mysqli_query($link,"SELECT * FROM `xodim_temp` ORDER BY updated_at DESC");
                            if(isset($_GET['status'])){
                                $status = $_GET['status'];
                                $sql = mysqli_query($link,"SELECT * FROM `xodim_temp` WHERE status='$status' ORDER BY id ASC");
                            }
                            while($fetch = mysqli_fetch_assoc($sql)){
                                $t++;                               
                        ?>
                        <tr>
                        <td><?=$t?></td>
                        <td><img src="../bot/uploads/<?=$fetch['rasm']?>" width="50"></td>
                        <td><?=$fetch['familya']?> <?=$fetch['ism']?> <?=$fetch['otch']?></td>
                         <td><?=$fetch['nomer']?></td>
                          <td><?=$fetch['jshir']?></td>
                          <td><?=$fetch['telefon']?></td>
                          <td>
                              <?php
                                if($fetch['status']=="nochecked"){
                                    ?>
                                    <button class="btn btn-warning disabled"  >Tekshirilmoqda</button>
                                    <?php
                                }
                                elseif($fetch['status']=="success"){                             
                                    ?>
                                    <button class="btn btn-success disabled"  >Tekshirilgan</button>
                                    <?php
                                }
                                else{
                                     ?>
                                    <button class="btn btn-danger disabled"  >Rad etilgan</button>
                                    <?php
                                }
                            ?>
                          </td>
                        
                        <td><a href="tinglovchi-view2.php?id=<?=$fetch['id']?>" class="btn btn-success"><i class="fa fa-eye"></i> Batafsil</a>
                           
                            
                        </td>
                      </tr>
                            <?php }?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>    
    </main>
  <?php include_once 'js.php'; ?>
    <script type="text/javascript">
        $(function (){
            $("#statusSelect").change(function () {
                var status = $("#statusSelect").val();
                window.location.href = 'recieve-data.php?status='+status;
            });
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
                        type: "POST",
                        data:{
                            course_id:id,action:"kurslar",
                        },
                        success:function(data) {
                            var obj = jQuery.parseJSON(data);
                            if(obj.error==0){
                                swal("O'chirildi!", "Muvaffaqqiyatli o'chirildi", "success");
                                $('#tr'+id).remove();
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
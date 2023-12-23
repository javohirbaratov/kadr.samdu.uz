<?php
    include_once 'ximoya.php';
    $_SESSION['page'] =152;
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
            <h1><i class="fa fa-th-list"></i> Qabul qilingan malumotlar</h1>
            <p>Qabul qilingan malumotlarni qulay tarzda saralash va ular ustida tezkor amallarni bajarish</p>
          </div>
          <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Kurslar</li>
            <li class="breadcrumb-item active"><a href="#">Kurslarni ko'rish</a></li>
          </ul>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="tile">
              <div class="tile-body">
               
                <div class="table-responsive">
                  <table class="table table-hover table-bordered" id="sampleTable">
                    <thead>
                      <tr>
                        <th>Nomer</th>
                        <th>Rasm</th>
                         
                        <th>F.I.SH</th>
                        <th>Pasport SN</th>
                        <th>Jshshir</th>
                        <th>Telefon</th>
                        <th>Pasport</th>
                        <th>Bo'lim </th>
                        <th>Kafedra </th>
                        <th>Lavozim</th>
                        <th>Manzil</th>
                        <th>Viloyat</th>
                        <th>Tuman</th>
                        <th>Amallar</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?
                            $t=0;
                            $sql = mysqli_query($link,"SELECT * FROM xodimlar ORDER BY id DESC");
                            while($fetch = mysqli_fetch_assoc($sql)){
                                $viloyat_id = $fetch['viloyat_id'];
                                $tuman_id = $fetch['tuman_id'];
                                $viloyat = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM `viloyat` WHERE id='$viloyat_id'"));
                                $tuman = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM `tuman` WHERE id='$tuman_id'"));
                                $user_id = intval($fetch['id']);
                                $work = mysqli_query($link,"SELECT * FROM `workplace` WHERE user_id='$user_id'");
                                $work_r = mysqli_fetch_assoc($work);
                                $bulim_id = $work_r['bulim_id'];
                                $kafedra_id = $work_r['kafedra_id'];
                                $lavozim_id = $work_r['lavozim'];
                                
                                $bulim = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM `bulimlar` WHERE id='$bulim_id'"));
                                
                                $kafedra = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM `kafedra` WHERE id='$bulim_id'"));
                                
                                $lavozim = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM `lavozimlar` WHERE id='$lavozim_id'"));
                                $t++; 
                        ?>
                        <tr>
                        <td><?=$fetch['id']?></td>
                        <td></td>
                        <td><?=$fetch['familya']?> <?=$fetch['ism']?> <?=$fetch['otch']?></td>
                         <td><?=$fetch['nomer']?></td>
                         
                          <td><?=$fetch['jshir']?></td>
                          <td><?=$fetch['telefon']?></td>
                          <td></td>
                          <td><?=$bulim['name']?></td>
                          <td><?=$kafedra['name']?></td>
                          <td><?=$lavozim['lavozim']?></td>
                          <td><?=$fetch['manzil']?></td>
                          <td><?=$viloyat['nomi']?></td>
                          <td><?=$tuman['nomi']?></td>
                        <td><a href="xodim-view.php?id=<?=$fetch['id']?>" class="btn btn-success"><i class="fa fa-eye"></i> Batafsil</a>
                           
                            
                        </td>
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
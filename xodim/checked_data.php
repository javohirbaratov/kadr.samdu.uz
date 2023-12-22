<?php
include_once 'ximoya.php';
$_SESSION['page'] = 5;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <? include_once 'css.php'; ?>
</head>
<body class="app sidebar-mini">
    <? include_once 'header.php'; ?>
    <main class="app-content">
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
               <?         $sql3 = mysqli_query($link,"SELECT COUNT(*) FROM xodim_temp WHERE status = 'nochecked' ");
                    $sql4 = mysqli_query($link,"SELECT COUNT(*) FROM xodim_temp WHERE status = 'success' ");
                    $sql5 = mysqli_query($link,"SELECT COUNT(*) FROM xodim_temp WHERE status = 'refused' ");
                    $sql6 = mysqli_query($link,"SELECT COUNT(*) FROM xodim_temp ");
                    $row3 = mysqli_fetch_array($sql3);
                    $row4 = mysqli_fetch_array($sql4);
                    $row5 = mysqli_fetch_array($sql5);
                    $row6 = mysqli_fetch_array($sql6);
                  ?>
           <a href="#" class="btn btn-primary" style="margin-bottom: 10px;"> Jami <?=$row6['COUNT(*)']?></a>
           <a href="#" class="btn btn-default" style="margin-bottom: 10px;"> Tekshirilgan <?=$row5['COUNT(*)']+$row4['COUNT(*)']?></a>
            <a href="#" class="btn btn-success" style="margin-bottom: 10px;">Qabul qilingan <?=$row4['COUNT(*)']?></a>
            <a href="#" class="btn btn-danger" style="margin-bottom: 10px;">Rad etilgan  <?=$row5['COUNT(*)']?></a>
            <a href="#" class="btn btn-warning" style="margin-bottom: 10px;">Tekshirilmagan <?=$row3['COUNT(*)']?></a>
            <div class="table-responsive">
              <table class="table table-hover table-bordered" >
                <thead>
                  <tr>
                    <th>#</th>
                    <th>F.I.O</th>
                    <th>Count</th>
                </tr>
            </thead>
            <tbody>
                <?
                $t=0;
                $sql = mysqli_query($link,"SELECT * FROM users where id = '14' OR id = '15' OR id = '16' OR id = '17' OR id = '5' ");
                while($fetch = mysqli_fetch_assoc($sql)){
                    $t++;    
                    $u_id = $fetch['id'];
                    $sql2 = mysqli_query($link,"SELECT COUNT(*) FROM xodim_temp WHERE check_user_id = '$u_id' ");
                    $row =  mysqli_fetch_array($sql2);
                   
                    ?>
                    <tr>
                        <td><?=$t?></td>
                        <td><?=$fetch['familya']?> <?=$fetch['ism']?> <?=$fetch['otch']?></td>
                        <td><?=$row['COUNT(*)']?></td>
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
</body>
</html>
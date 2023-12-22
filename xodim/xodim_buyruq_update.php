<?php
include_once 'ximoya.php';
$_SESSION['page'] = 129;
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $sql = mysqli_query($link,"SELECT * FROM buyruq_xodim WHERE id = '$id'");
  $l = mysqli_fetch_assoc($sql);



  $xodim_id = $l['xodim_id'];
  $buyruq_id = $l['buyruq_id'];
  $buyruq_tur = $l['buyruq_tur'];


  $sql2 = mysqli_query($link,"SELECT * FROM xodimlar WHERE id = '$xodim_id'");
  $x = mysqli_fetch_assoc($sql2);

  $sql3 = mysqli_query($link,"SELECT * FROM buyruq WHERE id = '$buyruq_id'");
  $br = mysqli_fetch_assoc($sql3);

  $sql4 = mysqli_query($link,"SELECT * FROM buyruq_tur WHERE id = '$xodim_id'");
  $bt = mysqli_fetch_assoc($sql4);

  $_SESSION['_csrf']=md5(time());
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
        <h1><i class="fa fa-th-list"></i> Xodimlar</h1>
        <p>Xodimlarni qulay tarzda saralash va ular ustida tezkor amallarni bajarish</p>
      </div>
      <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Xodimlar</li>
        <li class="breadcrumb-item active"><a href="#">Tinglovchilarni ko'rish</a></li>
      </ul>
    </div>

    <div class="col-md-6">
      <div class="tile">
        <!-- <h3 class="tile-title">Subscribe</h3> -->
        <div class="tile-body">
          <form class="row" action="insert_buyruq.php" method="POST">

            <div class="form-group col-md-12">
              <label class="control-label">F.I.O</label>
              <input type="text" name="fio" class="form-control" readonly value="<?=strtoupper(utf8_decode($x['familya']))?>  <?=strtoupper(utf8_decode($x['ism']))?>  <?=strtoupper(utf8_decode($x['otch']))?> ">
            </div>

            <div class="form-group col-md-12">
              <label class="control-label">Buyruq turi</label>
              <select class="form-control"  id="buyruq_tur" name="buyruq_tur"  required>
               <option  value="">~ Tanlang ~</option>
               <?
               $sql = mysqli_query($link,"SELECT * FROM buyruq_tur ");
               while ($kb = mysqli_fetch_assoc($sql)) {
                 ?>
                 <option <? if($kb['id'] ==$buyruq_tur){?> selected <?} ?>  value="<?=$kb['id']?>" ><?=strtoupper(($kb['name']))?> </option>
                 <?
               }
               ?>
             </select>
           </div>
           <div class="form-group col-md-12">
             <label class="control-label">Buyruq raqamini tanlang </label>
             <select class="form-control" id="buyruq" name="buyruq" required>
             <option value="">~ Tanlang ~</option>
               <?
               $sql2 = mysqli_query($link,"SELECT * FROM buyruq ");
               while ($bt = mysqli_fetch_assoc($sql2)) {
                 ?>
                 <option <? if($bt['id'] ==$buyruq_id){?> selected <?} ?>  value="<?=$bt['id']?>" ><?=strtoupper($bt['braqam'])?> (<?=$bt['sana'] ?>) </option>
                 <?
               }
               ?>
            </select>
          </div>
          <div class="form-group col-md-12">
            <label class="control-label">Buyruq matni</label>
            <textarea name="matn" class="form-control" id="exampleTextarea" rows="5"><?=$l['matn']?></textarea>
          </div>

          <div class="form-group col-md-12">
            <label class="control-label">Asos</label>
            <textarea name="asos" class="form-control" id="exampleTextarea" rows="3"><?=$l['asos']?></textarea>
          </div>

          <div class="form-group col-md-12">
           <input type="hidden" name="id" class="form-control" value="<?=$l['id']?>">
           <input type="hidden" name="action" value="xodim_buyruq_update">
           <input type="hidden" name="_csrf" value="<?=$_SESSION['_csrf']?>">
         </div>

         <div class="form-group col-md-12 align-self-end">
          <button class="btn btn-primary col-md-12" type="submit" ><i class="fa fa-fw fa-lg fa-check"></i>Saqlash</button>
        </div>
      </form>
      <button onclick="window.history.back()" class="btn btn-default col-md-12" ><i class="fa fa-fw fa-lg fa-arrow-left"></i>Ortga</button>
    </div>
  </div>
</div> 
</main>
<? include_once 'js.php'; ?>
<script type="text/javascript">
  $('#buyruq_tur').select2();
  $('#buyruq').select2();
 </script>
</body>
</html>
<?php
include_once 'ximoya.php';
$_SESSION['page'] = 119;
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $sql = mysqli_query($link,"SELECT * FROM buyruq WHERE id = '$id'");
  $l = mysqli_fetch_assoc($sql);
  require '../vendor/autoload.php';
  $phpWord = new \PhpOffice\PhpWord\PhpWord();
  $section = $phpWord->addSection();
  $phpWord->addTitleStyle(1, array('size' => 14, 'color' => '000', 'bold' => true), array('align' => 'center'));
  $section->addTitle($l['braqam']. "(".$l['sana'].")",1);

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
        <h1><i class="fa fa-th-list"></i> <?=$l['name']?></h1>
        
      </div>
      
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile" >

          <div id="#">
            <button class="btn btn-primary" onclick="history.back()"> <i class="fa fa-arrow-left"></i> Ortga</button>
            
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile" >

          <div id="">
           <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
               <tr>
                <th>№</th>
                <th>Buyruq turi</th>
                <th>Buyruq raqami (sanasi)</th>
                <th>Buyruq matni</th>
                <th>Asos</th>
              </tr>                        
            </tr>
          </thead>
          <tbody>
           <? 
           $pr = mysqli_query($link,"SELECT * FROM buyruq_xodim WHERE buyruq_id = '$id'");
           $sanoq = 0;

           while($kk = mysqli_fetch_assoc($pr)){
             $sanoq++;
             $pr_id = $kk['buyruq_id'];
             $pr2 = mysqli_query($link,"SELECT * FROM buyruq WHERE id='$pr_id'");
             $prikaz = mysqli_fetch_assoc($pr2);

             $pr_tur = $kk['buyruq_tur'];
             $pr3 = mysqli_query($link,"SELECT * FROM buyruq_tur WHERE id='$pr_tur'");
             $prikaz_tur = mysqli_fetch_assoc($pr3);
             
             $section->addText($prikaz_tur['name'],array('size' => 14, 'color' => '000','bold' => true));
             $section->addText($kk['matn'], array('size' => 14, 'color' => '000'),array('align' => 'both'));
             $section->addText("Asos: " .$kk['asos'], array('size' => 14, 'color' => '000'),array('align' => 'both'));

             $filename = $prikaz['braqam'].'('.$prikaz['sana'].').docx';
             $phpWord->save('buyruqlar/'.$filename);
             ?>
             <tr >
              <td><?=$sanoq?></td>

              <td><?=$prikaz_tur['name']?></td>
              <td><?=$prikaz['braqam']?> (<?=$prikaz['sana']?>)</td>
              <td><?=$kk['matn']?></td>
              <td><?=$kk['asos']?></td>

            </tr> 
            <?}?>
          </tbody>

        </table>
        <a href="buyruqlar/<?=$filename?>" class="btn btn-success"><i class="fa fa-download"></i> Yuklash</a>
      </div>
    </div>
  </div>
</div>

</main>
<? include_once 'js.php'; ?>
</body>
</html>
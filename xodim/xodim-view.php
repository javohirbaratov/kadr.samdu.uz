<?php
include_once 'ximoya.php';
$_SESSION['page'] = 125;
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $sql = mysqli_query($link,"SELECT * FROM xodimlar WHERE id = '$id'");
  $l = mysqli_fetch_assoc($sql);

  $sql = mysqli_query($link,"SELECT * FROM workplace WHERE user_id = '$id'");
  $qabul = mysqli_fetch_assoc($sql);

  $bulim_id = $qabul['bulim_id'];
  $sql2 = mysqli_query($link,"SELECT * FROM bulimlar WHERE id='$bulim_id'");
  $bulimlar = mysqli_fetch_assoc($sql2);

  $kafedra_id = $qabul['kafedra_id'];
  $sql10 = mysqli_query($link,"SELECT * FROM kafedra WHERE id='$kafedra_id'");
  $kafedralar = mysqli_fetch_assoc($sql10);

  $lavozim_id = $qabul['lavozim'];
  $sql2 = mysqli_query($link,"SELECT * FROM lavozimlar WHERE id='$lavozim_id'");
  $lavozimlar = mysqli_fetch_assoc($sql2);
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
        <li class="breadcrumb-item active"><a href="#"></a></li>
      </ul>
    </div>

    <div class="col-md-12">
      <div class="tile">
        <!-- <h3 class="tile-title">Subscribe</h3> -->
        <div class="tile-body">
          <form class="row" action="qabul_xodim.php" method="POST">
           <div class="form-group col-md-3">
            <img width="150" src="../bot/uploads/<?=$l['rasm']?>">
          </div>
          <input type="hidden" name="fish" id="fish" class="form-control" readonly value="<?= ucfirst($l['familya'])?> <?= ucfirst($l['ism'])?> <?= ucfirst($l['otch'])?>">
          <input type="hidden" name="fam" id="fish" class="form-control" readonly value="<?= ucfirst($l['familya'])?> <?=$l['ism'][0]?>".>
          <div class="form-group col-md-3">
            <label class="control-label">Ismi</label>
            <input type="text" name="malumot" class="form-control" readonly value="<?=$l['ism']?>">
            <br>
            <label class="control-label">Tug'ilgan sana</label>
            <input type="text" name="malumot" class="form-control" readonly value="<?=$l['birthdate']?>">
          </div>

          <div class="form-group col-md-3">
            <label class="control-label">Familiyasi</label>
            <input type="text" name="shartnoma" class="form-control" readonly value="<?=$l['familya']?>">

            <br>
            <label class="control-label">JSHSHIR</label>
            <input type="text" name="malumot" class="form-control" readonly value="<?=$l['jshir']?>">
          </div>

          <div class="form-group col-md-3">
            <label class="control-label">Otasining ismi</label>
            <input type="text" name="malumot" class="form-control" readonly value="<?=$l['otch']?>">

            <br>

            <label class="control-label">Pasport</label>
            <input type="text" name="shtat" class="form-control" readonly value="<?=$l['seriya']?> <?=$l['nomer']?>">
            <input type="hidden" name="id" id = "id" class="form-control" readonly value="<?=$l['id']?>">

          </div>
          <div class="form-group col-md-3">


          </div>
          <div class="form-group col-md-3">

           <a  href="tinglovchi-view3.php?id=<?=$l['id']?>" class="btn btn-success btn-lg" ><i class="fa fa-pencil"></i>Tahrirlash</a>
         </div>
       </form>

     </div>
   </div>
 </div>

 <div class="row">
  <div class="col-md-12">
    <div class="tile" >
      <button  class="btn btn-default btn-lg col-md-12" >Ish joyi va lavozimi</button>
      <a href="xodim_work.php?id=<?=$l['id']?>"  class="btn btn-primary btn-lg col-md-4" > <i class="fa fa-plus"></i> Ish joyi Qo'shish</a>
      <br>
      <div id="displaytable">


      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="tile" >

      <div id="#">
        <a  href="xodim_buyruq.php?id=<?=$l['id']?>" class="btn btn-primary btn-lg" ><i class="fa fa-plus"></i>Buyruq qo'shish</a>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="tile" >
      Buyruqlar
      <div id="">

       <table class="table table-hover table-bordered" id="dataTable">
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

       $pr = mysqli_query($link,"SELECT * FROM buyruq_xodim WHERE xodim_id = '$id'");
       $sanoq = 0;
       while($kk = mysqli_fetch_assoc($pr)){
         $sanoq++;
         $pr_id = $kk['buyruq_id'];
         $pr2 = mysqli_query($link,"SELECT * FROM buyruq WHERE id='$pr_id'");
         $prikaz = mysqli_fetch_assoc($pr2);

         $pr_tur = $kk['buyruq_tur'];
         $pr3 = mysqli_query($link,"SELECT * FROM buyruq_tur WHERE id='$pr_tur'");
         $prikaz_tur = mysqli_fetch_assoc($pr3);
         ?>
         <tr >
          <td><?=$sanoq?></td>

          <td id="bname<?=$kk['id']?>"><?=$prikaz_tur['name']?></td>
          <td><?=$prikaz['braqam']?> (<?=$prikaz['sana']?>)</td>
          <td id="matn<?=$kk['id']?>"><?=$kk['matn']?></td>
          <td id="asos<?=$kk['id']?>"><?=$kk['asos']?></td>
          <td> 
            <a  href="xodim_buyruq_update.php?id=<?=$kk['id']?>" class="btn btn-success btn-lg" ><i class="fa fa-pencil"></i>Tahrirlash</a>
            <button onclick="words(<?=$kk['id']?>)" class="btn btn-primary">Yuklab olish</button>
          </td>

        </tr> 
        <?}?>
      </tbody>

    </table>
  </div>
</div>
</div>
</div>

</main>
<? include_once 'js.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/docxtemplater/3.28.5/docxtemplater.js"></script>
<script src="https://unpkg.com/pizzip@3.1.1/dist/pizzip.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.8/FileSaver.js"></script>
<script src="https://unpkg.com/pizzip@3.1.1/dist/pizzip-utils.js"></script>
<script type="text/javascript">
  $('#as').select2();
  $('#lavozim_id').select2();
  $('#bulim_id').select2();
  $('#xodim').select2();
  $('#buyruq').select2();
  $('#bulinma_id').select2();

  function xodimmm() {
   let xodim_id = $('#id').val();
   $.ajax({
    url: "get-xodim-buyruq.php",
    type: "GET",
    data:{
     xodim_id:xodim_id,
   },
   success:function(data){
     $('#loader').css("display","none");
     $('#displaytable').html(data);
   },
   error:function(xhr) {
     alert("Kechirasiz internetda uzilish ro'y berdi. Internet aloqasini tekshiring");
   }
 });
 }	
 xodimmm();
  function loadFile(url, callback) {
            PizZipUtils.getBinaryContent(url, callback);
        }
 function words(id) {
  var bname = document.getElementById ("bname"+id).innerText;
  var matn = document.getElementById ("matn"+id).innerText;
  var asos = document.getElementById ("asos"+id).innerText;
  let fish = $('#fish').val();
   //console.log(bname,matn,asos,id,fish);
   //return 0;
  loadFile(
    "shablon/buyruq.docx",
    function (error, content) {
      if (error) {
        throw error;
      }
      var zip = new PizZip(content);
      var doc = new window.docxtemplater(zip, {
        paragraphLoop: true,
        linebreaks: true,
      });
      doc.render({
        bname : bname,
        matn : matn,
        asos : asos,
      });
      var out = doc.getZip().generate({
        type: "blob",
        mimeType:
        "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
      });
                    // Output the document using Data-URI
      saveAs(out, fish+" - "+bname+".docx");
    }
    );
}
</script>
 <script type="text/javascript">
                      $('#dataTable').DataTable( {
                        dom: 'Bfrtip',
                        lengthMenu: [
                          [ 10, 25, 50, -1 ],
                          [ '10 talab', '25 talab', '50 talab', 'Barchasi' ]
                          ],        
                        buttons: [
                          'copy', 'csv', 'excel', 'pdf', 'print','pageLength',
                          ],
                        language: {
                        search: 'Qidiruv', // removed the word 'search' from the left of search
                        "paginate": {
                          "previous": "Orqaga",
                          "next": "Keyingi"
                        },
                        "emptyTable":     "Bu jadval bo'sh. Malumot yo'q",
                        "info":           "Ko'rsatilyapti _START_ dan boshlab _END_ gacha _TOTAL_ tadan",
                        "infoEmpty":      "Ko'rsatilyapti 0 ta 0  0 tadan",
                        "zeroRecords":    "Bunday ma'lumot topilmadi",
                      },
                      initComplete: function() {
                        $('div.dataTables_filter input').attr('placeholder', 'Kiriting') // put 'search' inside of search box
                      },
                    });
                    // $('#sampleTable').DataTable();
                  </script>
</body>
</html>
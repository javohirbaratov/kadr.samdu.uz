      <?php
      include_once 'ximoya.php';
      $_SESSION['page'] = 113;
      if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = mysqli_query($link,"SELECT * FROM workplace WHERE user_id = '$id'");
        $q = mysqli_fetch_assoc($sql);
        

        $sql = mysqli_query($link,"SELECT * FROM xodimlar WHERE id = '$id'");
        $l = mysqli_fetch_assoc($sql);

        $kadr_bulim_id = $q['kadr_bulim_id'];
        $sql2 = mysqli_query($link,"SELECT * FROM kadrlarbulimi WHERE id='$kadr_bulim_id'");
        $kadrlarbulimi = mysqli_fetch_assoc($sql2);

        $bulim_id = $q['bulim_id'];
        $sql2 = mysqli_query($link,"SELECT * FROM bulimlar WHERE id='$bulim_id'");
        $bulimlar = mysqli_fetch_assoc($sql2);

        $kafedra_id = $q['kafedra_id'];
        $sql10 = mysqli_query($link,"SELECT * FROM kafedra WHERE id='$kafedra_id'");
        $kafedralar = mysqli_fetch_assoc($sql10);

        $lavozim_id = $q['lavozim'];
        $sql2 = mysqli_query($link,"SELECT * FROM lavozimlar WHERE id='$lavozim_id'");
        $lavozimlar = mysqli_fetch_assoc($sql2);
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
         
  
    <div class="col-md-12">
      <div class="tile">
        <h3 class="tile-title">Xodimga yangi ish joyi qo'shish</h3> 
        <div class="tile-body">

          <form class="row" action="insert_buyruq.php" method="POST">
            <input type="hidden" name="id" value="<?=$id?>">
            <input type="hidden" name="_csrf" value="<?=$_SESSION['_csrf']?>">
            <input type="hidden" name="action" value="insertwork">
           <div class="form-group col-md-3">
            <label class="control-label">F.I.O</label>
            <input type="text" name="fio" class="form-control" readonly value="<?=strtoupper(utf8_decode($l['familya']))?>  <?=strtoupper(utf8_decode($l['ism']))?>  <?=strtoupper(utf8_decode($l['otch']))?> ">
          </div>

          <div class="form-group col-md-3">
            <label class="control-label">Ma'lumoti</label>
            <input type="text" name="malumot" class="form-control" required>
          </div>

          <div class="form-group col-md-3">
            <label class="control-label">Shartnoma raqami</label>
            <input type="text" name="shartnoma" class="form-control" required>
          </div>

          <div class="form-group col-md-3">
            <label class="control-label">Shtat birligi</label>
            <input type="text" name="shtat" class="form-control" required>
          </div>

          <div class="form-group col-md-3">
            <label class="control-label">Sana</label>
            <input type="date" name="sana" class="form-control" required>
          </div>
          <div class="form-group col-md-3">
           <label class="control-label">Kadrlar bo'limni tanlang</label>
           <select class="form-control" id="bulim_name_list" name="bulim_name_list" required onchange="filter(1)">
            <option value="-1">~ Tanlang ~</option>
            <?
            $sql = mysqli_query($link,"SELECT * FROM kadrlarbulimi");
            while ($kb = mysqli_fetch_assoc($sql)) {
              ?>
              <option value="<?=$kb['id']?>"><?=$kb['name']?></option>
              <?
            }
            ?>
          </select>
        </div>
        <div class="form-group col-md-3">
          <label class="control-label">Bo'limni tanlang</label>
          <select class="form-control" id="bulim_id" name="bulim_id" required onchange="filter(2)">
            <option value="">~ Tanlang ~</option>
          </select>
        </div>
        <div class="form-group col-md-3">
          <label class="control-label">Bo'linma/kafedra tanlang</label>
          <select class="form-control" id="bulinma_id" name="bulinma_id" onchange="filter(2)" required>
            <option value="0">~ Tanlang ~</option>

          </select>
        </div>
        <div class="form-group col-md-3">
          <label class="control-label">Lavozimni tanlang</label>
          <select class="form-control" id="lavozim_id" name="lavozim_id" required>
            <option value="">~ Tanlang ~</option>

          </select>
        </div>
        <div class="form-group col-md-3">
          <label class="control-label">Faoliyat turi</label>
          <select class="form-control" id="faoliyat" name="faoliyat" >
            <option value="">~ Tanlang ~</option>
            <option value="asosiy">Asosiy</option>
            <option value="ichki">Ichki o'rindosh</option>
            <option value="tashqi">Tashqi o'rindosh</option>
            <option value="tashqi">Soatbay</option>                    
          </select>
        </div>
        <div class="col-md-12">
          <div class="toggle lg form-group col-md-3">
            <label class="control-label">Sinov muddati bormi? </label>
            <label >
              <input class="form-control" type="checkbox" onchange="check()" id="Mycheck"><span class="button-indecator"></span>
            </label>
          </div>
          <div class="toggle lg form-group col-md-3">
            <label class="control-label">Nomuayyan muddatda </label>
            <label >
              <input class="form-control" type="checkbox" onchange="check2()" id="Mycheck2"><span class="button-indecator"></span>
            </label>
          </div>
        </div>
        <div class="form-group col-md-3"  id="mdc">
          <input type="hidden" name="muddattype" id="muddattype" value="1">
          <label class="control-label">Muddatni kiriting</label>
          <input
          class="form-control"
          type="date"
          placeholder="Muddatini kiriting"
          name="muddati" />
        </div>
        <div class="form-group col-md-3" style="display:none" id="sinov1">
          <label class="control-label">Sinov muddati</label>
          <select name="sinov" class="form-control"  id="sinov">
            <option value="0">Tanlang</option>
            <option value="1">1-oy sinov</option>
            <option value="2">2-oy sinov</option>
            <option value="3">3-oy sinov</option>
          </select>
        </div>

        <div class="form-group col-md-4 align-self-end">
          <button class="btn btn-primary" type="submit" name="saqla"><i class="fa fa-fw fa-lg fa-check"></i>Saqlash</button>
        </div>
      </form>
      <button onclick="window.history.back()" class="btn btn-warning col-md-12" ><i class="fa fa-fw fa-lg fa-arrow-left"></i>Ortga</button>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="tile" id="displaytable">

    </div>
  </div>
</div>    
</main>
<? include_once 'js.php'; ?>
<script type="text/javascript">
  $('#bulim_name_list').select2();
  $('#lavozim_id').select2();
  $('#bulim_id').select2();
  $('#xodim').select2();
  $('#buyruq').select2();
  $('#bulinma_id').select2();
  function check() {
    let che = document.getElementById("Mycheck").checked;
    console.log(document.getElementById('sinov').value);
    if (che) {
      document.getElementById('sinov1').style = "display:block";
      document.getElementById('sinov').value = "1";
    }else
    document.getElementById('sinov1').style = "display:none";
    document.getElementById('sinov').value = "0";
  }
  function check2() {
    let che = document.getElementById("Mycheck2").checked;
    if (!che) {
      document.getElementById('mdc').style = "display:block";
      document.getElementById('muddattype').value = "1";
    }else
    document.getElementById('mdc').style = "display:none";
    document.getElementById('muddattype').value = "0";
  }
  $('#bulim_id').change(function() {
    let kb_id = $(this).val();
    $.ajax({
      url: "get-bulinma-options.php",
      type: "GET",
      data:{
       kb:kb_id,
     },
     success:function(data){              
      $('#bulinma_id').html(data);
    },
    error:function(xhr) {
      alert("Kechirasiz internetda uzilish ro'y berdi. Internet aloqasini tekshiring");
    }
  });
  })
  function filter(f){
    $('#loader').css("display","flex");
    let kb = $('#bulim_name_list').val();
    let bulim_id = $('#bulim_id').val();
    let lavozim_id = $('#lavozim_id').val();
    let faoliyat = $('#faoliyat').val();
    if (Number(kb)>0 && f==1){
      $.ajax({
        url: "get-bulim-options.php",
        type: "GET",
        data:{
          kb:kb,
        },
        success:function(data){
          $('#loader').css("display","none");
          $('#bulim_id').html(data);
        },
        error:function(xhr) {
          alert("Kechirasiz internetda uzilish ro'y berdi. Internet aloqasini tekshiring");
        }
      });
    }
    if (Number(bulim_id)>0 && f==2){
      let bulinma_id = $('#bulinma_id').val();
      console.log(bulinma_id);
      $.ajax({
        url: "get-lavozim-options.php",
        type: "GET",
        data:{
          bulim_id:bulim_id,
          bulinma_id:bulinma_id,
        },
        success:function(data){
          $('#loader').css("display","none");
          $('#lavozim_id').html(data);
        },
        error:function(xhr) {
          alert("Kechirasiz internetda uzilish ro'y berdi. Internet aloqasini tekshiring");
        }
      });
    }

  }

  function xodimmm() {
    let xodim_id = $('#xodim').val();
    $.ajax({
      url: "get-xodim.php",
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

  function buyruq_insert() {
    let braqam = $('#braqam').val();
    let bsana = $('#bsana').val();
    if ((braqam != '') && (bsana != '')) {
      console.log(braqam,bsana);
      $.ajax({
        url: "insert_buyruq.php",
        type: "GET",
        data:{
          braqam:braqam,
          bsana:bsana,
        },
        success:function(data){
          buyruq();
          $('#myModal').modal('hide');
        },
        error:function(xhr) {
          alert("Kechirasiz internetda uzilish ro'y berdi. Internet aloqasini tekshiring");
        }
      });

    }
  }



</script>
</body>
</html>
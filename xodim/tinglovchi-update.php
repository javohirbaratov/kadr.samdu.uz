<?php
	include_once 'ximoya.php';
	$_SESSION['page'] = 2.3;
  if(!isset($_GET['id'])){
      exit('Bad request 400!');
  }
  else{
    $id = filter($_GET['id']);
    $sql = mysqli_query($link,"SELECT * FROM tinglovchilar WHERE id='$id'");
    $fetch = mysqli_fetch_assoc($sql);
  }
  $statuslar = array();
  $tinglovchi_id = $fetch['id'];
  $sql = mysqli_query($link,"SELECT * FROM statusresult WHERE tinglovchi_id='$tinglovchi_id'");
  while($f = mysqli_fetch_assoc($sql)){
    array_push($statuslar, $f['status_id']);
  }
  $natijalar = array();
  $tinglovchi_id = $fetch['id'];
  $sql = mysqli_query($link,"SELECT * FROM results WHERE tinglovchi_id='$tinglovchi_id'");
  while($f = mysqli_fetch_assoc($sql)){
    array_push($natijalar, $f['natija_id']);
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <? include_once 'css.php'; ?>
    <script src="https://unpkg.com/imask"></script>
  </head>
  <body class="app sidebar-mini">
    <? include_once 'header.php'; ?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> Tinglovchini tahrirlash</h1>
          <p>Formani to'ldiring</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Tinglovchilar bo'limi</li>
          <li class="breadcrumb-item"><a href="#">Tinglovchini tahrirlash</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Tinglovchi malumotlarini tahrirlash</h3>
            <div class="tile-body">
              <form id="formdata">
                <div class="form-group">
                  <label class="control-label">Tinglovchi FIO</label>
                  <input class="form-control" type="text" placeholder="Familya Ism Sharif" name="fio" value="<?=$fetch['fio']?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Pasport seriya</label>
                  <input class="form-control" type="text" placeholder="__" value="<?=$fetch['seriya']?>" name="seriya" id="mask">
                </div>
                <script type="text/javascript">
                    var phoneMask = IMask(
                      document.getElementById('mask'), {
                        mask: '{aa}'
                    });
                </script>
                <div class="form-group">
                  <label class="control-label">Pasport nomer</label>
                  <input class="form-control" type="text" placeholder="_______" value="<?=$fetch['nomer']?>" name="nomer" id="number-mask5">
                </div>
                <script type="text/javascript">
                    var overwriteMask = IMask(
                      document.getElementById('number-mask5'),
                      {
                        mask: Number,

                        mask: IMask.MaskedRange, from: 0, to: 9999999, maxLength: 7                               
                    }
                    );
                </script>
                <div class="form-group">
                  <label class="control-label">Tug'ilgan sana</label>
                  <input class="form-control" type="date" placeholder="Tug'ilgan sana kiriting" name="birthsana" value="<?=date("Y-m-d",$fetch['birthsana'])?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Jinsi</label>
                  <select name="jinsi" class="form-control" id="jinsi">
                    <option value="Erkak" <? if($fetch['jinsi']=="Erkak"){echo "selected";} ?>>Erkak</option>
                    <option value="Ayol" <? if($fetch['jinsi']=="Ayol"){echo "selected";} ?>>Ayol</option>
                  </select>
                </div>
                <div class="form-group">
                  <label class="control-label">Telefon raqami</label>
                  <input class="form-control" type="text" placeholder="+998(XX)YYY-YY-YY" name="telefon" id="tel_raqam" value="<?=$fetch['telefon']?>">
                </div>
                
                <script type="text/javascript">
                    var phoneMask = IMask(
                      document.getElementById('tel_raqam'), {
                        mask: '+{998}(00)000-00-00'
                    });
                </script>
                <div class="form-group">
                  <label class="control-label">Viloyat</label>
                  <select name="viloyat_id" class="form-control" id="vil_id">
                    <option value="-1">~ Tanlang ~</option>
                    <?
                      $sql = mysqli_query($link,"SELECT * FROM viloyat ORDER BY nomi ASC");
                      while ($f = mysqli_fetch_assoc($sql)) {
                        ?>
                        <option value="<?=$f['id']?>" <? if($fetch['viloyat_id']==$f['id']){echo "selected";} ?>><?=$f['nomi']?></option>
                        <?
                      }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label class="control-label">Tuman</label>
                  <select name="tuman_id" class="form-control" id="tuman_id">
                    <option value="-1">~ Tanlang ~</option>
                    <?
                      $viloyat_id = $fetch['viloyat_id'];
                      $sql = mysqli_query($link,"SELECT * FROM tuman WHERE vil_id='$viloyat_id' ORDER BY nomi ASC");
                      while ($f = mysqli_fetch_assoc($sql)) {
                        ?>
                        <option value="<?=$f['id']?>" <? if($fetch['tuman_id']==$f['id']){echo "selected";} ?>><?=$f['nomi']?></option>
                        <?
                      }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label class="control-label">Manzil</label>
                  <input class="form-control" type="text" placeholder="Manzilni kiriting" value="<?=$fetch['manzil']?>" name="manzil">
                </div>
                <div class="form-group">
                  <label class="control-label">Bandlik</label>
                  <div id="bandlik_id">
                    <input class="form-control" type="text" placeholder="Manzilni kiriting" value="<?=$fetch['bandlik_id']?>" name="bandlik_id">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label">Kurslar</label>
                  <select name="kurs_id" class="form-control" id="kurs_id">
                    <option value="-1">~ Tanlang ~</option>
                    <?
                      $sql = mysqli_query($link,"SELECT * FROM kurslar ORDER BY id ASC");
                      while ($f = mysqli_fetch_assoc($sql)) {
                        ?>
                        <option value="<?=$f['id']?>" <? if($fetch['kurs_id']==$f['id']){echo "selected";} ?>><?=$f['kurs_nomi']?>(<?=$f['trener']?>)</option>
                        <?
                      }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label class="control-label">Kuratorlar</label>
                  <select name="kurator_id" class="form-control" id="kurator_id">
                    <option value="-1">~ Tanlang ~</option>
                    <?
                      $sql = mysqli_query($link,"SELECT * FROM kuratorlar ORDER BY id ASC");
                      while ($f = mysqli_fetch_assoc($sql)) {
                        ?>
                        <option value="<?=$f['id']?>" <? if($fetch['kurator_id']==$f['id']){echo "selected";} ?>><?=$f['fio']?></option>
                        <?
                      }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label class="control-label">Yo'llanma mavjud bo'lsa uning nomeri-№</label>
                  <input class="form-control" type="text" placeholder="Yo'llanma raqamini kiriting" name="yullanma" value="<?=$fetch['yullanma']?>">
                </div>
                <div class="form-group">
                 <label class="control-label">Kursdan keyin olingan sertifikat nomeri</label>
                  <input class="form-control" type="text" placeholder="Sertifikat raqamini kiriting" name="sernomer" value="<?=$fetch['sernomer']?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Kursni boshlash sanasi</label>
                  <input class="form-control" type="date" placeholder="Sana kiriting" name="sana1" value="<?=date("Y-m-d",$fetch['sana1'])?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Kursni yakunlash sanasi</label>
                  <input class="form-control" type="date" placeholder="Sana kiriting" name="sana2" value="<?=date("Y-m-d",$fetch['sana2'])?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Kurs o'tkaziladigan joy</label>
                  <input class="form-control" type="text" placeholder="Kurs o'tkaziladigan joyni kiriting" value="<?=$fetch['kursjoy']?>" name="kursjoy">
                </div>
                <div class="form-group">
                  <label class="control-label">Tashkilot nomi(tinglovchi biror tashkilotdan kelgan bo'lsa)</label>
                  <input class="form-control" type="text" placeholder="Tashkilot nomini kiriting" value="<?=$fetch['tashkilot']?>" name="tashkilot">
                </div>
                <div class="form-group">
                  <label class="control-label">Tashkilot turi</label>
                  <input class="form-control" list="datalistOptions" id="tashkilottype" value="<?=$fetch['tashkilottype']?>" placeholder="Tashkilot turi" name="tashkilottype">
                  <datalist id="datalistOptions">
                    <option value="MChJ">
                    <option value="AJ">
                    <option value="XK">
                    <option value="YT">
                  </datalist>                  
                </div>
                <div class="form-group">
                  <label class="control-label">Lavozim</label>
                  <input class="form-control" type="text" placeholder="Lavozimni yozing" name="lavozim" value="<?=$fetch['lavozim']?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Kurslardan qanday natijaga erishilganligi</label>
                  <?                    
                    $sql = mysqli_query($link,"SELECT * FROM natijalar ORDER BY id ASC");
                    while ($f = mysqli_fetch_assoc($sql)) {                      
                      ?>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="checkbox" name="natija[]" value="<?=$f['id']?>" <?if(in_array($f['id'], $natijalar)){ echo "checked"; }?>><?=$f['name']?>
                    </label>
                  </div>
                      <?
                    }
                  ?>
                </div>
                <div class="form-group">
                  <label class="control-label">Kurslardan qanday ko’nikma/texnologiyalar/tajribalarga erishilganligi</label>
                  <textarea class="form-control" rows="4" placeholder="Izoh yozing" name="tajriba"><?=$fetch['tajriba']?></textarea>
                </div>
                <div class="form-group">
                  <label class="control-label">Kursdan keyingi</label>
                  <?
                    $sql = mysqli_query($link,"SELECT * FROM statuslar ORDER BY id ASC");
                    while ($f = mysqli_fetch_assoc($sql)) {                      
                      ?>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="checkbox" name="status[]" <?if(in_array($f['id'], $statuslar)){ echo "checked"; }?> value="<?=$f['id']?>"><?=$f['name']?>
                    </label>
                  </div>
                      <?
                    }
                  ?>
                </div>
                
                </div>
                <input type="hidden" name="action" value="updatetinglovchi">   
                <input type="hidden" name="id" value="<?=$fetch['id']?>">  
              </form>
            </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="button" id="submitform"><i class="fa fa-fw fa-lg fa-edit"></i>Tahrirlash</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="tinglovchilar.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Bekor qilish</a>
            </div>
          </div>
        </div>

      </div>
    </main>
    <? include_once 'js.php'; ?>  
    <script type="text/javascript">
    	$('#vil_id').change(function() {
    		let vil_id = $(this).val();
    		$.ajax({
    			url: "get-tuman.php",
    			type: "GET",
    			data:{
    				viloyat_id:vil_id,
    			},
    			success:function(data) {
    				$('#tuman_id').html(data);
    			},
    			error:function(xhr) {
    				alert("Kechirasiz internetda uzilish ro'y berdi")
    			}
    		});
    	});
      $('#tuman_id').change(function() {
        let tuman_id = $(this).val();
        let viloyat_id = $('#vil_id').val();

        $.ajax({
          url: "get-bandlik.php",
          type: "GET",
          data:{
            tuman_id:tuman_id,viloyat_id:viloyat_id,
          },
          success:function(data) {
            console.log(data);
            $('#bandlik_id').html(data);
          },
          error:function(xhr) {
            alert("Kechirasiz internetda uzilish ro'y berdi")
          }
        });
      });
    	$('#submitform').click(function() {
    		let dataform = $('#formdata').serialize();
    		console.log(dataform);
    		$.ajax({
    			url: "update.php",
    			type: "POST",
    			data:dataform,
    			success:function(data) {
    				console.log(data);
    				var obj = jQuery.parseJSON(data);
    				if (obj.error == 0) {
	              $.notify({
	                title: "Good job : ",
	                message: obj.xabar,
	                icon: 'fa fa-check' 
	              },{
	                type: "success"
	              });
	              setTimeout(() => {
	                location.href='tinglovchilar.php';
	              }, 1500);
	              //$('#formdata')[0].reset();
	          }
	          else{ 
	            $.notify({
	              title: "Xatolik : ",
	              message: obj.xabar,
	              icon: 'fa fa-close' 
	            },{
	              type: "danger"
	            });
	          }    				
    			},
    			error:function(xhr) {
    				alert("Kechirasiz internetda uzilish ro'y berdi")
    			}
    		})
    	})
    </script>  
  </body>
</html>
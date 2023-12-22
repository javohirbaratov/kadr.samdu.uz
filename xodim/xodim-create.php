<?php
  include_once 'ximoya.php';
  $_SESSION['page'] = 7.2;
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
          <h1><i class="fa fa-edit"></i> Xodim qo'shish</h1>
          <p>Formani to'ldiring</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Xodimlar bo'limi</li>
          <li class="breadcrumb-item"><a href="#">Xodim yaratish</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Xodim yaratish uchun maydonlarni to'ldiring</h3>
            <div class="tile-body">
              <form id="form" action="index.php" method="post">
              <div class="form-group">
                <label>Ism</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Ism kiriting"
                    name="ism"
                    id="ism"
                    required
                />
                <div class="invalid-feedback">Ism kiriting</div>
              </div>

              <div class="form-group">
                <label>Familya</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Familya kiriting"
                    name="familya"
                    id="familya"
                    required
                />
                <div class="invalid-feedback">Familya kiriting</div>
              </div>


              <div class="form-group">
                <label>Otasining ismi</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Otasining ismini kiriting"
                    name="otch"
                    id="otch"
                    required
                />
                <div class="invalid-feedback">Otasining ismini kiriting</div>
              </div>


              <div class="form-group">
                <label>JSHIR </label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="______________"
                    name="jshir"
                    id="jshir"
                    required
                />
                <div class="invalid-feedback">JSHIR ni kiriting</div>
              </div>

              <div class="form-group">
                <label>INN</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="_________"
                    name="inn"
                    id="inn"
                    required
                />
                <div class="invalid-feedback">INN kiriting</div>
              </div>
              <div class="form-group">
                <label>Seriya</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="__"
                    name="seriya"
                    id="seriya"
                    required
                />
                <div class="invalid-feedback">Seriya kiriting</div>
              </div>

              <div class="form-group">
                <label>Nomer</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="_______"
                    name="nomer"
                    id="nomer"
                    required
                />
                <div class="invalid-feedback">Nomerni kiriting</div>
              </div>

              <div class="form-group">
                <label>Pasport berilgan sana</label>
                <input
                    class="form-control"
                    type="date"
                    placeholder="Pasport berilgan sanani kiriting"
                    name="pasportdate"
                    id="pasportdate"
                    required
                />
                <div class="invalid-feedback">Pasport berilgan sanani kiriting</div>
              </div>


              <div class="form-group">
                <label>Pasport berilgan joy</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Pasport berilgan joyni kiriting"
                    name="pasportjoy"
                    id="pasportjoy"
                    required
                />
                <div class="invalid-feedback">Pasport berilgan joyni kiriting</div>
              </div>


              <div class="form-group">
                <label>Pasport muddati</label>
                <input
                    class="form-control"
                    type="date"
                    placeholder="Pasport muddatini kiriting"
                    name="pasportenddate"
                    id="pasportenddate"
                    required
                />
                <div class="invalid-feedback">Pasport muddatini kiriting</div>
              </div>



              <div class="form-group">
                <label>Pasport</label>
                <input
                    class="form-control"
                    type="file"
                    placeholder="Pasport"
                    name="passport"
                    id="passport"
                    
                />
                <div class="invalid-feedback">Pasport</div>
              </div>



              <div class="form-group">
                <label>To`g`ilgan sana</label>
                <input
                    class="form-control"
                    type="date"
                    placeholder="To`g`ilgan sanani kiriting"
                    name="birthdate"
                    id="birthdate"
                    required
                />
                <div class="invalid-feedback">To`g`ilgan sanani kiriting</div>
              </div>



              <div class="form-group">
                <label>Tug`ilgan joy</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Tug`ilgan joyni kiriting"
                    name="birthplace"
                    id="birthplace"
                    required
                />
                <div class="invalid-feedback">Tug`ilgan joyni kiriting</div>
              </div>

              <div class="form-group">
                <label>Xodim jinsini tanlang</label>
                <select name="jinsi"  id="jinsi"  required class="form-control">
                  <option value="erkak">erkak</option>
                  <option value="ayol">ayol</option>
                  
                </select>
                <div class="invalid-feedback">Xodim jinsini tanlang</div>
              </div>


              <div class="form-group">
                <label>Millati</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Millatini kiriting"
                    name="millati"
                    id="millati"
                    required
                />
                <div class="invalid-feedback">Millatini kiriting</div>
              </div>


              <div class="form-group">
                <label>Fuqoroligi</label>
                <select name="fuqaroligi" id="fuqaroligi"  required class="form-control">
                  <option value="O`zbekiston fuqorosi">O`zbekiston fuqorosi</option>
                  <option value="Chet el fuqorosi">Chet el fuqorosi</option>
                  <option value="Fuqoroligi yuq shaxs">Fuqoroligi yuq shaxs</option>
                </select>
                <div class="invalid-feedback">Fuqoroligini Tanlang</div>
              </div>


              <div class="form-group">
                <label>Partiyaviyligi</label>
                <select name="partiyaviyligi" id="partiyaviyligi"  required class="form-control">
                  <option value="Yo`q">Yo`q</option>
                  <option value="Oʻzbekiston Xalq demokratik partiyasi">Oʻzbekiston Xalq demokratik partiyasi</option>
                  <option value="Oʻzbekiston Liberal demokratik partiyasi">Oʻzbekiston Liberal demokratik partiyasi</option>
                  <option value="Oʻzbekiston Milliy tiklanish demokratik partiyasi">Oʻzbekiston Milliy tiklanish demokratik partiyasi</option>
                  <option value="Oʻzbekiston Adolat sotsial demokratik partiyasi">Oʻzbekiston Adolat sotsial demokratik partiyasi</option>
                  <option value="Oʻzbekiston ekologik partiyasi">Oʻzbekiston ekologik partiyasi</option>
                </select>
                <div class="invalid-feedback">Partiyaviyligini Tanlang</div>
              </div>



              <div class="form-group">
                <label>Xarbiy emasmi?</label>
                <select name="xarbiy" id="xarbiy"  required class="form-control">
                  <option value="Yo`q">Yo`q</option>
                  <option value="Xa">Xa</option>
                </select>
                <div class="invalid-feedback">Xarbiyni Tanlang</div>
              </div>


              <div class="form-group">
                <label>Moddiy javobgar shaxsmi</label>
                <select name="mjshaxs" id="mjshaxs"  required class="form-control">
                  <option value="Yo`q">Yo`q</option>
                  <option value="Xa">Xa</option>
                </select>
                <div class="invalid-feedback">Moddiy javobgar shaxsmi tanlang</div>
              </div>


              <div class="form-group">
                <label>Tibbiy ko`rik muddati</label>
                <input
                    class="form-control"
                    type="date"
                    placeholder="Tibbiy ko`rik muddati kiriting"
                    name="tkmuddati"
                    id="tkmuddati"
                    required
                />
                <div class="invalid-feedback">Tibbiy ko`rik muddati kiriting</div>
              </div>


              <div class="form-group">
                <label>Tibbiy ko`rik guvohnomasi</label>
                <input
                    class="form-control"
                    type="file"
                    placeholder="Tibbiy ko`rik guvohnomasi kiriting"
                    name="tkguvohnoma"
                    id="tkguvohnoma"
                    
                />
                <div class="invalid-feedback">Tibbiy ko`rik guvohnomasi kiriting</div>
              </div>


              <div class="form-group">
                <label>Manzili</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Manzilini kiriting"
                    name="manzil"
                    id="manzil"
                    required
                />
                <div class="invalid-feedback">Manzilini kiriting</div>
              </div>


              <div class="form-group">
                <label>Doimiy yashash joyi</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Doimiy yashash joyini kiriting"
                    name="doimiy"
                    id="doimiy"
                    required
                />
                <div class="invalid-feedback">Doimiy yashash joyini kiriting</div>
              </div>


              <div class="form-group">
                <label>Telefoni</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="+998(__)___-__-__"
                    name="telefon"
                    id="telefon"
                    required
                />
                <div class="invalid-feedback">Telefonini kiriting</div>
              </div>


              <div class="form-group">
                <label>Telegram ID</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Telegram IDsini kiriting"
                    name="telegram_id"
                    id="telegram_id"
                    
                />
                <div class="invalid-feedback">Telegram IDsini kiriting</div>
              </div>
                

              <div class="form-group">
                <label>Email</label>
                <input
                    class="form-control"
                    type="email"
                    placeholder="Emailni kiriting"
                    name="pochta"
                    id="pochta"
                    
                />
                <div class="invalid-feedback">Emailni kiriting</div>
              </div>



              <div class="form-group">
                <label>Rasm</label>
                <input
                    class="form-control"
                    type="file"
                    placeholder="Rasm"
                    name="rasm"
                    id="rasm"
                    
                />
                <div class="invalid-feedback">Rasm</div>
              </div>

              <div class="form-group" >
                <label>Oilaviy ahvoli</label>
                <select name="oilaviyahvoli"  id="oilaviyahvoli"  required class="form-control">
                  <option value="Uylanmagan">Uylanmagan</option>
                  <option value="Turmushga chiqmagan">Turmushga chiqmagan</option>
                  <option value="Oilali">Oilali</option>
                  <option value="Ajrashgan">Ajrashgan</option>
                  <option value="Beva">Beva</option>
                </select>
                <div class="invalid-feedback">Oilaviy ahvolini kiriting</div>
              </div>

              <div class="form-group">
                <label>Viloyatni tanlang</label>
                <select name="viloyat_id"  id="viloyat_id" required class=" js-example-data-ajax form-control">
                  <?php
                    $sql = mysqli_query($link,"SELECT * FROM viloyat ORDER BY nomi ASC");
                    while($fetch = mysqli_fetch_assoc($sql)){
                      ?>
                      <option value="<?=$fetch['id']?>"><?=$fetch['nomi']?></option>
                      <?
                    }
                    mysqli_close($link);
                    
                   ?>
                   <option value="Boshqa">Boshqa</option>
                </select>
                <div class="invalid-feedback">Viloyatni tanlang</div>
              </div>


              <div class="form-group" id="tuman">
                <label>Tumanni tanlang</label>
                <select name="tuman_id"  id="tuman_id"  required class="js-example-data-ajax form-control">
                  <option value="1">Tanlang</option>
                </select>
                <div class="invalid-feedback">Tumanni tanlang</div>
              </div>
              <div class="form-group">
                <input type="hidden" name="_csrf" value="<?=$_SESSION['_csrf']?>" id="_csrf">
              </div>
            </form>
            </div>
            <div class="tile-footer">
              <button class="btn btn-success" type="button" id="submitform"><i class="fa fa-fw fa-lg fa-check-circle"></i>Qo'shish</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="tinglovchilar.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Bekor qilish</a>
            </div>
          </div>
        </div>

      </div>
    </main>
    <? include_once 'js.php'; ?>  
    <script type="text/javascript">
      $('#viloyat_id').select2();
      $('#tuman_id').select2();
      $('#viloyat_id').change(function() {
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
        let dataform = $('#form').serialize();
        //console.log(dataform);
        $.ajax({
          url: "insert.php",
          type: "POST",
          data: new FormData($("#form")[0]),
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
                // setTimeout(() => {
                //   location.href='tinglovchilar.php';
                // }, 1500);
                $('#form')[0].reset();
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
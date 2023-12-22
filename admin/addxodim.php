<?php 

include 'menu/head.php';
?>



<!--MAIN-CONTENT-OPEN-->
<main>
  <div class="container">
    <div class="page-header">
      <h2 class="page-header__title">Xodim </h2>
      <ul class="page-header__nav">
        <li>
          <i class="far fa-home-lg-alt"></i>
          <a href="index.html">Home</a>
        </li>
        <li>
          Xodim 
        </li>
      </ul>
    </div>
    <div class="page-content">
      <div class="form-group">
        <div class="card">
          <div class="card-header">
            <p>Xodim </p>
          </div>
          <div class="card-body">
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
                <select name="jinsi"  id="jinsi"  required class="form-select">
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
                <select name="fuqaroligi" id="fuqaroligi"  required class="form-select">
                  <option value="O`zbekiston fuqorosi">O`zbekiston fuqorosi</option>
                  <option value="Chet el fuqorosi">Chet el fuqorosi</option>
                  <option value="Fuqoroligi yuq shaxs">Fuqoroligi yuq shaxs</option>
                </select>
                <div class="invalid-feedback">Fuqoroligini Tanlang</div>
              </div>


              <div class="form-group">
                <label>Partiyaviyligi</label>
                <select name="partiyaviyligi" id="partiyaviyligi"  required class="form-select">
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
                <select name="xarbiy" id="xarbiy"  required class="form-select">
                  <option value="Yo`q">Yo`q</option>
                  <option value="Xa">Xa</option>
                </select>
                <div class="invalid-feedback">Xarbiyni Tanlang</div>
              </div>


              <div class="form-group">
                <label>Moddiy javobgar shaxsmi</label>
                <select name="mjshaxs" id="mjshaxs"  required class="form-select">
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
                <select name="oilaviyahvoli"  id="oilaviyahvoli"  required class="form-select">
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
                <select name="viloyat_id"  id="viloyat_id" onchange="ttuman()"  required class=" js-example-data-ajax form-group">
                  <?php 
                    $fetch = Functions::getall("viloyat");
                     foreach ($fetch as $value) {
                    echo"<option value=\"".$value['id']."\">".$value['nomi']."</option>";
                  }
                   ?>
                   <option value="Boshqa">Boshqa</option>
                </select>
                <div class="invalid-feedback">Viloyatni tanlang</div>
              </div>


              <div class="form-group" id="tuman">
                <label>Tumanni tanlang</label>
                <select name="tuman_id"  id="tuman_id"  required class="js-example-data-ajax form-select">
                  <option value="1">Samarqand</option>
                  <option value="2">Oqdaryo</option>
                </select>
                <div class="invalid-feedback">Tumanni tanlang</div>
              </div>



              <div class="form-group">
      <input type="hidden" name="_csrf" value="<?=$_SESSION['_csrf']?>" id="_csrf">
                
                 <button
                  class="btn btn-primary w-100"
                  id="ok1"
                  name="ok1"
                  disabled
              >
                Shakllantirish
                <div class="lds-dual-ring btn-load"></div>
              </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<!--MAIN-CONTENT-CLOSE-->

<script src="https://unpkg.com/imask"></script>
<script type="text/javascript">
  var phoneMask = IMask(
      document.getElementById('telefon'), {
          mask: '+{998}(00)000-00-00'
      });
  var seriyaMask = IMask(
      document.getElementById('seriya'), {
          mask: 'aa',

      });

  var jshirMask = IMask(
      document.getElementById('jshir'), {
          mask: '00000000000000',

      });

  var nomerMask = IMask(
      document.getElementById('nomer'), {
          mask: '0000000',

      });

  var innMask = IMask(
      document.getElementById('inn'), {
          mask: '000000000',

      });

</script>
<script type="text/javascript">

  let submitBtn = document.getElementById('ok1');
    submitBtn.addEventListener("click", function submit(e) {
      console.log($("#form").serialize());
      e.preventDefault();
      loadingStart();
      $.ajax({
        url: "core/addxodim.php",
        type: 'POST',
        processData: false,
        contentType: false,
        data:   new FormData($("#form")[0]),
        success: function (data) {
          console.log(data);  
            var obj = jQuery.parseJSON(data);
          if (obj.xatolik==0) {
            toast.create({
              title: "Muvaffaqiyatli.",
              text: "Ma'lumot kiritildi!",
              type: "success",
              icon: "assets/img/icon/success.svg",
            });
            setTimeout(() => {
              location.href = "xodim.php";
            }, 3500);
          } else {
            $('#_csrf').val(obj._csrf);
            toast.create({
              title: "Xatolik.",
              text: "Ma'lumotda kamchilik bor!",
              type: "error",
              icon: "assets/img/icon/error.svg",
            });
          }
          loadingStop();
        },
        error: function () {
          toast.create({
            title: "Xatolik.",
            text: "Ulanishda xatolik!",
            type: "error",
            icon: "assets/img/icon/error.svg",
          });
          loadingStop();
        },
      });
    });

</script>
<?php 

include 'menu/footer.php';
?>
<script type="text/javascript">
    $(function() {
      $('#seriya').keyup(function() {
          this.value = this.value.toUpperCase();
      });
  });
    $('#viloyat_id').select2({});
    $('#tuman_id').select2({});
function ttuman() {
  var qiymat = document.getElementById('viloyat_id').value;
  if (qiymat == 'Boshqa') {
    document.getElementById('tuman').innerHTML = 
                '<label>Manzilini Kiriting</label><input class="form-control type="text placeholder="Manzilini Kiriting " name="tuman_id" "id="tuman_id" require/> <div class="invalid-feedback">Manzilini Kiriting</div>';
  }
  else{
        var bulim_id = document.getElementById('viloyat_id').value;
        
        $.ajax({
        url: "core/tuman.php",
        type: 'POST',
        data: {
          tuman_id:bulim_id,
        },
        success: function (data) {
            document.getElementById('tuman').innerHTML=data;
            $('#tuman_id').select2({});
        },
        error: function () {
          toast.create({
            title: "Xatolik.",
            text: "Ulanishda xatolik!",
            type: "error",
            icon: "assets/img/icon/error.svg",
          });
        },
      });
  }
}
</script>
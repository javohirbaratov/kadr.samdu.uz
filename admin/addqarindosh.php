<?php

include 'menu/head.php';
?>



<!--MAIN-CONTENT-OPEN-->
<main>
  <div class="container">
    <div class="page-header">
      <h2 class="page-header__title">Qarindosh Qo`shish </h2>
      <ul class="page-header__nav">
        <li>
          <i class="far fa-home-lg-alt"></i>
          <a href="index">Home</a>
        </li>
        <li>
          Qarindosh Qo`shish
        </li>
      </ul>
    </div>
    <div class="page-content">
      <div class="form-group">
        <div class="card">
          <div class="card-header">
            <p>Qarindosh Qo`shish  </p>
          </div>
          <div class="card-body">
            <form id="form" action="index.php" method="post">

              <div class="form-group">
                <label>Xodimni tanlang</label>
                <select name="user_id"  id="user_id"  required class="js-example-data-ajax form-select">
                  <option>Tanlang</option>
                  <?php
                  $fetch=Functions::getall("xodimlar");
                  foreach ($fetch as  $value) {
                    echo"<option value=\"".$value['id']."\">".$value['familya']." ".$value['ism']." ".$value['otch']."</option>";
                  }
                   ?>
                </select>
                <div class="invalid-feedback">Xodimni tanlang</div>
              </div>

              <div class="form-group" id = "kafedra1">
                <label  >Qarindoshligini tanlang</label>
                <select   name="qarindoshligi" id="qarindoshligi"  required class="form-select">
                  <option value="0">Tanlang</option>
                  <option value="Otasi">Otasi</option>
                  <option value="Onasi">Onasi</option>
                  <option value="Turmush">Turmush o'rtog'i</option>
                  <option value="Opasi">Opasi</option>
                  <option value="Singlisi">Singlisi</option>
                  <option value="Akasi">Akasi</option>
                  <option value="Ukasi">Ukasi</option>
                  <option value="O`g`li">O`g`li</option>
                  <option value="Qizi">Qizi</option>
                  <option value="Qayni otasi">Qayni otasi</option>
                  <option value="Qayni onasi">Qayni onasi</option>
                </select>
              </div>

              <div class="form-group">
                <label>To`liq ism</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="To`liq ism"
                    id="fio"
                    name="fio"
                />
                <div class="invalid-feedback">Ismni kiriting</div>
              </div>

              <div class="form-group">
                <label>Manzil</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Kiritish"
                    id="manzil"
                    name="manzil"
                />
                <div class="invalid-feedback">Manzil kiriting</div>
              </div>

              <div class="form-group">
                <label>Tug`ilgan joyi</label>
                <input
                    class="form-control"
                    type="taxt"
                    placeholder="Kiritish"
                    id="tsana"
                    name="tsana"
                />
                <div class="invalid-feedback">Tug`ilgan joyi kiriting</div>
              </div>

              <div class="form-group">
                <label>Mashg`uloti</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="KiritMashg`uloti"
                    id="mashguloti"
                    name="mashguloti"

                />
                <div class="invalid-feedback">Mashg`ulotini kiriting </div>
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


<script type="text/javascript">
	<?php
  if(isset($_GET['best']))
    echo 'document.getElementById("user_id").value='.$_GET['best'].';';
  
  ?>
  let submitBtn = document.getElementById('ok1');
    submitBtn.addEventListener("click", function submit(e) {
      e.preventDefault();
      loadingStart();
      $.ajax({
        url: "core/add.php?table=<?=str_rot13("qarindoshlar")?>&soni=<?=6*$keyuser?>",
        type: 'POST',
        processData: false,
        contentType: false,
        data: new FormData($("#form")[0]),
            success: function (data) {
                  var obj = jQuery.parseJSON(data);
                if (obj.xatolik==0) {
                  toast.create({
                    title: "Muvaffaqiyatli.",
                    text: "Ma'lumot kiritildi!",
                    type: "success",
                    icon: "assets/img/icon/success.svg",
                  });

                  setTimeout(() => {
                    let user = document.getElementById("user_id").value;
                    location.href = "addqarindosh.php?best="+user;
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

function mehnat() {
  let user = document.getElementById("user_id").value;
  $.ajax({
    url: "core/mehnattatili.php",
        type: 'get',
        data:{
        user_id:user
        },
        success: function (data) {
          let obj = jQuery.parseJSON(data);
          if (obj.hasOwnProperty('bulim_id')) {
            document.getElementById('bulimdan').value = obj['bulim_id'];
            document.getElementById('kadr_bulimdan').value = obj['kadr_id'];
            document.getElementById('lavozimdan').value = obj['lavozim'];
            document.getElementById('shtatdan').value = obj['shtat'];
            document.getElementById('kafedradan').value = obj['kafname'];
            document.getElementById('bulimdan1').value = obj['bulim_id'];
            document.getElementById('kadr_bulim1').value = obj['kadr_id'];
            document.getElementById('kafedradan1').value = obj['kafname'];
            document.getElementById('lavozimdan1').value = obj['lavozim'];
            document.getElementById('shtatdan1').value = obj['shtat'];
          }
          else{
            toast.create({
            title: "Xatolik.",
            text: "Xodim Ishga qabul qilinmagan!",
            type: "error",
            icon: "assets/img/icon/error.svg",
          });

            document.getElementById('bulim1_id').value = "Xodimni avval ishga qabul qiling";
            document.getElementById('shtat1').value = "Xodimni avval ishga qabul qiling";
          }
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


function bulim(){
        var bulim_id = document.getElementById('kadr_bulim_id').value;
        document.getElementById('bulim1').innerHTML = '';
        document.getElementById('kaf2').style.display = 'none';
        document.getElementById('kafedra_id').style.display = 'none';
        document.getElementById('kafedra_id').value = '0';

        document.getElementById('lavozim1').innerHTML = '';
        $.ajax({
        url: "core/bulim.php",
        type: 'POST',
        data: {
          bulim_id:bulim_id,
        },
        success: function (data) {

            document.getElementById('bulim1').innerHTML=data;
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

function funkaf(){
        var bulim_id = document.getElementById('bulim_id').value;

        $.ajax({
        url: "core/kafedra.php",
        type: 'POST',
        data: {
          bulim_id:bulim_id,
        },
        success: function (data) {
            document.getElementById('kafedra1').innerHTML=data;
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

function funlav(){
        var bulim_id = document.getElementById('bulim_id').value;

        $.ajax({
        url: "core/lavozim.php",
        type: 'POST',
        data: {
          bulim_id:bulim_id,
        },
        success: function (data) {
            document.getElementById('lavozim1').innerHTML=data;
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

</script>
<?php

include 'menu/footer.php';
?>
<script type="text/javascript">
  (function($) {
$.fn.serializefiles = function() {
    var obj = $(this);
    /* ADD FILE TO PARAM AJAX */
    var formData = new FormData();
    $.each($(obj).find("input[type='file']"), function(i, tag) {
        $.each($(tag)[0].files, function(i, file) {
            formData.append(tag.name, file);
        });
    });
    var params = $(obj).serializeArray();
    $.each(params, function (i, val) {
        formData.append(val.name, val.value);
    });
    return formData;
};
})(jQuery);
  $('#user_id').select2({});
</script>

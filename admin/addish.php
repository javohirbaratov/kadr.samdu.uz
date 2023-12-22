<?php

include 'menu/head.php';
?>



<!--MAIN-CONTENT-OPEN-->
<main>
  <div class="container">
    <div class="page-header">
      <h2 class="page-header__title">Ishga Qabul qilish </h2>
      <ul class="page-header__nav">
        <li>
          <i class="far fa-home-lg-alt"></i>
          <a href="index.html">Home</a>
        </li>
        <li>
          Ishga Qabul qilish
        </li>
      </ul>
    </div>
    <div class="page-content">
      <div class="form-group">
        <div class="card">
          <div class="card-header">
            <p>Ishga Qabul qilish </p>
          </div>
          <div class="card-body">
            <form id="form" action="index.php" method="post">
              <div class="form-group">
                <label>Xodimni tanlang</label>
                <select name="user_id" id="user_id"  required  class="js-example-data-ajax form-select">
                  <?php
                  $fetch=Functions::getall("xodimlar");
                  foreach ($fetch as  $value) {
                    echo"<option value=\"".$value['id']."\">".$value['familya']." ".$value['ism']." ".$value['otch']."</option>";
                  }
                   ?>
                </select>
                <div class="invalid-feedback">Xodimni tanlang</div>
              </div>
              <div class="form-group">
                <label>Ma'lumot</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Ma'lumot kiriting"
                    name="malumot"
                    required
                />
                <div class="invalid-feedback">Ma'lumot kiriting</div>
              </div>
              <div class="form-group">
                <label>Shartnoma raqamini kiriting</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Ma'lumot kiriting"
                    name="shartnomaraqam" 
                    required
                />
                <div class="invalid-feedback">Shartnoma raqamni kiriting</div>
              </div>

              <div class="form-group">
                <label>Shtat</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Shtat kiriting"
                    name="shtat"

                />
                <div class="invalid-feedback">Shtat kiriting</div>
              </div>

              <div class="form-group">
                <label>Sana</label>
                <input
                    class="form-control"
                    type="date"
                    placeholder="Sana kiriting"
                    name="sana"

                />
                <div class="invalid-feedback">Sana kiriting</div>
              </div>

              <div class="form-group switch_box box_1">
                <label>Nomuayyan muddatda</label>
                <input type="checkbox" onchange="check2()" id="Mycheck2" class="switch_1">
                <input type="hidden" name="muddattype" id="muddattype" value="1">
              </div>

              <div class="form-group" id="mdc">
                <label>Muddati</label>
                <input
                    class="form-control"
                    type="date"
                    placeholder="Muddatini kiriting"
                    name="muddati"

                />
                <div class="invalid-feedback">Muddatini kiriting</div>
              </div>


              <div class="form-group switch_box box_1">
                <label>Sinov asosida qabul bilindimi?</label>
                <input type="checkbox" onchange="check()" id="Mycheck" class="switch_1">
              </div>

            <div class="form-group">
              <select name="sinov" class="form-select" style="display:none" id="sinov">
                <option value="0">Tanlang</option>
                <option value="1">1-oy sinov</option>
                <option value="2">2-oy sinov</option>
                <option value="3">3-oy sinov</option>
              </select>
              </div>
              <div class="form-group">
                <label>Kadrlar bo'limini tanlang</label>
                <select name="kadr_bulim_id" id="kadr_bulim_id" onchange="bulim()"   class="form-select">
                  <?php
                  $fetch=Functions::getall("kadrlarbulimi");
                  foreach ($fetch as $value) {
                    echo"<option value=\"".$value['id']."\">".$value['name']."</option>";
                  }
                   ?>
                </select>
                <div class="invalid-feedback">Kadrlar bo'limini tanlang</div>

              </div>

              <div class="form-group" id = "bulim1">

              </div>

              <div class="form-group" id = "kafedra1">
                <label id = "kaf2" style="display:none">Kafedrani tanlang</label>
                <select style="display:none" onchange="funlav()"   name="kafedra_id" id="kafedra_id"   class="form-select">
                  <option value="0">Tanlang</option>
                </select>
              </div>

              <div class="form-group" id="lavozim1">
              </div>



            <div class="form-group">
                <label>Ish o'rnini tanlang</label>
              <select name="urindosh" class="form-select">
                <option value="asosiy">Asosiy</option>
                <option value="ichki">Ichki o'rindosh</option>
                <option value="tashqi">Tashqi o'rindosh</option>
              </select>

                <div class="invalid-feedback">Ish o'rnini tanlang</div>
              </div>


              <div class="form-group">
                <label>Ariza skaneri</label>
                <input
                    class="form-control"
                    type="file"
                    placeholder="Ariza skanerini kiriting"
                    name="ariza"
                    id="ariza"

                />
                <div class="invalid-feedback">Ariza skanerini kiriting</div>
              </div>

              <div class="form-group">
                <label>Buyruq</label>
                <select name="buyruq"  id="buyruq"  class=" js-example-data-ajax form-group">
                     <option value="Tanlang">Tanlang</option>
                    <?php
                      $fetch = Functions::getall("buyruq");
                       foreach ($fetch as $value) {
                      echo"<option value=\"".$value['braqam']."\">".$value['braqam']." (".$value['sana'].")</option>";
                    }
                     ?>
                  </select>
                <div class="invalid-feedback">Buyruqni kiriting</div>
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
  function check() {
    let che = document.getElementById("Mycheck").checked;
    console.log(document.getElementById('sinov').value);
    if (che) {
      document.getElementById('sinov').style = "display:block";
      document.getElementById('sinov').value = "1";
    }else
      document.getElementById('sinov').style = "display:none";
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

  let submitBtn = document.getElementById('ok1');
    submitBtn.addEventListener("click", function submit(e) {
      e.preventDefault();
      loadingStart();
      $.ajax({
        url: "core/addish.php",
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
              location.href = "ish.php";
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

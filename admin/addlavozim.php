<?php

include 'menu/head.php';
?>



<!--MAIN-CONTENT-OPEN-->
<main>
  <div class="container">
    <div class="page-header">
      <h2 class="page-header__title">Lavozimlar </h2>
      <ul class="page-header__nav">
        <li>
          <i class="far fa-home-lg-alt"></i>
          <a href="index">Home</a>
        </li>
        <li>
          Lavozimlar
        </li>
      </ul>
    </div>
    <div class="page-content">
      <div class="form-group">
        <div class="card">
          <div class="card-header">
            <p>Lavozimlar </p>
          </div>
          <div class="card-body">
            <form id="form" action="index.php" method="post">



              <div class="form-group">
                <label>Kadrlar bo'limini tanlang</label>
                <select name="kadr_bulim_id" id="kadr_bulim_id" onchange="bulim()"  required class="form-select">
                   <option value="">Tanlang</option>
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
                <select style="display:none" onchange="funlav()"   name="kafedra_id" id="kafedra_id"  required class="form-select">
                  <option value="0">Tanlang</option>
                </select>
              </div>



              <div class="form-group">
                <label>Lavozim nomi</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Lavozim nomi kiriting"
                    name="name"
                    required
                />
                <div class="invalid-feedback">Lavozim nomi kiriting</div>
              </div>



              <div class="form-group">
                <label>Shtat soni</label>
                <input
                    class="form-control"
                    type="number"
                    step="0.25"
                    min="0.25"
                    placeholder="Shtat soni kiriting"
                    name="soni"
                    required
                />
                <div class="invalid-feedback">Shtat soni kiriting</div>
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
  let submitBtn = document.getElementById('ok1');
    submitBtn.addEventListener("click", function submit(e) {
      e.preventDefault();
      loadingStart();
      $.ajax({
        url: "core/addlavozim.php",
        method: "get",
        data: $(form).serialize(),
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
              location.reload();
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


function bulim(){
        var bulim_id = document.getElementById('kadr_bulim_id').value;
        document.getElementById('bulim1').innerHTML = '';
        document.getElementById('kafedra1').innerHTML = '';

        $.ajax({
        url: "core/bulim.php",
        type: 'POST',
        data: {
          bulim_id:bulim_id,
        },
        success: function (data) {
            document.getElementById('bulim1').innerHTML=data;
          	$('#bulim_id').select2({});
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
          	$('#kafedra_id').select2({});
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
function funlav() {


}
</script>
<?php

include 'menu/footer.php';
?>

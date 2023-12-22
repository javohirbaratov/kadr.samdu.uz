<?php

include 'menu/head.php';
?>



<!--MAIN-CONTENT-OPEN-->
<main>
  <div class="container">
    <div class="page-header">
      <h2 class="page-header__title">Kadrlar bo'limidagi yo`nalishlarni shakllantirish</h2>
      <ul class="page-header__nav">
        <li>
          <i class="far fa-home-lg-alt"></i>
          <a href="index.html">Home</a>
        </li>
        <li>
          Kadrlar bo'limidagi yo`nalishlarni shakllantirish
        </li>
      </ul>
    </div>
    <div class="page-content">
      <div class="form-group">
        <div class="card">
          <div class="card-header">
            <p>Kadrlar bo'limidagi yo`nalishlarni shakllantirish</p>
          </div>
          <div class="card-body">
            <form id="form" action="index.php" method="post">



              <div class="form-group">
                <label>Kadrlar bo'limidagi yo`nalishlar</label>
                <select name="kadr_bulim_id" id="kadr_bulim_id" onchange="bulim()"  required class="form-select">
                  <option>Tanlash</option>
                  <?php
                  $fetch=Functions::getall("kadrlarbulimi");
                  foreach ($fetch as $value) {
                    echo"<option value=\"".$value['id']."\">".$value['name']."</option>";
                  }
                   ?>
                </select>
                <div class="invalid-feedback">Kadrlar bo'limidagi yo`nalishlar</div>

              </div>

              <div class="form-group" id = "bulim1">

              </div>

              <div class="form-group">
                <label> Nomi</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Nomi kiriting"
                    name="name"
                    required
                />
                <div class="invalid-feedback">Nomi kiriting</div>
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
        url: "core/addkafedra.php",
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

function funlav(){

}
function funkaf(){

}
</script>
<?php

include 'menu/footer.php';
?>

<?php

include 'menu/head.php';
?>



<!--MAIN-CONTENT-OPEN-->
<main>
  <div class="container">
    <div class="page-header">
      <h2 class="page-header__title">Bo`lim, Fakultet, Bino, Grantni Shakllantirish</h2>
      <ul class="page-header__nav">
        <li>
          <i class="far fa-home-lg-alt"></i>
          <a href="index">Home</a>
        </li>
        <li>
          Bo`lim, Fakultet, Bino, Grantni Shakllantirish
        </li>
      </ul>
    </div>
    <div class="page-content">
      <div class="form-group">
        <div class="card">
          <div class="card-header">
            <p>Bo`lim, Fakultet, Bino, Grantni Shakllantirish</p>
          </div>
          <div class="card-body">
            <form id="form" action="index" method="post">

              <div class="form-group">
                <label>Kadrlar bo`limini tanlang</label>
                <select name="kadrbulimi_id"  required class="form-select">
                  <option value="">Tanlang</option>
                  <?php
                  $fetch=Functions::getall("kadrlarbulimi");
                  foreach ($fetch as  $value) {
                    echo"<option value=\"".$value['id']."\">".$value['name']."</option>";
                  }
                   ?>
                </select>
                <div class="invalid-feedback">Kadrlar bo`limini tanlang</div>
              </div>

              <div class="form-group">
                <label>Nomi</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Nomini kiriting"
                    name="name"
                    required
                />
                <div class="invalid-feedback">Nomini kiriting</div>
              </div>
              <div class="form-group">
                <label>Izoh</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Izoh kiriting"
                    name="izoh"

                />
                <div class="invalid-feedback">Izoh kiriting</div>
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
        url: "core/addbulim.php",
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
</script>
<?php

include 'menu/footer.php';
?>

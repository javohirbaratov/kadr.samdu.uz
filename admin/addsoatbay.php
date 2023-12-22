<?php 

include 'menu/head.php';
?>



<!--MAIN-CONTENT-OPEN-->
<main>
  <div class="container">
    <div class="page-header">
      <h2 class="page-header__title">Soatbay asosida bajariladigan ish hajmini tasdiqlash</h2>
      <ul class="page-header__nav">
        <li>
          <i class="far fa-home-lg-alt"></i>
          <a href="index.html">Home</a>
        </li>
        <li>
          Soatbay asosida bajariladigan ish hajmini tasdiqlash
        </li>
      </ul>
    </div>
    <div class="page-content">
      <div class="form-group">
        <div class="card">
          <div class="card-header">
            <p>Soatbay asosida bajariladigan ish hajmini tasdiqlash</p>
          </div>
          <div class="card-body">
            <form id="form" action="index.php" method="post">


              <div class="form-group">
                <label>Buyruq raqami</label>
                <select name="braqam"  id="braqam"  class=" js-example-data-ajax form-group">
                     <option value="Tanlang">Tanlang</option>
                    <?php
                      $fetch = Functions::getall("buyruq");
                       foreach ($fetch as $value) {
                      echo"<option value=\"".$value['braqam']."\">".$value['braqam']." (".$value['sana'].")</option>";
                    }
                     ?>
                  </select>
              </div>
              
              <div class="form-group">
                <label>To`liq Ism</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="To`liq Ismni kiriting"
                    name="user_id"
                    id="user_id"
                    required
                />
                <div class="invalid-feedback">To`liq Ismni kiriting</div>
              </div>
              
              <div class="form-group">
                <label>Lavozim</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Lavozimni kiriting"
                    name="lavozim"
                    id="lavozim"
                    required
                />
                <div class="invalid-feedback">Lavozimni kiriting</div>
              </div>
              
              

              <div class="form-group">
                <label>Ish hajmi</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Ish hajmini kiriting"
                    name="hajm"
                    id="hajm"
                    required
                />
                <div class="invalid-feedback">Ish hajmini kiriting</div>
              </div>
              

              <div class="form-group">
                <label>Fakultet, kafedra </label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Fakultet, kafedra ni kiriting"
                    name="bulim_id"
                    id="bulim_id"
                    required
                />
                <div class="invalid-feedback">Fakultet, kafedra ni kiriting</div>
              </div>
              

              <div class="form-group">
                <label>Ish turi</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Ish turini kiriting"
                    name="ishturi"
                    id="ishturi"
                    required
                />
                <div class="invalid-feedback">Ish turini kiriting</div>
              </div>
              
              <div class="form-group">
                <label>Fayl</label>
                <input
                    class="form-control"
                    type="file"
                    placeholder="Fayl kiriting"
                    name="soatbay"
                />
                <div class="invalid-feedback">Fayl kiriting</div>
              </div>
              
              
              <div class="form-group">
                <label>Asos</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Asosni kiriting"
                    name="asos"
                    id="asos"
                    required
                />
                <div class="invalid-feedback">Asosni kiriting</div>
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
        url: "core/add.php?table=<?=str_rot13("soatbay")?>&soni=<?=6*$keyuser?>",
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
              location.href = "soatbay";
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

<script>
  
 $('#braqam').select2({});
</script>
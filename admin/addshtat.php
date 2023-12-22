<?php 

include 'menu/head.php';
?>



<!--MAIN-CONTENT-OPEN-->
<main>
  <div class="container">
    <div class="page-header">
      <h2 class="page-header__title">Shtat </h2>
      <ul class="page-header__nav">
        <li>
          <i class="far fa-home-lg-alt"></i>
          <a href="index">Home</a>
        </li>
        <li>
          Shtat 
        </li>
      </ul>
    </div>
    <div class="page-content">
      <div class="form-group">
        <div class="card">
          <div class="card-header">
            <p>Shtat</p>
          </div>
          <div class="card-body">
            <form id="form" action="index.php" method="post">
              <div class="form-group">
                <label>Xodimni tanlang</label>
                  <select name="teacher_id" id="user_id" required class="form-select  js-example-data-ajax " class="selectpicker" data-live-search="true" >
                    <?php 
                  $fetch=Functions::getall("xodimlar");
                  foreach ($fetch as  $value) {
                    echo"<option value=\"".$value['id']."\">".$value['familya']." ".$value['ism']." ".$value['otch']."</option>";
                  }
                   ?>
                    <option value="1">Wisconsin </option>
                    <option value="2">Wyoming</option>
                </select>
                 <div class="invalid-feedback">Xodimni tanlang</div>
              </div>
              <div class="form-group">
                <label>Kadrlar bo`limini tanlang</label>
                <select name="kadr_bulimi_id"  required class="form-select">
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
                <label>Lavozimni tanlang</label>
                <select name="lavozim_id"  required class="form-select">
                  <?php 
                  $fetch=Functions::getall("lavozimlar");
                  foreach ($fetch as  $value) {
                    echo"<option value=\"".$value['id']."\">".$value['lavozim']."</option>";
                  }
                   ?>
                </select>
                <div class="invalid-feedback">Lavozimni tanlang</div>
              </div>
              <div class="form-group">
                <label>Asosiy</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Asosiyni kiriting"
                    name="asosiy"
                    required
                />
                <div class="invalid-feedback">Asosiyni  kiriting</div>
              </div>


              <div class="form-group">
                <label>Ichki</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Ichkini kiriting"
                    name="ichki"
                    required
                />
                <div class="invalid-feedback">Ichkini kiriting</div>
              </div>

              <div class="form-group">
                <label>Tashqi</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Tashqi kiriting"
                    name="tashqi"
                    required
                />
                <div class="invalid-feedback">Tashqi kiriting</div>
              </div>
              <div class="form-group">
                <label>Soatbay</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Soatbay kiriting"
                    name="soatbay"
                    required
                />
                <div class="invalid-feedback">Soatbay kiriting</div>
              </div>

              <div class="form-group">
                <label>Sana</label>
                <input
                    class="form-control"
                    type="date"
                    placeholder="Sanani kiriting"
                    name="sana"
                    required
                />
                <div class="invalid-feedback">Sanani kiriting</div>
              </div>

              <div class="form-group">
                <label>Buyruq sanasi</label>
                <input
                    class="form-control"
                    type="date"
                    placeholder="Buyruq sanasini kiriting"
                    name="buyruqsana"
                    required
                />
                <div class="invalid-feedback">Buyruq sanasini kiriting</div>
              </div>
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
                <label>Kontrakt raqami</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Kontrakt raqamini kiriting"
                    name="kontraktnomer"
                    required
                />
                <div class="invalid-feedback">Kontrakt raqamini kiriting</div>
              </div>
              <input type="hidden" name="_csrf" value="<?=$_SESSION['_csrf']?>" id="_csrf">
              <div class="form-group">
                
                
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
        url: "core/addshtat.php",
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
              location.href = "shtat.php";
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
    $('#user_id').select2({});
</script>
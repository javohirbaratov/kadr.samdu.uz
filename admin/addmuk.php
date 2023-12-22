<?php 

include 'menu/head.php';
?>



<!--MAIN-CONTENT-OPEN-->
<main>
  <div class="container">
    <div class="page-header">
      <h2 class="page-header__title">Xodimlar mukofot </h2>
      <ul class="page-header__nav">
        <li>
          <i class="far fa-home-lg-alt"></i>
          <a href="index.html">Home</a>
        </li>
        <li>
          Xodimlar mukofot
        </li>
      </ul>
    </div>
    <div class="page-content">
      <div class="form-group">
        <div class="card">
          <div class="card-header">
            <p>Xodimlar mukofot </p>
          </div>
          <div class="card-body">
            <form id="form" action="index.php" method="post">


              <div class="form-group">
                <label>Buyruq raqami</label>
                <select name="braqam" id="braqam" class=" js-example-data-ajax form-group">
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
                <label>Xodimni tanlang</label>
                <select name="user_id" id="user_id" onchange="mehnat()" required
                  class="js-example-data-ajax form-select">
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
                <label>Kadr bulimdan</label>
                <input class="form-control" type="text" placeholder="Mavjud emas" id="kadr_bulim1" disabled />
                <input type="hidden" id="kadr_bulimdan">
                <div class="invalid-feedback">Kadr bulim kiriting</div>
              </div>

              <div class="form-group">
                <label>Bo`limdan</label>
                <input class="form-control" type="text" placeholder="Mavjud emas" id="bulimdan1" disabled />
                <input type="hidden" id="bulimdan" name="bulim_id">
                <div class="invalid-feedback">Bo`lim kiriting</div>
              </div>

              <div class="form-group">
                <label>Kafedradan</label>
                <input class="form-control" type="text" placeholder="Mavjud emas" id="kafedradan1" disabled />
                <input type="hidden" id="kafedradan">
                <div class="invalid-feedback">Kafedra </div>
              </div>

              <div class="form-group">
                <label>Lavozimdan</label>
                <input class="form-control" type="text" placeholder="Mavjud emas" id="lavozimdan1" disabled />
                <input type="hidden" id="lavozimdan" name="lavozim">
                <div class="invalid-feedback">Lavozimdan kiriting</div>
              </div>

              <div class="form-group">
                <label>Fayl</label>
                <input class="form-control" type="file" placeholder="Fayl kiriting" name="muk" />
                <div class="invalid-feedback">Fayl kiriting</div>
              </div>


              <div class="form-group">
                <label>Summa</label>
                <input class="form-control" type="text" placeholder="Summani kiriting" name="summa" required />
                <div class="invalid-feedback">Summani kiriting</div>
              </div>


              <div class="form-group">
                <label>Asos</label>
                <input class="form-control" type="text" placeholder="Asosni kiriting" name="asos" required />
                <div class="invalid-feedback">Asosni kiriting</div>
              </div>

              <div class="form-group">
                <input type="hidden" name="_csrf" value="<?=$_SESSION['_csrf']?>" id="_csrf">

                <button class="btn btn-primary w-100" id="ok1" name="ok1" disabled>
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
      url: "core/add.php?table=<?=str_rot13('
      muk')?>&soni=<?=6*$keyuser?>",
      type: 'POST',
      processData: false,
      contentType: false,
      data: new FormData($("#form")[0]),
      success: function (data) {
        console.log(data);
        var obj = jQuery.parseJSON(data);
        if (obj.xatolik == 0) {
          toast.create({
            title: "Muvaffaqiyatli.",
            text: "Ma'lumot kiritildi!",
            type: "success",
            icon: "assets/img/icon/success.svg",
          });
          setTimeout(() => {
            location.href = "muk";
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
      data: {
        user_id: user
      },
      success: function (data) {
        let obj = jQuery.parseJSON(data);
        if (obj.hasOwnProperty('bulim_id')) {
          document.getElementById('bulimdan').value = obj['bulim_id'];
          document.getElementById('kadr_bulimdan').value = obj['kadr_id'];
          document.getElementById('lavozimdan').value = obj['lavozim'];
          document.getElementById('kafedradan').value = obj['kafname'];
          document.getElementById('bulimdan1').value = obj['bulim_id'];
          document.getElementById('kadr_bulim1').value = obj['kadr_id'];
          document.getElementById('kafedradan1').value = obj['kafname'];
          document.getElementById('lavozimdan1').value = obj['lavozim'];
        } else {
          toast.create({
            title: "Xatolik.",
            text: "Xodim Ishga qabul qilinmagan!",
            type: "error",
            icon: "assets/img/icon/error.svg",
          });

          document.getElementById('bulimdan').value = 0;
          document.getElementById('kadr_bulimdan').value = 0;
          document.getElementById('lavozimdan').value = 0;
          document.getElementById('kafedradan').value = 0;
          document.getElementById('bulimdan1').value = "Xodimni avval ishga qabul qiling";
          document.getElementById('kadr_bulim1').value = "Xodimni avval ishga qabul qiling";
          document.getElementById('kafedradan1').value = "Xodimni avval ishga qabul qiling";
          document.getElementById('lavozimdan1').value = "Xodimni avval ishga qabul qiling";
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
</script>
<?php 

include 'menu/footer.php';
?>
<script>
  $('#braqam').select2({});
  $('#user_id').select2({});
</script>
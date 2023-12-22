<?php 

include 'menu/head.php';
?>



<!--MAIN-CONTENT-OPEN-->
<main>
  <div class="container">
    <div class="page-header">
      <h2 class="page-header__title">Diplom </h2>
      <ul class="page-header__nav">
        <li>
          <i class="far fa-home-lg-alt"></i>
          <a href="index.html">Home</a>
        </li>
        <li>
          Diplom 
        </li>
      </ul>
    </div>
    <div class="page-content">
      <div class="form-group">
        <div class="card">
          <div class="card-header">
            <p>Diplom </p>
          </div>
          <div class="card-body">
            <form id="form" action="index" method="post">
              <div class="form-group">
                <label>Xodimni tanlang</label>
                <select name="user_id" id="user_id"  required class="js-example-data-ajax  form-select">
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
                <label>Diplom seriyasi</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Diplom seriyasi kiriting"
                    name="seriya"
                    required
                />
                <div class="invalid-feedback">Diplom seriyasi kiriting</div>
              </div>
              <div class="form-group">
                <label>Diplom raqami</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Diplom raqami kiriting"
                    name="raqam"
                    required
                />
                <div class="invalid-feedback">Diplom raqami kiriting</div>
              </div>
              <div class="form-group">
                <label>Diplom turini tanlang</label>
                <select name="tur_id"  required class="form-select">
                  <?php 
                  $fetch=Functions::getall("diplomtype");
                  foreach ($fetch as $value) {
                    echo"<option value=\"".$value['id']."\">".$value['name']."</option>";
                  }
                   ?>
                </select>
                <div class="invalid-feedback">Diplom turini tanlang</div>
                
              </div>
              <div class="form-group">
                <label>Diplom berilgan sana</label>
                <input
                    class="form-control"
                    type="date"
                    placeholder="Diplom berilgan sanasini kiriting"
                    name="givedate"
                    required
                />
                <div class="invalid-feedback">Diplom berilgan sanasini kiriting</div>
              </div>
              <div class="form-group">
                <label>Diplom skaneri</label>
                <input
                    class="form-control"
                    type="file"
                    placeholder="Diplom skanerini kiriting"
                    name="file"
                    id="file"
                    required
                />
                <div class="invalid-feedback">Diplom skanerini kiriting</div>
              </div>
              <div class="form-group">
                <label>Diplom ilovasi</label>
                <input
                    class="form-control"
                    type="file"
                    placeholder="Diplom ilovasini kiriting"
                    name="ilova"
                    id="ilova"
                    required
                />
                <div class="invalid-feedback">Diplom ilovasini kiriting</div>
              </div>
              <div class="form-group">
                <label>Mutaxasislik nomi</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Mutaxasislik nomini kiriting"
                    name="mname"
                    required
                />
                <div class="invalid-feedback">Mutaxasislik nomini kiriting</div>
              </div><div class="form-group">
                <label>Berilgani</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Berilganini kiriting"
                    name="berilgan"
                    id="berilgan"
                    required
                />
                <div class="invalid-feedback">Berilganini kiriting</div>
              </div>
              <div class="form-group">
                <label>OTM</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="OTM ni kiriting"
                    name="otm"
                    id="otm"
                    required
                />
                <div class="invalid-feedback">OTM ni kiriting</div>
              </div>
              <div class="form-group">
                <label>Ta`lim turi</label>
                <select name="talimturi" id="talimturi"  required class="form-select">
                  <option value="Kunduzgi">Kunduzgi</option>
                  <option value="Kechki">Kechki</option>
                  <option value="Sirtqi">Sirtqi</option>
                </select>
                <div class="invalid-feedback">Ta`lim turini kiriting</div>
              </div>
              <div class="form-group">
                <label>Mutaxasislik shifri</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Mutaxasislik shifrini kiriting"
                    name="mshifr"
                    required
                />
                <div class="invalid-feedback">Mutaxasislik shifrini kiriting</div>
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
        url: "core/adddiplom.php",
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
              location.href = "diplom.php";
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
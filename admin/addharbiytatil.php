<?php 

include 'menu/head.php';
?>



<!--MAIN-CONTENT-OPEN-->
<main>
  <div class="container">
    <div class="page-header">
      <h2 class="page-header__title">Harbiy o’quv mashg’ulotga   yuborish </h2>
      <ul class="page-header__nav">
        <li>
          <i class="far fa-home-lg-alt"></i>
          <a href="index.html">Home</a>
        </li>
        <li>
          Harbiy o’quv mashg’ulotga   yuborish 
        </li>
      </ul>
    </div>
    <div class="page-content">
      <div class="form-group">
        <div class="card">
          <div class="card-header">
            <p>Harbiy o’quv mashg’ulotga   yuborish  </p>
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
                <label>Xodimni tanlang</label> 
                <select name="user_id"  id="user_id"  onchange="mehnat()" required class="form-select">
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

              <div class="form-group">
                <label>Bo`lim</label>
                <input 
                    class="form-control"
                    type="text"
                    placeholder="Bo`lim"
                    id="bulim1_id"
                    disabled
                />
                <input type="hidden" id="bulim_id" name="bulim_id">
                <div class="invalid-feedback">Bo`lim kiriting</div>
              </div>

              <div class="form-group">
                <label>Lavozim</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Lavozim"
                    id="lavozim1"
                    disabled
                />
                <input type="hidden" id="lavozim" name="lavozim">
                <div class="invalid-feedback">Lavozim kiriting</div>
              </div>

              <div class="form-group">
                <label>Fayli</label>
                <input
                    class="form-control"
                    type="file"
                    placeholder="Faylini kiriting"
                    name="harbiytatil"
                    id="file"
                    required
                />
                <div class="invalid-feedback">Faylini kiriting</div>
              </div>

              <div class="form-group">
                <label>Boshlanish sanasi</label>
                <input
                    class="form-control"
                    type="date"
                    placeholder="Boshlanish sanasini kiriting"
                    name="sanadan"
                    required
                />
                <div class="invalid-feedback">Boshlanish sanasini kiriting</div>
              </div>

              <div class="form-group">
                <label>Tugash sanasi</label>
                <input
                    class="form-control"
                    type="date"
                    placeholder="Tugash sanasini kiriting"
                    name="sanagacha"
                    required
                />
                <div class="invalid-feedback">Tugash sanasini kiriting</div>
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
        url: "core/add.php?table=<?=str_rot13("harbiytatil")?>&soni=<?=6*$keyuser?>",
        type: 'POST',
        processData: false,
        contentType: false,
        data: new FormData($("#form")[0]),
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
              location.href = "harbiytatil.php";
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
            document.getElementById('bulim_id').value = obj['bulim_id'];
            document.getElementById('lavozim').value = obj['lavozim'];
            document.getElementById('bulim1_id').value = obj['bulim_id'];
            document.getElementById('lavozim1').value = obj['lavozim'];
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
$('#braqam').select2({});

</script>
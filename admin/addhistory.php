<?php

include 'menu/head.php';
?>



<!--MAIN-CONTENT-OPEN-->
<main>
  <div class="container">
    <div class="page-header">
      <h2 class="page-header__title">Avvalgi ish joylarini kiritish</h2>
      <ul class="page-header__nav">
        <li>
          <i class="far fa-home-lg-alt"></i>
          <a href="index">Home</a>
        </li>
        <li>
          Avvalgi ish joylarini kiritish
        </li>
      </ul>
    </div>
    <div class="page-content">
      <div class="form-group">
        <div class="card">
          <div class="card-header">
            <p>Avvalgi ish joylarini kiritish </p>
          </div>
          <div class="card-body">
            <form id="form" action="index.php" method="post">

              <div class="form-group">
                <label>Xodimni tanlang</label>
                <select name="user_id"  id="user_id"  required class="js-example-data-ajax  form-select">
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
                <label>Ish joyi</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Ish joyi"
                    name="ishjoyi"
                    id="ishjoyi"

                />
                <div class="invalid-feedback">Ish joyi</div>
              </div>

              <div class="form-group">
                <label>Sanadan</label>
                <input
                    class="form-control"
                    type="date"
                    placeholder="Sanadanni kiriting"
                    name="sanadan"
                    id="sanadan"
                    required
                />
                <div class="invalid-feedback">Sanadanni kiriting</div>
              </div>

              <div class="form-group">
                <label>Sanagacha</label>
                <input
                    class="form-control"
                    type="date"
                    placeholder="Sanagachani kiriting"
                    name="sanagacha"
                    id="sanagacha"
                    required
                />
                <div class="invalid-feedback">Sanagachani kiriting</div>
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
        url: "core/add.php?table=<?=str_rot13("history")?>&soni=<?=4*$keyuser?>",
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

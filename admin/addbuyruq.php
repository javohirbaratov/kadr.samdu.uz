<?php

include 'menu/head.php';
?>



<!--MAIN-CONTENT-OPEN-->
<main>
  <div class="container">
    <div class="page-header">
      <h2 class="page-header__title">Yangi buyruq </h2>
      <ul class="page-header__nav">
        <li>
          <i class="far fa-home-lg-alt"></i>
          <a href="index.html">Home</a>
        </li>
        <li>
          Yangi buyruq
        </li>
      </ul>
    </div>
    <div class="page-content">
      <div class="form-group">
        <div class="card">
          <div class="card-header">
            <p>Yangi buyruq </p>
          </div>
          <div class="card-body">
            <form id="form" action="index.php" method="post">


              <div class="form-group">
                <label>Buyruq raqami</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Buyruq raqamini kiriting"
                    name="braqam"

                />
                <div class="invalid-feedback">Buyruq raqamini kiriting</div>
              </div>


              <div class="form-group">
                <label>Sana</label>
                <input
                    class="form-control"
                    type="date"
                    placeholder="Sanani kiriting"
                    name="sana"

                />
                <div class="invalid-feedback">Sanani kiriting</div>
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
        url: "core/add.php?table=<?=str_rot13("buyruq")?>&soni=<?=2*$keyuser?>",
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
              location.href = "print";
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

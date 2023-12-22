<?php 

include 'menu/head.php';
?>



<!--MAIN-CONTENT-OPEN-->
<main>
  <div class="container">
    <div class="page-header">
      <h2 class="page-header__title">Xodimlar malakasi </h2>
      <ul class="page-header__nav">
        <li>
          <i class="far fa-home-lg-alt"></i>
          <a href="index.html">Home</a>
        </li>
        <li>
          Xodimlar malakasi 
        </li>
      </ul>
    </div>
    <div class="page-content">
      <div class="form-group">
        <div class="card">
          <div class="card-header">
            <p>Xodimlar malakasi </p>
          </div>
          <div class="card-body">
            <form id="form" action="index.php" method="post">
              <div class="form-group">
                <label>Xodimni tanlang</label>
                <select name="user_id"  required class="form-select">
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
                <label>Malaka sertifikati</label>
                <input
                    class="form-control"
                    type="file"
                    placeholder="Malaka sertifikatini kiriting"
                    name="file"
                    required
                />
                <div class="invalid-feedback">Malaka sertifikatini kiriting</div>
              </div>
              

              <div class="form-group">
                <label>Malaka boshlanish sanasi</label>
                <input
                    class="form-control"
                    type="date"
                    placeholder="Malaka boshlanish sanasini kiriting"
                    name="begin"
                    required
                />
                <div class="invalid-feedback">Malaka boshlanish sanasini kiriting</div>
              </div>
              
              
              <div class="form-group">
                <label>Malaka muddati tugash sanasi</label>
                <input
                    class="form-control"
                    type="date"
                    placeholder="Malaka muddati tugash sanasini kiriting"
                    name="end"
                    required
                />
                <div class="invalid-feedback">Malaka muddati tugash sanasini kiriting</div>
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
        url: "core/addmalaka.php",
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
              location.href = "malaka.php";
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
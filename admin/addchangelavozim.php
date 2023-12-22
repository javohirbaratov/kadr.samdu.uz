<?php 

include 'menu/head.php';
?>



<!--MAIN-CONTENT-OPEN-->
<main>
  <div class="container">
    <div class="page-header">
      <h2 class="page-header__title">Shtat birligi va lavozimni o`zgartirish </h2>
      <ul class="page-header__nav">
        <li>
          <i class="far fa-home-lg-alt"></i>
          <a href="index">Home</a>
        </li>
        <li>
          Shtat birligi va lavozimni o`zgartirish 
        </li>
      </ul>
    </div>
    <div class="page-content">
      <div class="form-group">
        <div class="card">
          <div class="card-header">
            <p>Shtat birligi va lavozimni o`zgartirish  </p>
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
                <select name="user_id"  id="user_id"  onchange="mehnat()" required class="js-example-data-ajax form-select">
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
                <label>Kadr bulimdan</label>
                <input 
                    class="form-control"
                    type="text"
                    placeholder="Mavjud emas"
                    id="kadr_bulim1"
                    disabled
                />
                <input type="hidden" id="kadr_bulimdan" name="bulimdan">
                <div class="invalid-feedback">Kadr bulim kiriting</div>
              </div>

              <div class="form-group">
                <label>Bo`limdan</label>
                <input 
                    class="form-control"
                    type="text"
                    placeholder="Mavjud emas"
                    id="bulimdan1"
                    disabled
                />
                <input type="hidden" id="bulimdan" name="bulimdan">
                <div class="invalid-feedback">Bo`lim kiriting</div>
              </div>

              <div class="form-group">
                <label>Kafedradan</label>
                <input 
                    class="form-control"
                    type="text"
                    placeholder="Mavjud emas"
                    id="kafedradan1"
                    disabled
                />
                <input type="hidden" id="kafedradan" name="kafedradan">
                <div class="invalid-feedback">Kafedra </div>
              </div>

              <div class="form-group">
                <label>Lavozimdan</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Mavjud emas"
                    id="lavozimdan1"
                    disabled
                />
                <input type="hidden" id="lavozimdan" name="lavozimdan">
                <div class="invalid-feedback">Lavozimdan kiriting</div>
              </div>

              <div class="form-group">
                <label>Shtatdan</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Shtatdan"
                    id="shtatdan1"
                    disabled
                />
                <input type="hidden" id="shtatdan" name="shtatdan">
                <div class="invalid-feedback">Shtatdan kiriting</div>
              </div>

              <div class="form-group">
                <label>Fayli</label>
                <input
                    class="form-control"
                    type="file"
                    placeholder="Faylini kiriting"
                    name="changelavozim"
                    id="file"
                    
                />
                <div class="invalid-feedback">Faylini kiriting</div>
              </div>

              <div class="form-group">
                <label>Sana</label>
                <input
                    class="form-control"
                    type="date"
                    placeholder="Sanasini kiriting"
                    name="sana"
                    required
                />
                <div class="invalid-feedback">Sanasini kiriting</div>
              </div>


              <div class="form-group">
                <label>Kadrlar bo'limini tanlang</label>
                <select name="kadr_bulim_id" id="kadr_bulim_id" onchange="bulim()"  required class="form-select">
                  <?php  
                  $fetch=Functions::getall("kadrlarbulimi");
                  foreach ($fetch as $value) {
                    echo"<option value=\"".$value['id']."\">".$value['name']."</option>";
                  }
                   ?>
                </select>
                <div class="invalid-feedback">Kadrlar bo'limini tanlang</div>
                
              </div>

              <div class="form-group" id = "bulim1">

              </div>

              <div class="form-group" id = "kafedra1">
                <label id = "kaf2" style="display:none">Kafedrani tanlang</label>
                <select style="display:none" onchange="funlav()"   name="kafedra_id" id="kafedra_id"  required class="form-select">  
                  <option value="0">Tanlang</option>  
                </select>
              </div>

              <div class="form-group" id="lavozim1">
              </div>



              <div class="form-group">
                <label>Shtat</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="shtat"
                    id="shtat"
                    name="shtat"
                    required
                />
                <div class="invalid-feedback">Shtatdan kiriting</div>
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
        url: "core/add.php?table=<?=str_rot13("changelavozim")?>&soni=<?=10*$keyuser?>",
        type: 'POST',
        processData: false,
        contentType: false,
        data: new FormData($("#form")[0]),
            success: function (data) {
                  var obj = jQuery.parseJSON(data);
                if (obj.xatolik==0) {
                  toast.create({
                    title: "Muvaffaqiyatli.",
                    text: "Ma'lumot kiritildi!",
                    type: "success",
                    icon: "assets/img/icon/success.svg",
                  });

                  setTimeout(() => {
                    location.href = "changelavozim.php";
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
            document.getElementById('bulimdan').value = obj['bulim_id'];
            document.getElementById('kadr_bulimdan').value = obj['kadr_id'];
            document.getElementById('lavozimdan').value = obj['lavozim'];
            document.getElementById('shtatdan').value = obj['shtat'];
            document.getElementById('kafedradan').value = obj['kafname'];
            document.getElementById('bulimdan1').value = obj['bulim_id'];
            document.getElementById('kadr_bulim1').value = obj['kadr_id'];
            document.getElementById('kafedradan1').value = obj['kafname'];
            document.getElementById('lavozimdan1').value = obj['lavozim'];
            document.getElementById('shtatdan1').value = obj['shtat'];
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


function bulim(){
        var bulim_id = document.getElementById('kadr_bulim_id').value;
        document.getElementById('bulim1').innerHTML = '';
        document.getElementById('kaf2').style.display = 'none';
        document.getElementById('kafedra_id').style.display = 'none';
        document.getElementById('kafedra_id').value = '0';

        document.getElementById('lavozim1').innerHTML = '';
        $.ajax({
        url: "core/bulim.php",
        type: 'POST',
        data: {
          bulim_id:bulim_id,
        },
        success: function (data) {

            document.getElementById('bulim1').innerHTML=data;
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

function funkaf(){
        var bulim_id = document.getElementById('bulim_id').value;
        
        $.ajax({
        url: "core/kafedra.php",
        type: 'POST',
        data: {
          bulim_id:bulim_id,
        },
        success: function (data) {
            document.getElementById('kafedra1').innerHTML=data;
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
        var bulim_id = document.getElementById('bulim_id').value;
        
        $.ajax({
        url: "core/lavozim.php",
        type: 'POST',
        data: {
          bulim_id:bulim_id,
        },
        success: function (data) {
            document.getElementById('lavozim1').innerHTML=data;
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
  $('#user_id').select2({});
  $('#braqam').select2({});
</script>
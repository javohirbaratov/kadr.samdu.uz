  <?php
  include_once'menu/head.php';

   ?>



  <!--MAIN-CONTENT-OPEN-->
  <main>
    <div class="container">
      <div class="page-header">
        <h2 class="page-header__title">Buyruqlar </h2>
        <ul class="page-header__nav">
          <li>
            <i class="far fa-home-lg-alt"></i>
            <a href="index">Home</a>
          </li>
          <li>
            Buyruqlar
          </li>
        </ul>
      </div>
      <div class="page-content">
        <div class="form-group">
          <div class="card">
            <div class="card-header">
              <p>Buyruqlar </p>
            </div>
            <div class="card-body">
              <form id="form"  method="post">


                <div class="form-group">
                  <label>Buyruqni tanlang</label>
                  <select name="braqam"  id="braqam" onchange="generate()"  class=" js-example-data-ajax form-group">
                     <option value="Tanlang">Tanlang</option>
                    <?php
                      $fetch = Functions::getall("buyruq");
                       foreach ($fetch as $value) {
                      echo"<option value=\"".$value['braqam']."\">".$value['braqam']." (".$value['sana'].")</option>";
                    }
                     ?>
                  </select>
                  <div class="invalid-feedback">Buyruqni tanlang</div>
                </div>
                   <button
                    class="btn btn-primary w-100"
                    id="ok1"
                    name="ok1"
                >
                  Shakllantirish
                  <div class="lds-dual-ring btn-load"></div>
                </button>
                </div>
              </form>
            </div>
          </div>
        </div>
    <table id="MyTable" class="display">
          <thead>
              <tr>
                <th>ID</th>
                <th>Buyruq raqami</th>
                <th>Sana</th>
                <th>Funksiyalar</th>
              </tr>
          </thead>
          <tbody id="tbl">
            <?php
              $fetch = Functions::getall("buyruq");
              $no=0;

              foreach($fetch as $value){
                $indexs = md5(sha1($value['id']));
                echo ('

                  <tr>

                    <td class="sha1'.$indexs.'">'.$value['id'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['braqam'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['sana'].'</td>
                    <td>

                      <b  class="deletef status open_button status-unpaid" data="'.$value['id'].'">
                      <i class="fal fa-trash-alt"></i></b>
                      <br><br>


                    </td>
                  </tr>
                  ');
              }
?>
          </tbody>
        </table>
      </div>
    </div>


  <!-- Delete modal -->
<div id="modal1" class="modal_info">
  <h1>Chindan xam o`chirmoqchimisiz?</h1>
  <b class="bekorqil status status-paid">Bekor qilish</b>
  <b id="delete" class=" status status-unpaid">O`chirish</b>
</div>
<div id="modal11" class="modal_overlay">
</div>
  <!-- Delete modal -->

  </main>
  <!--MAIN-CONTENT-CLOSE-->



  <div class="source-html-outer" style="display:none">
      <div id="source-html" >


      </div>
  </div>
      <script>

function generate() {
  let buyruq = document.getElementById("braqam").value;
        loadingStart();
        $.ajax({
          url: "core/getbuy.php",
          method: "post",
          data:{
          buyruq_id:buyruq
          },
          success: function (data) {

             document.getElementById('source-html').innerHTML = data;



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

}

  function delinfo(id) {
    $('.modal, #modal11').removeClass('display');
        $('.deletef').removeClass('load');
        modal.close();
    $.ajax({
      url:"core/delete/delete.php",
      method:"get",
      data:{
        id:id,
        table:'buyruq',
        _csrf:'<?=$_SESSION['_csrf']?>',
      },
      success:function (data) {

        var obj = jQuery.parseJSON(data);
        if (obj.xatolik==0) {
          toast.create({
              title: "Muvaffaqiyatli.",
              text: "Ma'lumot o`chirildi!",
              type: "success",
              icon: "assets/img/icon/success.svg",
            });
            setTimeout(() => {
              location.reload();
            }, 1500);
        }
        else{
          toast.create({
              title: "Xatolik.",
              text: "Ma'lumot negadur o`chirilmadi!",
              type: "error",
              icon: "assets/img/icon/error.svg",
            });
        }
      },
      error:function () {
          toast.create({
            title: "Xatolik.",
            text: "Ulanishda xatolik!",
            type: "error",
            icon: "assets/img/icon/error.svg",
          });
        },
    });
  }

  let submitBtn = document.getElementById('ok1');
      submitBtn.addEventListener("click", function submit(e) {
        e.preventDefault();

      function exportHTML(){
         var header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' "+
              "xmlns:w='urn:schemas-microsoft-com:office:word' "+
              "xmlns='http://www.w3.org/TR/REC-html40'>"+
              "<head><meta charset='utf-8'><title>Export HTML to Word Document with JavaScript</title></head><body>";
         var footer = "</body></html>";
         var sourceHTML = header+document.getElementById("source-html").innerHTML+footer;

         var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
         var fileDownload = document.createElement("a");
         document.body.appendChild(fileDownload);
         fileDownload.href = source;
         fileDownload.download = 'document.doc';
         fileDownload.click();
         document.body.removeChild(fileDownload);
         }
         exportHTML();
        });

  </script>
  </body>
  </html>

  <?php
  include_once'menu/footer.php';
   ?>

<script>

    $('#braqam').select2({});
</script>

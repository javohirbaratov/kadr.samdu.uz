<?php
include_once'menu/head.php';
 ?>

<!--MAIN-CONTENT-OPEN-->
<main>
  <div class="container">
    <div class="page-header">
      <h2 class="page-header__title">Qarindoshlar</h2>
      <ul class="page-header__nav">
        <li>
          <i class="far fa-home-lg-alt"></i>
          <a href="index">Home</a>
        </li>
        <li>
          Qarindoshlar
        </li>
      </ul>
    </div>
    <div class="page-content">
        <table id="MyTable" class="display">
          <thead>
              <tr>
                <th>ID</th>
                <th>Xodim</th>
                <th>Qarindoshligi</th>
                <th>FIO</th>
                <th>Tug`ilgan Sana</th>
                <th>manzil</th>
                <th>Mashg`uloti</th>
                <th>Funksiyalar</th>
              </tr>
          </thead>
          <tbody id="tbl">
            <?php
              $fetch = Functions::getall("qarindoshlar");
              $no=0;
              foreach($fetch as $value){
                $no++;
                $indexs = md5(sha1($value['id']));
                $kadrb = Functions::getbyid("xodimlar",$value['user_id']);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $teacher = $kbulimi['familya']." ".$kbulimi['ism']." ".$kbulimi['otch'];

                echo ('

                  <tr>

                    <td class="sha1'.$indexs.'">'.$value['id'].'</td>
                    <td class="sha1'.$indexs.'" id="'.$value['user_id'].'">'.$teacher.'</td>
                    <td class="sha1'.$indexs.'">'.$value['qarindoshligi'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['fio'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['tsana'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['manzil'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['mashguloti'].'</td>
                    <td>
                      <b class="taxrirf status status-paid" data="'.$indexs.'"><i class="fal fa-pen">
                      </i></b>

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

  <!-- EDIT modal -->
<div id="modal2" class="modal_info">
  <h1>Taxrirlash</h1>
              <form id="form">

              <div class="form-group">
                <label>Xodimni tanlang</label>
                <select name="user_id"  id="user_id"  required class="js-example-data-ajax form-select">
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

              <div class="form-group" id = "kafedra1">
                <label  >Qarindoshligini tanlang</label>
                <select   name="qarindoshligi" id="qarindoshligi"  required class="form-select">
                  <option value="0">Tanlang</option>
                  <option value="Otasi">Otasi</option>
                  <option value="Onasi">Onasi</option>
                  <option value="Turmush">Turmush o'rtog'i</option>
                  <option value="Opasi">Opasi</option>
                  <option value="Singlisi">Singlisi</option>
                  <option value="Akasi">Akasi</option>
                  <option value="Ukasi">Ukasi</option>
                  <option value="O`g`li">O`g`li</option>
                  <option value="Qizi">Qizi</option>
                  <option value="Qayni otasi">Qayni otasi</option>
                  <option value="Qayni onasi">Qayni onasi</option>
                </select>
              </div>

              <div class="form-group">
                <label>To`liq ism</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="To`liq ism"
                    id="fio"
                    name="fio"
                />
                <div class="invalid-feedback">Ismni kiriting</div>
              </div>

              <div class="form-group">
                <label>Manzil</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Kiritish"
                    id="manzil"
                    name="manzil"
                />
                <div class="invalid-feedback">Manzil kiriting</div>
              </div>

              <div class="form-group">
                <label>Tug`ilgan joyi</label>
                <input
                    class="form-control"
                    type="taxt"
                    placeholder="Kiritish"
                    id="tsana"
                    name="tsana"
                />
                <div class="invalid-feedback">Tug`ilgan joyi kiriting</div>
              </div>

              <div class="form-group">
                <label>Mashg`uloti</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="KiritMashg`uloti"
                    id="mashguloti"
                    name="mashguloti"

                />
                <div class="invalid-feedback">Mashg`ulotini kiriting </div>
              </div>


              <div class="form-group">
      <input type="hidden" name="_csrf" value="<?=$_SESSION['_csrf']?>" id="_csrf">
      <input type="hidden" name="id"  id="id">

              </div>
</form>
  <b id="taxrir" class=" status status-paid">Taxrirlash</b >
  <b  class="bekorqil status status-unpaid">Bekor qilish</b>
</div>
<div id="modal22" class="modal_overlay">
</div>
  <!-- EDIT modal -->


</main>
<!--MAIN-CONTENT-CLOSE-->


<script type="text/javascript">

function modalinfos(event) {
  infoid = event.attributes[1].nodeValue;
  infoid=".sha1"+infoid;
  var infos = new Array();
    var arr = $(infoid);
    for(var i=0; i< arr.length; i++){
        infos.push(arr[i].innerHTML);
    }
    document.getElementById('id').value=infos[0];
    document.getElementById('user_id').value=arr[1].id;
    document.getElementById('qarindoshligi').value=infos[2];
    document.getElementById('fio').value=infos[3];
    document.getElementById('tsana').value=infos[4];
    document.getElementById('manzil').value=infos[5];
    document.getElementById('mashguloti').value=infos[6];
    document.getElementById('taxrir').setAttribute("onclick",'taxririnfo('+ infos[0] +')');
}


  function taxririnfo(id) {
    $.ajax({
      url:"core/edit/edit.php?table=<?=str_rot13("qarindoshlar")?>",
        type: 'POST',
        processData: false,
        contentType: false,
        data:   new FormData($("#form")[0]),
      success:function (data) {
        console.log(data);
        var obj = jQuery.parseJSON(data);
        if (obj.xatolik==0) {
          toast.create({
              title: "Muvaffaqiyatli.",
              text: "Ma'lumot tahrirlandi!",
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
              text: "Ma'lumot negadur tahrirlanmadi!",
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
    $('.modal, #modal22').removeClass('display');
        $('.taxrirf').removeClass('load');
        modal2.close();
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
        table:'qarindoshlar',
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

</script>
<?php
include_once'menu/footer.php';
 ?>
<script type="text/javascript">



</script>

<?php 
include_once'menu/head.php';
 ?>

<!--MAIN-CONTENT-OPEN-->
<main>
  <div class="container">
    <div class="page-header">
      <h2 class="page-header__title">Admin </h2>
      <ul class="page-header__nav">
        <li>
          <i class="far fa-home-lg-alt"></i>
          <a href="index">Home</a>
        </li>
        <li>
          Admin 
        </li>
      </ul>
    </div>
    <div class="page-content">
        <table id="MyTable" class="display">
          <thead>
              <tr>
                <th>ID</th>
                <th>O`qituvchi</th>
                <th>Kadrlar bulim</th>
                <th>Lavozim</th>
                <th>Asosiy</th>
                <th>Ichki</th>
                <th>Tashqi</th>
                <th>Soatbay</th>
                <th>Sana</th>
                <th>Buyruq sana</th>
                <th>Buyruq raqami</th>
                <th>Kontrakt raqami</th>
                <th>Funksiyalar</th>
              </tr>
          </thead>
          <tbody id="tbl">
            <?php 
              $fetch = Functions::getall("shtat");
              $no=0;
              foreach($fetch as $value){
                $no++;
                $indexs = md5(sha1($value['id']));
                $kadrb = Functions::getbyid("xodimlar",$value['teacher_id']);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $teacher = $kbulimi['familya']." ".$kbulimi['ism']." ".$kbulimi['otch'];
                $kadrb = Functions::getbyid("kadrlarbulimi",$value['kadr_bulim_id']);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $kadrbul = $kbulimi['name'];
                $kadrb = Functions::getbyid("lavozimlar",$value['lavozim_id']);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $lavozim = $kbulimi['lavozim'];
                echo ('

                  <tr>
                    <td class="sha1'.$indexs.'">'.$value['id'].'</td>
                    <td class="sha1'.$indexs.'" id="'.$value['teacher_id'].'">'.$teacher.'</td>
                    <td class="sha1'.$indexs.'" id="'.$value['kadr_bulim_id'].'">'.$kadrbul.'</td>
                    <td class="sha1'.$indexs.'" id="'.$value['lavozim_id'].'">'.$lavozim.'</td>
                    <td class="sha1'.$indexs.'">'.$value['asosiy'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['ichki'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['tashqi'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['soatbay'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['sana'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['buyruqsana'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['buyruqraqam'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['kontraktnomer'].'</td>
                    <td>
                      <b class="taxrirf status status-paid" data="'.$indexs.'"><i class="fal fa-pen">
                      </i></b>

                      <b  class="deletef status open_button status-unpaid" data="'.$value['id'].'">
                      <i class="fal fa-trash-alt"></i></b>
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
                  <select name="teacher_id" id="teacher_id"  required class="form-select" class="selectpicker" data-live-search="true" >
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
                <select name="kadr_bulim_id" id="kadr_bulim_id"  required class="form-select">
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
                <select  name="lavozim_id"  id="lavozim_id"  required class="form-select">
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
                    id="asosiy"
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
                    id="ichki"
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
                    id="tashqi"
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
                    id="soatbay"
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
                    id="sana"
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
                    id="buyruqsana"
                    required
                />
                <div class="invalid-feedback">Buyruq sanasini kiriting</div>
              </div>
              <div class="form-group">
                <label>Buyruq raqami</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Buyruq raqamini kiriting"
                    name="buyruqraqam"
                    id="buyruqraqam"
                    required
                />
                <div class="invalid-feedback">Buyruq raqamini kiriting</div>
              </div>
              <div class="form-group">
                <label>Kontrakt raqami</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Kontrakt raqamini kiriting"
                    name="kontraktnomer"
                    id="kontraktnomer"
                    required
                />
                <div class="invalid-feedback">Kontrakt raqamini kiriting</div>
              </div>
              <input type="hidden" name="_csrf" value="<?=$_SESSION['_csrf']?>" id="_csrf">
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
    document.getElementById('teacher_id').value=arr[1].id;
    document.getElementById('kadr_bulim_id').value=arr[2].id;
    document.getElementById('lavozim_id').value=arr[3].id;
    document.getElementById('asosiy').value=infos[4];
    document.getElementById('ichki').value=infos[5];
    document.getElementById('tashqi').value=infos[6];
    document.getElementById('soatbay').value=infos[7];
    document.getElementById('sana').value=infos[8];
    document.getElementById('buyruqsana').value=infos[9];
    document.getElementById('buyruqraqam').value=infos[10];
    document.getElementById('kontraktnomer').value=infos[11];
    document.getElementById('taxrir').setAttribute("onclick",'taxririnfo('+ infos[0] +')');
}


  function taxririnfo(id) {
  console.log($('#form').serialize());
    $.ajax({
      url:"core/edit/editshtat.php",
      method:"get",
      data:$('#form').serialize(),
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
      url:"core/delete/deleteshtat.php",
      method:"get",
      data:{
        id:id,
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

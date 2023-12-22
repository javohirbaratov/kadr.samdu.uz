<?php
include_once'menu/head.php';
 ?>

<!--MAIN-CONTENT-OPEN-->
<main>
  <div class="container">
    <div class="page-header">
      <h2 class="page-header__title">Lavozim </h2>
      <ul class="page-header__nav">
        <li>
          <i class="far fa-home-lg-alt"></i>
          <a href="index">Home</a>
        </li>
        <li>
          Lavozim
        </li>
      </ul>
    </div>
    <div class="page-content">
        <table id="MyTable" class="display">
          <thead>
              <tr>
                <th>ID</th>
                <th>Kadr bo`limi</th>
                <th>Bo`lim, Fakultet, Bino, Grant</th>
                <th>Kafedra, Bo`linmalar</th>
                <th>Lavozim</th>
                <th>Ish hajmi</th>
                <th>Funksiyalar</th>
              </tr>
          </thead>
          <tbody id="tbl">
            <?php
              $fetch = Functions::getall("lavozimlar");
              $no=0;
                foreach($fetch as $value){
                  $no++;
                  $indexs = md5(sha1($value['id']));
                  $kadrb = Functions::getbyid("bulimlar",$value['bulim_id']);
                  $kbulimi = mysqli_fetch_assoc($kadrb);
                  $ka = $kbulimi['name'];
                  $kadrb = Functions::getbyid("kafedra",$value['kafedra_id']);
                  $kbulimi = mysqli_fetch_assoc($kadrb);
                  $kaf = $kbulimi['name'];
                  $kadrb = Functions::getbyid("kadrlarbulimi",$value['kadr_bulim_id']);
                  $kbulimi = mysqli_fetch_assoc($kadrb);
                  $kadr = $kbulimi['name'];
                  echo ('
  
                    <tr>
  
                      <td class="sha1'.$indexs.'">'.$value['id'].'</td>
                      <td class="sha1'.$indexs.'" id="'.$value['kadr_bulim_id'].'">'.$kadr.'</td>
                      <td class="sha1'.$indexs.'" id="'.$value['bulim_id'].'">'.$ka.'</td>
                      <td class="sha1'.$indexs.'" id="'.$value['kafedra_id'].'">'.$kaf.'</td>
                      <td class="sha1'.$indexs.'">'.$value['lavozim'].'</td>
                      <td class="sha1'.$indexs.'">'.$value['soni'].'</td>
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
                <label>Nomi</label>
                <input id="name"
                    class="form-control"
                    type="text"
                    placeholder="Bo`lim nomi kiriting"
                    name="name"
                    required
                />
                <div class="invalid-feedback">Lavozim nomi kiriting</div>
              </div>
              <div class="form-group">
                <label>Bo`limini tanlang</label>
                <select name="bulim_id" id="bulim_id"  required class="form-select">
                  <?php
                  $fetch=Functions::getall("bulimlar");
                  foreach ($fetch as  $value) {
                    echo"<option value=\"".$value['id']."\">".$value['name']."</option>";
                  }
                   ?>
                </select>
                <div class="invalid-feedback">Bo`limini tanlang</div>
              </div>
              <div class="form-group">
                <input type="hidden" name="idx" id="idx">
                <input type="hidden" name="_csrf" value="<?=$_SESSION['_csrf']?>" id="_csrf">

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
    document.getElementById('idx').value=infos[0];
    document.getElementById('name').value=infos[1];
    document.getElementById('bulim_id').value=arr[2].id;
    document.getElementById('taxrir').setAttribute("onclick",'taxririnfo('+ infos[0] +')');
}


  function taxririnfo(id) {
  console.log($('#form').serialize());
    $.ajax({
      url:"core/edit/editlavozim.php",
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
      url:"core/delete/deletelavozim.php",
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

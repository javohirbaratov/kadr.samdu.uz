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
                <th>Xodim</th>
                <th>Diplom Turi</th>
                <th>Seriya</th>
                <th>Raqami</th>
                <th>Berilgan</th>
                <th>OTM</th>
                <th>Ta`lim turi</th>
                <th>Berilgan vaqti</th>
                <th>Mutaxasislik nomi</th>
                <th>Mutaxasislik shifri</th>
                <th>Diplom</th>
                <th>Ilova</th>
                <th>Funksiyalar</th>
              </tr>
          </thead>
          <tbody id="tbl">
            <?php 
              $fetch = Functions::getall("diplomlar");
              $no=0;
              foreach($fetch as $value){
                $no++;
                $indexs = md5(sha1($value['id']));
                $kadrb = Functions::getbyid("xodimlar",$value['user_id']);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $teacher = $kbulimi['familya']." ".$kbulimi['ism']." ".$kbulimi['otch'];
                $kadrb = Functions::getbyid("diplomtype",$value['tur_id']);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $kadrbul = $kbulimi['name'];
                if(strlen($value['ilova'])>1){
                  $ilova='<a target="_blank" href="../docs/ilova/'.$value['ilova'].'">Yuklash</a>';
                }else{
                  $ilova='<b style="color:red"> Mavjud emas</b>';
                }
                if(strlen($value['fayl'])>1){
                  $fayl='<a target="_blank" href="../docs/diplom/'.$value['fayl'].'">Yuklash</a>';
                }else{
                  $fayl='<b style="color:red"> Mavjud emas</b>';
                }
                echo ('

                  <tr>
                    
                    <td class="sha1'.$indexs.'">'.$value['id'].'</td>
                    <td class="sha1'.$indexs.'" id="'.$value['user_id'].'">'.$teacher.'</td>
                    <td class="sha1'.$indexs.'" id="'.$value['tur_id'].'">'.$kadrbul.'</td>
                    <td class="sha1'.$indexs.'">'.$value['seriya'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['raqam'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['berilgan'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['otm'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['talimturi'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['givedate'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['mname'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['mshifr'].'</td>
                    <td class="sha1'.$indexs.'">'.$fayl.'</td>
                    <td class="sha1'.$indexs.'">'.$ilova.'</td>
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
                <select name="user_id" id="user_id"  required class="form-select">
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
                    id="seriya"
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
                    id="raqam"
                    required
                />
                <div class="invalid-feedback">Diplom raqami kiriting</div>
              </div>
              <div class="form-group">
                <label>Diplom turini tanlang</label>
                <select name="tur_id" id="tur_id"  required class="form-select">
                  <?php 
                  $fetch=Functions::getall("diplomtype");
                  foreach ($fetch as $value) {
                    echo"<option value=\"".$value['id']."\">".$value['name']."</option>";
                  }
                   ?>
                </select>
                <div class="invalid-feedback">Diplom turini tanlang</div>
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
              </div>
              <div class="form-group">
                <label>Diplom berilgan sana</label>
                <input
                    class="form-control"
                    type="date"
                    placeholder="Diplom berilgan sanasini kiriting"
                    name="givedate"
                    id="givedate"
                    required
                />
                <div class="invalid-feedback">Diplom berilgan sanasini kiriting</div>
              </div>
              <div class="form-group">
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
                <label>Mutaxasislik nomi</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Mutaxasislik nomini kiriting"
                    name="mname"
                    id="mname"
                    required
                />
                <div class="invalid-feedback">Mutaxasislik nomini kiriting</div>
              </div>
              
              <div class="form-group">
                <label>Mutaxasislik shifri</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Mutaxasislik shifrini kiriting"
                    name="mshifr"
                    id="mshifr"
                    required
                />
                <div class="invalid-feedback">Mutaxasislik shifrini kiriting</div>
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
    document.getElementById('tur_id').value=arr[2].id;
    document.getElementById('seriya').value=infos[3];
    document.getElementById('raqam').value=infos[4];
    document.getElementById('berilgan').value=infos[5];
    document.getElementById('otm').value=infos[6];
    document.getElementById('talimturi').value=infos[7];
    document.getElementById('givedate').value=infos[8];
    document.getElementById('mname').value=infos[9];
    document.getElementById('mshifr').value=infos[10];
    document.getElementById('taxrir').setAttribute("onclick",'taxririnfo('+ infos[0] +')');
}


  function taxririnfo(id) {
    $.ajax({
      url:"core/edit/editdiplom.php",
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
      url:"core/delete/deletediplom.php",
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

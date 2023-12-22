<?php 
include_once'menu/head.php';
 ?>

<!--MAIN-CONTENT-OPEN-->
<main>
  <div class="container">
    <div class="page-header">
      <h2 class="page-header__title">Bola Parvarishi uchun ta`til </h2>
      <ul class="page-header__nav">
        <li>
          <i class="far fa-home-lg-alt"></i>
          <a href="index">Home</a>
        </li>
        <li>
          Bola Parvarishi uchun ta`til 
        </li>
      </ul>
    </div>
    <div class="page-content">
        <table id="MyTable" class="display">
          <thead>
              <tr>
                <th>ID</th>
                <th>Buyruq raqami</th>
                <th>Xodim</th>
                <th>Bo'lim</th>
                <th>Lavozim</th>
                <th>Sanadan</th>
                <th>Sanagacha</th>
                <th>Necha yoshgacha</th>
                <th>Hujjat raqami</th>
                <th>Fayl</th>
                <th>Funksiyalar</th>
              </tr>
          </thead>
          <tbody id="tbl">
            <?php 
              $fetch = Functions::getall("bolaparvarishi");
              $no=0;
              foreach($fetch as $value){
                $no++;
                $indexs = md5(sha1($value['id']));
                $kadrb = Functions::getbyid("xodimlar",$value['user_id']);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $teacher = $kbulimi['familya']." ".$kbulimi['ism']." ".$kbulimi['otch'];

                if(strlen($value['file'])>1){
                  $file='<a target="_blank" href="../docs/bolaparvarishi/'.$value['file'].'">Yuklash</a>';
                }else{
                  $file='<b style="color:red"> Mavjud emas</b>';
                }
                echo ('

                  <tr>
                    
                    <td class="sha1'.$indexs.'">'.$value['id'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['braqam'].'</td>
                    <td class="sha1'.$indexs.'" id="'.$value['user_id'].'">'.$teacher.'</td>
                    <td class="sha1'.$indexs.'">'.$value['bulim_id'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['lavozim'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['sanadan'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['sanagacha'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['yosh'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['hujjat'].'</td>
                    <td class="sha1'.$indexs.'">'.$file.'</td>
                    <td>
                      <b class="taxrirf status status-paid" data="'.$indexs.'"><i class="fal fa-pen">
                      </i></b>

                      <b  class="deletef status open_button status-unpaid" data="'.$value['id'].'">
                      <i class="fal fa-trash-alt"></i></b>
                      <br><br>

                      <b  class="status status-pending" onclick="words(\''.$indexs.'\')">
                      <i class="fal fa-file-word"></i></b>

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
                <label>Buyruq raqami</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Buyruq raqami"
                    id="braqam"
                    name="braqam"
                    required
                />
                <div class="invalid-feedback">Buyruq raqami kiriting</div>
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
                    name="file"
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
                    id="sanadan"
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
                    id="sanagacha"
                    required
                />
                <div class="invalid-feedback">Tugash sanasini kiriting</div>
              </div>

              <div class="form-group">
                <label>Necha yoshgacha</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Necha yoshgacha"
                    id="yosh"
                    name="yosh"
                    required
                />
                <div class="invalid-feedback">Necha yoshgacha kiriting</div>
              </div>

              <div class="form-group">
                <label>Hujjat raqami</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Hujjat raqami"
                    id="hujjat"
                    name="hujjat"
                    required
                />
                <div class="invalid-feedback">Hujjat raqami kiriting</div>
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
    document.getElementById('braqam').value=infos[1];
    document.getElementById('user_id').value=arr[2].id;
    document.getElementById('bulim_id').value=infos[3];
    document.getElementById('lavozim').value=infos[4];
    document.getElementById('bulim1_id').value=infos[3];
    document.getElementById('lavozim1').value=infos[4];
    document.getElementById('sanadan').value=infos[5];
    document.getElementById('sanagacha').value=infos[6];
    document.getElementById('yosh').value=infos[7];
    document.getElementById('hujjat').value=infos[8];
    document.getElementById('taxrir').setAttribute("onclick",'taxririnfo('+ infos[0] +')');
}


  function taxririnfo(id) {
    $.ajax({
      url:"core/edit/editbolaparvarishi",
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
      url:"core/delete/deletebolaparvarishi.php",
      method:"get",
      data:{
        id:id,
        _csrf:'<?=$_SESSION['_csrf']?>',
      },
      success:function (data) {
console.log(data);
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

function mehnat() {
  let user = document.getElementById("user_id").value;
  $.ajax({
    url: "core/mehnattatili",
        type: 'get',
        data:{
        user_id:user
        },
        success: function (data) {
          let obj = jQuery.parseJSON(data);
          if (obj.hasOwnProperty('bulim_id')) {
            document.getElementById('bulim_id').value = obj['bulim_id'];
            document.getElementById('bulim1_id').value = obj['bulim_id'];
            document.getElementById('lavozim').value = obj['lavozim'];
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
            document.getElementById('lavozim1').value = "Xodimni avval ishga qabul qiling";
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
include_once'menu/footer.php';
 ?>
<script type="text/javascript">
  

        function loadFile(url, callback) {
            PizZipUtils.getBinaryContent(url, callback);
        }
function words(hash) {

  infoid=".sha1"+hash;
  var infos = new Array();
    var arr = $(infoid);
    for(var i=0; i< arr.length; i++){
        infos.push(arr[i].innerHTML);
    }
 
            loadFile(
                "../docs/shablon/bolaparvarishi.docx",
                function (error, content) {
                    if (error) {
                        throw error;
                    }

                    var zip = new PizZip(content);
                    var doc = new window.docxtemplater(zip, {
                        paragraphLoop: true,
                        linebreaks: true,
                    });
                    doc.render({
                      braqam : infos[1],
                      name : infos[2],
                      bulim : infos[3],
                      lavozim : infos[4],
                      sanadan : infos[5],
                      sanagacha : infos[6],
                      yosh : infos[7],
                      hujjat : infos[8],
                    });
                    var out = doc.getZip().generate({
                        type: "blob",
                        mimeType:
                            "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
                    });
                    // Output the document using Data-URI
                    saveAs(out, infos[1]+".docx");
                }
            );
        


}

</script>
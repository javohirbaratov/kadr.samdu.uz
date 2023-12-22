<?php 
include_once'menu/head.php';
 ?>

<!--MAIN-CONTENT-OPEN-->
<main>
  <div class="container">
    <div class="page-header">
      <h2 class="page-header__title">Mehnat ta`tilidan chaqirib olish</h2>
      <ul class="page-header__nav">
        <li>
          <i class="far fa-home-lg-alt"></i>
          <a href="index">Home</a>
        </li>
        <li>
          Mehnat ta`tilidan chaqirib olish
        </li>
      </ul>
    </div>
    <div class="page-content">
        <table id="MyTable" class="display">
          <thead>
              <tr>
                <th>ID</th>
                <th>Buyruq</th>
                <th>Xodim</th>
                <th>Bo'lim</th>
                <th>Lavozim</th>
                <th>Summa</th>
                <th>Asos</th>
                <th>Fayl</th>
                <th>Funksiyalar</th>
              </tr>
          </thead>
          <tbody id="tbl">
            <?php 
              $fetch = Functions::getall("muk");
              $no=0;
              foreach($fetch as $value){
                $no++;
                $indexs = md5(sha1($value['id']));
                $kadrb = Functions::getbyid("xodimlar",$value['user_id']);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $teacher = $kbulimi['familya']." ".$kbulimi['ism']." ".$kbulimi['otch'];

                if(strlen($value['muk'])>1){
                  $file='<a target="_blank" href="../docs/muk/'.$value['muk'].'">Yuklash</a>';
                }else{
                  $file='<b style="color:red"> Mavjud emas</b>';
                }
                echo ('

                  <tr>
                    
                    <td class="sha1'.$indexs.'">'.$value['id'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['braqam'].'</td>
                    <td class="sha1'.$indexs.'" id="'.$value['user_id'].'">'.$teacher.'</td>
                    <td class="sha1'.$indexs.'" >'.$value['bulim_id'].'</td>
                    <td class="sha1'.$indexs.'" >'.$value['lavozim'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['summa'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['asos'].'</td>
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
                    placeholder="Buyruq raqamini kiriting"
                    name="braqam"
                    id="braqam"
                    required
                />
                <div class="invalid-feedback">Buyruq raqamini kiriting</div>
              </div>
              
              
              <div class="form-group">
                <label>Xodimni tanlang</label>
                <select name="user_id"  id="user_id"  onchange="mehnat()" required class="form-select">
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
                <input type="hidden" id="kadr_bulimdan" >
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
                <input type="hidden" id="bulimdan" name="bulim_id">
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
                <input type="hidden" id="kafedradan">
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
                <input type="hidden" id="lavozimdan" name="lavozim">
                <div class="invalid-feedback">Lavozimdan kiriting</div>
              </div>

              <div class="form-group">
                <label>Fayl</label>
                <input
                    class="form-control"
                    type="file"
                    placeholder="Fayl kiriting"
                    name="muk"
                />
                <div class="invalid-feedback">Fayl kiriting</div>
              </div>
              

              <div class="form-group">
                <label>Summa</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Summani kiriting"
                    name="summa"
                    id="summa"
                    required
                />
                <div class="invalid-feedback">Summani kiriting</div>
              </div>
              
              
              <div class="form-group">
                <label>Asos</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Asosni kiriting"
                    name="asos"
                    id="asos"
                    required
                />
                <div class="invalid-feedback">Asosni kiriting</div>
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
    document.getElementById('bulimdan').value=infos[3];
    document.getElementById('lavozimdan').value=infos[4];
    document.getElementById('bulimdan1').value=infos[3];
    document.getElementById('lavozimdan1').value=infos[4];
    document.getElementById('summa').value=infos[5];
    document.getElementById('asos').value=infos[6];
    document.getElementById('taxrir').setAttribute("onclick",'taxririnfo('+ infos[0] +')');
}


  function taxririnfo(id) {
    $.ajax({
      url:"core/edit/edit.php?table=<?=str_rot13("muk")?>",
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
        table:'muk',
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
            document.getElementById('kafedradan').value = obj['kafname'];
            document.getElementById('bulimdan1').value = obj['bulim_id'];
            document.getElementById('kadr_bulim1').value = obj['kadr_id'];
            document.getElementById('kafedradan1').value = obj['kafname'];
            document.getElementById('lavozimdan1').value = obj['lavozim'];
          }
          else{
            toast.create({
            title: "Xatolik.",
            text: "Xodim Ishga qabul qilinmagan!",
            type: "error",
            icon: "assets/img/icon/error.svg",
          });

            document.getElementById('bulimdan').value = 0;
            document.getElementById('kadr_bulimdan').value = 0;
            document.getElementById('lavozimdan').value = 0;
            document.getElementById('kafedradan').value = 0;
            document.getElementById('bulimdan1').value = "Xodimni avval ishga qabul qiling";
            document.getElementById('kadr_bulim1').value = "Xodimni avval ishga qabul qiling";
            document.getElementById('kafedradan1').value = "Xodimni avval ishga qabul qiling";
            document.getElementById('lavozimdan1').value = "Xodimni avval ishga qabul qiling";
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
                "../docs/shablon/muk.docx",
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
                      name : infos[2],
                      braqam : infos[1],
                      bulim : infos[3],
                      lavozim : infos[4],
                      asos : infos[6],
                      summa : infos[5],
                    });
                    var out = doc.getZip().generate({
                        type: "blob",
                        mimeType:
                            "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
                    });
                    // Output the document using Data-URI
                    saveAs(out, infos[2]+".docx");
                }
            );
        


}

</script>
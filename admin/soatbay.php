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
                <th>To`liq ism</th>
                <th>Lavozim</th>
                <th>Ish hajmi</th>
                <th>Fakultet, kafedra</th>
                <th>Ish turi</th>
                <th>Asos</th>
                <th>Fayl</th>
                <th>Funksiyalar</th>
              </tr>
          </thead>
          <tbody id="tbl">
            <?php 
              $fetch = Functions::getall("soatbay");
              $no=0;
              foreach($fetch as $value){
                $no++;
                $indexs = md5(sha1($value['id']));
                $kadrb = Functions::getbyid("xodimlar",$value['user_id']);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $teacher = $kbulimi['familya']." ".$kbulimi['ism']." ".$kbulimi['otch'];

                if(strlen($value['soatbay'])>1){
                  $file='<a target="_blank" href="../docs/soatbay/'.$value['soatbay'].'">Yuklash</a>';
                }else{
                  $file='<b style="color:red"> Mavjud emas</b>';
                }
                echo ('

                  <tr>
                    
                    <td class="sha1'.$indexs.'">'.$value['id'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['braqam'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['user_id'].'</td>
                    <td class="sha1'.$indexs.'" >'.$value['lavozim'].'</td>
                    <td class="sha1'.$indexs.'" >'.$value['hajm'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['bulim_id'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['ishturi'].'</td>
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
                <label>To`liq Ism</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="To`liq Ismni kiriting"
                    name="user_id"
                    id="user_id"
                    required
                />
                <div class="invalid-feedback">To`liq Ismni kiriting</div>
              </div>
              
              <div class="form-group">
                <label>Lavozim</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Lavozimni kiriting"
                    name="lavozim"
                    id="lavozim"
                    required
                />
                <div class="invalid-feedback">Lavozimni kiriting</div>
              </div>
              
              

              <div class="form-group">
                <label>Ish hajmi</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Ish hajmini kiriting"
                    name="hajm"
                    id="hajm"
                    required
                />
                <div class="invalid-feedback">Ish hajmini kiriting</div>
              </div>
              

              <div class="form-group">
                <label>Fakultet, kafedra </label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Fakultet, kafedra ni kiriting"
                    name="bulim_id"
                    id="bulim_id"
                    required
                />
                <div class="invalid-feedback">Fakultet, kafedra ni kiriting</div>
              </div>
              

              <div class="form-group">
                <label>Ish turi</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Ish turini kiriting"
                    name="ishturi"
                    id="ishturi"
                    required
                />
                <div class="invalid-feedback">Ish turini kiriting</div>
              </div>
              
              <div class="form-group">
                <label>Fayl</label>
                <input
                    class="form-control"
                    type="file"
                    placeholder="Fayl kiriting"
                    name="soatbay"
                />
                <div class="invalid-feedback">Fayl kiriting</div>
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
    document.getElementById('lavozim').value=infos[3];
    document.getElementById('hajm').value=infos[4];
    document.getElementById('bulim_id').value=infos[5];
    document.getElementById('ishturi').value=infos[6];
    document.getElementById('asos').value=infos[7];
    document.getElementById('taxrir').setAttribute("onclick",'taxririnfo('+ infos[0] +')');
}


  function taxririnfo(id) {
    $.ajax({
      url:"core/edit/edit.php?table=<?=str_rot13("soatbay")?>",
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
        table:'soatbay',
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
                "../docs/shablon/soatbay.docx",
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
                      lavozim : infos[3],
                      hajm : infos[4],
                      ishturi : infos[6],
                      bulim : infos[5],
                      asos : infos[7],
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
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
                <th>Bosqich</th>
                <th>Sanadan</th>
                <th>Oylarga</th>
                <th>Asos</th>
                <th>Fayl</th>
                <th>Funksiyalar</th>
              </tr>
          </thead>
          <tbody id="tbl">
            <?php 
              $fetch = Functions::getall("dschiqish");
              $no=0;
              foreach($fetch as $value){
                $no++;
                $indexs = md5(sha1($value['id']));
                $kadrb = Functions::getbyid("xodimlar",$value['user_id']);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $teacher = $kbulimi['familya']." ".$kbulimi['ism']." ".$kbulimi['otch'];

                if(strlen($value['dschiqish'])>1){
                  $file='<a target="_blank" href="../docs/dschiqish/'.$value['dschiqish'].'">Yuklash</a>';
                }else{
                  $file='<b style="color:red"> Mavjud emas</b>';
                }
                echo ('

                  <tr>
                    
                    <td class="sha1'.$indexs.'">'.$value['id'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['braqam'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['user_id'].'</td>
                    <td class="sha1'.$indexs.'" >'.$value['bosqich'].'</td>
                    <td class="sha1'.$indexs.'" >'.$value['sana'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['oylar'].'</td>
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
                <label>Bosqich</label>
                <input
                    class="form-control"
                    type="number"
                    placeholder="Bosqichni kiriting"
                    name="bosqich"
                    id="bosqich"
                    required
                />
                <div class="invalid-feedback">Bosqichni kiriting</div>
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
                <label>Stipendiya to`lanadigan oylar</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Stipendiya to`lanadigan oylarni kiriting"
                    name="oylar"
                    id="oylar"
                    required
                />
                <div class="invalid-feedback">Stipendiya to`lanadigan oylarni kiriting</div>
              </div>
              
              <div class="form-group">
                <label>Fayl</label>
                <input
                    class="form-control"
                    type="file"
                    placeholder="Fayl kiriting"
                    name="dschiqish"
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
    document.getElementById('bosqich').value=infos[3];
    document.getElementById('sana').value=infos[4];
    document.getElementById('oylar').value=infos[5];
    document.getElementById('asos').value=infos[6];
    document.getElementById('taxrir').setAttribute("onclick",'taxririnfo('+ infos[0] +')');
}


  function taxririnfo(id) {
    $.ajax({
      url:"core/edit/edit?table=<?=str_rot13("dschiqish")?>",
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
        table:'dschiqish',
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
                "../docs/shablon/dschiqish.docx",
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
                      bosqich : infos[3],
                      sana : infos[4],
                      asos : infos[6],
                      oylar : infos[5],
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
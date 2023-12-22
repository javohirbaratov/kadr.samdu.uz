<?php 
  include_once'menu/head.php';
?>

<!--MAIN-CONTENT-OPEN-->
<main>
  <div class="container">
    <div class="page-header">
      <h2 class="page-header__title">Ishga qabul qilinganlar </h2>
      <ul class="page-header__nav">
        <li>
          <i class="far fa-home-lg-alt"></i>
          <a href="index">Home</a>
        </li>
        <li>
          Ishga qabul qilinganlar 
        </li>
      </ul>
    </div>
    <div class="page-content">
        <table id="MyTable" class="display">
          <thead>
              <tr>
                <th>ID</th>
                <th>Xodim</th>
                <th>Ma'lumot</th>
                <th>Shtat</th>
                <th>Sana</th>
                <th>Muddat</th>
                <th>Sinov(oy)</th>
                <th>Kadrlar bo'limi</th>
                <th>Bo'lim,Bino,Fakultet,Grant</th>
                <th>Kafedra</th>
                <th>Lavozim</th>
                <th>O'rindosh</th>
                <th>Buyruq</th>
                <th>Ariza</th>
                <th>Funksiyalar</th>
              </tr>
          </thead>
          <tbody id="tbl">
            <?php 
              $fetch = Functions::getall("qabul");
              $no=0;
              foreach($fetch as $value){
                $no++;
                $indexs = md5(sha1($value['id']));
                $kadrb = Functions::getbyid("xodimlar",$value['user_id']);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $teacher = $kbulimi['familya']." ".$kbulimi['ism']." ".$kbulimi['otch'];

                $kadrb = Functions::getbyid("kadrlarbulimi",$value['kadr_bulim_id']);
                if (mysqli_num_rows($kadrb)>0) {
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $kadrbul = $kbulimi['name'];}
                $bul = " ";
                $kadrb = Functions::getbyid("bulimlar",$value['bulim_id']);
                if (mysqli_num_rows($kadrb)>0) {
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $bul = $kbulimi['name'];
                }
                $Kaf = " ";
                $kadrb = Functions::getbyid("kafedra",$value['kafedra_id']);
                if (mysqli_num_rows($kadrb)>0) {
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $Kaf = $kbulimi['name'];}
                $lavozim = '';
                $kadrb = Functions::getbyid("lavozimlar",$value['lavozim']);
                if (mysqli_num_rows($kadrb)>0) {
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $lavozim = $kbulimi['lavozim'];}

                if(strlen($value['ariza'])>1){
                  $ariza='<a target="_blank" href="../docs/ariza/'.$value['ariza'].'">Yuklash</a>';
                }else{
                  $ariza='<b style="color:red"> Mavjud emas</b>';
                }

                if($value['sinov']>0){
                  $sinov=$value['sinov'].' oy sinov';
                }else{
                  $sinov='Sinovsiz';
                }
                echo ('

                  <tr>
                    
                    <td class="sha1'.$indexs.'">'.$value['id'].'</td>
                    <td class="sha1'.$indexs.'" id="'.$value['user_id'].'">'.$teacher.'</td>
                    <td class="sha1'.$indexs.'">'.$value['malumot'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['shtat'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['sana'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['muddati'].'</td>
                    <td class="sha1'.$indexs.'">'.$sinov.'</td>
                    <td class="sha1'.$indexs.'" id="'.$value['kadr_bulim_id'].'">'.$kadrbul.'</td>
                    <td class="sha1'.$indexs.'" id="'.$value['bulim_id'].'">'.$bul.'</td>
                    <td class="sha1'.$indexs.'" id="'.$value['kafedra_id'].'">'.$Kaf.'</td>
                    <td class="sha1'.$indexs.'" id="'.$value['lavozim'].'">'.$lavozim.'</td>
                    <td class="sha1'.$indexs.'">'.$value['urindosh'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['buyruq'].'</td>
                    <td class="sha1'.$indexs.'">'.$ariza.'</td>
                    <td>
                      <b class="taxrirf status status-paid" data="'.$indexs.'"><i class="fal fa-pen">
                      </i></b>

                      <b  class="deletef status open_button status-unpaid" data="'.$value['id'].'">
                      <i class="fal fa-trash-alt"></i></b>
                      <br><br>

                      <b  class="status status-pending" onclick="words(\''.$indexs.'\')">
                      <i class="fal fa-file-word"></i></b>
                      <b  class="status status-pending" onclick="formwords(\''.$value['id'].'\')">
                      <i class="fal fa-download"></i></b>
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
                <label>Ma'lumot</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Ma'lumot kiriting"
                    name="malumot"
                    id="malumot"
                    required
                />
                <div class="invalid-feedback">Ma'lumot kiriting</div>
              </div>
              <div class="form-group">
                <label>Shtat</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Shtat kiriting"
                    name="shtat"
                    id="shtat"
                    required
                />
                <div class="invalid-feedback">Shtat kiriting</div>
              </div>

              <div class="form-group">
                <label>Sana</label>
                <input
                    class="form-control"
                    type="date"
                    placeholder="Sana kiriting"
                    name="sana"
                    id="sana"
                    required
                />
                <div class="invalid-feedback">Sana kiriting</div>
              </div>

              <div class="form-group">
                <label>Muddati</label>
                <input
                    class="form-control"
                    type="date"
                    placeholder="Muddatini kiriting"
                    name="muddati"
                    id="muddati"
                    required
                />
                <div class="invalid-feedback">Muddatini kiriting</div>
              </div>


              <div class="form-group switch_box box_1">
                <label>Sinov asosida qabul bilindimi?</label>
                <input type="checkbox" onchange="check()" id="Mycheck" class="switch_1">
              </div>

            <div class="form-group">
              <select name="sinov" class="form-select" style="display:none" id="sinov">
                <option value="0">Tanlang</option>
                <option value="1">1-oy sinov</option>
                <option value="2">2-oy sinov</option>
                <option value="3">3-oy sinov</option>
              </select>
              </div>
              <div class="form-group">
                <label>Kadrlar bo'limini tanlang</label>
                <select name="kadr_bulim_id" id="kadr_bulim_id" onchange="bulim()" value="0"  required class="form-select">
                  <option>Tanlash</option>
                  <?php 
                  $fetch=Functions::getall("kadrlarbulimi");
                  foreach ($fetch as $value) {
                    echo"<option value=\"".$value['id']."\">".$value['name']."</option>";
                  }
                   ?>
                </select>
                <div class="invalid-feedback">Kadrlar bo'limini tanlang</div>
                
              </div>

              <div class="form-group" id="bulim1">
                <label>Bo'limni tanlang</label>
                <select name="bulim_id"  id="bulim_id" onchange="funkaf()" required class="form-select">
                  <option>Tanlash</option>
                  <?php 
                  $fetch=Functions::getall("bulimlar");
                  foreach ($fetch as $value) {
                    echo"<option value=\"".$value['id']."\">".$value['name']."</option>";
                  }
                   ?>
                </select>
                <div class="invalid-feedback">Bo'limni tanlang</div>
                
              </div>

              <div class="form-group" id="kafedra1">
                <label id="kaf2">Kafedrani tanlang</label>
                <select name="kafedra_id"  id="kafedra_id" onchange="funlav()"   class="form-select">
                  <option>Tanlash</option>
                  <?php 
                  $fetch=Functions::getall("kafedra");
                  foreach ($fetch as $value) {
                    echo"<option value=\"".$value['id']."\">".$value['name']."</option>";
                  }
                   ?>
                </select>
                <div id="kaf3" class="invalid-feedback">Kafedrani tanlang</div>
                
              </div>

              <div class="form-group" id="lavozim1">
                <label>Lavozimni tanlang</label>
                <select name="lavozim"  id="lavozim"  required class="form-select">
                  <option>Tanlash</option>
                  <?php 
                  $fetch=Functions::getall("lavozimlar");
                  foreach ($fetch as $value) {
                    echo"<option value=\"".$value['id']."\">".$value['lavozim']."</option>";
                  }
                   ?>
                </select>
                <div class="invalid-feedback">Lavozimni tanlang</div>
                
              </div>



            <div class="form-group">
                <label>Ish o'rnini tanlang</label>
              <select name="urindosh"  id="urindosh" class="form-select" style="display:none" id="sinov">
                <option value="asosiy">Asosiy</option>
                <option value="ichki">Ichki o'rindosh</option>
                <option value="tashqi">Tashqi o'rindosh</option>
              </select>

                <div class="invalid-feedback">Ish o'rnini tanlang</div>
              </div>


              <div class="form-group">
                <label>Ariza skaneri</label>
                <input
                    class="form-control"
                    type="file"
                    placeholder="Ariza skanerini kiriting"
                    name="ariza"
                    id="ariza"
                    required
                />
                <div class="invalid-feedback">Ariza skanerini kiriting</div>
              </div>

              <div class="form-group">
                <label>Buyruq</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Buyruqni kiriting"
                    name="buyruq"
                    id="buyruq"
                    required
                />
                <div class="invalid-feedback">Buyruqni kiriting</div>
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
    document.getElementById('malumot').value=infos[2];
    document.getElementById('shtat').value=infos[3];
    document.getElementById('sana').value=infos[4];
    document.getElementById('muddati').value=infos[5];
    document.getElementById('sinov').value=infos[6];
    document.getElementById('kadr_bulim_id').value=arr[7].id;
    document.getElementById('bulim_id').value=arr[8].id;
    document.getElementById('kafedra_id').value=arr[9].id;
    document.getElementById('lavozim').value=arr[10].id;
    document.getElementById('urindosh').value=infos[11];
    document.getElementById('buyruq').value=infos[12];
    document.getElementById('taxrir').setAttribute("onclick",'taxririnfo('+ infos[0] +')');
}

  
  function check() {
    let che = document.getElementById("Mycheck").checked;
    console.log(document.getElementById('sinov').value);
    if (che) {
      document.getElementById('sinov').style = "display:block";
      document.getElementById('sinov').value = "1";
    }else
      document.getElementById('sinov').style = "display:none";
      document.getElementById('sinov').value = "0";
  }


  function taxririnfo(id) {
    console.log($("#form").serialize());
    $.ajax({
      url:"core/edit/editish",
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
      url:"core/delete/deleteish.php",
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

function bulim(){
        var bulim_id = document.getElementById('kadr_bulim_id').value;
        
        document.getElementById('bulim1').innerHTML = '';
        document.getElementById('kaf2').style.display = 'none';
        document.getElementById('kaf3').style.display = 'none';
        document.getElementById('kafedra_id').style.display = 'none';
        document.getElementById('kafedra_id').value = '0';
        document.getElementById('lavozim1').innerHTML = '';

        $.ajax({
        url: "core/bulim",
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
        url: "core/kafedra",
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
        url: "core/lavozim",
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
include_once'menu/footer.php';
 ?>
<script type="text/javascript">
  

        function loadFile(url, callback) {
            PizZipUtils.getBinaryContent(url, callback);
        }
        
        function formwords(id) {
          $.ajax({
            url: "get-qabul-xodim.php",
            type : "GET",
            data:{
              xodim_id:id,
            },
            success:function(data) {
              console.log(data);
              var obj = jQuery.parseJSON(data);
              loadFile(
                "../docs/shablon/shartnoma.docx",
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
                      nomer : obj.nomer,
                      sana : obj.sana,
                      fio : obj.fio,
                      fio : obj.fio,
                      bulim : obj.bulim,
                      lavozim : obj.lavozim,
                      shtat : obj.shtat,
                      shakl : obj.shakl,
                      sinov : obj.sinov,
                      fam : obj.fam,
                    });
                    var out = doc.getZip().generate({
                        type: "blob",
                        mimeType:
                            "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
                    });
                    // Output the document using Data-URI
                    saveAs(out, obj.id+".docx");
                }
              );
            },
            error:function(xhr) {
              alert("Internetdan uzilish ro'y berdi");
            }
          })
          // infoid = ".sha1" + hash;
          // var infos = new Array();
          // var arr = $(infoid);
          
          // for(var i=0; i< arr.length; i++){
          //     infos.push(arr[i].innerHTML);
          // }
          
        }
function words(hash) {
  infoid=".sha1"+hash;
  var infos = new Array();
  var arr = $(infoid);
  for(var i=0; i< arr.length; i++){
      infos.push(arr[i].innerHTML);
  }
  loadFile(
      "../docs/shablon/ishga_qabul_qilish_new.docx",
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
            name : infos[1],
            malumoti : infos[2],
            sana : infos[4],
            muddati : infos[5],
            shtat : infos[3],
            kafedra : infos[7],
            lavozim : infos[9],
            buyruq :infos[11],
            nameikki : infos[1],
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
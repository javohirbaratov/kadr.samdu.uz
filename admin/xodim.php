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
                <th>Familiya</th>
                <th>Ism</th>
                <th>Otasining ismi</th>
                <th>JSHIR</th>
                <th>INN</th>
                <th>Seriya</th>
                <th>Nomer</th>
                <th>Pasport berilgan sana</th>
                <th>Pasport berilgan joy</th>
                <th>Pasport muddati</th>
                <th>Pasport</th>
                <th>Obektivka</th>
                <th>To`g`ilgan sana</th>
                <th>Tug`ilgan joy</th>
                <th>Jinsi</th>
                <th>Millari</th>
                <th>Fuqoroligi</th>
                <th>Partiyaviyligi</th>
                <th>Xarbiy xizmat</th>
                <th>Tibbiy ko`rik guvohnomasi</th>
                <th>Tibbiy ko`rik muddati</th>
                <th>Manzili</th>
                <th>Doimiy yashash joyi</th>
                <th>Telefon</th>
                <th>Telegram ID</th>
                <th>Pochta</th>
                <th>Rasm</th>
                <th>Rasmni yuklash</th>
                <th>Oilaviy ahvoli</th>
                <th>Viloyat</th>
                <th>Tuman</th>
                <th>Funksiyalar</th>
              </tr>
          </thead>
          <tbody id="tbl">
            <?php 
              $fetch = Functions::getall("xodimlar");
              $no=0;
              foreach($fetch as $value){
                $no++;
                $indexs = md5(sha1($value['id']));
                if(strlen($value['passport'])>1){
                  $passport='<a class="btn btn-success" target="_blank" href="../bot/uploads/'.$value['passport'].'">Yuklash</a>';
                }else{
                  $passport='<b style="color:red"> Mavjud emas</b>';
                }
                if(strlen($value['obyektivka'])>1){
                  $obyektivka='<a class="btn btn-success" target="_blank" href="../bot/uploads/'.$value['obyektivka'].'">Yuklash</a>';
                }else{
                  $obyektivka='<b style="color:red"> Mavjud emas</b>';
                }
                if(strlen($value['passport'])>1){
                  $passport='<a class="btn btn-success" target="_blank" href="../bot/uploads/'.$value['passport'].'">Yuklash</a>';
                }else{
                  $passport='<b style="color:red"> Mavjud emas</b>';
                }
                if(strlen($value['tkguvohnoma'])>1){
                  $tkguvohnoma='<a class="btn btn-success" target="_blank" href="../bot/uploads/'.$value['tkguvohnoma'].'">Yuklash</a>';
                }else{
                  $tkguvohnoma='<b style="color:red"> Mavjud emas</b>';
                }

                if(strlen($value['rasm'])>1){
                  $rasm='<img width="100px" src="../bot/uploads/'.$value['rasm'].'">';
                  $rasm_u = '<a class="btn btn-primary" href="../bot/uploads/'.$value['rasm'].'" download="3x4-rasm">3x4</a>';
                }else{
                  $rasm='<b style="color:red"> Mavjud emas</b>';
                  $rasm_u = '<b style="color:red"> Mavjud emas</b>';
                }
                echo ('

                  <tr>
                    
                    <td class="sha1'.$indexs.'">'.$value['id'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['familya'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['ism'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['otch'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['jshir'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['inn'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['seriya'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['nomer'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['pasportdate'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['pasportjoy'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['pasportenddate'].'</td>
                    <td class="sha1'.$indexs.'">'.$passport.'</td>
                    <td class="sha1'.$indexs.'">'.$obyektivka.'</td>
                    <td class="sha1'.$indexs.'">'.$value['birthdate'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['birthplace'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['jinsi'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['millati'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['fuqaroligi'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['partiyaviyligi'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['xarbiy'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['tkmuddati'].'</td>
                    <td class="sha1'.$indexs.'">'.$tkguvohnoma.'</td>
                    <td class="sha1'.$indexs.'">'.$value['manzil'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['doimiy'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['telefon'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['telegram_id'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['pochta'].'</td>
                    <td class="sha1'.$indexs.'">'.$rasm.'</td>
                    <td class="sha1'.$indexs.'">'.$rasm_u.'</td>
                    <td class="sha1'.$indexs.'">'.$value['oilaviyahvoli'].'</td>
                    <td class="sha1'.$indexs.'" id="'.$value['viloyat_id'].'">'.$value['viloyat_id'].'</td>
                    <td class="sha1'.$indexs.'" id="'.$value['tuman_id'].'">'.$value['tuman_id'].'</td>
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
                <label>Ism</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Ism kiriting"
                    name="ism"
                    id="ism"
                    
                />
                <div class="invalid-feedback">Ism kiriting</div>
              </div>

              <div class="form-group">
                <label>Familya</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Familya kiriting"
                    name="familya"
                    id="familya"
                    
                />
                <div class="invalid-feedback">Familya kiriting</div>
              </div>


              <div class="form-group">
                <label>Otasining ismi</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Otasining ismini kiriting"
                    name="otch"
                    id="otch"
                    
                />
                <div class="invalid-feedback">Otasining ismini kiriting</div>
              </div>


              <div class="form-group">
                <label>JSHIR </label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="______________"
                    name="jshir"
                    id="jshir"
                    
                />
                <div class="invalid-feedback">JSHIR ni kiriting</div>
              </div>

              <div class="form-group">
                <label>INN</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="_________"
                    name="inn"
                    id="inn"
                    
                />
                <div class="invalid-feedback">INN kiriting</div>
              </div>
              <div class="form-group">
                <label>Seriya</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="__"
                    name="seriya"
                    id="seriya"
                    
                />
                <div class="invalid-feedback">Seriya kiriting</div>
              </div>

              <div class="form-group">
                <label>Nomer</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="_______"
                    name="nomer"
                    id="nomer"
                    
                />
                <div class="invalid-feedback">Nomerni kiriting</div>
              </div>

              <div class="form-group">
                <label>Pasport berilgan sana</label>
                <input
                    class="form-control"
                    type="date"
                    placeholder="Pasport berilgan sanani kiriting"
                    name="pasportdate"
                    id="pasportdate"
                    
                />
                <div class="invalid-feedback">Pasport berilgan sanani kiriting</div>
              </div>


              <div class="form-group">
                <label>Pasport berilgan joy</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Pasport berilgan joyni kiriting"
                    name="pasportjoy"
                    id="pasportjoy"
                    
                />
                <div class="invalid-feedback">Pasport berilgan joyni kiriting</div>
              </div>


              <div class="form-group">
                <label>Pasport muddati</label>
                <input
                    class="form-control"
                    type="date"
                    placeholder="Pasport muddatini kiriting"
                    name="pasportenddate"
                    id="pasportenddate"
                    
                />
                <div class="invalid-feedback">Pasport muddatini kiriting</div>
              </div>



              <div class="form-group">
                <label>Pasport</label>
                <input
                    class="form-control"
                    type="file"
                    placeholder="Pasport"
                    name="passport"
                    id="passport"

                />
                <div class="invalid-feedback">Pasport</div>
              </div>



              <div class="form-group">
                <label>To`g`ilgan sana</label>
                <input
                    class="form-control"
                    type="date"
                    placeholder="To`g`ilgan sanani kiriting"
                    name="birthdate"
                    id="birthdate"
                    
                />
                <div class="invalid-feedback">To`g`ilgan sanani kiriting</div>
              </div>



              <div class="form-group">
                <label>Tug`ilgan joy</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Tug`ilgan joyni kiriting"
                    name="birthplace"
                    id="birthplace"
                    
                />
                <div class="invalid-feedback">Tug`ilgan joyni kiriting</div>
              </div>

              <div class="form-group">
                <label>Xodim jinsini tanlang</label>
                <select name="jinsi"  id="jinsi"   class="form-select">
                  <option value="erkak">erkak</option>
                  <option value="ayol">ayol</option>

                </select>
                <div class="invalid-feedback">Xodim jinsini tanlang</div>
              </div>


              <div class="form-group">
                <label>Millati</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Millatini kiriting"
                    name="millati"
                    id="millati"
                    
                />
                <div class="invalid-feedback">Millatini kiriting</div>
              </div>


              <div class="form-group">
                <label>Fuqoroligi</label>
                <select name="fuqaroligi" id="fuqaroligi"   class="form-select">
                  <option value="O`zbekiston fuqorosi">O`zbekiston fuqorosi</option>
                  <option value="Chet el fuqorosi">Chet el fuqorosi</option>
                  <option value="Fuqoroligi yuq shaxs">Fuqoroligi yuq shaxs</option>
                </select>
                <div class="invalid-feedback">Fuqoroligini Tanlang</div>
              </div>


              <div class="form-group">
                <label>Partiyaviyligi</label>
                <select name="partiyaviyligi" id="partiyaviyligi"   class="form-select">
                  <option value="Yo`q">Yo`q</option>
                  <option value="Oʻzbekiston Xalq demokratik partiyasi">Oʻzbekiston Xalq demokratik partiyasi</option>
                  <option value="Oʻzbekiston Liberal demokratik partiyasi">Oʻzbekiston Liberal demokratik partiyasi</option>
                  <option value="Oʻzbekiston Milliy tiklanish demokratik partiyasi">Oʻzbekiston Milliy tiklanish demokratik partiyasi</option>
                  <option value="Oʻzbekiston Adolat sotsial demokratik partiyasi">Oʻzbekiston Adolat sotsial demokratik partiyasi</option>
                  <option value="Oʻzbekiston ekologik partiyasi">Oʻzbekiston ekologik partiyasi</option>
                </select>
                <div class="invalid-feedback">Partiyaviyligini Tanlang</div>
              </div>



              <div class="form-group">
                <label>Xarbiy emasmi?</label>
                <select name="xarbiy" id="xarbiy"   class="form-select">
                  <option value="Yo`q">Yo`q</option>
                  <option value="Xa">Xa</option>
                </select>
                <div class="invalid-feedback">Xarbiyni Tanlang</div>
              </div>


              <div class="form-group">
                <label>Moddiy javobgar shaxsmi</label>
                <select name="mjshaxs" id="mjshaxs"   class="form-select">
                  <option value="Yo`q">Yo`q</option>
                  <option value="Xa">Xa</option>
                </select>
                <div class="invalid-feedback">Moddiy javobgar shaxsmi tanlang</div>
              </div>


              <div class="form-group">
                <label>Tibbiy ko`rik muddati</label>
                <input
                    class="form-control"
                    type="date"
                    placeholder="Tibbiy ko`rik muddati kiriting"
                    name="tkmuddati"
                    id="tkmuddati"
                />
                <div class="invalid-feedback">Tibbiy ko`rik muddati kiriting</div>
              </div>


              <div class="form-group">
                <label>Tibbiy ko`rik guvohnomasi</label>
                <input
                    class="form-control"
                    type="file"
                    placeholder="Tibbiy ko`rik guvohnomasi kiriting"
                    name="tkguvohnoma"
                    id="tkguvohnoma"

                />
                <div class="invalid-feedback">Tibbiy ko`rik guvohnomasi kiriting</div>
              </div>


              <div class="form-group">
                <label>Manzili</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Manzilini kiriting"
                    name="manzil"
                    id="manzil"
                    
                />
                <div class="invalid-feedback">Manzilini kiriting</div>
              </div>


              <div class="form-group">
                <label>Doimiy yashash joyi</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Doimiy yashash joyini kiriting"
                    name="doimiy"
                    id="doimiy"
                    
                />
                <div class="invalid-feedback">Doimiy yashash joyini kiriting</div>
              </div>


              <div class="form-group">
                <label>Telefoni</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="+998(__)___-__-__"
                    name="telefon"
                    id="telefon"
                    
                />
                <div class="invalid-feedback">Telefonini kiriting</div>
              </div>


              <div class="form-group">
                <label>Telegram ID</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Telegram IDsini kiriting"
                    name="telegram_id"
                    id="telegram_id"

                />
                <div class="invalid-feedback">Telegram IDsini kiriting</div>
              </div>


              <div class="form-group">
                <label>Email</label>
                <input
                    class="form-control"
                    type="email"
                    placeholder="Emailni kiriting"
                    name="pochta"
                    id="pochta"

                />
                <div class="invalid-feedback">Emailni kiriting</div>
              </div>



              <div class="form-group">
                <label>Rasm</label>
                <input
                    class="form-control"
                    type="file"
                    placeholder="Rasm"
                    name="rasm"
                    id="rasm"

                />
                <div class="invalid-feedback">Rasm</div>
              </div>

              <div class="form-group" >
                <label>Oilaviy ahvoli</label>
                <select name="oilaviyahvoli"  id="oilaviyahvoli"   class="form-select">
                  <option value="Uylanmagan">Uylanmagan</option>
                  <option value="Turmushga chiqmagan">Turmushga chiqmagan</option>
                  <option value="Oilali">Oilali</option>
                  <option value="Ajrashgan">Ajrashgan</option>
                  <option value="Beva">Beva</option>
                </select>
                <div class="invalid-feedback">Oilaviy ahvolini kiriting</div>
              </div>

              <div class="form-group">
                <label>Viloyatni tanlang</label>
                <select name="viloyat_id"  id="viloyat_id" onchange="ttuman()"   class=" js-example-data-ajax form-group">
                  <?php
                    $fetch = Functions::getall("viloyat");
                     foreach ($fetch as $value) {
                    echo"<option value=\"".$value['id']."\">".$value['nomi']."</option>";
                  }
                   ?>
                   <option value="Boshqa">Boshqa</option>
                </select>
                <div class="invalid-feedback">Viloyatni tanlang</div>
              </div>


              <div class="form-group" id="tuman">
                <label>Tumanni tanlang</label>
                <select name="tuman_id"  id="tuman_id"   class="js-example-data-ajax form-select">
                  <option value="1">Samarqand</option>
                  <option value="2">Oqdaryo</option>
                </select>
                <div class="invalid-feedback">Tumanni tanlang</div>
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
    document.getElementById('familya').value=infos[1];
    document.getElementById('ism').value=infos[2];
    document.getElementById('otch').value=infos[3];
    document.getElementById('jshir').value=infos[4];
    document.getElementById('inn').value=infos[5];
    document.getElementById('seriya').value=infos[6];
    document.getElementById('nomer').value=infos[7];
    document.getElementById('pasportdate').value=infos[8];
    document.getElementById('pasportjoy').value=infos[9];
    document.getElementById('pasportenddate').value=infos[10];
    document.getElementById('birthdate').value=infos[12];
    document.getElementById('birthplace').value=infos[13];
    document.getElementById('jinsi').value=infos[14];
    document.getElementById('millati').value=infos[15];
    document.getElementById('fuqaroligi').value=infos[16];
    document.getElementById('partiyaviyligi').value=infos[17];
    document.getElementById('xarbiy').value=infos[18];
    document.getElementById('tkmuddati').value=infos[19];
    document.getElementById('manzil').value=infos[21];
    document.getElementById('doimiy').value=infos[22];
    document.getElementById('telefon').value=infos[23];
    document.getElementById('telegram_id').value=infos[24];
    document.getElementById('pochta').value=infos[25];
    document.getElementById('oilaviyahvoli').value=infos[27];
    document.getElementById('viloyat_id').value=arr[28].id;
    document.getElementById('tuman_id').value=arr[29].id;
    document.getElementById('taxrir').setAttribute("onclick",'taxririnfo('+ infos[0] +')');
    
}


  
  function taxririnfo(id) {
    $.ajax({
      url:"core/edit/editxodim.php",
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
      url:"core/delete/deletexodim.php",
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

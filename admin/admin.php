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
                <th>Login</th>
                <th>Email</th>
                <th>Telefon</th>
                <th>Roli</th>
                <th>Telegram ID</th>
                <th>Sungi kirish</th>
                <th>Funksiyalar</th>
              </tr>
          </thead>
          <tbody id="tbl">
            <?php 
              $fetch = Functions::getall("users");
              $no=0;
              foreach($fetch as $value){
                $no++;
                $indexs = md5(sha1($value['id']));
                echo ('

                  <tr>
                    
                    <td class="sha1'.$indexs.'">'.$value['id'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['familya'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['ism'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['otch'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['login'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['email'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['telefon'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['rol'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['telegram_id'].'</td>
                    <td class="sha1'.$indexs.'">'.$value['registrdate'].'</td>
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
                  id="ism"
                    class="form-control"
                    type="text"
                    placeholder="Ism kiriting"
                    name="ism"
                    required
                />
                <div class="invalid-feedback">Ism kiriting</div>
              </div>

              <div class="form-group">
                <label>Familya</label>
                <input id="familya" 
                    class="form-control"
                    type="text"
                    placeholder="Familya kiriting"
                    name="familya"
                    required
                />
                <div class="invalid-feedback">Familya kiriting</div>
              </div>


              <div class="form-group">
                <label>Otasining ismi</label>
                <input
                    id="otch"
                    class="form-control"
                    type="text"
                    placeholder="Otasining ismini kiriting"
                    name="otch"
                    required
                />
                <div class="invalid-feedback">Otasining ismini kiriting</div>
              </div>

              <div class="form-group">
                <label>Login</label>
                <input id="login" 
                    class="form-control"
                    type="text"
                    placeholder="Login kiriting"
                    name="login"
                    required
                />
                <div class="invalid-feedback">Login kiriting</div>
              </div>

              <div class="form-group">
                <label>Telefon raqami</label>
                <input id="telefon" 
                    class="form-control"
                    type="text"
                    placeholder="Telefon raqamini kiriting"
                    name="telefon"
                    required
                />
                <div class="invalid-feedback">Telefon raqamini kiriting</div>
              </div>

              <div class="form-group">
                <label>Email</label>
                <input id="email" 
                    class="form-control"
                    type="text"
                    placeholder="Emailni kiriting"
                    name="email"
                    required
                />
                <div class="invalid-feedback">Emailni kiriting</div>
              </div>

              <div class="form-group">
                <label>Xodim rolini tanlang</label>
                <select id="rol" name="rol"  required class="form-select">
                  <option value="xodim">xodim</option>
                  <option value="admin">admin</option>
                  
                </select>
                <div class="invalid-feedback">Xodim rolini tanlang</div>
              </div>
              <div class="form-group">
                <label>Telegram ID</label>
                <input id="telegram_id" 
                    class="form-control"
                    type="text"
                    placeholder="Telegram IDsini kiriting"
                    name="telegram_id"
                    required
                />
                <div class="invalid-feedback">Telegram IDsini kiriting</div>
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
    document.getElementById('login').value=infos[4];
    document.getElementById('email').value=infos[5];
    document.getElementById('telefon').value=infos[6];
    document.getElementById('rol').value=infos[7];
    document.getElementById('telegram_id').value=infos[8];
    document.getElementById('taxrir').setAttribute("onclick",'taxririnfo('+ infos[0] +')');
}


  function taxririnfo(id) {
  console.log($('#form').serialize());
    $.ajax({
      url:"core/edit/editadmin.php",
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
      url:"core/delete/deleteadmin.php",
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

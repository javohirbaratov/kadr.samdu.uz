<?
  session_start();
  if (isset($_SESSION['login'])) {
    $rol = $_SESSION['rol'];
    ?>
    <script type="text/javascript">
      window.location.href = '<?=$_SESSION['rol']?>/index.php';
    </script>
    <?
    exit;
  }
  $_SESSION['_csrf'] = md5(time());
?>

<!DOCTYPE html>
<html lang="uz">
<head>
  <meta charset="UTF-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo.jpg/>
  
  <? include 'meta.php'; ?>
  <title>Ro'yxatdan o'tish</title>
  <link rel="stylesheet" href="assets/css/nomalize.css"/>
  <link rel="stylesheet" href="assets/css/mess-alert.css"/>
  <link rel="stylesheet" href="assets/css/main.css"/>
</head>
<body class="login-page">
<div class="login-page--wrapper">
  <img class="login-page--wrapper-logo" src="https://hemis.samdu.uz/static/crop/3/9/250_250_90_3968016486.png"
            alt="logo" style="width: 80px;" />
        <br>
        <h3 style="text-align:center;">Sharof Rashidov nomidagi Samarqand davlat universiteti</h3><br>
        <p>KADRLAR BO'LIMI</p><br>
  <!-- Form-open -->
  <form id="form" action="check.php" method="post">
    
    <?php if($_SESSION['action']=="checkcode" && time()-$_SESSION['send_time']<300){?>
    <div class="form-group">
      <label>Telefon</label>
      <input
          class="form-control"
          type="text"
          placeholder="+998(XX)YYY-YY-YY"
          name="telefon"
          id="telefon"
          disabled
          value="<?=$_SESSION['telefon']?>"
      />
      <div class="invalid-feedback">Telefon raqimini kiriting</div>
    </div>
    <div class="form-group">
      <?php $m = (300-(time()) ) ?>
      <label><span id="smsmsg">Telefon raqamga sms yuborildi iltimos kodni kiriting</span> <span id="time">00:00</span></label>
      <input
          class="form-control"
          type="text"
          placeholder="_ _ _ _ _"
          name="codeconfirm"
          id="codeconfirm"
          required
      />
      <div class="invalid-feedback">SMS qilib yuborilgan kodni kiriting</div>
    </div>
    <input type="hidden" name="_csrf" value="<?=$_SESSION['_csrf']?>" id="_csrf">
    <div class="form-group">
      <button
          class="btn btn-primary w-100"
          id="checksubmit"
          type="button"
      >
        Tekshirish
        <div class="lds-dual-ring btn-load"></div>
      </button>
    </div>
    <?
      }
      else{
        if(isset($_SESSION['send_time'])){
          unset($_SESSION['sms_code']);
          unset($_SESSION['send_time']);
          unset($_SESSION['action']);
        }        
        ?>
    <div class="form-group">
      <label>Telefon</label>
      <input
          class="form-control"
          type="text"
          placeholder="+998(XX)YYY-YY-YY"
          name="telefon"
          id="telefon"
          required
      />
      <div class="invalid-feedback">Sms kodni kiriting</div>
    </div>
    <div class="form-group" style="display: none;" id="codeinput">
      <label><span id="smsmsg">Telefon raqamga sms yuborildi iltimos kodni kiriting</span> <span id="time">00:00</span></label>
      <input
          class="form-control"
          type="text"
          placeholder="_ _ _ _ _"
          name="codeconfirm"
          id="codeconfirm"
          required
      />
      <div class="invalid-feedback">SMS qilib yuborilgan kodni kiriting</div>
    </div>
    <input type="hidden" name="_csrf" value="<?=$_SESSION['_csrf']?>" id="_csrf">
    <div class="form-group" id="submitbtn">
      <button
          class="btn btn-primary w-100"
          id="submit"
          type="button"
      >
        Yuborish
        <div class="lds-dual-ring btn-load"></div>
      </button>
    </div>
    <div class="form-group" id="checkbtn" style="display:none;">
      <button
          class="btn btn-primary w-100"
          id="checksubmit"
          type="button"
      >
        Tekshirish
        <div class="lds-dual-ring btn-load"></div>
      </button>
    </div>
        <?
      }
    ?>
    
  </form>
  <!-- Form-close -->
</div>

<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/plagin/mess-alert.js"></script>
<script src="assets/js/sweetalert.min.js"></script>
<script src="assets/js/imask.js"></script>
<script type="text/javascript">
  var phoneMask = IMask(
    document.getElementById('telefon'), {
      mask: '+{998}(00)000-00-00'
  });
  var regExpMask = IMask(
    document.getElementById('codeconfirm'),
    {
      mask: /^[1-9]\d{0,4}$/
    }
  );
</script>
<script type="text/javascript">
    function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            if (--timer < 0) {
                timer = duration;
                //window.alert('Ok');
                $('#smsmsg').text("Vaqt tugadi");
                document.getElementById('checksubmit').disabled=true;
                document.getElementById('time').style.display = "none";
            }
            else{
              display.textContent = minutes + ":" + seconds;
            }
        }, 1000);
    }
    <?
      if($_SESSION['action']=="checkcode" && time()-$_SESSION['send_time']<300){
    ?>
      var fiveMinutes = <? echo 300-(time()-$_SESSION['send_time']); ?>;

      var display = document.querySelector('#time');
      startTimer(fiveMinutes, display);
    <?
      }
    ?>

    $('#submitbtn').click(function() {
      let telefon = $('#telefon').val();
      if(telefon.length!=17){
        swal("Diqqat!", "Telefon raqimini kiriting", "warning");
        return 0;
      }
      let _csrf = $('#_csrf').val();
      $.ajax({
        url : "send-sms.php",
        type : "POST",
        data :{
          telefon:telefon,_csrf:_csrf,action:"sendsms"
        },
        success:function(data) {
          console.log(data);
          var obj = jQuery.parseJSON(data);
          if(obj.error == 0){
            swal("Good job!", obj.xabar, "success");
            $('#_csrf').val(obj._csrf);
            $('#codeinput').css("display","block");
            $('#telefon').prop("disabled", true);
            $('#submitbtn').css("display","none");
            $('#checkbtn').css("display","block");
            var fiveMinutes = 300;
            var display = document.querySelector('#time');
            startTimer(fiveMinutes, display);
          }
          else{
            swal("XATOLIK!", obj.xabar, "error");
          }
        },
        error:function(xhr) {
          swal("Kechirasiz internetda uzilish ro'y berdi. Internet aloqasini tekshiring!");
        }
      })
    });
    $('#checksubmit').click(function() {
      let codeconfirm = $('#codeconfirm').val();
      let _csrf = $('#_csrf').val();
      $.ajax({
        url : "send-sms.php",
        type : "POST",
        data :{
          codeconfirm:codeconfirm,_csrf:_csrf,action:"checkcode"
        },
        success:function(data) {
          var obj = jQuery.parseJSON(data);
          if(obj.error == 0){
            swal("Good job!", obj.xabar, "success");
            window.location.href = 'user/index.php';
          }
          else{
            swal("XATOLIK!", obj.xabar, "error");
          }
        },
        error:function(xhr) {
          swal("Kechirasiz internetda uzilish ro'y berdi. Internet aloqasini tekshiring!");
        }
      })
    });
    // swal("XATOLIK!", obj.xabar, "error");
</script>
</body>
</html>
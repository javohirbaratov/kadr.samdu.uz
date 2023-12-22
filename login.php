<?
// exit("Proflaktika ishlari olib borilmoqda");
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
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo.jpg"/>
  <title>Ro'yxatdan o'tish</title>
  <link rel="stylesheet" href="assets/css/nomalize.css"/>
  <link rel="stylesheet" href="assets/css/mess-alert.css"/>
  <link rel="stylesheet" href="assets/css/main.css"/>
</head>
<body class="login-page">
<div class="login-page--wrapper">
  <img
      class="login-page--wrapper-logo"
      src="assets/img/logo.jpg"
      alt="logo"
  />
  <!-- Form-open -->
  <form id="form" action="check.php" method="post">
    <div class="form-group">
      <label>Login</label>
      <input
          class="form-control"
          type="text"
          placeholder="Login kiriting"
          name="login"
          required
      />
      <div class="invalid-feedback">Login kiriting</div>
    </div>
    <div class="form-group">
      <label>Parol</label>
      <input
          class="form-control"
          type="password"
          placeholder="Parolni kiriting"
          name="parol"
          required
      />
      <div class="invalid-feedback">Parol kiriting</div>
    </div>
    <div class="form-group">
      <label for="check" class="d-flex">
        <input
            class="form-check"
            type="checkbox"
            id="check"
            name="remember"
        />
        <p>Meni eslab qol</p>
      </label>
      <input type="hidden" name="_csrf" value="<?=$_SESSION['_csrf']?>" id="_csrf">
    </div>
    <div class="form-group">
      <button
          class="btn btn-primary w-100"
          id="submit"
          type="submit"
          disabled
      >
        Yuborish
        <div class="lds-dual-ring btn-load"></div>
      </button>
    </div>
  </form>
  <!-- Form-close -->
</div>

<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/plagin/mess-alert.js"></script>
<script src="assets/js/app.js"></script>
</body>
</html>



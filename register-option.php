<?php
    session_start();
    include'config.php';
    $_SESSION['_csrf'] = md5(time());
?>
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo.jpg" />
    <title>Shaxsiy ma'lumotlarni ro'yxatdan o'tkazish</title>
    <? include 'meta.php'; ?>
    <link rel="stylesheet" href="assets/css/nomalize.css" />
    <link rel="stylesheet" href="assets/css/mess-alert.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="assets/js/imask.js"></script>
</head>

<body class="login-page">
    <div class="login-page--wrapper">
        
        <img
                class="login-page--wrapper-logo"
                src="https://hemis.samdu.uz/static/crop/3/9/250_250_90_3968016486.png"
                alt="logo"
                style="width: 80px;"
        />
        <br>
        
        <h3 style="text-align:center;">Sharof Rashidov nomidagi Samarqand davlat universiteti</h3><br>
        <p>KADRLAR BO'LIMI</p><br>
        <!-- Form-open -->
        <div class="form-group">
            <a href="open-register.php"><button class="btn btn-primary w-100" id="button" type="button" name="submit" style="background-color: #4CAF50;">
                <i class="fa fa-address-card-o"></i> Ma'lumotlarni kiritish
                <div class="lds-dual-ring btn-load"></div>
            </button></a>
        </div>
        <div class="form-group">
            <a href="check-person.php"><button class="btn btn-primary w-100" id="button" type="button" name="submit">
                <i class="fa fa-edit" aria-hidden="true"></i>Ma'lumotlarni tahrirlash
                <div class="lds-dual-ring btn-load"></div>
            </button></a>
        </div>
        <a href="login.php" class="nav-link float-right">Admin oynasi</a>
    
        <!-- Form-close -->
    </div>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/plagin/mess-alert.js"></script>
    <script src="appa.js"></script>
</body>

</html>
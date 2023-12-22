<?php


ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

session_start();

include 'model.php';


if (!isset($_SESSION["rol"])) {

        header('Location: ../login.php');

        exit();

    }

    if (isset($_SESSION["rol"])&&$_SESSION["rol"]!="admin") {

        header('Location: ../login.php');

        exit();

    }


 if((!isset($_SESSION["loginx"]) && $_SESSION["rol"]!="admin")){

    header('Location: ../login.php');

    exit();

  }

  if(empty($_SESSION['keyuser'])){

        $keyuser=rand(1000,9999);

        $_SESSION['keyuser']=$keyuser;



    }

    $_SESSION['_csrf'] = md5(time());
    $keyuser=$_SESSION['keyuser'];

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png"/>
  <title>Kadr- Admin</title>
  <link rel="stylesheet" href="assets/css/nomalize.css">
  <link rel="stylesheet" href="assets/css/all.min.css">
  <link rel="stylesheet" href="assets/css/mess-alert.css">
  <link rel="stylesheet" href="assets/css/main.css">
  <link rel="stylesheet" href="assets/css/responsive.css">
  <link rel="stylesheet" href="assets/css/table.css">
  <link rel="stylesheet" href="assets/css/modal.css">
  <link rel="stylesheet" href="assets/css/datatable.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
</head>
<body>
<!-- HEADER-OPEN -->
<header>
  <div class="container">
    <!--HEADER-OUTER-OPEN-->
    <div class="site-header__outer">
      <button class="btn btn-unset humburger-btn" type="button">
        <i class="far fa-bars"></i>
      </button>
      <form>
        <div class="input-group">
          <input class="form-control search-input" type="text" placeholder="Qidirish" id="searchInput">
          <div class="append">
            <button class="btn" id="searchClearBtn">
              <i class="far fa-search"></i>
            </button>
          </div>
        </div>
      </form>
      <ul class="site-header__outer--nav">
        
        <li>
          <div class="dropdown">
            <button class="btn btn-light dropdown-btn" type="button" drop-target="dropdown">
              <!--<span class="user-icon">
                <img src="assets/img/user-06.jpg" alt="">
              </span>-->
              <span class="btn-text">Sozlamalar</span>
            </button>
            <div class="dropdown-body" drop-id="dropdown">
              <a href="../logout.php" class="dropdown-item">
                <i class="fal fa-sign-out"></i>
                Chiqish
              </a>
            </div>
          </div>
        </li>
      </ul>
    </div>
    <!--HEADER-OUTER-CLOSE-->
    <!--SIDEBAR-OPEN-->
    <nav class="site-header__sidebar">
      <div class="site-header__sidebar--top">
        <a class="logo m-1 p-1" href="index.php">
          <p class="btn-text">Kadr</p>
        </a>
        <button class="btn-close" type="button" id="sidebarCloseBtn">
          <i class="far fa-arrow-left"></i>
        </button>
      </div>
      <div class="site-header__sidebar--inner">
        <ul class="site-header__sidebar--nav">
          <li class="nav-top">
            <span class="btn-text">Menu</span>
          </li>

          <li class="collapse ">
            <!-- Collapse-btn-open -->
            <a class="collapse-btn" href="#" title="Struktura">
              <span>
                <i class="far fa-user"></i>
                <span class="btn-text">Struktura</span>
              </span>
              <i class="arrow-bottom-icon"></i>
            </a>
            <!-- Collapse-btn-close -->
            <!-- Collapse-nav-open -->
            <ul class="collapse-nav">


                  <li>
                    <a href="bulim.php" title="Fakultet, Bo`lim, Bino, Grant">
                      <i class="far fa-eye"></i>
                      <span class="btn-text">Fakultet, Bo`lim, Bino, Grant</span>
                    </a>
                  </li>
                  <li>
                    <a href="addbulim.php" title="Fakultet, Bo`lim, Bino, Grant kiritish">
                      <i class="far fa-plus"></i>
                      <span class="btn-text">Fakultet, Bo`lim, Bino, Grant kiritish</span>
                    </a>
                  </li>

                  <li>
                    <a href="kafedra.php" title="Kafedra, Bo`linmalar">
                      <i class="far fa-eye"></i>
                      <span class="btn-text">Kafedra, Bo`linmalar</span>
                    </a>
                  </li>
                  <li>
                    <a href="addkafedra.php" title="Kafedra, Bo`linmalar  kiritish">
                      <i class="far fa-plus"></i>
                      <span class="btn-text">Kafedra, Bo`linmalar  kiritish</span>
                    </a>
                  </li>


                  <li>
                    <a href="lavozim.php" title="Lavozimlar">
                      <i class="fa fa-eye"></i>
                      <span class="btn-text">Lavozimlar</span>
                    </a>
                  </li>
                  <li>
                    <a href="addlavozim.php" title="Lavozimni  kiritish">
                      <i class="fa fa-plus"></i>
                      <span class="btn-text">Lavozimni  kiritish</span>
                    </a>
                  </li>


                  <li>
                    <a href="kadrlarbulimi.php" title="Kadrlar bo'limidagi yo`nalishlar">
                      <i class="far fa-eye"></i>
                      <span class="btn-text">Kadrlar bo'limidagi yo`nalishlar</span>
                    </a>
                  </li>
                  <li>
                    <a href="addkadrlarbulimi.php" title="Kadrlar bo'limidagi yo`nalishlarni  kiritish">
                      <i class="far fa-plus"></i>
                      <span class="btn-text">Kadrlar bo'limidagi yo`nalishlarni  kiritish</span>
                    </a>
                  </li>



            </ul>
            <!-- Collapse-nav-close -->
          </li>

          <li class="collapse ">
            <!-- Collapse-btn-open -->
            <a class="collapse-btn" href="#" title="Xodimlar">
              <span>
                <i class="far fa-user"></i>
                <span class="btn-text">Xodimlar</span>
              </span>
              <i class="arrow-bottom-icon"></i>
            </a>
            <!-- Collapse-btn-close -->
            <!-- Collapse-nav-open -->
            <ul class="collapse-nav">
              <li>
                <a href="xodim.php" title="Xodimlar">
                  <i class="far fa-eye"></i>
                  <span class="btn-text">Xodimlar</span>
                </a>
              </li>
              <li>
                <a href="addxodim.php" title="Xodimni kiritish">
                  <i class="far fa-plus"></i>
                  <span class="btn-text">Xodimni kiritish</span>
                </a>
              </li>
            </ul>
            <!-- Collapse-nav-close -->
          </li>

          <li class="collapse ">
            <!-- Collapse-btn-open -->
            <a class="collapse-btn" href="#" title="Ish joyi">
              <span>
                <i class="far fa-user"></i>
                <span class="btn-text">Ish joyi</span>
              </span>
              <i class="arrow-bottom-icon"></i>
            </a>
            <!-- Collapse-btn-close -->
            <!-- Collapse-nav-open -->
            <ul class="collapse-nav">
              <li>
                <a href="history.php" title="Ish joyi">
                  <i class="far fa-eye"></i>
                  <span class="btn-text">Ish joyi</span>
                </a>
              </li>
              <li>
                <a href="addhistory.php" title="Ish joyini kiritish">
                  <i class="far fa-plus"></i>
                  <span class="btn-text">Ish joyini kiritish</span>
                </a>
              </li>
            </ul>
            <!-- Collapse-nav-close -->
          </li>


          <li class="collapse ">
            <!-- Collapse-btn-open -->
            <a class="collapse-btn" href="#" title="Qarindoshlar">
              <span>
                <i class="far fa-user"></i>
                <span class="btn-text">Qarindoshlar</span>
              </span>
              <i class="arrow-bottom-icon"></i>
            </a>
            <!-- Collapse-btn-close -->
            <!-- Collapse-nav-open -->
            <ul class="collapse-nav">
              <li>
                <a href="qarindosh.php" title="Qarindoshlar">
                  <i class="far fa-eye"></i>
                  <span class="btn-text">Qarindoshlar</span>
                </a>
              </li>
              <li>
                <a href="addqarindosh.php" title="Qarindoshlarni kiritish">
                  <i class="far fa-plus"></i>
                  <span class="btn-text">Qarindoshlarni kiritish</span>
                </a>
              </li>
            </ul>
            <!-- Collapse-nav-close -->
          </li>

          <li>
            <a href="print.php" title="Buyruq shakllantirish">
              <i class="far fa-layer-plus"></i>
              <span class="btn-text">Buyruq shakllantirish</span>
            </a>
          </li>

          <li>
            <a href="addbuyruq.php" title="Buyruq nomer">
              <i class="far fa-layer-plus"></i>
              <span class="btn-text">Buyruq nomer</span>
            </a>
          </li>

          <li class="collapse">
            <!-- Collapse-btn-open -->
            <a class="collapse-btn" href="#" title="Xodimni ishga qabul qilish">
              <span>
                <i class="far fa-user-plus"></i>
                <span class="btn-text">Xodimni ishga qabul qilish</span>
              </span>
              <i class="arrow-bottom-icon"></i>
            </a>
            <!-- Collapse-btn-close -->
            <!-- Collapse-nav-open -->
            <ul class="collapse-nav">
              <li>
                <a href="ish.php" title="Ishga qabul qilinganlar">
                  <i class="far fa-eye"></i>
                  <span class="btn-text">Ishga qabul qilinganlar</span>
                </a>
              </li>
              <li>
                <a href="addish.php" title="Ishga qabul qilish">
                  <i class="far fa-plus"></i>
                  <span class="btn-text">Ishga qabul qilish</span>
                </a>
              </li>
            </ul>
            <!-- Collapse-nav-close -->
          </li>



          <li class="collapse ">
            <!-- Collapse-btn-open -->
            <a class="collapse-btn" href="#" title="Shtat birligi va lavozimni o`zgartirish">
              <span>
                <i class="far fa-user-plus"></i>
                <span class="btn-text">Shtat birligi va lavozimni o`zgartirish</span>
              </span>
              <i class="arrow-bottom-icon"></i>
            </a>
            <!-- Collapse-btn-close -->
            <!-- Collapse-nav-open -->
            <ul class="collapse-nav">
              <li>
                <a href="changelavozim.php" title="Shtat birligi va lavozim o`zgarganlar">
                  <i class="far fa-eye"></i>
                  <span class="btn-text">Shtat birligi va lavozim o`zgarganlar</span>
                </a>
              </li>
              <li>
                <a href="addchangelavozim.php" title="Shtat birligi va lavozimni o`zgartirish">
                  <i class="far fa-plus"></i>
                  <span class="btn-text">Shtat birligi va lavozimni o`zgartirish</span>
                </a>
              </li>
            </ul>
            <!-- Collapse-nav-close -->
          </li>


          <li class="collapse ">
            <!-- Collapse-btn-open -->
            <a class="collapse-btn" href="#" title="Moddiy javobgarlik">
              <span>
                <i class="far fa-user-plus"></i>
                <span class="btn-text">Moddiy javobgarlik</span>
              </span>
              <i class="arrow-bottom-icon"></i>
            </a>
            <!-- Collapse-btn-close -->
            <!-- Collapse-nav-open -->
            <ul class="collapse-nav">
              <li>
                <a href="moddiy.php" title="Moddiy javobgar Shaxslar">
                  <i class="far fa-eye"></i>
                  <span class="btn-text">Moddiy javobgar Shaxslar</span>
                </a>
              </li>
              <li>
                <a href="addmoddiy.php" title="Moddiy javobgar shaxsni kiritish">
                  <i class="far fa-plus"></i>
                  <span class="btn-text">Moddiy javobgar shaxsni kiritish</span>
                </a>
              </li>
            </ul>
            <!-- Collapse-nav-close -->
          </li>



          <li class="collapse ">
            <!-- Collapse-btn-open -->
            <a class="collapse-btn" href="#" title="Mehnat Ta`tili">
              <span>
                <i class="far fa-user-plus"></i>
                <span class="btn-text">Mehnat Ta`tili</span>
              </span>
              <i class="arrow-bottom-icon"></i>
            </a>
            <!-- Collapse-btn-close -->
            <!-- Collapse-nav-open -->
            <ul class="collapse-nav">
              <li>
                <a href="mehnattatili.php" title="Mahnat Ta`tillari">
                  <i class="far fa-eye"></i>
                  <span class="btn-text">Mahnat Ta`tillari</span>
                </a>
              </li>
              <li>
                <a href="addmehnattatili.php" title="Mehnat ta`tili berish">
                  <i class="far fa-plus"></i>
                  <span class="btn-text">Mehnat ta`tili berish</span>
                </a>
              </li>
            </ul>
            <!-- Collapse-nav-close -->
          </li>



          <li class="collapse ">
            <!-- Collapse-btn-open -->
            <a class="collapse-btn" href="#" title="Mehnat Ta`tilidan so`ng ishga chiqish">
              <span>
                <i class="far fa-user-plus"></i>
                <span class="btn-text">Mehnat Ta`tilidan so`ng ishga chiqish</span>
              </span>
              <i class="arrow-bottom-icon"></i>
            </a>
            <!-- Collapse-btn-close -->
            <!-- Collapse-nav-open -->
            <ul class="collapse-nav">
              <li>
                <a href="mtsish.php" title="Mahnat Ta`tilidan so`ng ishga chiqganlar">
                  <i class="far fa-eye"></i>
                  <span class="btn-text">Mahnat Ta`tilidan so`ng ishga chiqganlar</span>
                </a>
              </li>
              <li>
                <a href="addmtsish.php" title="Mehnat ta`tilidan so`ng ishga chiqarish ">
                  <i class="far fa-plus"></i>
                  <span class="btn-text">Mehnat ta`tilidan so`ng ishga chiqarish </span>
                </a>
              </li>
            </ul>
            <!-- Collapse-nav-close -->
          </li>



          <li class="collapse ">
            <!-- Collapse-btn-open -->
            <a class="collapse-btn" href="mehnattatilidanchaqirish.php" title="Mehnat Ta`tilidan chaqirish">
              <span>
                <i class="far fa-user-plus"></i>
                <span class="btn-text">Mehnat Ta`tilidan chaqirish</span>
              </span>
              <i class="arrow-bottom-icon"></i>
            </a>
            <!-- Collapse-btn-close -->
            <!-- Collapse-nav-open -->
            <ul class="collapse-nav">
              <li>
                <a href="mehnattatilidanchaqirish.php" title="Mehnat Ta`tilidan chaqirilganlar">
                  <i class="far fa-eye"></i>
                  <span class="btn-text">Mahnat Ta`tilidan chaqirilganlar</span>
                </a>
              </li>
              <li>
                <a href="addmehnattatilidanchaqirish.php" title="Mehnat ta`tilidan chaqirish ">
                  <i class="far fa-plus"></i>
                  <span class="btn-text">Mehnat ta`tilidan chaqirish </span>
                </a>
              </li>
            </ul>
            <!-- Collapse-nav-close -->
          </li>



          <li class="collapse ">
            <!-- Collapse-btn-open -->
            <a class="collapse-btn" href="#" title="Homiladorik Ta`tili">
              <span>
                <i class="far fa-user-plus"></i>
                <span class="btn-text">Homiladorik Ta`tili</span>
              </span>
              <i class="arrow-bottom-icon"></i>
            </a>
            <!-- Collapse-btn-close -->
            <!-- Collapse-nav-open -->
            <ul class="collapse-nav">
              <li>
                <a href="homiladorliktatili.php" title="Homiladorik Ta`tillari">
                  <i class="far fa-eye"></i>
                  <span class="btn-text">Homiladorik Ta`tillari</span>
                </a>
              </li>
              <li>
                <a href="addhomiladorliktatili.php" title="Homiladorik ta`tili berish">
                  <i class="far fa-plus"></i>
                  <span class="btn-text">Homiladorik ta`tili berish</span>
                </a>
              </li>
            </ul>
            <!-- Collapse-nav-close -->
          </li>



          <li class="collapse ">
            <!-- Collapse-btn-open -->
            <a class="collapse-btn" href="#" title="Homiladorik Ta`tilidan so`ng ishga chiqish">
              <span>
                <i class="far fa-user-plus"></i>
                <span class="btn-text">Homiladorik Ta`tilidan so`ng ishga chiqish</span>
              </span>
              <i class="arrow-bottom-icon"></i>
            </a>
            <!-- Collapse-btn-close -->
            <!-- Collapse-nav-open -->
            <ul class="collapse-nav">
              <li>
                <a href="htish.php" title="Homiladorik Ta`tilidan so`ng ishga chiqganlar">
                  <i class="far fa-eye"></i>
                  <span class="btn-text">Homiladorik Ta`tilidan so`ng ishga chiqganlar</span>
                </a>
              </li>
              <li>
                <a href="addhtish.php" title="Homiladorik ta`tilidan so`ng ishga chiqish ">
                  <i class="far fa-plus"></i>
                  <span class="btn-text">Homiladorik ta`tilidan so`ng ishga chiqish </span>
                </a>
              </li>
            </ul>
            <!-- Collapse-nav-close -->
          </li>



          <li class="collapse ">
            <!-- Collapse-btn-open -->
            <a class="collapse-btn" href="#" title="Haq to`lanmaydigan Ta`til">
              <span>
                <i class="far fa-user-plus"></i>
                <span class="btn-text">Haq to`lanmaydigan Ta`til</span>
              </span>
              <i class="arrow-bottom-icon"></i>
            </a>
            <!-- Collapse-btn-close -->
            <!-- Collapse-nav-open -->
            <ul class="collapse-nav">
              <li>
                <a href="haqsiztatil.php" title="Haq to`lanmaydigan Ta`tillar">
                  <i class="far fa-eye"></i>
                  <span class="btn-text">Haq to`lanmaydigan Ta`tillar</span>
                </a>
              </li>
              <li>
                <a href="addhaqsiztatil.php" title="Haq to`lanmaydigan ta`til berish">
                  <i class="far fa-plus"></i>
                  <span class="btn-text">Haq to`lanmaydigan ta`til berish</span>
                </a>
              </li>
            </ul>
            <!-- Collapse-nav-close -->
          </li>



          <li class="collapse ">
            <!-- Collapse-btn-open -->
            <a class="collapse-btn" href="#" title="Haq to`lanmaydigan tatilidan so`ng ishga chiqish">
              <span>
                <i class="far fa-user-plus"></i>
                <span class="btn-text">Haq to`lanmaydigan tatilidan so`ng ishga chiqish</span>
              </span>
              <i class="arrow-bottom-icon"></i>
            </a>
            <!-- Collapse-btn-close -->
            <!-- Collapse-nav-open -->
            <ul class="collapse-nav">
              <li>
                <a href="haqsizish.php" title="Haq to`lanmaydigan tatilidan so`ng ishga chiqganlar">
                  <i class="far fa-eye"></i>
                  <span class="btn-text">Haq to`lanmaydigan tatilidan so`ng ishga chiqganlar</span>
                </a>
              </li>
              <li>
                <a href="addhaqsizish.php" title="Haq to`lanmaydigan tatilidan so`ng ishga chiqish ">
                  <i class="far fa-plus"></i>
                  <span class="btn-text">Haq to`lanmaydigan tatilidan so`ng ishga chiqish </span>
                </a>
              </li>
            </ul>
            <!-- Collapse-nav-close -->
          </li>





          <li class="collapse ">
            <!-- Collapse-btn-open -->
            <a class="collapse-btn" href="#" title="Harbiy o’quv mashg’ulotga   yuborish">
              <span>
                <i class="far fa-user-plus"></i>
                <span class="btn-text">Harbiy o’quv mashg’ulotga   yuborish</span>
              </span>
              <i class="arrow-bottom-icon"></i>
            </a>
            <!-- Collapse-btn-close -->
            <!-- Collapse-nav-open -->
            <ul class="collapse-nav">
              <li>
                <a href="harbiytatil.php" title="Harbiy o’quv mashg’ulotga   yuborilganar">
                  <i class="far fa-eye"></i>
                  <span class="btn-text">Harbiy o’quv mashg’ulotga   yuborilganar</span>
                </a>
              </li>
              <li>
                <a href="addharbiytatil.php" title="Harbiy o’quv mashg’ulotga   yuborish ">
                  <i class="far fa-plus"></i>
                  <span class="btn-text">Harbiy o’quv mashg’ulotga   yuborish </span>
                </a>
              </li>
            </ul>
            <!-- Collapse-nav-close -->
          </li>


          <li class="collapse ">
            <!-- Collapse-btn-open -->
            <a class="collapse-btn" href="#" title="Harbiy o’quv mashg’ulotlaridan so`ng ishga chiqish">
              <span>
                <i class="far fa-user-plus"></i>
                <span class="btn-text">Harbiy o’quv mashg’ulotlaridan so`ng ishga chiqish</span>
              </span>
              <i class="arrow-bottom-icon"></i>
            </a>
            <!-- Collapse-btn-close -->
            <!-- Collapse-nav-open -->
            <ul class="collapse-nav">
              <li>
                <a href="harbiyish.php" title="Harbiy o’quv mashg’ulotlaridan so`ng ishga chiqganlar">
                  <i class="far fa-eye"></i>
                  <span class="btn-text">Harbiy o’quv mashg’ulotlaridan so`ng ishga chiqganlar</span>
                </a>
              </li>
              <li>
                <a href="addharbiyish.php" title="Harbiy o’quv mashg’ulotlaridan so`ng ishga chiqarish ">
                  <i class="far fa-plus"></i>
                  <span class="btn-text">Harbiy o’quv mashg’ulotlaridan so`ng ishga chiqarish </span>
                </a>
              </li>
            </ul>
            <!-- Collapse-nav-close -->
          </li>



          <li class="collapse ">
            <!-- Collapse-btn-open -->
            <a class="collapse-btn" href="#" title="Bola parvarishi uchun tatil">
              <span>
                <i class="far fa-graduation-cap"></i>
                <span class="btn-text">Bola parvarishi uchun tatil</span>
              </span>
              <i class="arrow-bottom-icon"></i>
            </a>
            <!-- Collapse-btn-close -->
            <!-- Collapse-nav-open -->
            <ul class="collapse-nav">
              <li>
                <a href="bolaparvarishi.php" title="Bola parvarishi uchun tatil olganlar">
                  <i class="far fa-eye"></i>
                  <span class="btn-text">Bola parvarishi uchun tatil olganlar</span>
                </a>
              </li>
              <li>
                <a href="addbolaparvarishi.php" title="Bola parvarishi uchun tatil berish">
                  <i class="far fa-plus"></i>
                  <span class="btn-text">Bola parvarishi uchun tatil berish</span>
                </a>
              </li>
            </ul>
            <!-- Collapse-nav-close -->
          </li>



          <li class="collapse ">
            <!-- Collapse-btn-open -->
            <a class="collapse-btn" href="#" title="Bola parvarish tatilidan so`ng ishga chiqish">
              <span>
                <i class="far fa-user-plus"></i>
                <span class="btn-text">Bola parvarish tatilidan so`ng ishga chiqish</span>
              </span>
              <i class="arrow-bottom-icon"></i>
            </a>
            <!-- Collapse-btn-close -->
            <!-- Collapse-nav-open -->
            <ul class="collapse-nav">
              <li>
                <a href="bpish.php" title="Bola parvarish tatilidan so`ng ishga chiqganlar">
                  <i class="far fa-eye"></i>
                  <span class="btn-text">Bola parvarish tatilidan so`ng ishga chiqganlar</span>
                </a>
              </li>
              <li>
                <a href="addbpish.php" title="Bola parvarish tatilidan so`ng ishga chiqish ">
                  <i class="far fa-plus"></i>
                  <span class="btn-text">Bola parvarish tatilidan so`ng ishga chiqish </span>
                </a>
              </li>
            </ul>
            <!-- Collapse-nav-close -->
          </li>



          <li class="collapse ">
            <!-- Collapse-btn-open -->
            <a class="collapse-btn" href="#" title="Xodimlar mukofotlari">
              <span>
                <i class="far fa-gift"></i>
                <span class="btn-text">Xodimlar mukofotlari</span>
              </span>
              <i class="arrow-bottom-icon"></i>
            </a>
            <!-- Collapse-btn-close -->
            <!-- Collapse-nav-open -->
            <ul class="collapse-nav">
              <li>
                <a href="mukofot.php" title="Xodimlar mukofotlari">
                  <i class="far fa-eye"></i>
                  <span class="btn-text">Xodimlar mukofotlari</span>
                </a>
              </li>
              <li>
                <a href="addmukofot.php" title="Xodimlarni mukofotlarini kiritish">
                  <i class="far fa-plus"></i>
                  <span class="btn-text">Xodimlarni mukofotlarini kiritish</span>
                </a>
              </li>
            </ul>
            <!-- Collapse-nav-close -->
          </li>



          <li class="collapse ">
            <!-- Collapse-btn-open -->
            <a class="collapse-btn" href="#" title="Xodim biladigan Tillar">
              <span>
                <i class="far fa-language"></i>
                <span class="btn-text">Xodim biladigan Tillar</span>
              </span>
              <i class="arrow-bottom-icon"></i>
            </a>
            <!-- Collapse-btn-close -->
            <!-- Collapse-nav-open -->
            <ul class="collapse-nav">
              <li>
                <a href="lang.php" title="Xodim biladigan Tillar">
                  <i class="far fa-eye"></i>
                  <span class="btn-text">Xodim biladigan Tillar</span>
                </a>
              </li>
              <li>
                <a href="addlang.php" title="Xodimla biladigan Tillarni kiritish">
                  <i class="far fa-plus"></i>
                  <span class="btn-text">Xodimla biladigan Tillarni kiritish</span>
                </a>
              </li>
            </ul>
            <!-- Collapse-nav-close -->
          </li>


          <li class="collapse">
            <!-- Collapse-btn-open -->
            <a class="collapse-btn" href="#" title="Ustama">
              <span>
                <i class="fa fa-briefcase"></i>
                <span class="btn-text">Ustama</span>
              </span>
              <i class="arrow-bottom-icon"></i>
            </a>
            <!-- Collapse-btn-close -->
            <!-- Collapse-nav-open -->
            <ul class="collapse-nav">
              <li>
                <a href="ustama.php" title="Ustamalar">
                  <i class="fa fa-eye"></i>
                  <span class="btn-text">Ustamalar</span>
                </a>
              </li>
              <li>
                <a href="addustama.php" title="Ustamani  kiritish">
                  <i class="fa fa-plus"></i>
                  <span class="btn-text">Ustamani  kiritish</span>
                </a>
              </li>
            </ul>
            <!-- Collapse-nav-close -->
          </li>

          <li class="collapse">
            <!-- Collapse-btn-open -->
            <a class="collapse-btn" href="#" title="Mukofot berish">
              <span>
                <i class="far fa-server"></i>
                <span class="btn-text">Mukofot berish</span>
              </span>
              <i class="arrow-bottom-icon"></i>
            </a>
            <!-- Collapse-btn-close -->
            <!-- Collapse-nav-open -->
            <ul class="collapse-nav">
              <li>
                <a href="muk.php" title="Mukofot berilganlar">
                  <i class="far fa-eye"></i>
                  <span class="btn-text">Mukofot berilganlar</span>
                </a>
              </li>
              <li>
                <a href="addmuk.php" title="Mukofot berish">
                  <i class="far fa-plus"></i>
                  <span class="btn-text">Mukofot berish</span>
                </a>
              </li>
            </ul>
            <!-- Collapse-nav-close -->
          </li>
          <li class="collapse">
            <!-- Collapse-btn-open -->
            <a class="collapse-btn" href="#" title="Mehnat shartnomasini bekor qilishlar">
              <span>
                <i class="far fa-server"></i>
                <span class="btn-text">Mehnat shartnomasini bekor qilishlar</span>
              </span>
              <i class="arrow-bottom-icon"></i>
            </a>
            <!-- Collapse-btn-close -->
            <!-- Collapse-nav-open -->
            <ul class="collapse-nav">
              <li>
                <a href="mshbekor.php" title="Mehnat shartnomasini bekor qilishlar">
                  <i class="far fa-eye"></i>
                  <span class="btn-text">Mehnat shartnomasini bekor qilishlar</span>
                </a>
              </li>
              <li>
                <a href="addmshbekor.php" title="Mehnat shartnomasini bekor qilishni  kiritish">
                  <i class="far fa-plus"></i>
                  <span class="btn-text">Mehnat shartnomasini bekor qilishni  kiritish</span>
                </a>
              </li>
            </ul>
            <!-- Collapse-nav-close -->
          </li>




          <li class="collapse">
            <!-- Collapse-btn-open -->
            <a class="collapse-btn" href="#" title="Doktorantura safidan chiqarishlar">
              <span>
                <i class="far fa-server"></i>
                <span class="btn-text">Doktorantura safidan chiqarishlar</span>
              </span>
              <i class="arrow-bottom-icon"></i>
            </a>
            <!-- Collapse-btn-close -->
            <!-- Collapse-nav-open -->
            <ul class="collapse-nav">
              <li>
                <a href="dschiqish.php" title="Doktorantura safidan chiqarishlar">
                  <i class="far fa-eye"></i>
                  <span class="btn-text">Doktorantura safidan chiqarishlar</span>
                </a>
              </li>
              <li>
                <a href="adddschiqish.php" title="Doktorantura safidan chiqarishni  kiritish">
                  <i class="far fa-plus"></i>
                  <span class="btn-text">Doktorantura safidan chiqarishni  kiritish</span>
                </a>
              </li>
            </ul>
            <!-- Collapse-nav-close -->
          </li>


          <li class="collapse">
            <!-- Collapse-btn-open -->
            <a class="collapse-btn" href="#" title="Sababsiz ishda yuqlar">
              <span>
                <i class="far fa-server"></i>
                <span class="btn-text">Sababsiz ishda yuqlar</span>
              </span>
              <i class="arrow-bottom-icon"></i>
            </a>
            <!-- Collapse-btn-close -->
            <!-- Collapse-nav-open -->
            <ul class="collapse-nav">
              <li>
                <a href="sababyuq.php" title="Sababsiz ishda yuqlar">
                  <i class="far fa-eye"></i>
                  <span class="btn-text">Sababsiz ishda yuqlar</span>
                </a>
              </li>
              <li>
                <a href="addsababyuq.php" title="Sababsiz ishda yuqni  kiritish">
                  <i class="far fa-plus"></i>
                  <span class="btn-text">Sababsiz ishda yuqni  kiritish</span>
                </a>
              </li>
            </ul>
            <!-- Collapse-nav-close -->
          </li>



          <li class="collapse">
            <!-- Collapse-btn-open -->
            <a class="collapse-btn" href="#" title="Diplomlar">
              <span>
                <i class="far fa-file"></i>
                <span class="btn-text">Diplomlar</span>
              </span>
              <i class="arrow-bottom-icon"></i>
            </a>
            <!-- Collapse-btn-close -->
            <!-- Collapse-nav-open -->
            <ul class="collapse-nav">
              <li>
                <a href="diplom.php" title="Diplomlar">
                  <i class="far fa-eye"></i>
                  <span class="btn-text">Diplomlar</span>
                </a>
              </li>
              <li>
                <a href="adddiplom.php" title="Diplomni  kiritish">
                  <i class="far fa-plus"></i>
                  <span class="btn-text">Diplomni  kiritish</span>
                </a>
              </li>
            </ul>
            <!-- Collapse-nav-close -->
          </li>



          <li class="collapse">
            <!-- Collapse-btn-open -->
            <a class="collapse-btn" href="#" title="Ilmiy rahbarni o’zgartirish">
              <span>
                <i class="far fa-file"></i>
                <span class="btn-text">Ilmiy rahbarni o’zgartirish</span>
              </span>
              <i class="arrow-bottom-icon"></i>
            </a>
            <!-- Collapse-btn-close -->
            <!-- Collapse-nav-open -->
            <ul class="collapse-nav">
              <li>
                <a href="iruzgarish.php" title="Ilmiy rahbarni o’zgartirish">
                  <i class="far fa-eye"></i>
                  <span class="btn-text">Ilmiy rahbarni o’zgartirish</span>
                </a>
              </li>
              <li>
                <a href="addiruzgarish.php" title="Ilmiy rahbarni o’zgarganlar">
                  <i class="far fa-plus"></i>
                  <span class="btn-text">Ilmiy rahbarni o’zgarganlar</span>
                </a>
              </li>
            </ul>
            <!-- Collapse-nav-close -->
          </li>



          <li class="collapse">
            <!-- Collapse-btn-open -->
            <a class="collapse-btn" href="#" title="Soatbay asosida bajariladigan ish hajmini tasdiqlash">
              <span>
                <i class="far fa-file"></i>
                <span class="btn-text">Soatbay asosida bajariladigan ish hajmini tasdiqlash</span>
              </span>
              <i class="arrow-bottom-icon"></i>
            </a>
            <!-- Collapse-btn-close -->
            <!-- Collapse-nav-open -->
            <ul class="collapse-nav">
              <li>
                <a href="soatbay.php" title="Soatbay asosida bajariladigan ish hajmini tasdiqlash">
                  <i class="far fa-eye"></i>
                  <span class="btn-text">Soatbay asosida bajariladigan ish hajmini tasdiqlash</span>
                </a>
              </li>
              <li>
                <a href="addsoatbay.php" title="Soatbay asosida bajariladigan ish hajmini tasdiqlanganlar">
                  <i class="far fa-plus"></i>
                  <span class="btn-text">Soatbay asosida bajariladigan ish hajmini tasdiqlanganlar</span>
                </a>
              </li>
            </ul>
            <!-- Collapse-nav-close -->
          </li>



          <li class="collapse">
            <!-- Collapse-btn-open -->
            <a class="collapse-btn" href="#" title="Diplom turlari">
              <span>
                <i class="far fa-clone"></i>
                <span class="btn-text">Diplom turlari</span>
              </span>
              <i class="arrow-bottom-icon"></i>
            </a>
            <!-- Collapse-btn-close -->
            <!-- Collapse-nav-open -->
            <ul class="collapse-nav">
              <li>
                <a href="diplomtype.php" title="Diplom turlari">
                  <i class="far fa-eye"></i>
                  <span class="btn-text">Diplom turlari</span>
                </a>
              </li>
              <li>
                <a href="adddiplomtype.php" title="Diplom turlarini  kiritish">
                  <i class="far fa-plus"></i>
                  <span class="btn-text">Diplom turlarini  kiritish</span>
                </a>
              </li>
            </ul>
            <!-- Collapse-nav-close -->
          </li>




          <li class="collapse">
            <!-- Collapse-btn-open -->
            <a class="collapse-btn" href="#" title="Ilmiy daraja berilganligini tasdiqlash">
              <span>
                <i class="far fa-clone"></i>
                <span class="btn-text">Ilmiy daraja berilganligini tasdiqlash</span>
              </span>
              <i class="arrow-bottom-icon"></i>
            </a>
            <!-- Collapse-btn-close -->
            <!-- Collapse-nav-open -->
            <ul class="collapse-nav">
              <li>
                <a href="idberish.php" title="Ilmiy daraja berilganligini tasdiqlash">
                  <i class="far fa-eye"></i>
                  <span class="btn-text">Ilmiy daraja berilganligini tasdiqlash</span>
                </a>
              </li>
              <li>
                <a href="addidberish.php" title="Ilmiy daraja berilganligini tasdiqlashni  kiritish">
                  <i class="far fa-plus"></i>
                  <span class="btn-text">Ilmiy daraja berilganligini tasdiqlashni  kiritish</span>
                </a>
              </li>
            </ul>
            <!-- Collapse-nav-close -->
          </li>



          <li class="collapse">
            <!-- Collapse-btn-open -->
            <a class="collapse-btn" href="#" title="Hayfsan bekor qilish">
              <span>
                <i class="far fa-clone"></i>
                <span class="btn-text">Hayfsan bekor qilish</span>
              </span>
              <i class="arrow-bottom-icon"></i>
            </a>
            <!-- Collapse-btn-close -->
            <!-- Collapse-nav-open -->
            <ul class="collapse-nav">
              <li>
                <a href="hbekorqilish.php" title="Hayfsan bekor qilish">
                  <i class="far fa-eye"></i>
                  <span class="btn-text">Hayfsan bekor qilish</span>
                </a>
              </li>
              <li>
                <a href="addhbekorqilish.php" title="Hayfsan bekor qilishni  kiritish">
                  <i class="far fa-plus"></i>
                  <span class="btn-text">Hayfsan bekor qilishni  kiritish</span>
                </a>
              </li>
            </ul>
            <!-- Collapse-nav-close -->
          </li>



          <li class="collapse">
            <!-- Collapse-btn-open -->
            <a class="collapse-btn" href="#" title="Adminlar">
              <span>
                <i class="far fa-user-shield"></i>
                <span class="btn-text">Adminlar</span>
              </span>
              <i class="arrow-bottom-icon"></i>
            </a>
            <!-- Collapse-btn-close -->
            <!-- Collapse-nav-open -->
            <ul class="collapse-nav">
              <li>
                <a href="admin.php" title="Adminlar">
                  <i class="far fa-eye"></i>
                  <span class="btn-text">Adminlar</span>
                </a>
              </li>
              <li>
                <a href="addadmin.php" title="Adminni  kiritish">
                  <i class="far fa-plus"></i>
                  <span class="btn-text">Adminni  kiritish</span>
                </a>
              </li>
            </ul>
            <!-- Collapse-nav-close -->
          </li>

          <li>
            <a href="shtat.php" title="Shtatlar">
              <i class="fas fa-layer-group"></i>
              <span class="btn-text">Shtatlar</span>
            </a>
          </li>
          <li>
            <a href="addshtat.php" title="Shtatni Shakllantirish">
              <i class="far fa-layer-plus"></i>
              <span class="btn-text">Shtatni Shakllantirish</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <!--SIDEBAR-CLOSE-->
    <div class="sidebar-back"></div>
  </div>
</header>
<!-- HEADER-CLOSE -->


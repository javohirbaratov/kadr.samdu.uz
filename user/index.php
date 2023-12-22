<?php include_once 'ximoya.php'; ?>
<!DOCTYPE html>
<html lang="uz">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Malumotlarni tahrirlash</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: OnePage - v4.9.2
  * Template URL: https://bootstrapmade.com/onepage-multipurpose-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="index.php">Samdu Kadrlar Bo'limi</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="update.php">Shaxsiy malumotlarni tahrirlash</a></li>
          
          <li><a class="getstarted scrollto" href="../logout.php">Chiqish</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="" class="d-flex align-items-center">
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
      <div class="row justify-content-center">
        <div class="col-xl-7 col-lg-9 text-center">
          <?php 
            $id = $_SESSION['id'];
            $sql = mysqli_query($link,"SELECT * FROM xodim_temp WHERE id='$id'");
            $fetch = mysqli_fetch_assoc($sql);
            $object = (object) $fetch;
            $rasmdata = file_get_contents("../bot/uploads/".$object->rasm);
            $rasmdata = base64_encode($rasmdata);
            $pasportskaner = file_get_contents("../bot/uploads/".$object->passport);
            $pasportskaner = base64_encode($pasportskaner);
            $obyektivka = file_get_contents("../bot/uploads/".$object->obyektivka);
            $obyektivka = base64_encode($obyektivka);            
            $tarjimayi_hol = file_get_contents("../bot/uploads/".$object->tarjimayi_hol);
            $tarjimayi_hol = base64_encode($tarjimayi_hol);
            $viloyat_id = $object->viloyat_id;
            $tuman_id = $object->tuman_id;
            $vsql = mysqli_query($link,"SELECT * FROM viloyat WHERE id='$viloyat_id'");
            $viloyat = mysqli_fetch_assoc($vsql);
            $tsql = mysqli_query($link,"SELECT * FROM tuman WHERE id='$tuman_id'");
            $tuman = mysqli_fetch_assoc($tsql);
          ?>
          <h1 style="color:red">Sizning ma'lumotlaringiz qabul qilinmadi</h1>
          <h2>Qoldirilgan xabar : <?=$object->xabar?></h2>
        </div>
      </div>


      <div class="row icon-boxes">
        <div class="col-md-4 col-lg-4 align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="200">
          <div class="icon-box">
            <img style="width: 350px;" src="data:image/png;base64, <?=$rasmdata?>" />
          </div>
        </div>
        <div class="col-md-8 col-lg-8 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="200">
          <table class="table table-bordered table-striped">
            <tr>
              <td>Famia Ism Sharif</td>
              <td><?=$object->familya?> <?=$object->ism?> <?=$object->otch?></td>
            </tr>
            <tr>
              <td>JSHSHIR</td>
              <td><?=$object->jshir?></td>
            </tr>
            <tr>
              <td>Pasport SN</td>
              <td><?=$object->nomer?></td>
            </tr>
            <tr>
              <td>Pasport berilgan sana</td>
              <td><?=$object->pasportdate?></td>
            </tr>
            <tr>
              <td>Pasport amal qilish muddati</td>
              <td><?=$object->pasportenddate?></td>
            </tr>
            <tr>
              <td>Pasport berilgan joy</td>
              <td><?=$object->pasportjoy?></td>
            </tr>
            <tr>
              <td>Pasport skaneri</td>
              <td><a download="Pasport.pdf" href="data:application/pdf;base64,<?=$pasportskaner?>"><button type="button" class="btn btn-primary"><i class="bx bx-download"></i> Yuklash</button> </a></td>
            </tr>
            <tr>
              <td>Tug'ilgan sana</td>
              <td><?=$object->birthdate?></td>
            </tr>
            <tr>
              <td>Jinsi</td>
              <td><?=$object->jinsi?></td>
            </tr>
            <tr>
              <td>Millati</td>
              <td><?=$object->millati?></td>
            </tr>
            <tr>
              <td>Fuqaroligi</td>
              <td><?=$object->fuqaroligi?></td>
            </tr>
            <tr>
              <td>Partiyaviyligi</td>
              <td><?=$object->partiyaviyligi?></td>
            </tr>
            <tr>
              <td>Harbiy hizmat o'taganligi</td>
              <td>
                <?=$object->xarbiy?>
                <?
                  if($object->xguvohnoma!=""){
                    $xguvohnoma = file_get_contents("../bot/uploads/".$object->xguvohnoma);
                    $xguvohnoma = base64_encode($xguvohnoma);
                    ?>
                    <a download="Harbiyguvohnoma.pdf" href="data:application/pdf;base64,<?=$xguvohnoma?>"><button type="button" class="btn btn-primary"><i class="bx bx-download"></i> Yuklash</button> </a>
                    <?
                  }
                ?>
              </td>
            </tr>
            <tr>
              <td>Tibbiy ko'rikning amal qilish muddati</td>
              <td><?=$object->tkmuddati?></td>
            </tr>
            <tr>
              <td>Turar joy manzil</td>
              <td><?=$object->manzil?></td>
            </tr>
            <tr>
              <td>Doimiy yashash manzili</td>
              <td><?=$object->doimiy?></td>
            </tr>
            <tr>
              <td>Telefon raqami</td>
              <td><?=$object->telefon?></td>
            </tr>
            <tr>
              <td>E-mail</td>
              <td><?=$object->pochta?></td>
            </tr>
            <tr>
              <td>Oialaviy ahvoli</td>
              <td><?=$object->oilaviyahvoli?></td>
            </tr>
            <tr>
              <td>Tug'ilgan viloyat</td>
              <td><?=$viloyat['nomi']?></td>
            </tr>
            <tr>
              <td>Tug'ilgan tumani</td>
              <td><?=$tuman['nomi']?></td>
            </tr>
            <tr>
              <td>Obyektivka</td>
              <?
                $obname = explode(".", $object->obyektivka);
              ?>
              <td><a download="obyektivka.<?=$obname[1]?>" href="data:application/msword;base64,<?=$obyektivka?>"><button type="button" class="btn btn-primary"><i class="bx bx-download"></i> Yuklash</button> </a></td>
            </tr>
            <tr>
              <td>Tarjimayi hol</td>
              <td><a download="Tarjimaiyhol.pdf" href="data:application/pdf;base64,<?=$tarjimayi_hol?>"><button type="button" class="btn btn-primary"><i class="bx bx-download"></i> Yuklash</button> </a></td>
            </tr>
            <tr>
              <td>Biladigan chet tillari</td>
              <td><?=$object->chettili?></td>
            </tr>
            <tr>
              <td>Davlat mukofotlari</td>
              <td><?=$object->davlatmukofoti?></td>
            </tr>
            <tr>
              <td>Idoraviy mukofotlar</td>
              <td><?=$object->idoramukofoti?></td>
            </tr>
            <tr>
              <td>Malaka oshirilgan tashkilot</td>
              <td><?=$object->malakatashkilot?></td>
            </tr>
            <tr>
              <td>Malaka oshirilgan yo'nalish</td>
              <td><?=$object->malakayunalish?></td>
            </tr>
            <tr>
              <td>Malaka oshirilgan davr</td>
              <td><?=$object->malakadavr?> dan <?=$object->malakadavr2?> gacha</td>
            </tr>
            <tr>
              <td>Diplomlar va o'qish joyidan malumotnomalar</td>
              <td>
                
                <?
                  $diplom_name = [];
                  $diplom_name += ['diplom1'=>"O'rta maxsus kasb-hunar kolleji diplomi"];
                  $diplom_name += ['diplom2'=>"Bakalavr diplomi"];
                  $diplom_name += ['diplom3'=>"Ikkinchi mutaxasislik diplomi"];
                  $diplom_name += ['diplom4'=>"Magistrlik diplomi"];
                  $diplom_name += ['diplom5'=>"PhD diplomi"];
                  $diplom_name += ['diplom6'=>"DSc diplomi"];
                  $diplom_name += ['diplom7'=>"Katta ilmiy xodimlik diplomi"];
                  $diplom_name += ['diplom8'=>"Dotsentlik diplomi"];
                  $diplom_name += ['diplom9'=>"Professorlik diplomi"];
                  $diplom_name += ['diplom10'=>"Akademiklik diplomi"];
                  $diplom_name += ['diplom11'=>"Diplom"];
                  $diplom_name += ['diplom12'=>"Diplom_q"];
                  for ($i=1; $i <12 ; $i++) {
                    $d = "diplom".$i;
                    $dname = $d;
                    if($object->$d!=""){
                      $d = file_get_contents("../bot/uploads/".$object->$d);
                      $d = base64_encode($d);
                      ?>
                      <p><?=$diplom_name[$dname]?> - 
                      <a download="<?=$diplom_name[$dname]?>.pdf" href="data:application/pdf;base64,<?=$d?>"><button type="button" class="btn btn-primary"><i class="bx bx-download"></i> Yuklash</button> </a></p>
                      <?
                    }
                  }
                ?>
              </td>
            </tr>
          </table>
        </div>
        
        <?
          foreach ($object as $key => $value) {
            break;
            ?>
            <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="200">
              <div class="icon-box">
                <div class="icon"><i class="ri-stack-line"></i></div>
                <h4 class="title"><a href=""><?=$key?></a></h4>
                <p class="description">
                  <?=$value?>
                </p>
              </div>
            </div>
            <?
          }

        ?>
      </div>
    </div>
  </section><!-- End Hero -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>SamDU KADRLAR BO'LIMI</h3>
            <p>
              Universitet xiyoboni <br>
              15-uy<br>
              <br>
              <strong>Telefon:</strong> +998 66 2403848<br>
              <strong>Email:</strong> saidqulov98@bk.ru<br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Foydali linklar</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="//www.samdu.uz">Samarqand davlat universiteti</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="//my.samdu.uz">Interaktiv xizmatlar</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="//kadr-info.uz">Kadrlar bo'limi</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="//kadr.samdu.uz">Kadrlar bo'limi</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Maxfiylik siyosatit</a></li>
            </ul>
          </div>

          

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Ish vaqti</h4>
            <p>8:00 dan 17:00 gacha</p>
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>Kadrlar bo'limi</span></strong>. Barcha huquqlar ximoyalangan
        </div>
        <div class="credits">          
          Ishlab chiqildi <a href="https://kadr.samdu.uz/">Kadrlar bo'limi</a>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
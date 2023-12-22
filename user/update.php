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
  <script src="../assets/js/imask.js"></script>
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
          
          <li><a class="getstarted scrollto" href="../logout">Chiqish</a></li>
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
          <h1>Malumotlarni tahrirlash</h1>          
        </div>
      </div>
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
          if($fetch['status']=="refused"){
        ?>
      <div class="row icon-boxes">
        <div class="col-md-12 col-lg-12 align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="200">
          <div class="icon-box">
            <form id="form" action="update-user-data.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Iltimos familyangizni kiriting!</label>
                <input class="form-control" type="text" placeholder="Familya" value="<?=$object->familya?>" name="familya" required />
                <div class="invalid-feedback">Eslatma ma'lumotlar lotin alifbosiga asoslanga o'zbek alifbosida kiritilsin</div>
            </div>
            <div class="form-group">
                <label>Ismingizni kiriting!</label>
                <input class="form-control" type="text" placeholder="Ism" value="<?=$object->ism?>" name="ism" required />
                <div class="invalid-feedback">Eslatma ma'lumotlar lotin alifbosiga asoslanga o'zbek alifbosida kiritilsin</div>
            </div>
            <div class="form-group">
                <label>Sharifingizni kiriting!</label>
                <input class="form-control" type="text" placeholder="Sharifingiz" value="<?=$object->otch?>" name="otch" required />
                <div class="invalid-feedback">Eslatma ma'lumotlar lotin alifbosiga asoslanga o'zbek alifbosida kiritilsin</div>
            </div>
            <div class="form-group">
                <label>JSHIRni kiriting!</label>
                <input class="form-control" type="text" value="<?=$object->jshir?>" placeholder="______________" name="jshir" required id="jshshir" />
                <script type="text/javascript">
                var regExpMask = IMask(
                    document.getElementById('jshshir'), {
                        mask: /^[0-9]\d{0,13}$/
                    });
                </script>
                <div class="invalid-feedback">Eslatma ma'lumotlar 14ta raqamdan kam bo'lmagan xolatda kiritilsin</div>
            </div>
            <div class="form-group">
                <label>Pasport seriya va raqamini kiriting</label>
                <input class="form-control" value="<?=$object->nomer?>" type="text" placeholder="_______" name="nomer" required max="7" min="7" />
                <p class="help-blpock">Namuna : AB1234567</p>
                <div class="invalid-feedback">Pasport seriya va raqamini kiriting</div>
            </div>

            <div class="form-group">
                <label>Pasport berilgan sananggizni kiriting </label>
                <input class="form-control" type="text" value="<?=$object->pasportdate?>" name="pasportdate" required id="psana1" />
                <script type="text/javascript">
                var dateMask = IMask(
                    document.getElementById('psana1'), {
                        mask: Date,
                        min: new Date(2010, 0, 1),
                        max: new Date(2050, 0, 1),
                        lazy: false
                    });
                </script>
                <div class="invalid-feedback">Pasport berilgan sananggizni kiriting </div>
            </div>
            <div class="form-group">
                <label>Pasportning amal qilish muddatini kiriting!</label>
                <input class="form-control" type="text" value="<?=$object->pasportenddate?>" placeholder="Login kiriting" name="pasportenddate" required id="psana2" />
                <script type="text/javascript">
                var dateMask = IMask(
                    document.getElementById('psana2'), {
                        mask: Date,
                        min: new Date(2010, 0, 1),
                        max: new Date(2050, 0, 1),
                        lazy: false
                    });
                </script>
                <div class="invalid-feedback">Pasportning amal qilish muddatini kiriting </div>
            </div>
            <div class="form-group">
                <label>Pasport berilgan joyni kiriting!</label>
                <input class="form-control" type="text" value="<?=$object->pasportjoy?>" placeholder="Kiriting" name="pasportjoy" required />
                <p class="help-blpock">Namuna : Samarqand viloyati Samarqand shahar IIB</p>
                <div class="invalid-feedback">Pasport berilgan joyni kiriting!</div>
            </div>
            <div class="form-group">
                <label>Oilaviy ahvoli</label>
                <select name="oilaviyahvoli" id="oilaviyahvoli" required class="form-select">
                    <option value="Uylanmagan" <?php if($object->oilaviyahvoli=="Uylanmagan"){ echo "selected"; } ?>>Uylanmagan</option>
                    <option value="Turmushga chiqmagan" <?php if($object->oilaviyahvoli=="chiqmagan"){ echo "selected"; } ?>>Turmushga chiqmagan</option>
                    <option value="Oilali" <?php if($object->oilaviyahvoli=="Oilali"){ echo "selected"; } ?>>Oilali</option>
                    <option value="Ajrashgan" <?php if($object->oilaviyahvoli=="Ajrashgan"){ echo "selected"; } ?>>Ajrashgan</option>
                    <option value="Beva" <?php if($object->oilaviyahvoli=="Beva"){ echo "selected"; } ?>>Beva</option>
                </select>
                <div class="invalid-feedback">Oilaviy ahvolini kiriting</div>
            </div>


            <div class="form-group">
                <label>Tug'ilgan viloyatni tanlang</label>
                <select name="viloyat_id" id="viloyat_id" required class="js-example-data-ajax form-select"> 
                <option value="Boshqa">Boshqa</option>
                    <?php
                $sql=mysqli_query($link,"SELECT * FROM viloyat");
                  while ($res=mysqli_fetch_assoc($sql)){?>              
                    <option value="<?=$res['id'];?>" <?php if($object->viloyat_id==$res['id']){ echo "selected"; } ?> ><?=$res['nomi'];?></option>
                  <?php
                  }
                ?>
                </select>
                <div class="invalid-feedback">Viloyatni tanlang</div>
            </div>


           <div class="form-group" id="tuman">
                <label>Tug'ilgan tumanni tanlang</label>
                <select name="tuman_id" id="tuman_id" required class="js-example-data-ajax form-select">
                    <?php
                     $v_id = $object->viloyat_id;
                $sql2=mysqli_query($link,"SELECT * FROM tuman where vil_id = '$v_id'");
                  while ($res2=mysqli_fetch_assoc($sql2)){?>              
                    <option value="<?=$res2['id'];?>" <?php if($object->tuman_id==$res2['id']){ echo "selected"; } ?> ><?=$res2['nomi'];?></option>
                  <?php
                  }
                ?>
                </select>
                <div class="invalid-feedback">Tumanni tanlang</div>
            </div>



            <div class="form-group">
                <label>Rasmingizni fayl qilib yuboring fayl turi JPG formatda bo'lsin : (2Mbdan oshmasin)</label>
                <input class="form-control" type="file" name="rasm" required accept=".jpg" />
                <div class="invalid-feedback">File yuklanish shart</div>
            </div>
            <div class="form-group">
                <label>Millatni tanlang :</label>
                <select name="millati" class="form-control">
                    <option value="-1">~ Tanlang ~</option>
                    <option <?php if($object->millati==filter("O'zbek")){ echo "selected"; } ?>>O'zbek</option>
                    <option <?php if($object->millati==filter("Rus")){ echo "selected"; } ?>>Rus</option>
                    <option <?php if($object->millati==filter("Tojik")){ echo "selected"; } ?>>Tojik</option>
                    <option <?php if($object->millati==filter("Qozoq")){ echo "selected"; } ?>>Qozoq</option>
                    <option <?php if($object->millati==filter("Qirg")){ echo "selected"; } ?>>Qirg'iz</option>
                    <option <?php if($object->millati==filter("Turkman")){ echo "selected"; } ?>>Turkman</option>
                    <option <?php if($object->millati==filter("Tatar")){ echo "selected"; } ?>>Tatar</option>
                    <option <?php if($object->millati==filter("Boshqa")){ echo "selected"; } ?>>Boshqa</option>
                </select>
                <div class="invalid-feedback">Malumotni tanlang</div>
            </div>
            <div class="form-group">
                <label>Fuqarolikni tanlang :</label>
                <select name="fuqaroligi" class="form-control">
                    <option value="-1">~ Tanlang ~</option>
                    <option <?php if($object->fuqaroligi==filter("O'zbekiston fuqarosi")){ echo "selected"; } ?>>O'zbekiston fuqarosi</option>
                    <option <?php if($object->fuqaroligi==filter("Chet el fuqarosi")){ echo "selected"; } ?>>Chet el fuqarosi</option>
                    <option <?php if($object->fuqaroligi==filter("Fuqaroligi yo'q shaxs")){ echo "selected"; } ?>>Fuqaroligi yo'q shaxs</option>
                </select>
                <div class="invalid-feedback">Malumotni tanlang</div>
            </div>
            <div class="form-group">
                <label>Partiyaviyligi</label>
                <select name="partiyaviyligi" id="partiyaviyligi" required class="form-select">
                    <option value="Yo`q">Yo`q</option>
                    <option <?php if($object->partiyaviyligi==filter("Oʻzbekiston Xalq demokratik partiyasi")){ echo "selected"; } ?> value="Oʻzbekiston Xalq demokratik partiyasi">Oʻzbekiston Xalq demokratik partiyasi</option>
                    <option <?php if($object->partiyaviyligi==filter("Oʻzbekiston Liberal demokratik partiyasi")){ echo "selected"; } ?> value="Oʻzbekiston Liberal demokratik partiyasi">Oʻzbekiston Liberal demokratik partiyasi</option>
                    <option <?php if($object->partiyaviyligi==filter("Oʻzbekiston Milliy tiklanish demokratik partiyasi")){ echo "selected"; } ?> value="Oʻzbekiston Milliy tiklanish demokratik partiyasi">Oʻzbekiston Milliy tiklanish demokratik partiyasi</option>
                    <option <?php if($object->partiyaviyligi==filter("Oʻzbekiston Adolat sotsial demokratik partiyasi")){ echo "selected"; } ?> value="Oʻzbekiston Adolat sotsial demokratik partiyasi">Oʻzbekiston Adolat sotsial demokratik partiyasi</option>
                    <option <?php if($object->partiyaviyligi==filter("Oʻzbekiston ekologik partiyasi")){ echo "selected"; } ?> value="Oʻzbekiston ekologik partiyasi">Oʻzbekiston ekologik partiyasi</option>
                </select>
                <div class="invalid-feedback">Partiyaviyligini Tanlang</div>
            </div>
            <div class="form-group">
                <label>Harbiy guvohnoma mavjudmi?</label>
                <select name="xarbiy" id="xarbiy" required class="form-select">                    
                    <option <?php if($object->xarbiy==filter("Yo`q")){ echo "selected"; } ?> value="Yo`q">Yo`q</option>
                    <option <?php if($object->xarbiy==filter("Ha")){ echo "selected"; } ?> value="Ha">Ha</option>
                </select>
                <div class="invalid-feedback">Xarbiyni Tanlang</div>
            </div>
            <div class="form-group" style="display: <?php if($object->xarbiy==filter("Ha")){ echo "none"; }else{echo "block";} ?>;" id="xguvohnoma">
                <label>Harbiy guvohnoma pdf shaklini yuklang : (2Mbdan oshmasin)</label>
                <input class="form-control" type="file" name="xguvohnoma" required accept="application/pdf"/>
                <div class="invalid-feedback">File yuklanish shart</div>
            </div>
            <div class="form-group">
                <label>Tug'ilgan sananggizni kiriting : </label>
                <input class="form-control" type="text" value="<?=$object->birthdate?>" placeholder="Login kiriting" name="birthdate" required id="tsana" />
                <script type="text/javascript">
                var dateMask = IMask(
                    document.getElementById('tsana'), {
                        mask: Date,
                        min: new Date(1930, 0, 1),
                        max: new Date(2024, 0, 1),
                        lazy: false
                    });
                </script>
                <div class="invalid-feedback">Tug'ilgan sananggizni kiriting </div>
            </div>
            <div class="form-group">
                <label>Jinsingizni tanlang :</label>
                <select name="jinsi" class="form-control">
                    <option value="-1">~ Tanlang ~</option>
                    <option value="erkak" <?php if($object->jinsi==filter("erkak")){ echo "selected"; } ?>>Erkak</option>
                    <option value="ayol" <?php if($object->jinsi==filter("ayol")){ echo "selected"; } ?>>Ayol</option>
                </select>
                <div class="invalid-feedback">Jinsingizni tanlang</div>
            </div>
            
            <div class="form-group">
                <label>Moddiy javobgar shaxsmi</label>
                <select name="mjshaxs" id="mjshaxs" class="form-select">
                    <option value="Yo`q" <?php if($object->mjshaxs==filter("Yo`q")){ echo "selected"; } ?>>Yo`q</option>
                    <option value="Xa" <?php if($object->mjshaxs==filter("Xa")){ echo "selected"; } ?>>Xa</option>
                </select>
                <div class="invalid-feedback">Moddiy javobgar shaxsmi tanlang</div>
            </div>

            
            <div class="form-group">
                <label>Manzili</label>
                <input class="form-control" value="<?=$object->manzil?>" type="text" placeholder="Manzilini kiriting" name="manzil" id="manzil" required />
                <div class="invalid-feedback">Manzilini kiriting</div>
            </div>

            <div class="form-group">
                <label>Doimiy yashash joyi</label>
                <input class="form-control" type="text" value="<?=$object->doimiy?>" placeholder="Doimiy yashash joyini kiriting" name="doimiy" id="doimiy" required />
                <div class="invalid-feedback">Doimiy yashash joyini kiriting</div>
            </div>
            <div class="form-group">
                <label>Telefoni</label>
                <input class="form-control" value="<?=$object->telefon?>" type="text" placeholder="+998(__)___-__-__" name="telefon" id="telefon" required />
                <div class="invalid-feedback">Telefonini kiriting</div>
            </div>
            <script type="text/javascript">
                var phoneMask = IMask(
                  document.getElementById('telefon'), {
                    mask: '+{998}(00)000-00-00'
                });
            </script>
            <div class="form-group">
                <label>Telegram ID agar mavjud bo'lsa</label>
                <input class="form-control" type="text" value="<?=$object->telegram_id?>" placeholder="Telegram IDsini kiriting" name="telegram_id" id="telegram_id" />
                <div class="invalid-feedback">Telegram IDsini kiriting</div>
            </div>
            <div class="form-group">
                <label>Email agar mavjud bo'lsa</label>
                <input class="form-control" type="email" value="<?=$object->pochta?>" placeholder="Emailni kiriting" name="pochta" id="pochta" />
                <div class="invalid-feedback">Emailni kiriting</div>
            </div>
            <div class="form-group">
                <label>Pasportni pdf variantini yuklang (2Mbdan oshmasin rangli)</label>
                <input class="form-control" type="file" name="paspdf" required accept="application/pdf" />
                <div class="invalid-feedback">File yuklanish shart</div>
            </div>
            <div class="form-group">
                <label>Tarjimai holingizni yuklang (pdf formatda)</label>
                <input class="form-control" type="file" name="tarjimayi_hol" required accept="application/pdf"/>
                <div class="invalid-feedback">File yuklanish shart</div>
            </div>
            <div class="form-group">
                <label>Obyektivkangizni yuklang (.doc,.docx formatda)</label>
                <a href="../namuna-obyektivka.doc">Namunani ko'rish (Yuklab olish)</a>
                <input class="form-control" type="file" name="obyektivka" required accept=".doc,.docx,application/msword" />
                <div class="invalid-feedback">File yuklanish shart</div>
            </div>
            <div class="form-group">
                <label>Chet tilini bilish darajangiz</label>
                <input class="form-control" type="text" value="<?=$object->chettili?>" placeholder="Kiriting" name="chettili" required />
                <p class="help-blpock">Namuna : Rus tili o'rta, Ingliz tili B1</p>
                <div class="invalid-feedback">Chet tilini bilish darajangizni kiriting!</div>
            </div>
            <div class="form-group">
                <label>O'rta maxsus kasb-hunar kolleji diplomi ilovasi bilan agar mavjud bo'lsa (pdf formatda 2Mbdan oshmasin)</label>
                <input class="form-control" type="file" name="diplom1" accept="application/pdf" />
                <div class="invalid-feedback">File yuklanish shart</div>
            </div>
            <div class="form-group">
                <label>Bakalavr diplomi ilovasi bilan agar mavjud bo'lsa agar ayni vaqtda tahsil olayotgan bo'lsangiz o'qish joyidan malumotnoma (pdf formatda 2Mbdan oshmasin)</label>
                <input class="form-control" type="file" name="diplom2" accept="application/pdf"/>
                <div class="invalid-feedback">File yuklanish shart</div>
            </div>
            <div class="form-group">
                <label>Ikkinchi mutaxasislik diplomi ilovasi bilan agar mavjud bo'lsa (pdf formatda 2Mbdan oshmasin)</label>
                <input class="form-control" type="file" name="diplom3" accept="application/pdf" />
                <div class="invalid-feedback">File yuklanish shart</div>
            </div>
            <div class="form-group">
                <label>Magistrlik diplomingiz ilovasi bilan agar mavjud bo'lsa (pdf formatda 2Mbdan oshmasin)</label>
                <input class="form-control" type="file" name="diplom4" accept="application/pdf"/>
                <div class="invalid-feedback">File yuklanish shart</div>
            </div>
            <div class="form-group">
                <label>PhD diplomingiz agar mavjud bo'lsa (pdf formatda 2Mbdan oshmasin)</label>
                <input class="form-control" type="file" name="diplom5" accept="application/pdf"/>
                <div class="invalid-feedback">File yuklanish shart</div>
            </div>
            <div class="form-group">
                <label>DSc diplomingiz agar mavjud bo'lsa (pdf formatda 2Mbdan oshmasin)</label>
                <input class="form-control" type="file" name="diplom6" accept="application/pdf"/>
                <div class="invalid-feedback">File yuklanish shart</div>
            </div>
            <div class="form-group">
                <label>Katta ilmiy xodimlik diplomingiz agar mavjud bo'lsa</label>
                <input class="form-control" type="file" name="diplom7" accept="application/pdf"/>
                <div class="invalid-feedback">File yuklanish shart</div>
            </div>
            <div class="form-group">
                <label>Dotsentlik diplomingiz agar mavjud bo'lsa</label>
                <input class="form-control" type="file" name="diplom8" accept="application/pdf"/>
                <div class="invalid-feedback">File yuklanish shart</div>
            </div>
            <div class="form-group">
                <label>Professorlik diplomingiz agar mavjud bo'lsa</label>
                <input class="form-control" type="file" name="diplom9" accept="application/pdf"/>
                <div class="invalid-feedback">File yuklanish shart</div>
            </div>
            <div class="form-group">
                <label>Akademiklik diplomingiz agar mavjud bo'lsa</label>
                <input class="form-control" type="file" name="diplom10" accept="application/pdf"/>
                <div class="invalid-feedback">File yuklanish shart</div>
            </div>
            <div class="form-group">
                <label>Davlat mukofotlari agar mavjud bo'lsa</label>
                <textarea name="davlatmukofoti" class="form-control" placeholder="Kiriting"><?=$object->davlatmukofoti?></textarea>
                <p class="help-blpock">Namuna : 2009-yil "Mehnat shuhrati" ordeni</p>
                <div class="invalid-feedback">Davlat mukofotlarni kiriting!</div>
            </div>
            <div class="form-group">
                <label>Idoraviy mukofotlari agar mavjud bo'lsa</label>
                <textarea name="idoramukofoti" class="form-control" placeholder="Kiriting"><?=$object->idoramukofoti?></textarea>
                <p class="help-blpock">Namuna : 2019-yil "Ma'naviyat fidoyisi" ko'krak nishoni</p>
                <div class="invalid-feedback">Idoraviy mukofotlarni kiriting!</div>
            </div>
            <div class="form-group">
                <label>Malaka oshirilgan tashkilot nomi agar mavjud bo'lsa</label>
                <textarea name="malakatashkilot" class="form-control" placeholder="Kiriting"><?=$object->malakatashkilot?></textarea>
                <p class="help-blpock">Namuna : Davlat boshqaruv akademiyasi</p>
                <div class="invalid-feedback">Malaka oshirilgan tashkilot nomini kiriting!</div>
            </div>
            <div class="form-group">
                <label>Malaka oshirilgan yo'nalishi agar mavjud bo'lsa</label>
                <textarea name="malakayunalish" class="form-control" placeholder="Kiriting"><?=$object->malakayunalish?></textarea>
                <p class="help-blpock">Namuna : "Madaniyat soxasini boshqarish"</p>
                <div class="invalid-feedback">Malaka oshirilgan yo'nalishini kiriting!</div>
            </div>
            <div class="form-group">
                <label>Malaka oshirilgan davr oralig'ini tanlang boshlanish va tugash vaqti agar mavjud bo'lsa</label>
                <input class="form-control" type="text" name="malakadavr" value="<?=$object->malakadavr?>" id="malakadavr" />
                <script type="text/javascript">
                var dateMask = IMask(
                    document.getElementById('malakadavr'), {
                        mask: Date,
                        min: new Date(1930, 0, 1),
                        max: new Date(2023, 0, 1),
                        lazy: false
                    });
                </script>
                <br>
                <input class="form-control" type="text" name="malakadavr2" value="<?=$object->malakadavr2?>" id="malakadavr2" />
                <script type="text/javascript">
                    var dateMask = IMask(
                    document.getElementById('malakadavr2'), {
                        mask: Date,
                        min: new Date(1930, 0, 1),
                        max: new Date(2023, 0, 1),
                        lazy: false
                    });
                </script>                
            </div>
            <input type="hidden" name="id" value="<?=$object->id?>">
            <input type="hidden" name="_csrf" value="<?=$_SESSION['_csrf']?>">
            <div class="form-group">
                <button class="btn btn-primary w-100" id="submitBtn" type="button" name="submit">
                    Tahrirlash
                    <div class="lds-dual-ring btn-load"></div>
                </button>
            </div>
        </form>           
          </div>
        </div>
      </div>
              <?php
          }
          else{
            ?>
            <h1>Malumotlar tekshirishga jo'natilgan Iltimos javobni kuting!</h1>
              <?php
          }
      ?>
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
  <script src="../assets/js/jquery-3.6.0.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>  
  <script src="../assets/js/sweetalert.min.js"></script>
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script type="text/javascript">
    $('#viloyat_id').change(function() {
        let viloyat_id = $('#viloyat_id').val();
        //console.log(viloyat_id);
        $.ajax({
          url:"get-tuman.php",
          type:"GET",
          data:{
            viloyat_id:viloyat_id,
          },
          success:function(data) {
            $('#tuman_id').html(data);
          },
          error:function(xhr) {
            alert("Kechirasi internetdan uzilish ro'y berdi");
          }
        })
    });

    $('#xarbiy').change(function() {                    
        let xg = $(this).val();                    
        if(xg == "Ha"){                        
            $('#xguvohnoma').css("display","block");
        }
        else{
            $('#xguvohnoma').css("display","none");
        }
    });
    function loadingStart() {
      submitBtn.classList.add("loading");
      setTimeout(() => {
      }, 2000);
    }

    function loadingStop() {
      setTimeout(() => {
        submitBtn.classList.remove("loading");
      }, 1000);
    }
    submitBtn.addEventListener("click", function submit(e) {
      e.preventDefault();
      loadingStart();
      var formData = new FormData($("#form")[0]);
      $.ajax({
        url: "update-user-data.php",
        type: "POST",
        data: formData,
        async: false,
        success: function (data) {
          console.log(data);
          loadingStop();
          var obj = jQuery.parseJSON(data);
          if (obj.xatolik == 0) {
            swal("Barchasi muvaffaqqiyatli",obj.xabar,"success");
            setTimeout(() => {
              // location.reload();
                window.location.href = 'index.php';
            }, 1500);
          }
          else {            
            swal("Xatolik",obj.xabar,"error");
          }
          loadingStop();
        },
        cache: false,
        contentType: false,
        processData: false,
        error: function () {
          toast.create({
            title: "Xatolik.",
            text: "Ulanishda xatolik!",
            type: "error",
            icon: "assets/img/icon/error.svg",
          });
          loadingStop();
        },
      });
    });
    </script>
</body>

</html>
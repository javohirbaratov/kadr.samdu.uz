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
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png" />
    <title>Shaxsiy ma'lumotlarni ro'yxatdan o'tkazish</title>
    <? include 'meta.php'; ?>
    <link rel="stylesheet" href="assets/css/nomalize.css" />
    <link rel="stylesheet" href="assets/css/mess-alert.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <script src="assets/js/imask.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body class="login-page">
    <div class="login-page--wrapper">
        <img
                class="login-page--wrapper-logo"
                src="https://hemis.samdu.uz/static/crop/3/9/250_250_90_3968016486.png"
                alt="logo"
                style="width: 80px;"
        />
        <h5 style="text-align:center;">Sharof Rashidov nomidagi Samarqand davlat universiteti</h5>
        <p>KADRLAR BO'LIMI</p>
        <!-- Form-open -->
        <p class="alert alert-danger" role="alert">Pasport, diplom va fayl yuklamalari rangli va sifatli bo'lishi talab etiladi. Ma'lumotlar lotin alifbosiga asoslangan o'zbek tilida kiritilsin.</p>
        <form id="form" action="test.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Iltimos familyangizni kiriting!</label>
                <input class="form-control" type="text" placeholder="Familya" name="familya" required />
                <div class="invalid-feedback">Eslatma ma'lumotlar lotin alifbosiga asoslanga o'zbek alifbosida kiritilsin</div>
            </div>
            <div class="form-group">
                <label>Ismingizni kiriting!</label>
                <input class="form-control" type="text" placeholder="Ism" name="ism" required />
                <div class="invalid-feedback">Eslatma ma'lumotlar lotin alifbosiga asoslanga o'zbek alifbosida kiritilsin</div>
            </div>
            <div class="form-group">
                <label>Sharifingizni kiriting!</label>
                <input class="form-control" type="text" placeholder="Sharifingiz" name="otch" required />
                <div class="invalid-feedback">Eslatma ma'lumotlar lotin alifbosiga asoslanga o'zbek alifbosida kiritilsin</div>
            </div>
            <div class="form-group">
                <label>JSHIRni kiriting!</label>
                <input class="form-control" type="text" placeholder="______________" name="jshir" required id="jshshir" />
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
                <input class="form-control" type="text" placeholder="_______" name="nomer" required max="7" min="7" />
                <p class="help-blpock">Namuna : AB1234567</p>
                <div class="invalid-feedback">Pasport seriya va raqamini kiriting</div>
            </div>

            <div class="form-group">
                <label>Pasport berilgan sananggizni kiriting </label>
                <input class="form-control" type="text" name="pasportdate" required id="psana1" />
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
                <input class="form-control" type="text" placeholder="Login kiriting" name="pasportenddate" required id="psana2" />
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
                <input class="form-control" type="text" placeholder="Kiriting" name="pasportjoy" required />
                <p class="help-blpock">Namuna : Samarqand viloyati Samarqand shahar IIB</p>
                <div class="invalid-feedback">Pasport berilgan joyni kiriting!</div>
            </div>
            <div class="form-group">
                <label>Oilaviy ahvoli</label>
                <select name="oilaviyahvoli" id="oilaviyahvoli" required class="form-select">
                    <option value="Uylanmagan">Uylanmagan</option>
                    <option value="Turmushga chiqmagan">Turmushga chiqmagan</option>
                    <option value="Oilali">Oilali</option>
                    <option value="Ajrashgan">Ajrashgan</option>
                    <option value="Beva">Beva</option>
                </select>
                <div class="invalid-feedback">Oilaviy ahvolini kiriting</div>
            </div>
            <div class="form-group">
                <label>Tug'ilgan viloyatni tanlang</label>
                <select name="viloyat_id" id="viloyat_id" class="form-select js-example-data-ajax form-group" required > 
                <option value="Boshqa">Boshqa</option>   
               <?
                $sql=mysqli_query($link,"SELECT * FROM viloyat");
                  while ($res=mysqli_fetch_assoc($sql)){?>              
                    <option value="<?=$res['id'];?>"><?=$res['nomi'];?></option>
                  <?}
                ?>
                </select>
                <div class="invalid-feedback">Viloyatni tanlang</div>
            </div>
            <div class="form-group" id="tuman">
                <label>Tug'ilgan tumanni tanlang</label>
                <select name="tuman_id" id="tuman_id" required class="js-example-data-ajax form-select">
                    <option value="0">~ Tanlang ~</option>
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
                    <option>O'zbek</option>
                    <option>Rus</option>
                    <option>Tojik</option>
                    <option>Qozoq</option>
                    <option>Qirg'iz</option>
                    <option>Rus</option>
                    <option>Turkman</option>
                    <option>Tatar</option>
                    <option>Boshqa</option>
                </select>
                <div class="invalid-feedback">Malumotni tanlang</div>
            </div>
            <div class="form-group">
                <label>Fuqarolikni tanlang :</label>
                <select name="fuqaroligi" class="form-control">
                    <option value="-1">~ Tanlang ~</option>
                    <option>O'zbekiston fuqarosi</option>
                    <option>Chet el fuqarosi</option>
                    <option>Fuqaroligi yo'q shaxs</option>
                </select>
                <div class="invalid-feedback">Malumotni tanlang</div>
            </div>
            <div class="form-group">
                <label>Partiyaviyligi</label>
                <select name="partiyaviyligi" id="partiyaviyligi" required class="form-select">
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
                <label>Harbiy guvohnoma mavjudmi?</label>
                <select name="xarbiy" id="xarbiy" required class="form-select">                    
                    <option value="Yo`q">Yo`q</option>
                    <option value="Ha">Ha</option>
                </select>
                <div class="invalid-feedback">Xarbiyni Tanlang</div>
            </div>
            <div class="form-group" style="display: none;" id="xguvohnoma">
                <label>Harbiy guvohnoma pdf shaklini yuklang : (2Mbdan oshmasin)</label>
                <input class="form-control" type="file" name="xguvohnoma" required accept="application/pdf"/>
                <div class="invalid-feedback">File yuklanish shart</div>
            </div>
            <div class="form-group">
                <label>Tug'ilgan sananggizni kiriting : </label>
                <input class="form-control" type="text" placeholder="Login kiriting" name="birthdate" required id="tsana" />
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
                    <option value="erkak">Erkak</option>
                    <option value="ayol">Ayol</option>
                </select>
                <div class="invalid-feedback">Jinsingizni tanlang</div>
            </div>
            
            <div class="form-group">
                <label>Moddiy javobgar shaxsmi</label>
                <select name="mjshaxs" id="mjshaxs" class="form-select">
                    <option value="Yo`q">Yo`q</option>
                    <option value="Xa">Xa</option>
                </select>
                <div class="invalid-feedback">Moddiy javobgar shaxsmi tanlang</div>
            </div>

            
            <div class="form-group">
                <label>Manzili</label>
                <input class="form-control" type="text" placeholder="Manzilini kiriting" name="manzil" id="manzil" required />
                <div class="invalid-feedback">Manzilini kiriting</div>
            </div>

            <div class="form-group">
                <label>Doimiy yashash joyi</label>
                <input class="form-control" type="text" placeholder="Doimiy yashash joyini kiriting" name="doimiy" id="doimiy" required />
                <div class="invalid-feedback">Doimiy yashash joyini kiriting</div>
            </div>
            <div class="form-group">
                <label>Telefoni</label>
                <input class="form-control" type="text" placeholder="+998(__)___-__-__" name="telefon" id="telefon" required />
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
                <input class="form-control" type="text" placeholder="Telegram IDsini kiriting" name="telegram_id" id="telegram_id" />
                <div class="invalid-feedback">Telegram IDsini kiriting</div>
            </div>
            <div class="form-group">
                <label>Email agar mavjud bo'lsa</label>
                <input class="form-control" type="email" placeholder="Emailni kiriting" name="pochta" id="pochta" />
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
                <a href="namuna-obyektivka.doc">Namunani ko'rish (Yuklab olish)</a>
                <input class="form-control" type="file" name="obyektivka" required accept=".doc,.docx,application/msword" />
                <div class="invalid-feedback">File yuklanish shart</div>
            </div>
            <div class="form-group">
                <label>Chet tilini bilish darajangiz</label>
                <input class="form-control" type="text" placeholder="Kiriting" name="chettili" required />
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
                <textarea name="davlatmukofoti" class="form-control" placeholder="Kiriting"></textarea>
                <p class="help-blpock">Namuna : 2009-yil "Mehnat shuhrati" ordeni</p>
                <div class="invalid-feedback">Davlat mukofotlarni kiriting!</div>
            </div>
            <div class="form-group">
                <label>Idoraviy mukofotlari agar mavjud bo'lsa</label>
                <textarea name="idoramukofoti" class="form-control" placeholder="Kiriting"></textarea>
                <p class="help-blpock">Namuna : 2019-yil "Ma'naviyat fidoyisi" ko'krak nishoni</p>
                <div class="invalid-feedback">Idoraviy mukofotlarni kiriting!</div>
            </div>
            <div class="form-group">
                <label>Malaka oshirilgan tashkilot nomi agar mavjud bo'lsa</label>
                <textarea name="malakatashkilot" class="form-control" placeholder="Kiriting"></textarea>
                <p class="help-blpock">Namuna : Davlat boshqaruv akademiyasi</p>
                <div class="invalid-feedback">Malaka oshirilgan tashkilot nomini kiriting!</div>
            </div>
            <div class="form-group">
                <label>Malaka oshirilgan yo'nalishi agar mavjud bo'lsa</label>
                <textarea name="malakayunalish" class="form-control" placeholder="Kiriting"></textarea>
                <p class="help-blpock">Namuna : "Madaniyat soxasini boshqarish"</p>
                <div class="invalid-feedback">Malaka oshirilgan yo'nalishini kiriting!</div>
            </div>
            <div class="form-group">
                <label>Malaka oshirilgan davr oralig'ini tanlang boshlanish va tugash vaqti agar mavjud bo'lsa</label>
                <input class="form-control" type="text" name="malakadavr" id="malakadavr" />
                <script type="text/javascript">
                var dateMask = IMask(
                    document.getElementById('malakadavr'), {
                        mask: Date,
                        min: new Date(1930, 0, 1),
                        max: new Date(2024, 0, 1),
                        lazy: false
                    });
                </script>
                <br>
                <input class="form-control" type="text" name="malakadavr2" id="malakadavr2" />
                <script type="text/javascript">
                var dateMask = IMask(
                    document.getElementById('malakadavr2'), {
                        mask: Date,
                        min: new Date(1930, 0, 1),
                        max: new Date(2024, 0, 1),
                        lazy: false
                    });
                </script>                
            </div>
            
            
            <input type="hidden" name="_csrf" value="<?=$_SESSION['_csrf']?>">
            <div class="form-group">
                <button class="btn btn-primary w-100" id="submit" type="button" name="submit">
                    Yuborish
                    <div class="lds-dual-ring btn-load"></div>
                </button>
            </div>
        </form>
        <!-- Form-close -->
    </div>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/plagin/mess-alert.js"></script>
    <script src="appa.js"></script>
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
        
    </script>
    <script type="text/javascript">
        $('#xarbiy').change(function() {                    
            let xg = $(this).val();                    
            if(xg == "Ha"){                        
                $('#xguvohnoma').css("display","block");
            }
            else{
                $('#xguvohnoma').css("display","none");
            }
        });
    </script>
    
</body>

</html>
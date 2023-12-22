<?php
        require '../model.php';

				$buyid=filter($_POST['buyruq_id']);
        
				// Mehnat shart
              $fetch = Functions::getbytable("mshbekor","`braqam`='$buyid'");
              $no=0;
              foreach($fetch as $value){
                $no++;
                $indexs = md5(sha1($value['id']));
                $kadrb = Functions::getbyid("xodimlar",$value['user_id']);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $teacher = $kbulimi['familya']." ".$kbulimi['ism']." ".$kbulimi['otch'];

                echo ('
                    <h5>
                        <center><b>'.$no.'-§</b></center>
                    </h5><p>
                    <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$teacher.'</b> - '.$value['bulim_id'].'  '.getmonth($value['sana']).'danuning arizasiga muvofiq mehnat shartnomasi bekor qilinsin. (O‘zR Mehnat kodeksining 99-moddasi)
                    2. Buxgalteriya '.$teacher.' bilan to‘liq moliyaviy hisob kitob qilsin – unga to‘lanishi kerak bo‘lgan ish haqi va mehnat ta’tilining foydalanilmagan kunlari uchun pullik kompensatsiya to‘lansin (O‘zR Mehnat kodeksining 151-moddasi 1-band)<br>
                    </p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Asos</b>: '.$teacher.'ning arizasi.<br>
                    Buyruqdan ko’chirma oldim: __________
                    <p>
                    <br><br><br><br>
                  ');
              }

              print_r($buyid);
              exit;

				// Bola parvarishi
              $fetch = Functions::getbytable("bolaparvarishi","`braqam`='$buyid'");

              foreach($fetch as $value){
                $no++;
                $indexs = md5(sha1($value['id']));
                $kadrb = Functions::getbyid("xodimlar",$value['user_id']);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $teacher = $kbulimi['familya']." ".$kbulimi['ism']." ".$kbulimi['otch'];

                echo ('
                            <h5>
                                <center><b>'.$no.'-§</b></center>
                            </h5><p>
                            <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$teacher.'</b> - '.$value['bulim_id'].' bo’limi '.$value['lavozim'].',  '.getmonth($value['sanadan']).'dan  '.getmonth($value['sanagacha']).'gacha bolasi '.$value['yosh'].' yoshga to’lgunga qadar bola parvarish ta’tili berilsin (O’zR Mehnat kodeksining 234-moddasi).<br>
                            </p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Asos</b>: '.$teacher.'ning arizasi, bola tug’ilganligi haqida guvohnoma nusxasi '.$value['hujjat'].'.<br>
                            Buyruq bilan tanishdim: __________
                            <p>
                            <br><br><br><br>
                          ');
              }






				// Bola parvarishida qaytish
              $fetch = Functions::getbytable("bpish","`braqam`='$buyid'");

              foreach($fetch as $value){
                $no++;
                $indexs = md5(sha1($value['id']));
                $kadrb = Functions::getbyid("xodimlar",$value['user_id']);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $teacher = $kbulimi['familya']." ".$kbulimi['ism']." ".$kbulimi['otch'];

                 echo ('
                            <h5>
                                <center><b>'.$no.'-§</b></center>
                            </h5><p>
                            <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$teacher.'</b> - '.$value['bulim_id'].' bo’limi '.$value['lavozim'].',  '.getmonth($value['sana']).'dan  bola parvarish ta’tilidan so‘ng ishga tushgan deb hisoblansin.<br>
                            </p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Asos</b>: '.$teacher.'ning bildirishnomasi.<br>
                            Buyruq bilan tanishdim: __________
                            <p>
                            <br><br><br><br>
                          ');

              }









				// Lavozim o'zgarish
              $fetch = Functions::getbytable("bpish","`braqam`='$buyid'");

              foreach($fetch as $value){
                $no++;
                $indexs = md5(sha1($value['id']));
                $kadrb = Functions::getbyid("xodimlar",$value['user_id']);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $teacher = $kbulimi['familya']." ".$kbulimi['ism']." ".$kbulimi['otch'];
				echo ('
                            <h5>
                                <center><b>'.$no.'-§</b></center>
                            </h5><p>
                            <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$teacher.'</b> - '.$value['bulimdan'].' '.$value['shtatdan'].' shtat birligi '.$value['lavozimdan'].', '.getmonth($value['sana']).'dan '.$value['bulim_id'].'ga '.$value['shtat'].' shtat birligi '.$value['lavozim'].' lavozimiga o’tkazilsin va shtat jadvaliga muvofiq oylik maosh belgilansin.<br>
                            </p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Asos</b>: '.$teacher.'ning arizasi, mehnat shartnomasiga ilova.<br>
                            Buyruq bilan tanishdim: __________
                            <p>
                            <br><br><br><br>
                          ');

              }




				// Dotsent
              $fetch = Functions::getbytable("dschiqish","`braqam`='$buyid'");

              foreach($fetch as $value){
                $no++;
                $indexs = md5(sha1($value['id']));
                $kadrb = Functions::getbyid("xodimlar",$value['user_id']);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $teacher = $kbulimi['familya']." ".$kbulimi['ism']." ".$kbulimi['otch'];
				echo ('
                            <h5>
                                <center><b>'.$no.'-§</b></center>
                            </h5><p>
                            <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$teacher.'</b> - '.$value['bosqich'].' bosqich doktoranti, dissertatsiya ishini muddatidan oldin himoya qilganliklari sababli, '.getmonth($value['sanadan']).'dan doktorantura safidan chiqarilsin va O’zbekiston Respublikasi Vazirlar Mahkamasining 2017-yil 22-maydagi №304-qaroriga asosan byudjet mablag’lari hisobidan '.$value['oylar'].' oylari stipendiyasi o’rnatilgan tartibda to’lab berilsin.<br>
                            </p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Asos</b>: '.$value['asos'].' .<br>
                            Buyruq bilan tanishdim: __________
                            <p>
                            <br><br><br><br>
                          ');

              }



				// haqsiz ish
              $fetch = Functions::getbytable("haqsizish","`braqam`='$buyid'");

              foreach($fetch as $value){
                $no++;
                $indexs = md5(sha1($value['id']));
                $kadrb = Functions::getbyid("xodimlar",$value['user_id']);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $teacher = $kbulimi['familya']." ".$kbulimi['ism']." ".$kbulimi['otch'];
				echo ('
                            <h5>
                                <center><b>'.$no.'-§</b></center>
                            </h5><p>
                            <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$teacher.'</b> - '.$value['bulim_id'].' bo’limi '.$value['lavozim'].',  '.getmonth($value['sana']).'dan  o’z hisobidan haq to’lanmaydigan ta’tilidan so’ng ishga tushgan deb hisoblansin.<br>
                            </p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Asos</b>: '.$teacher.'ning arizasi.<br>
                            Buyruq bilan tanishdim: __________
                            <p>
                            <br><br><br><br>
                          ');

              }



				// haqsiz tatil
              $fetch = Functions::getbytable("haqsiztatil","`braqam`='$buyid'");

              foreach($fetch as $value){
                $no++;
                $indexs = md5(sha1($value['id']));
                $kadrb = Functions::getbyid("xodimlar",$value['user_id']);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $teacher = $kbulimi['familya']." ".$kbulimi['ism']." ".$kbulimi['otch'];
				echo ('
                            <h5>
                                <center><b>'.$no.'-§</b></center>
                            </h5><p>
                            <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$teacher.'</b> - '.$value['bulim_id'].' bo’limi '.$value['lavozim'].',  '.getmonth($value['sanadan']).'dan '.getmonth($value['sanagacha']).'gacha oilaviy sharoitini inobatga olib, o’z hisobidan haq to’lanmaydigan ta’til berilsin.<br>
                            </p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Asos</b>: '.$teacher.'ning arizasi.<br>
                            Buyruq bilan tanishdim: __________
                            <p>
                            <br><br><br><br>
                          ');

              }





				// harbiydan qaytish
              $fetch = Functions::getbytable("harbiyish","`braqam`='$buyid'");

              foreach($fetch as $value){
                $no++;
                $indexs = md5(sha1($value['id']));
                $kadrb = Functions::getbyid("xodimlar",$value['user_id']);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $teacher = $kbulimi['familya']." ".$kbulimi['ism']." ".$kbulimi['otch'];
				echo ('
                            <h5>
                                <center><b>'.$no.'-§</b></center>
                            </h5><p>
                            <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$teacher.'</b> - '.$value['bulim_id'].' bo’limi '.$value['lavozim'].',  '.getmonth($value['sana']).'dan harbiy o’quv mashg’ulotlaridan so‘ng ishga tushgan deb hisoblansin.<br>
                            </p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Asos</b>: '.$teacher.'ning bildirishnomasi.<br>
                            Buyruq bilan tanishdim: __________
                            <p>
                            <br><br><br><br>
                          ');

              }






				// hayfsan bekor qilish
              $fetch = Functions::getbytable("hbekorqilish","`braqam`='$buyid'");

              foreach($fetch as $value){
                $no++;
                $indexs = md5(sha1($value['id']));
                $kadrb = Functions::getbyid("xodimlar",$value['user_id']);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $teacher = $kbulimi['familya']." ".$kbulimi['ism']." ".$kbulimi['otch'];
				            echo ('
                            <h5>
                                <center><b>'.$no.'-§</b></center>
                            </h5><p>
                            <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$teacher.'</b> - '.$value['bulim_id'].' bo’limi '.$value['lavozim'].',  '.getmonth($value['sana']).'dagi '.$value['hbuyruq'].' sonli buyruq bilan e’lon qilingan hayfsan, topshiriqlarni o‘z vaqtida bajargani va samarali mehnatlarini inobatga olib, O’zR MK ning 183-moddasiga asosan bekor qilinsin.<br>
                            </p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Asos</b>: '.$value['asos'].' <br>
                            Buyruq bilan tanishdim: __________
                            <p>
                            <br><br><br><br>
                          ');

              }








				// homiladorlik tatili
              $fetch = Functions::getbytable("homiladorliktatili","`braqam`='$buyid'");

              foreach($fetch as $value){
                $no++;
                $indexs = md5(sha1($value['id']));
                $kadrb = Functions::getbyid("xodimlar",$value['user_id']);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $teacher = $kbulimi['familya']." ".$kbulimi['ism']." ".$kbulimi['otch'];
				            echo ('
                            <h5>
                                <center><b>'.$no.'-§</b></center>
                            </h5><p>
                            <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$teacher.'</b> - '.$value['bulim_id'].' kafedrasi '.$value['lavozim'].',  '.getmonth($value['sanadan']).'dan '.getmonth($value['sanagacha']).'gacha homiladorlik va tug’ruq ta’tili berilsin (O’zR Mehnat Kodeksining 233-moddasi).<br>
                            </p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Asos</b>: '.$teacher.'ning arizasi, x/v №'.$value['id'].'.<br>
                            Buyruq bilan tanishdim: __________
                            <p>
                            <br><br><br><br>
                          ');

              }










				// homiladorlik tatilidan qaytish
              $fetch = Functions::getbytable("htish","`braqam`='$buyid'");

              foreach($fetch as $value){
                $no++;
                $indexs = md5(sha1($value['id']));
                $kadrb = Functions::getbyid("xodimlar",$value['user_id']);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $teacher = $kbulimi['familya']." ".$kbulimi['ism']." ".$kbulimi['otch'];
				             echo ('
                            <h5>
                                <center><b>'.$no.'-§</b></center>
                            </h5><p>
                            <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$teacher.'</b> - '.$value['bulim_id'].' kafedrasi '.$value['lavozim'].',  '.getmonth($value['sana']).'dan homiladorlik va tug’ruq ta’tilidan so’ng ishga tushgan deb hisoblansin.<br>
                            </p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Asos</b>: '.$teacher.'ning arizasi.<br>
                            Buyruq bilan tanishdim: __________
                            <p>
                            <br><br><br><br>
                          ');

              }










				// ilmiy daraja berish
              $fetch = Functions::getbytable("htish","`braqam`='$buyid'");

              foreach($fetch as $value){
                $no++;
                $indexs = md5(sha1($value['id']));
                $kadrb = Functions::getbyid("xodimlar",$value['user_id']);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $teacher = $kbulimi['familya']." ".$kbulimi['ism']." ".$kbulimi['otch'];
				                  echo('
                            <h5>
                                <center><b>'.$no.'-§</b></center>
                            </h5><p>
                            <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$teacher.'</b> - '.$value['bulim_id'].' kafedrasi '.$value['lavozim'].',  '.$value['daraja'].' ilmiy darajasi berilgan deb hisoblansin va shtat jadvaliga muvofiq oylik maosh belgilansin.<br>
                            </p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Asos</b>: '.$value['asos'].'.<br>
                            Buyruq bilan tanishdim: __________
                            <p>
                            <br><br><br><br>
                          ');
              }










				// ishga qabul qilish
              $fetch = Functions::getbytable("qabul"," `buyruq`='$buyid'");

              foreach($fetch as $value){
                $no++;
                $indexs = md5(sha1($value['id']));
                $kadrb = Functions::getbyid("xodimlar",$value['user_id']);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $teacher = $kbulimi['familya']." ".$kbulimi['ism']." ".$kbulimi['otch'];
                $kadrb = Functions::getbyid("lavozimlar",$value['lavozim']);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $lavozim = $kbulimi['lavozim'];
                $kadrb = Functions::getbyid("kafedra",$value['kafedra_id']);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $kafedra = $kbulimi['name'];
                $muddati = 'Nomuayyan muddatda';
                if($kbulimi['name']==1){
                  $muddati = getmonth($value['muddati']);
                }
				                  echo ('
                            <h5>
                                <center><b>'.$no.'-§</b></center>
                            </h5><p>
                            <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$teacher.'</b> - '.$value['malumot'].' '.getmonth($value['sana']).'dan,  '.$muddati.'gacha '.$kafedra.' kafedrasiga '.$value['shtat'].' shtat birligi '.$lavozim.' lavozimiga ishga qabul qilinsin va shtat jadvaliga muvofiq oylik maosh belgilansin.<br>
                            </p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Asos</b>: 2021-yildagi  1107-sonli mehnat shartnomasi, '.$teacher.'ning arizasi.<br>
                            Buyruq bilan tanishdim: __________
                            <p>
                            <br><br><br><br>
                          ');
              }










				// Mehnat tatili
              $fetch = Functions::getbytable("mehnattatili","`braqam`='$buyid'");

              foreach($fetch as $value){
                $no++;
                $indexs = md5(sha1($value['id']));
                $kadrb = Functions::getbyid("xodimlar",$value['user_id']);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $teacher = $kbulimi['familya']." ".$kbulimi['ism']." ".$kbulimi['otch'];
				                   echo ('
                            <h5>
                                <center><b>'.$no.'-§</b></center>
                            </h5><p>
                            <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$teacher.'</b> - '.$value['bulim_id'].' bo’limi '.$value['shtat'].'shtat birligi '.$value['lavozim'].',  '.$value['yil'].'-yil uchun '.$value['kun'].' ish kunidan iborat mehnat ta’tili, '.getmonth($value['sanadan']).'dan '.getmonth($value['sanagacha']).'gacha berilsin va O‘zbekiston Respublikasi Prezidentining 2021-yil 20-dekabrdagi PF-35-sonli Farmoniga asosan '.$teacher.'ning ishga chiqish kuni '.getmonth($value['sana']).' deb belgilansin.<br>
                            </p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Asos</b>: '.$teacher.'ning arizasi.<br>
                            Buyruq bilan tanishdim: __________
                            <p>
                            <br><br><br><br>
                          ');
              }











				// Mehnat tatili
              $fetch = Functions::getbytable("mehnattatilidanchaqirish","`braqam`='$buyid'");

              foreach($fetch as $value){
                $no++;
                $indexs = md5(sha1($value['id']));
                $kadrb = Functions::getbyid("xodimlar",$value['user_id']);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $teacher = $kbulimi['familya']." ".$kbulimi['ism']." ".$kbulimi['otch'];
				                  echo ('
                            <h5>
                                <center><b>'.$no.'-§</b></center>
                            </h5><p>
                            <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$teacher.'</b> - '.$value['bulim_id'].' bo’limi '.$value['lavozim'].', ish hajmining ko’pligini inobatga olib,'.getmonth($value['sana']).'dan mehnat ta’tilidan chaqirib olinsin va foydalanilmagan '.$value['kun'].' ish kunidan iborat mehnat ta’tili boshqa vaqtga ko’chirilsin.<br>
                            </p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Asos</b>: Yoshlar bilan ishlash, ma’naviyat va ma’rifat bo’limi boshlig’i K.Davronovning bildirishnomasi, '.$teacher.'ning arizasi.<br>
                            Buyruq bilan tanishdim: __________
                            <p>
                            <br><br><br><br>
                          ');
              }








				// moddiy javobgarlik
              $fetch = Functions::getbytable("moddiy","`buyruq`='$buyid'");

              foreach($fetch as $value){
                $no++;
                $indexs = md5(sha1($value['id']));
                $kadrb = Functions::getbyid("xodimlar",$value['user_id']);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $teacher = $kbulimi['familya']." ".$kbulimi['ism']." ".$kbulimi['otch'];
                $kadrb = Functions::getbyid("qabul",$value['user_id']);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $lavozim_id = $kbulimi['lavozim'];
                $kafedra_id = $kbulimi['kafedra_id'];

                $kadrb = Functions::getbyid("lavozimlar",$lavozim_id);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $lavozim = $kbulimi['lavozim'];
                $kadrb = Functions::getbyid("kafedra",$kafedra_id);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $kafedra = $kbulimi['name'];
				                 echo ('
                            <h5>
                                <center><b>'.$no.'-§</b></center>
                            </h5><p>
                            <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$teacher.'</b> - '.$kafedra.' kafedrasi kabinet mudiri '.$lavozim.', '.getmonth($value['sana']).'dan kafedradagi mavjud texnik jihozlarga moddiy javobgar shaxs etib tayinlansin.<br>
                            Quyidagicha komissiya tuzilsin:<br>
                            1.  Shukurov Shavkat Shukurovich – bosh muhandis – a’zo.<br>
                            2.  Bobaqandov Fazliddin Tirkashevich – texnik foydalanish va xo’jalik bo’limi boshlig’i – a’zo.<br>
                            3.  Xamrayev Xaydar Sadiyevich – o’qitishning texnik vositalari bo’limi boshlig’i – a’zo.<br>
                            4.  Qurdashev Aziz Abdumaxmudovich – bosh energetik – a’zo<br>
                            5.  He’matov Maxmud Raxmatullayevich – 1-toifali buxgalter<br>
                            <b>Topshirdi</b>: Xushnazarov Zoxidjon Shermamat o’g’li  Buyruq bilan tanishdim:_________<br>
                            <b>Qabul qildi</b>: '.$teacher.'<br>
                            </p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Asos</b>: Organik sintez va bioorganik kimyo kafedrasi mudiri S.Tillayevning bildirishnomasi, namunaviy shartnoma.<br>
                            Buyruq bilan tanishdim: __________
                            <p>
                            <br><br><br><br>
                          ');
              }







				// Mehnat tatili
              $fetch = Functions::getbytable("mehnattatilidanchaqirish","`braqam`='$buyid'");

              foreach($fetch as $value){
                $no++;
                $indexs = md5(sha1($value['id']));
                $kadrb = Functions::getbyid("xodimlar",$value['user_id']);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $teacher = $kbulimi['familya']." ".$kbulimi['ism']." ".$kbulimi['otch'];
				                   echo ('
                            <h5>
                                <center><b>'.$no.'-§</b></center>
                            </h5><p>
                            <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$teacher.'</b> - '.$value['bulim_id'].' '.$value['lavozim'].',  '.getmonth($value['sana']).'dan mehnat ta’tilidan so‘ng ishga tushgan deb hisoblansin.<br>
                            </p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Asos</b>: '.$teacher.'ning bildirishnomasi.<br>
                            Buyruq bilan tanishdim: __________
                            <p>
                            <br><br><br><br>
                          ');
              }






				// rag`bat
              $fetch = Functions::getbytable("muk","`braqam`='$buyid'");

              foreach($fetch as $value){
                $no++;
                $indexs = md5(sha1($value['id']));
                $kadrb = Functions::getbyid("xodimlar",$value['user_id']);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $teacher = $kbulimi['familya']." ".$kbulimi['ism']." ".$kbulimi['otch'];
				                   echo ('
                            <h5>
                                <center><b>'.$no.'-§</b></center>
                            </h5><p>
                            <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$teacher.'</b> - '.$$value['bulim_id'].' '.$value['lavozim'].',  samarali mehnatlari, topshiriqlarni o’z vaqtida bajarganligi hamda ish hajmining ko’pligini inobatga olib, byudjetdan tashqari mablag’lari hisobidan '.$value['summa'].' miqdorida moddiy rag’batlantirilsin.<br>
                            </p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Asos</b>: '.$value['asos'].'.<br>
                            Buyruq bilan tanishdim: __________
                            <p>
                            <br><br><br><br>
                          ');
              }









				// Sababsiz ishda yuq
              $fetch = Functions::getbytable("sababyuq","`braqam`='$buyid'");

              foreach($fetch as $value){
                $no++;
                $indexs = md5(sha1($value['id']));
                $kadrb = Functions::getbyid("xodimlar",$value['user_id']);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $teacher = $kbulimi['familya']." ".$kbulimi['ism']." ".$kbulimi['otch'];
				                   echo ('
                            <h5>
                                <center><b>'.$no.'-§</b></center>
                            </h5><p>
                            <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$teacher.'</b> - '.$value['bulim_id'].' '.$value['lavozim'].',  '.getmonth($value['sana']).'da sababsiz ishda yo’q deb hisoblansin.<br>
                            </p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Asos</b>: '.$value['asos'].'.<br>
                            Buyruq bilan tanishdim: __________
                            <p>
                            <br><br><br><br>
                          ');
              }









				// Soatbay ish
              $fetch = Functions::getbytable("soatbay","`braqam`='$buyid'");

              foreach($fetch as $value){
                $no++;
                $indexs = md5(sha1($value['id']));
                $kadrb = Functions::getbyid("xodimlar",$value['user_id']);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $teacher = $kbulimi['familya']." ".$kbulimi['ism']." ".$kbulimi['otch'];
				                   echo ('
                            <h5>
                                <center><b>'.$no.'-§</b></center>
                            </h5><p>
                            <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$teacher.'</b> - '.$value['bulim_id'].' '.$value['lavozim'].',  '.$value['hajm'].' hajmida universitetning 2021-2022 o‘quv yili uchun belgilangan soatbay ish fondi doirasida o‘quv yuklamasini soatbay asosida bajarishga ruxsat berilsin.<br>
                            </p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Asos</b>: '.$value['asos'].'.<br>
                            Buyruq bilan tanishdim: __________
                            <p>
                            <br><br><br><br>
                          ');
              }









				// Ustama
              $fetch = Functions::getbytable("ustama","`braqam`='$buyid'");

              foreach($fetch as $value){
                $no++;
                $indexs = md5(sha1($value['id']));
                $kadrb = Functions::getbyid("xodimlar",$value['user_id']);
                $kbulimi = mysqli_fetch_assoc($kadrb);
                $teacher = $kbulimi['familya']." ".$kbulimi['ism']." ".$kbulimi['otch'];
				                   echo ('
                            <h5>
                                <center><b>'.$no.'-§</b></center>
                            </h5><p>
                            <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$teacher.'</b> - '.$value['bulim_id'].' uslubchisi, ish hajmining ko’pligi hamda samarali mehnatlarini inobatga olib, byudjetdan tashqari mablag’lari hisobidan '.getmonth($value['sanadan']).'dan '.getmonth($value['sanagacha']).'gacha oylik maoshiga '.$value['foiz'].'% ustama tayinlansin.<br>
                            </p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Asos</b>: O’quv-uslubiy boshqarma boshlig’i B.Alikulovning bildirishnomasi, RMB bilan kelishilgan.<br>
                            Buyruq bilan tanishdim: __________
                            <p>
                            <br><br><br><br>
                          ');
              }








?>

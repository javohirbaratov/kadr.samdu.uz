<? include_once '../../config.php';  ?>
<?
  $id = filter($_GET['id']);
  $sql = mysqli_query($link,"SELECT * FROM xodimlar WHERE id='$id'");
  $fetch = mysqli_fetch_assoc($sql);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?=$fetch['familya']?> <?=$fetch['ism']?> <?=$fetch['otch']?> MA'LUMOTNOMASI</title>
  </head>
  <body>
    <div id="exportContent">
      <style>
        * {
          padding: 0;
          margin: 0;
          box-sizing: border-box;
        }
        #exportContent {
          width: 21cm;
          margin: 0 auto;
          padding: 0 80px;
        }
        h1 {
          text-align: center;
          font-size: 14pt;
        }
        p,
        td {
          font-size: 11pt;
        }
        table,
        th,
        td {
          /* border: none; */
        }
        .table,
        .table th,
        .table td {
          border: 1px solid black;
          border-collapse: collapse;
          text-align: center;
          padding: 10px;
        }
      </style>

      <div class="content">
        <!-- USER-INFO -->
        <section>
          <table border="" border-collapse="collapse" width="100%">
            <tr>
              <td colspan="2">
                <h1 style="text-align: right">
                  MA'LUMOTNOMA &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <br />
                  <?=$fetch['familya']?> <?=$fetch['ism']?> <?=$fetch['otch']?>
                </h1>
              </td>
              <td rowspan="2">
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                <!-- USER-PICTURE -->
                <img src="../../docs/rasm/<?=$fetch['rasm']?>" alt="" width="110" height="140" />
                <!-- /USER-PICTURE -->
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <p>
                  2007 yil 5 oktyabrdan: <br />
                  <b>
                    Toshkent davlat iqtisodiyot universitetining o‘quv ishlari bo‘yicha prorektori
                  </b>
                </p>
              </td>
            </tr>
            <tr>
              <td>
                <p>
                  <b>Tugʻilgan yili:</b> <br />
                  25.10.1960
                </p>
              </td>
              <td colspan="2">
                <p>
                  <b>Tugʻilgan joyi:</b> <br />
                  Toshkent viloyati, Qibray tumani
                </p>
              </td>
            </tr>
            <tr>
              <td>
                <p>
                  <b>Millati:</b> <br />
                  o‘zbek
                </p>
              </td>
              <td colspan="2">
                <p>
                  <b>Partiyaviyligi:</b> <br />
                  yo‘q
                </p>
              </td>
            </tr>
            <tr>
              <td>
                <p>
                  <b>Maʼlumoti:</b><br />
                  oliy
                </p>
              </td>
              <td colspan="2">
                <p>
                  <b>Tamomlagan:</b> <br />
                  1982-y. Toshkent davlat universiteti (kunduzgi)
                </p>
              </td>
            </tr>
            <tr>
              <td>
                <p>
                  <b>Maʼlumoti boʻyicha mutaxassisligi:</b><br />
                  iqtisodchi
                </p>
              </td>
            </tr>
            <tr>
              <td>
                <p>
                  <b>Ilmiy darajasi:</b><br />
                  yo'q
                </p>
              </td>
              <td>
                <p>
                  <b>Ilmiy unvoni:</b><br />
                  yo'q
                </p>
              </td>
            </tr>
            <tr>
              <td>
                <p>
                  <b>Qaysi chet tillarini biladi:</b><br />
                  rus, ingliz tillari
                </p>
              </td>
              <td>
                <p>
                  <b>Harbiy (maxsus) unvoni:</b><br />
                  yo'q
                </p>
              </td>
            </tr>
            <tr>
              <td colspan="3">
                <p>
                  <b>Davlat mukofotlari bilan taqdirlanganmi (qanaqa):</b><br />
                  yo'q
                </p>
              </td>
            </tr>
            <tr>
              <td colspan="3">
                <p>
                  <b>
                    Xalq deputatlari, respublika, viloyat, shahar va tuman Kengashi deputatimi yoki boshqa saylanadigan organlarning aʼzosimi (toʻliq koʻrsatilishi lozim):
                  </b>
                  <br />
                  yo'q
                </p>
              </td>
            </tr>
          </table>
        </section>
        <!-- /USER-INFO -->
        <br />
        <section>
          <h1>MEHNAT FAOLIYATI</h1>
          <p>
            1977-1982 yy. - Toshkent davlat universiteti talabasi<br />
            1982-1987 yy. - Toshkent davlat universiteti iqtisodiyot fakulteti kichik ilmiy xodimi<br />
          </p>
        </section>
        <br />
        <section>
          <h1><?=$fetch['familya']?> <?=$fetch['ism']?> <?=$fetch['otch']?>ning yaqin qarindoshlari haqida</h1>
          <h1>МАЪЛУМОТ</h1>
          <table class="table">
            <tr>
              <td><b>Qarindoshligi</b></td>
              <td><b>Familiyasi, ismi va otasining ismi</b></td>
              <td><b>Tugʻilgan yili va joyi</b></td>
              <td><b>Ish joyi va lavozimi</b></td>
              <td><b>Turar joyi</b></td>
            </tr>
            <tr>
              <td><b>Отаси</b></td>
              <td>Эшматов Баҳодир Темирович</td>
              <td>1935 йил, Тошкент вилояти, Қибрай тумани</td>
              <td>Пенсияда (Тошкент давлат иқтисодиёт университети доценти)</td>
              <td>Тошкент вилояти, Қибрай тумани, Бинокор кўчаси, 5-уй</td>
            </tr>
            <tr>
              <td><b>Онаси</b></td>
              <td>Абдушукурова (Хамдамова) Раҳима</td>
              <td>1936 йил, Тошкент вилояти, Қибрай тумани</td>
              <td>
                2000 йил вафот этган (Тошкент давлат иқтисодиёт университети
                доценти)
              </td>
            </tr>
            <tr>
              <td><b>Опаси</b></td>
              <td>Соатова (Эшматова) Гулчеҳра Баҳодировна</td>
              <td>1959 йил, Тошкент вилояти, Қибрай тумани</td>
              <td>Қибрай туманидаги касб-ҳунар коллежи ўқитувчиси</td>
              <td>Тошкент вилояти, Қибрай тумани, Бинокор кўчаси, 25-уй</td>
            </tr>
            <tr>
              <td><b>Укаси</b></td>
              <td>Эшматов Тохир Баҳодирович</td>
              <td>1972 йил, Тошкент вилояти, Қибрай тумани</td>
              <td>Ўзбекистон Республикаси Марказий банки етакчи иқтисодчиси</td>
              <td>Тошкент вилояти, Қибрай тумани, Бинокор кўчаси, 5-уй</td>
            </tr>
            <tr>
              <td><b>Турмуш ўртоғи</b></td>
              <td>Эшматова (Пирматова) Нозима Шарофходжаевна</td>
              <td>1968 йил, Тошкент шаҳри</td>
              <td>
                Тошкент шаҳар 1-марказий поликлиникаси физиотерапия бўлими
                шифокори
              </td>
              <td>
                Тошкент шаҳри, Миробод тумани, Нукус кўчаси, 20-уй, 21-хонадон
              </td>
            </tr>
          </table>
        </section>
      </div>
    </div>

    <button onclick="Export2Doc('exportContent');">Download as Word</button>
    
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
    <script>
      Export2Doc('exportContent');

      function Export2Doc(element, filename = "") {
        //  _html_ will be replace with custom html
        var meta =
          "Mime-Version: 1.0\nContent-Base: " +
          location.href +
          '\nContent-Type: Multipart/related; boundary="NEXT.ITEM-BOUNDARY";type="text/html"\n\n--NEXT.ITEM-BOUNDARY\nContent-Type: text/html; charset="utf-8"\nContent-Location: ' +
          location.href +
          "\n\n<!DOCTYPE html>\n<html>\n_html_</html>";
        //  _styles_ will be replaced with custome css
        var head =
          '<head>\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8">\n<style>\n_styles_\n</style>\n</head>\n';

        var html = document.getElementById(element).innerHTML;

        var blob = new Blob(["\ufeff", html], {
          type: "application/msword",
        });

        var css =
          "<style>" +
          "img {width:300px;}table {border-collapse: collapse; border-spacing: 0;}td{padding: 6px;}" +
          "</style>";
        //  Image Area %%%%
        var options = { maxWidth: 624 };
        var images = Array();
        var img = $("#" + element).find("img");
        for (var i = 0; i < img.length; i++) {
          // Calculate dimensions of output image
          var w = Math.min(img[i].width, options.maxWidth);
          var h = img[i].height * (w / img[i].width);
          // Create canvas for converting image to data URL
          var canvas = document.createElement("CANVAS");
          canvas.width = w;
          canvas.height = h;
          // Draw image to canvas
          var context = canvas.getContext("2d");
          context.drawImage(img[i], 0, 0, w, h);
          // Get data URL encoding of image
          var uri = canvas.toDataURL("image/png");
          $(img[i]).attr("src", img[i].src);
          img[i].width = w;
          img[i].height = h;
          // Save encoded image to array
          images[i] = {
            type: uri.substring(uri.indexOf(":") + 1, uri.indexOf(";")),
            encoding: uri.substring(uri.indexOf(";") + 1, uri.indexOf(",")),
            location: $(img[i]).attr("src"),
            data: uri.substring(uri.indexOf(",") + 1),
          };
        }

        // Prepare bottom of mhtml file with image data
        var imgMetaData = "\n";
        for (var i = 0; i < images.length; i++) {
          imgMetaData += "--NEXT.ITEM-BOUNDARY\n";
          imgMetaData += "Content-Location: " + images[i].location + "\n";
          imgMetaData += "Content-Type: " + images[i].type + "\n";
          imgMetaData +=
            "Content-Transfer-Encoding: " + images[i].encoding + "\n\n";
          imgMetaData += images[i].data + "\n\n";
        }
        imgMetaData += "--NEXT.ITEM-BOUNDARY--";
        // end Image Area %%

        var output =
          meta.replace("_html_", head.replace("_styles_", css) + html) +
          imgMetaData;

        var url =
          "data:application/vnd.ms-word;charset=utf-8," +
          encodeURIComponent(output);

        filename = filename ? filename + ".doc" : "document.doc";

        var downloadLink = document.createElement("a");

        document.body.appendChild(downloadLink);

        if (navigator.msSaveOrOpenBlob) {
          navigator.msSaveOrOpenBlob(blob, filename);
        } else {
          downloadLink.href = url;
          downloadLink.download = filename;
          downloadLink.click();
        }

        document.body.removeChild(downloadLink);
      }
      window.location.href = '../xodims-qabul.php?kadr_bulim_id=3';
    </script>
  </body>
</html>

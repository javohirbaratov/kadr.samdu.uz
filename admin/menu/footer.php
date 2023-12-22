
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/plagin/mess-alert.js"></script>
<script src="assets/js/datatable.js"></script>
<script src="assets/js/plagin/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="assets/js/app2.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
    $('#MyTable').DataTable( {
	    "buttons": [
	        'colvis',
	        'excel',
	        'print'
	    ],
        "language": {
            "lengthMenu": "Oynada _MENU_ element ko`rsatiladi",
            "search": "Qidirish",
            "oPaginate": {
	            "sNext":    "Keyingi",
	            "sPrevious": "Oldingi"
	        },
	        "sInfoFiltered": "(Filtrer un maximum de_MAX_)",
            "zeroRecords": "Ma'lumot topilmadi!",
          "info":           "Ko'rsatilyapti _START_ dan boshlab _END_ gacha _TOTAL_ tadan",
            "infoEmpty": "Ma'lumot topilmadi!",
            "infoFiltered": "(Hammasi bo'lib _MAX_ ta element bor )"
        }
    } );
} );
</script>
<!-- ////////DELETED MODAL\\\\\\\\  -->
<script type="text/javascript">

    (function(){
  var $content = $('#modal1').detach();

  $('.deletef').on('click', function(e){
    localStorage.bestid = this.attributes[1].nodeValue;
    console.log(localStorage.bestid);
    modal.open({
      content: $content,
      width: 540,
      height: 270,
    });
    $content.addClass('modal_content');
    $('.modal, #modal11').addClass('display');
    $('.deletef').addClass('load');
  });
}());

var modal = (function(){
  var $close = $('<button role="button" class="modal_close" title="Close"><span class="cls"></span></button>');
  var $content = $('<div class="modal_content"/>');
  var $modal = $('<div class="modal"/>');
  var $window = $(window);

  $modal.append($content, $close);

  $close.on('click', function(e){
    $('.modal, #modal11').removeClass('display');
    $('.deletef').removeClass('load');

    modal.close();
  });



  return {
    center: function(){
      var top = Math.max($window.height() - $modal.outerHeight(), 0) / 2;
      var left = Math.max($window.width() - $modal.outerWidth(), 0) / 2;
      $modal.css({
        top: top + $window.scrollTop(),
        left: left + $window.scrollLeft(),
      });
    },
    open: function(settings){
      $content.empty().append(settings.content);

      $modal.css({
        width: settings.width || 'auto',
        height: settings.height || 'auto'
      }).appendTo('body');

      modal.center();
      $(window).on('resize', modal.center);
      document.getElementById('delete').setAttribute("onclick", 'delinfo(' + localStorage.bestid + ');');
      $('.bekorqil').on('click', function(e){
        $('.modal, #modal11').removeClass('display');
        $('.deletef').removeClass('load');
        modal.close();
      });
    },
    close: function(){
      $content.empty();
      $modal.detach();
      $(window).off('resize', modal.center);
    }
  };
}());
</script>
<!-- ////////DELETED MODAL\\\\\\\\  -->


<!-- ////////EDIT MODAL\\\\\\\\  -->


<script type="text/javascript">
   var obj;
    (function(){
  var $content = $('#modal2').detach();

  $('.taxrirf').on('click', function(e){
    obj = this;
    modal2.open({
      content: $content,
      width: 540,
      height: 270,
    });
    $content.addClass('modal_content');
    $('.modal, #modal22').addClass('display');
    $('.taxrirf').addClass('load');
  });
}());

var modal2 = (function(){
  var $close = $('<button role="button" class="modal_close" title="Close"><span class="cls"></span></button>');
  var $content = $('<div class="modal_content"/>');
  var $modal2 = $('<div class="modal"/>');
  var $window = $(window);

  $modal2.append($content, $close);

  $close.on('click', function(e){
    $('.modal, #modal22').removeClass('display');
    $('.taxrirf').removeClass('load');

    modal2.close();
  });



  return {
    center: function(){
      var top = Math.max($window.height() - $modal2.outerHeight(), 0) / 10;
      var left = Math.max($window.width() - $modal2.outerWidth(), 0) / 2;
      $modal2.css({
        top: top + $window.scrollTop(),
        left: left + $window.scrollLeft(),
      });
    },
    open: function(settings){
      $content.empty().append(settings.content);

      $modal2.css({
        width: settings.width || 'auto',
        height: settings.height || 'auto'
      }).appendTo('body');

      modal2.center();
      $(window).on('resize', modal2.center);
      modalinfos(obj);

      $('.bekorqil').on('click', function(e){
        $('.modal, #modal22').removeClass('display');
        $('.taxrirf').removeClass('load');
        modal2.close();
      });
    },
    close: function(){
      $content.empty();
      $modal2.detach();
      $(window).off('resize', modal2.center);
    }
  };
}());
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/docxtemplater/3.28.5/docxtemplater.js"></script>
      <script src="https://unpkg.com/pizzip@3.1.1/dist/pizzip.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.8/FileSaver.js"></script>
    <script src="https://unpkg.com/pizzip@3.1.1/dist/pizzip-utils.js"></script>




<!-- ////////EDIT MODAL\\\\\\\\  -->
</body>
</html>

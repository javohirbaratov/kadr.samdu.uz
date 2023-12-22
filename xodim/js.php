
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <!-- Data table plugin-->
    <script src="js/DataTables/datatables.min.js"></script>
    <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
    <script src="js/DataTables/dataTables.buttons.min.js"></script>
    <script src="js/DataTables/jszip.min.js"></script>
    <script src="js/DataTables/pdfmake.min.js"></script>
    <script src="js/DataTables/vfs_fonts.js"></script>
    <script src="js/DataTables/buttons.html5.min.js"></script>
    <script src="js/DataTables/buttons.print.min.js"></script>
    <!-- <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script> -->
    <script type="text/javascript" src="js/plugins/select2.min.js"></script>
    <script type="text/javascript">
      $('#sampleTable').DataTable( {
        dom: 'Bfrtip',
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 talab', '25 talab', '50 talab', 'Barchasi' ]
        ],        
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print',
        ],
        language: {
          search: 'Qidiruv', // removed the word 'search' from the left of search
          "paginate": {
            "previous": "Orqaga",
            "next": "Keyingi"
          },
          "emptyTable":     "Bu jadval bo'sh. Malumot yo'q",
          "info":           "Ko'rsatilyapti _START_ dan boshlab _END_ gacha _TOTAL_ tadan",
          "infoEmpty":      "Ko'rsatilyapti 0 ta 0  0 tadan",
          "zeroRecords":    "Bunday ma'lumot topilmadi",
        },
        initComplete: function() {
          $('div.dataTables_filter input').attr('placeholder', 'Kiriting') // put 'search' inside of search box
        },
      });
      // $('#sampleTable').DataTable();
    </script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="js/plugins/bootstrap-notify.min.js"></script>
    <script type="text/javascript" src="js/plugins/sweetalert.min.js"></script>
    <?php

      if ($_SESSION['xatolik']==1) {
        ?>
          <script type="text/javascript">
            swal("Xatolik", "Xatolik ro'y berdi. Qaytadan urining", "error");    
          </script>
          <?php
        $_SESSION['xatolik']=0;
      }
       if ($_SESSION['success']==1) {
        ?>
          <script type="text/javascript">
            swal("Bajarildi", "Buyruq turi qo'shildi", "success");    
          </script>
           <?php
        $_SESSION['success']=0;
      }

    ?>
<?php include_once 'ximoya.php';?>
<table class="table table-hover table-bordered" id="sampleTable">
    <thead>
      <tr>
      	<th>Nomer</th>
        <th>Bo'lim nomi</th>
        <th>Kadrlar bo'limi</th>
        <th>Bo'lim</th>
        <th>Bo'linma/Kafedra</th>
        <th>Yats turi</th>
        <th>Oylik maosh</th>
        <th>Razryad</th>
        <th>Koef</th>
        <th>Shtat</th>
        <th>Band</th>
        <th>Bo'sh</th>        
        <th>Amal</th>
      </tr>
    </thead>
    <tbody>
    	<?
        $raz = mysqli_query($link,"SELECT * FROM settings");
        $settings = mysqli_fetch_assoc($raz);
        $ebh = $settings['qiymat'];

    		$t=0;
        if(isset($_GET['action'])){
          $kb_id = filter($_GET['kb_id']);
          $bulim_id = filter($_GET['bulim_id']);
          $kafedra_id = filter($_GET['bulinma_id']);
          $turi = filter($_GET['turi']);

          $query = "SELECT * FROM lavozimlar WHERE id>'0'";
          if($kb_id!=-1){
              $query .= " AND kadr_bulim_id='$kb_id'";
          }
          if($bulim_id!=-1){            
            $query .= " AND bulim_id='$bulim_id'";
          }
          if($kafedra_id!=0){
            $query .= " AND kafedra_id='$kafedra_id'";
          }
          if($turi!=-1){
            $query .= " AND turi='$turi'";            
          }          
          $sql = mysqli_query($link, $query);
        }
        else{
          $sql = mysqli_query($link,"SELECT * FROM lavozimlar ORDER BY id ASC");  
        }    		
    		while($fetch = mysqli_fetch_assoc($sql)){

          if($fetch['turi']=="razryad"){
            $fetch['oylik'] = $fetch['tarifkoef'] * $ebh;
          }

    			$t++;
    			$kadr_bulim_id = $fetch['kadr_bulim_id'];
    			$sql2 = mysqli_query($link,"SELECT * FROM kadrlarbulimi WHERE id='$kadr_bulim_id'");
    			$kb = mysqli_fetch_assoc($sql2);
    			
    			$bulim_id = $fetch['bulim_id'];
    			$sql2 = mysqli_query($link,"SELECT * FROM bulimlar WHERE id='$bulim_id'");
    			$bulim = mysqli_fetch_assoc($sql2);

    			$kf_id = $fetch['kafedra_id'];    			
    			$sql2 = mysqli_query($link,"SELECT * FROM kafedra WHERE id='$kf_id'");
    			$kafedra = mysqli_fetch_assoc($sql2);

          $lavozim_id = $fetch['id'];
          $sql2 = mysqli_query($link,"SELECT SUM(shtat) FROM workplace WHERE lavozim_id='$lavozim_id'");
          $w = mysqli_fetch_row($sql2);
          $vakansiya = $fetch['shtat'] - $w[0];


    	?>
    	<tr id="tr<?=$fetch['id']?>">
          	<td><?=$t?></td>
            <td><?=$fetch['lavozim']?></td>
            <td><?=$kb['name']?></td>
            <td><?=$bulim['name']?></td>
            <td><?=$kafedra['name']?></td>
            <td><?=$fetch['turi']?></td>
            <td><?=$fetch['oylik']?></td>            
            <td><?=$fetch['razryad']?></td>
            <td><?=$fetch['tarifkoef']?></td>
            <td><?=$fetch['shtat']?></td>
            <td><?=$w[0]?></td>
            <td><?=$vakansiya?></td>
            <td><a href="lavozim-update.php?l_id=<?=$fetch['id']?>" class="btn btn-primary"><i class="fa fa-pencil"></i> O'zgartirish</a><button class="btn btn-danger" onclick="udalit(<?=$fetch['id']?>)"><i class="fa fa-trash"></i> O'chirish</button></td>
        </tr>	
        <?}?>
    </tbody>
  </table>
  
  <script type="text/javascript">
    $('#sampleTable').DataTable( {
      dom: 'Bfrtip',
      lengthMenu: [
          [ 10, 25, 50, -1 ],
          [ '10 talab', '25 talab', '50 talab', 'Barchasi' ]
      ],        
      buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print','pageLength',
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


   function udalit(id) {
    swal({
        title: "Ishonchingiz komilmi?",
        text: "Bu jarayonga shaxsan siz javobgarsiz!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ha",
        closeOnConfirm: false
    }, function (isConfirm) {
        if (!isConfirm) return;
        $.ajax({
            url: "user-delete.php",
            type: "GET",
            data: {
                id: id,
                action:'lavozim',
            },
            dataType: "html",
            success: function () {
              $('#tr'+id).remove();
                swal("Bajarildi!", "", "success");
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Xatolik!", "", "error");
            }
        });
    });
}
  </script>
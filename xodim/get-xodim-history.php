<?php include_once 'ximoya.php'; ?>
		<table class="table table-hover table-bordered" id="sampleTable">
      <thead>
        <tr>
        	<th>No</th>
          <th>F.I.O</th>
          <th>Lavozim</th>
          <th>Qabul qilingan sana</th>
          <th>Buyruq raqam(sana)</th>                        
          <th>Amallar</th>
        </tr>
      </thead>
      <tbody>
      	<?                        
          if($_GET['action']=="filter"){
            $sql = "SELECT * FROM workplace WHERE id>0";
            if($_GET['kb']>0){
              $kb = filter($_GET['kb']);
              $kadr_bulim_id = filter($_GET['kadr_bulim_id']);
              $sql .= " and kadr_bulim_id='$kb'";
            }
            if($_GET['bulim_id']>0){
              $bulim_id = filter($_GET['bulim_id']);
              $bulim_id = filter($_GET['bulim_id']);
              $sql .= " and bulim_id='$bulim_id'";
            }
            if($_GET['lavozim_id']>0){
              $lavozim_id = filter($_GET['lavozim_id']);
              $lavozim_id = filter($_GET['lavozim_id']);
              $sql .= " and lavozim_id='$lavozim_id'";
            }
            if($_GET['faoliyat']!=-1){
              $faoliyat = filter($_GET['faoliyat']);
              $faoliyat = filter($_GET['faoliyat']);
              $sql .= " and faoliyat='$faoliyat'";
            }
            $sql = mysqli_query($link,$sql);                          
          }
          else{
            if(isset($_GET['kadr_bulim_id'])){
              $kadr_bulim_id = filter($_GET['kadr_bulim_id']);
              $sql = mysqli_query($link,"SELECT * FROM workplace WHERE kadr_bulim_id='$kadr_bulim_id' ORDER BY id ASC");
            }
            else{
              $sql = mysqli_query($link,"SELECT * FROM workplace ORDER BY id ASC"); 
            }  
          }                    		
      		$i = 0;
          $summashtat = 0;
          $erkak = 0;
          $ayol = 0;
      		while($fetch = mysqli_fetch_assoc($sql)){
      			$i++;
      			$user_id = $fetch['xodim_id'];
      			$sql2 = mysqli_query($link,"SELECT * FROM xodimlar WHERE id='$user_id'");
      			$xodim = mysqli_fetch_assoc($sql2);

            $kadr_bulim_id = $fetch['kadr_bulim_id'];
            $sql2 = mysqli_query($link,"SELECT * FROM kadrlarbulimi WHERE id='$kadr_bulim_id'");
            $kadrlarbulimi = mysqli_fetch_assoc($sql2);

            $bulim_id = $fetch['bulim_id'];
            $sql2 = mysqli_query($link,"SELECT * FROM bulimlar WHERE id='$bulim_id'");
            $bulimlar = mysqli_fetch_assoc($sql2);

            $lavozim_id = $fetch['lavozim_id'];
            $sql2 = mysqli_query($link,"SELECT * FROM lavozimlar WHERE id='$lavozim_id'");
            $lavozimlar = mysqli_fetch_assoc($sql2);

            $buyruq_id = $fetch['buyruq_id']; // Agar lavozim o'zgargan bo'lsa oxirgi buyrug'i
            $sql2 = mysqli_query($link,"SELECT * FROM changelavozim WHERE user_id='$user_id' ORDER BY id DESC");
            $change = mysqli_fetch_assoc($sql2);
            if($change['id']>0){
              $buyruq_id = $change['buyruq_id'];
            }                          
            $sql2 = mysqli_query($link,"SELECT * FROM buyruq WHERE id='$buyruq_id'");
            $buyruq = mysqli_fetch_assoc($sql2);
            $buyruq['sana'] = strtotime($buyruq['sana']);
            $fetch['sana'] = strtotime($fetch['sana']);
            $summashtat += $fetch['shtat'];

            if($xodim['jinsi']=="erkak"){
              $erkak += 1;
            }
            if($xodim['jinsi']=="ayol"){
              $ayol += 1;
            }                          

      	?>
      	<tr id="tr<?=$fetch['id']?>">
      			<td><?=$i?></td>
          	<td><?=$xodim['familya']?> <?=$xodim['ism']?> <?=$xodim['otch']?></td>
            <td><?=$lavozimlar['lavozim']?></td>
            <td><?=date("d.m.Y",$fetch['sana'])?></td>
            <td><?=date("d.m.Y",$buyruq['sana'])?></td>
            <td><button onclick="add(<?=$xodim['id']?>)" class="btn btn-success"><i class="fa fa-plus"></i> Qo'shish</button><button onclick="viewhistory(<?=$xodim['id']?>)" class="btn btn-primary"><i class="fa fa-eye"></i> Ko'rish</button><button onclick="edithistory(<?=$xodim['id']?>)" class="btn btn-warning"><i class="fa fa-pencil"></i> Tahrirlash</button></td>
        </tr>	
        <?}?>
      </tbody>
    </table>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="infocontent">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Yopish</button>
            <button type="button" class="btn btn-primary" id="btnok" style="display: none;">Saqlash</button>
          </div>
        </div>
      </div>
    </div>

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
      // $('#exampleModal').modal('show');
      function viewhistory(id) {
        $('#btnok').css("display","none");
        $.ajax({
          url: "get-history-work.php",
          type: "GET",
          data:{
            user_id:id,
          },
          success:function(data) {
            $('#infocontent').html(data);
          },
          error:function(xhr) {
            swal("Xatolik", "Internetdan uzilish ro'y berdi", "error");    
          }
        });
        $('#infocontent').html(id);
        $('#exampleModal').modal('show');
      }
      function edithistory(id) {
        $('#btnok').css("display","block");
        $.ajax({
          url: "get-history-edit-work.php",
          type: "GET",
          data:{
            user_id:id,
          },
          success:function(data) {
            $('#infocontent').html(data);
          },
          error:function(xhr) {
            swal("Xatolik", "Internetdan uzilish ro'y berdi", "error");    
          }
        });
        $('#infocontent').html('edit'+id);
        $('#exampleModal').modal('show');
      }
      function add(id) {
        // $('#btnok').css("display","block");
        $.ajax({
          url: "add-history-work.php",
          type: "GET",
          data:{
            user_id:id,
          },
          success:function(data) {
            $('#infocontent').html(data);
          },
          error:function(xhr) {
            swal("Xatolik", "Internetdan uzilish ro'y berdi", "error");    
          }
        });
        $('#infocontent').html('edit'+id);
        $('#exampleModal').modal('show');
      }
    </script>
<?php include_once 'ximoya.php';
error_reporting(0); ?>

<table class="table table-hover table-bordered" id="sampleTable">
  <thead>
    <tr>
     <th>No</th>
     <th>Kadr bo'limi</th>
     <th>Bo'lim nomi</th>
     <th>Bo'linma nomi</th>
     <th>Lavozim</th>
     <th>F.I.O</th> 
     <th>Faoliyat turi</th>
     <th>Shtat</th>
     <th>Ma'lumot</th>
     <th>Mutaxassis</th>


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
      $sql .= " and lavozim='$lavozim_id'";
    }
    if($_GET['faoliyat']!=-1){
      $faoliyat = filter($_GET['faoliyat']);
      $faoliyat = filter($_GET['faoliyat']);
      $sql .= " and urindosh='$faoliyat'";
    }


    if($_GET['shtat']>0) {
      $shtat = filter($_GET['shtat']);
      $sql .= " and shtat=$shtat";
    }
    
    if(isset($_GET['malumot']) AND $_GET['malumot'] != "") {
      $malumot = filter($_GET['malumot']);
      $sql .= " and malumot='$malumot'";
    }
    
    $sql = mysqli_query($link,$sql);   
    $fetch = mysqli_fetch_assoc($sql);
                     
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
   $user_id = $fetch['user_id'];
   $sql2 = mysqli_query($link,"SELECT * FROM xodimlar WHERE id='$user_id'");
   $xodim = mysqli_fetch_assoc($sql2);

   $kadr_bulim_id = $fetch['kadr_bulim_id'];
   $sql2 = mysqli_query($link,"SELECT * FROM kadrlarbulimi WHERE id='$kadr_bulim_id'");
   $kadrlarbulimi = mysqli_fetch_assoc($sql2);

   $bulim_id = $fetch['bulim_id'];
   $sql2 = mysqli_query($link,"SELECT * FROM bulimlar WHERE id='$bulim_id'");
   $bulimlar = mysqli_fetch_assoc($sql2);

   $kafedra_id = $fetch['kafedra_id'];
   $sql10 = mysqli_query($link,"SELECT * FROM kafedra WHERE id='$kafedra_id'");
   $kafedralar = mysqli_fetch_assoc($sql10);

   $lavozim_id = $fetch['lavozim'];
   $sql2 = mysqli_query($link,"SELECT * FROM lavozimlar WHERE id='$lavozim_id'");
   $lavozimlar = mysqli_fetch_assoc($sql2);

                          $buyruq_id = $fetch['buyruq']; // Agar lavozim o'zgargan bo'lsa oxirgi buyrug'i
                          $sql2 = mysqli_query($link,"SELECT * FROM changelavozim WHERE user_id='$user_id' ORDER BY id DESC");
                          $change = mysqli_fetch_assoc($sql2);
                          if($change['id']>0){
                            $buyruq_id = $change['buyruq'];
                          }                          
                          $sql3 = mysqli_query($link,"SELECT * FROM buyruq WHERE id='$buyruq_id'");
                          $buyruq = mysqli_fetch_assoc($sql3);
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
                            <td><?=strtoupper($kadrlarbulimi['name'])?></td>
                            <td><?=strtoupper($bulimlar['name'])?></td>
                            <td><?=strtoupper($kafedralar['name'])?></td>
                            <td><?=strtoupper($lavozimlar['lavozim'])?></td>
                            <td><?=strtoupper($xodim['familya'])?> <?=strtoupper($xodim['ism'])?> <?=strtoupper($xodim['otch'])?></td>
                            <td><?=strtoupper($fetch['urindosh'])?></td>
                            <td><?=strtoupper($fetch['shtat'])?></td>
                            <td><?=strtoupper($fetch['malumot'])?></td>
                            <td><?=strtoupper($fetch['mutaxassis'])?></td>


                           <td><a href="xodim-view.php?id=<?=$fetch['user_id']?>" class="btn btn-success"><i class="fa fa-eye"></i> Batafsil</a><!--<a href="obektivka-generate/index.php?id=<?=$fetch['xodim_id']?>" class="btn btn-default"><i class="fa fa-user"></i> Obektivka</a><a href="tinglovchi-update.php?id=<?=$fetch['id']?>" class="btn btn-primary"><i class="fa fa-pencil"></i> Tahrirlash</a><button class="btn btn-danger" onClick="udalit(<?=$fetch['id']?>)"><i class="fa fa-trash"></i> O'chirish</button>--></td>
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
                  </script>
                  <script type="text/javascript">
                    $('#xodimcount').html(<?=$i?>);
                    $('#shtatcount').html(<?=$summashtat?>);
                    $('#erkakcount').html(<?=$erkak?>);
                    $('#ayolcount').html(<?=$ayol?>);
                  </script>
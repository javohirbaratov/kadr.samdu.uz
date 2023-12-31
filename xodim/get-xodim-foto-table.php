<?php include_once 'ximoya.php'; ?>

									<table class="table table-hover table-bordered" id="sampleTable2">
                    <thead>
                      <tr>
                      	<th>No</th>
                        <th>F.I.Sh Tug'ilgan vaqti va joyi, millati</th>
                        <th>Rasm</th>
                        <th>Kadr bo'limi</th>
                         <th>Bo'lim</th>
                          <th>Bo'linma</th>
                        <th>Lavozimi</th>
                        <th>Maʼlumoti, mutaxasisligi (diplom boʻyicha)</th>
                        <th>PASPORT</th>                        
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
                          $sql = mysqli_query($link,$sql);                          
                        }
                        else{
                          if(isset($_GET['kadr_bulim_id'])){
                            $kadr_bulim_id = filter($_GET['kadr_bulim_id']);
                            $sql = mysqli_query($link,"SELECT * FROM workplace WHERE kadr_bulim_id='$kadr_bulim_id' ORDER BY id ASC");
                          }
                          else{
                            $sql = mysqli_query($link,"SELECT * FROM workplace WHERE id>0"); 
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
                          $sql3 = mysqli_query($link,"SELECT * FROM kafedra WHERE id='$kafedra_id'");
                          $kafedralar = mysqli_fetch_assoc($sql3);

                          $lavozim_id = $fetch['lavozim'];
                          $sql2 = mysqli_query($link,"SELECT * FROM lavozimlar WHERE id='$lavozim_id'");
                          $lavozimlar = mysqli_fetch_assoc($sql2);

                          $buyruq_id = $fetch['buyruq']; // Agar lavozim o'zgargan bo'lsa oxirgi buyrug'i
                          
                                                
                          $sql2 = mysqli_query($link,"SELECT * FROM buyruq WHERE id='$buyruq_id'");
                          $buyruq = mysqli_fetch_assoc($sql2);
                         
                          
                          $summashtat += intval($fetch['shtat']);

                          if($xodim['jinsi']=="erkak"){
                            $erkak += 1;
                          }
                          if($xodim['jinsi']=="ayol"){
                            $ayol += 1;
                          }                          

                    	?>
                    	<tr id="tr<?=$fetch['id']?>">
                    			<td><?=$fetch['id']?></td>
	                      	<td><?=$xodim['familya']?> <?=$xodim['ism']?> <?=$xodim['otch']?> <br><?=date("d.m.Y", strtotime($xodim['birthdate']))?> <br> <?=$xodim['jshir']?> <br> <?=$xodim['millati']?></td>
	                      	<td><img src="../bot/uploads/<?=$xodim['rasm']?>" width="50"></td>
	                      	<td><?=$kadrlarbulimi['name']?> </td>
	                      	 <td><?=$bulimlar['name']?> </td>
	                      	 <td><?=$kafedralar['name']?> </td>
                          <td> <?=$lavozimlar['lavozim']?> </td>
                          <td><?=$fetch['malumot']?></td>
                          <td><?=$xodim['seriya']?> <?=$xodim['nomer']?> <?=$xodim['pasportjoy']?>  <a target="_blank" href ="../bot/uploads/<?=$xodim['passport']?>" >Pasport</a></td>
	                    </tr>	
	                    <?}?>
                    </tbody>
                  </table>
                  <script type="text/javascript">
                    $('#sampleTable2').DataTable( {
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
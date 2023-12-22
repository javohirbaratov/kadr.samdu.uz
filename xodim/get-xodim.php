<?php include_once 'ximoya.php'; ?>

									<table class="table table-hover table-bordered" >
                    <thead>
                      <tr>
                      	<th>No</th>
                        <th>F.I.O</th>
                        <th>JSHSHIR</th>
                        <th>Rasm</th>
                        <th>Pasport</th>
                        <th>Ob'yektivka</th>
                      </tr>
                    </thead>
                    <tbody>
                    	<?                        
                        if(isset($_GET['xodim_id'])){
                          $user_id = $_GET['xodim_id'];
                          $sql = mysqli_query($link,"SELECT * FROM xodimlar WHERE id='$user_id'");
                          $fetch = mysqli_fetch_assoc($sql);
                          
                    	?>
                    	<tr>
                    			<td><?=$fetch['id']?></td>
	                      	<td><?=$fetch['familya']?> <?=$fetch['ism']?> <?=$fetch['otch']?></td>
                          <td><?=$fetch['jshir']?></td>
                        
                                <td><img src="../bot/uploads/<?=$fetch['rasm']?>" width="50"></td>
                                 
                                <td><a target="_blank" href="../bot/uploads/<?=$fetch['passport']?>">Pasportni Yuklash</a></td>
                                <td><a target="_blank"  href="../bot/uploads/<?=$fetch['obyektivka']?>">Obyektivkani Yuklash</a></td>
                             
	                      	
                          
                          
	                    </tr>	
	                    <?}?>
                    </tbody>
                  </table>
                  
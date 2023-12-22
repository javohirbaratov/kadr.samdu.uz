<?php
	include_once 'ximoya.php';

?>
<h1 id="jamidisplay">Jami : 1</h1>
<table class="table table-hover table-bordered" id="sampleTable">
    <thead>
        <tr>
            <th>Amallar</th>
            <th>F.I.O</th>
            <th>Tug'ilgan sana</th>
            <th>Kursga qo'shilgandagi yoshi</th>
            <th>Jinsi</th>
            <th>Manzili</th>
            <th>Telefon</th>
            <th>Kurs</th>
            <th>Boshlanish vaqti-Tugash vaqti</th>
            <th>Kurs o'tiladigan joy</th>
            <th>Sertifikat nomeri</th>
            <th>Tashkilot nomi</th>
            <th>Lavozim</th>
            <th>Kurslardan qanday natijaga erishilganligi</th>
            <th>Kurslardan qanday ko’nikma/texnologiyalar/tajribalarga erishilganligi</th>
            <th>Kurslardan keyin</th>
        </tr>
    </thead>
    <tbody>
        <?  
            $jami = 0;
            $natijafilter = array();
            $statusfilter = array();
            $viloyat_id = $_SESSION['viloyat_id'];
            if(isset($_POST['viloyat_id'])){
                if(isset($_POST['natija_id'])){
                    
                    $n = count($_POST['natija_id']);
                    for ($i=0; $i < $n; $i++) { 
                        array_push($natijafilter, $_POST['natija_id'][$i]);
                    }
                }
                if(isset($_POST['status_id'])){
                    
                    $n = count($_POST['status_id']);
                    for ($i=0; $i < $n; $i++) { 
                        array_push($statusfilter, $_POST['status_id'][$i]);
                    }    
                }
                $viloyat_id = $_SESSION['viloyat_id'];
                //print_r($_POST);
                if($_POST['viloyat_id']==-1 && $_POST['tuman_id']==-1 && $_POST['jins']==-1 && $_POST['sana1']=="" && $_POST['sana2']=="" && $_POST['kurs_id']==-1){
                    //echo "salom";
                    $sql = mysqli_query($link,"SELECT * FROM tinglovchilar WHERE viloyat_id='$viloyat_id' ORDER BY id ASC");
                }
                else{
                    $q = "SELECT * FROM tinglovchilar WHERE id>'0'";
                    $q .= "and viloyat_id='$viloyat_id'";
                    $tuman_id = filter($_POST['tuman_id']);
                    if($tuman_id!=-1){
                        $q .= "and tuman_id='$tuman_id'";
                    }
                    $kurs_id = filter($_POST['kurs_id']);
                    if($kurs_id!=-1){
                        $q .= "and kurs_id='$kurs_id'";
                    }
                    $jins = filter($_POST['jins']);
                    if($jins=="Erkak"){
                        $q .= "and jinsi='Erkak'";
                    }
                    if($jins=="Ayol"){
                        $q .= "and jinsi='Ayol'";
                    }
                    $sana1 = filter($_POST['sana1']);
                    if($sana1!=""){
                        $sana1 = strtotime($sana1);
                        $q .= "and sana1>='$sana1'";
                    }
                    $sana2 = filter($_POST['sana2']);
                    if($sana2!=""){
                        $sana2 = strtotime($sana2);
                        $q .= "and sana2<='$sana2'";
                    }
                    $sql = mysqli_query($link, $q);
                }
            }
            else{
                $sql = mysqli_query($link,"SELECT * FROM tinglovchilar WHERE viloyat_id='$viloyat_id' ORDER BY id ASC");   
            }      		
      		while($fetch = mysqli_fetch_assoc($sql)){
      			$vil_id = $fetch['viloyat_id'];
      			$sql2 = mysqli_query($link,"SELECT * FROM viloyat WHERE id='$vil_id'");
      			$viloyat = mysqli_fetch_assoc($sql2);
      			$tuman_id = $fetch['tuman_id'];
      			$sql2 = mysqli_query($link,"SELECT * FROM tuman WHERE id='$tuman_id'");
      			$tuman = mysqli_fetch_assoc($sql2);
      			$kurs_id = $fetch['kurs_id'];
      			$sql2 = mysqli_query($link,"SELECT * FROM kurslar WHERE id='$kurs_id'");
      			$kurslar = mysqli_fetch_assoc($sql2);

      			//$natija_id = $fetch['natija_id'];      			
      			//$status_id = $fetch['status_id'];
      	?>
            <?
                $ntf = 0;
                $stf = 0;
                $natijatxt = "";
                $tinglovchi_id = $fetch['id'];
                $q1 = mysqli_query($link,"SELECT * FROM results WHERE tinglovchi_id='$tinglovchi_id'");
                while ($natijas = mysqli_fetch_assoc($q1)){
                  $natija_id = $natijas['natija_id'];
                  $q2 = mysqli_query($link,"SELECT * FROM natijalar WHERE id='$natija_id'");
                  $natija = mysqli_fetch_assoc($q2);
                  $natijatxt .= $natija['name']."<br>";
                  if(in_array($natija_id, $natijafilter)){
                    $ntf++;
                  }
                }
            ?>
            <?
                $statustxt = "";
                $tinglovchi_id = $fetch['id'];
                $q1 = mysqli_query($link,"SELECT * FROM statusresult WHERE tinglovchi_id='$tinglovchi_id'");
                while ($statuses = mysqli_fetch_assoc($q1)){
                  $status_id = $statuses['status_id'];
                  $q2 = mysqli_query($link,"SELECT * FROM statuslar WHERE id='$status_id'");
                  $status = mysqli_fetch_assoc($q2);
                  $statustxt .= $status['name']."<br>";
                  if(in_array($status_id, $statusfilter)){
                    $stf++;
                  }
                }

                if(count($statusfilter)>0 and count($natijafilter)>0){
                    if($ntf==0 && $stf==0){
                        continue;
                    }
                }
                else{
                    if(count($natijafilter)>0){
                        if($ntf==0){
                            continue;
                        }
                    }
                    if(count($statusfilter)>0){
                        if($stf==0){
                            continue;
                        }
                    }
                }
                $jami++;
            ?>
        <tr id="tr<?=$fetch['id']?>">
            <td><a href="tinglovchi-view.php?id=<?=$fetch['id']?>" class="btn btn-success"><i class="fa fa-eye"></i> Batafsil</a><a href="tinglovchi-view.php?id=<?=$fetch['id']?>&print" class="btn btn-warning"><i class="fa fa-print"></i> Pechat</a><a href="tinglovchi-update.php?id=<?=$fetch['id']?>" class="btn btn-primary"><i class="fa fa-pencil"></i> Tahrirlash</a><button class="btn btn-danger" onClick="udalit(<?=$fetch['id']?>)"><i class="fa fa-trash"></i> O'chirish</button></td>
            <td>
                <?=$fetch['fio']?>
            </td>
            <td>
                <?=date("d.m.Y",$fetch['birthsana'])?>
            </td>
            <td>
                <?=$fetch['yoshi']?> yoshda</td>
            <td>
                <?=$fetch['jinsi']?>
            </td>
            <td>
                <?=$viloyat['nomi']?><br>
                <?=$tuman['nomi']?><br>
                <?=$fetch['manzil']?>
            </td>
            <td>
                <?=$fetch['telefon']?>
            </td>
            <td>
                <?=$kurslar['kurs_nomi']?>
            </td>
            <td>
                <?=date("d.m.Y", $fetch['sana1'])?>-
                <?=date("d.m.Y", $fetch['sana2'])?>
            </td>
            <td>
                <?=$fetch['kursjoy']?>
            </td>
            <td>
                <?=$fetch['sernom']?>
            </td>
            <td>
                <?=$fetch['tashkilot']?>
            </td>
            <td>
                <?=$fetch['lavozim']?>
            </td>
            <td>
                <?=$natijatxt?>
            </td>
            <td>
                <?=$fetch['tajriba']?>
            </td>
            <td>
                <?=$statustxt?>
            </td>
        </tr>
        <?}?>
        <?if($jami>0){?>
        <tr style="display: none;">
            <td></td>
            <td>
                <b style="font-weight: bold; text-transform: uppercase; font-size: 20px;">Jami tinglovchilar soni: </b>
            </td>
            <td>
                <?=$jami?>
            </td>
            <td>
               
            <td>
                
            </td>
            <td>
                
            </td>
            <td>
                
            </td>
            <td>
                
            </td>
            <td>
                
            </td>
            <td>
                
            </td>
            <td>
                
            </td>
            <td>
                
            </td>
            <td>
                
            </td>
            <td>
                
            </td>
            <td>
                
            </td>
            <td>
                
            </td>
        </tr>
        <?}?>
    </tbody>
</table>
<script type="text/javascript">
	$('#sampleTable').DataTable({
	    dom: 'Bfrtip',
	    lengthMenu: [
	        [10, 25, 50, -1],
	        ['10 talab', '25 talab', '50 talab', 'Barchasi']
	    ],
	    buttons: [
	        'copy', 'csv', 'excel', 'pdf', 'print', 'pageLength',
	    ],
	    language: {
	        search: 'Qidiruv', // removed the word 'search' from the left of search
	        "paginate": {
	            "previous": "Orqaga",
	            "next": "Keyingi"
	        },
	        "emptyTable": "Bu jadval bo'sh. Malumot yo'q",
	        "info": "Ko'rsatilyapti _START_ dan boshlab _END_ gacha _TOTAL_ tadan",
	        "infoEmpty": "Ko'rsatilyapti 0 ta 0  0 tadan",
	        "zeroRecords": "Bunday ma'lumot topilmadi",
	    },
	    initComplete: function() {
	        $('div.dataTables_filter input').attr('placeholder', 'Kiriting') // put 'search' inside of search box
	    },
	});
    $('#jamidisplay').html("Jami : <?=$jami?>");
	// $('#sampleTable').DataTable();
</script>
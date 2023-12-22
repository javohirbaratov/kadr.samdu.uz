<?php
	include_once 'ximoya.php';
	$_SESSION['page'] = 5;
?>
<table class="table table-hover table-bordered" id="sampleTable" border="1" cellpadding="10" cellspacing="0">
                    <thead>
                      <tr>
                      	<th>№</th>
                        <th>Лавозим номи ва тайинланган йили</th>
                        <th>Лавозимни эгаллаб турган ходим Ф.И.Ш.</th>
                        <th>Туғилган жойи </th>
                        <th>Туғилган куни, ойи ва йили </th>
                        <th>Ёши</th>
                        <th>Фото</th>
                        <th>Олий таълим муассасасини тамомлаган йили ва номи</th>
                        <th>мутахасисслиги</th>
                        <th>Чет тилини билиши (чет тили номи ва билиш даражаси (/бошланғич/ўрта /мукаммал ёки B1, B2, C1, C2) </th>
                        <th>Паспорт серияси ва рақами</th>
                        <th>Жисмоний шахснинг шахсий иденфикация рақами (ПИНФЛ)</th>
                        <th>Илмий даражаси</th>
                        <th>Илмий унвони</th>
                        <th>Давлат мукофотлари </th>
                        <th>Идоравий мукофотлар билан тақдирланганлиги </th>
                        <th>Малака оширилган ташкилот номи </th>
                        <th>Малака ошириш йўналиши </th>
                        <th>Малака оширилган давр </th>
                        <th>Ходимнинг телефон рақамлари </th>
                      </tr>
                    </thead>
                    <tbody>
                    	<?
                    		$t=0;
                    		$sql = mysqli_query($link,"SELECT * FROM xodim_temp ORDER BY id ASC");
                    		while($fetch = mysqli_fetch_assoc($sql)){
                    			$t++;
                    			$viloyat_id = $fetch['viloyat_id'];
                    			$sql2 = mysqli_query($link,"SELECT * FROM viloyat WHERE id='$viloyat_id'");
                    			$viloyat = mysqli_fetch_assoc($sql2);
                    			if($viloyat_id == 0){
                    				$viloyat['nomi'] = "Samarqand viloyati";
                    			}
                    	?>
                    	<tr>
                      	<td><?=$t?></td>
                        <td></td>
                        <td><?=$fetch['familya']?> <?=$fetch['ism']?> <?=$fetch['otch']?></td>
                        <td><?=$viloyat['nomi']?></td>
                        <td><?=$fetch['birthdate']?></td>
                        <td><?=(date("Y",time())-date("Y",strtotime($fetch['birthdate'])))?></td>
                        <td><img src="../bot/uploads/<?=$fetch['rasm']?>" width="50"></td>
                        <td><a href="../bot/uploads/<?=$fetch['passport']?>">Yuklash</a></td>
                        <td><a href="../bot/uploads/<?=$fetch['passport']?>">Yuklash</a></td>
                        <td><?=$fetch['chettili']?></td>
                        <td><?=$fetch['nomer']?></td>
                        <td><?=$fetch['jshir']?></td>                        
                        <td><?
                        	if($fetch['diplom6']!=""){
                        		echo "Fan doktori";
                        	}
                        	else{
                        		if($fetch['diplom5']!=""){
	                        		echo "PhD";
	                        	}
	                        	else{
	                        		echo "Yo'q";
	                        	}
                        	}
                    	?></td>

                        <td>Unovoni</td>
                        <td><?=$fetch['davlatmukofoti']?></td>
                        <td><?=$fetch['idoramukofoti']?></td>
                        <td><?=$fetch['malakatashkilot']?></td>
                        <td><?=$fetch['malakayunalish']?></td>
                        <td><?=$fetch['malakadavr']?>-<?=$fetch['malakadavr2']?></td>
                        <td><?=$fetch['telefon']?></td>                        
                      </tr>
	                    <?}?>
                    </tbody>
                  </table>
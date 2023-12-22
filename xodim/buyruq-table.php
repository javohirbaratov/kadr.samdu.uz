<?php include_once 'ximoya.php'; ?>
<table class="table table-hover table-bordered" id="sampleTable">
    <thead>
        <tr>
            <th>No</th>
            <th>Buyruq raqami</th>
            <th>Buyruq sanasi</th>
            <th>Amallar</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $year = $_POST['date'];
        
        $sql = mysqli_query($link,"SELECT * FROM buyruq WHERE yil=$year order by sana desc");    
    $i=0;                      
    while($fetch = mysqli_fetch_assoc($sql)){
        $i++;
        ?>
        <tr id="tr<?=$fetch['id'] ?>">
            <td><?=$i?></td>
            <td> <input type="text" class="form-control" id="braqam_update<?=$fetch['id']?>" readonly value="<?=$fetch['braqam']?>">  </td>
            <td> <input type="text" class="form-control" id="sana_update<?=$fetch['id']?>" readonly value="<?=$fetch['sana']?>">  </td>
            <td>
                <a class="btn btn-success" href="buyruq_view.php?id=<?=$fetch['id']?>">Batafsil</a>		
                <button  onclick="update(<?=$fetch['id']?>)" class="btn btn-primary">Tahrirlash</button>
                <button  onclick="udalit(<?=$fetch['id']?>)" class="btn btn-danger">O'chirish</button>
            </td>
        </tr>
    <?php }?>
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
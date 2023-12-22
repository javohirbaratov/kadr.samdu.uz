<?php include_once 'ximoya.php'; ?>
<table class="table table-hover table-bordered" id="sampleTable">
  <thead>
    <tr>
     <tr>
      <th>Ish joyi</th>
      <th>Shtat</th>
      <th>Faoliyat turi</th>
      <th>Lavozim</th>
      <th>Sana</th>                        
      <th>Amallar</th>
    </tr>                        
  </tr>
</thead>
<tbody>
 <? 
 if (isset($_GET['xodim_id'])) {
  $id = $_GET['xodim_id'];
  $sql = mysqli_query($link,"SELECT * FROM workplace WHERE user_id = '$id'");
  while($qabul = mysqli_fetch_assoc($sql)){
  $kadr_bulim_id = $qabul['kadr_bulim_id'];

  $sql2 = mysqli_query($link,"SELECT * FROM kadrlarbulimi WHERE id='$kadr_bulim_id'");
  $kadrlarbulimi = mysqli_fetch_assoc($sql2);

  $bulim_id = $qabul['bulim_id'];
  $sql2 = mysqli_query($link,"SELECT * FROM bulimlar WHERE id='$bulim_id'");
  $bulimlar = mysqli_fetch_assoc($sql2);

  $kafedra_id = $qabul['kafedra_id'];
  $sql10 = mysqli_query($link,"SELECT * FROM kafedra WHERE id='$kafedra_id'");
  $kafedralar = mysqli_fetch_assoc($sql10);

  $lavozim_id = $qabul['lavozim'];
  $sql2 = mysqli_query($link,"SELECT * FROM lavozimlar WHERE id='$lavozim_id'");
  $lavozimlar = mysqli_fetch_assoc($sql2);

  $buyruq_id = $qabul['buyruq'];
  $sql3 = mysqli_query($link,"SELECT * FROM buyruq WHERE id='$buyruq_id'");
  $buyruq = mysqli_fetch_assoc($sql3);
  ?>
  <tr >
    <td><b><?=strtoupper($bulimlar['name'])?></b> <?=strtoupper($kafedralar['name'])?> </td>
   
    <td><?=strtoupper($qabul['shtat'])?></td>
    <td><?=strtoupper($qabul['urindosh'])?></td>
    <td><?=strtoupper($lavozimlar['lavozim'])?></td>
    <td><?=$qabul['sana']?></td>
    <td><a href="xodim_update.php?id=<?=$qabul['id']?>" class="btn btn-success"><i class="fa fa-pencil"></i> O'zgartirish</a></td>
  </tr>	
<?}?>
</tbody>

</table>
<? } else{
  exit("xatolik");
} ?>







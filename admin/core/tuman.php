<?php 
require '../model.php';
echo('
		<label>Tumanni tanlang</label>
        <select name="tuman_id" id="tuman_id"  required class="js-example-data-ajax form-select" >          
	');
if (isset($_POST['tuman_id'])) {
	$id = filter($_POST['tuman_id']);
	$x=0;
	$fetch =Functions::getbytable("tuman","`vil_id` = '$id'");
	foreach ($fetch as $value) {
		$x++;
    	echo"<option value=\"".$value['id']."\">".$value['nomi']."</option>";
  	}
  	if ($x==0) {
  		echo"<option value=\"0\">Mavjud emas</option>";
  	}
}
else{
	$fetch =Functions::getbytable("tuman","`vil_id`='$id'");
	foreach ($fetch as $value) {
    	echo"<option value=\"".$value['id']."\">".$value['nomi']."</option>";
  	}
}
echo('
		</select>
        <div class="invalid-feedback">Bo\'limni tanlang</div>         
	');


 ?>
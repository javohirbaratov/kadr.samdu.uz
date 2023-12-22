<?php
require '../model.php';
echo('
		<label id="kaf2">Kafedra, Bo`linmani tanlang</label>
        <select onchange="funlav()"   name="kafedra_id" id="kafedra_id"  required class="form-select">
        <option>Tanlang</option>
	');
if (isset($_POST['bulim_id'])) {
	$id = filter($_POST['bulim_id']);
	$x=0;
	$fetch =Functions::getbytable("kafedra","`bulim_id` = '$id'");
	foreach ($fetch as $value) {
		$x++;
    	echo"<option value=\"".$value['id']."\">".$value['name']."</option>";
  	}
  	if ($x==0) {
  		echo"<option value=\"0\">Mavjud emas</option>";
  	}
}
else{
	$fetch =Functions::getall("kafedra");
	foreach ($fetch as $value) {
    	echo"<option value=\"".$value['id']."\">".$value['name']."</option>";
  	}
  }
echo('
		</select>
        <div class="invalid-feedback">Kafedrani tanlang</div>
	');


 ?>

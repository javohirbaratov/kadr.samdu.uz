<?php
require '../model.php';
if (isset($_POST['bulim_id']) && $_POST['bulim_id'] == 2) {

echo('
		<label>Bo\'limni tanlang</label>
        <select onchange="funkaf()"  name="bulim_id" id="bulim_id"  required class="form-select">
                  <option>Tanlang</option>

	');
}
elseif (isset($_POST['bulim_id']) && $_POST['bulim_id'] == 1) {

echo('
		<label>Fakultetni tanlang</label>
        <select onchange="funkaf()"  name="bulim_id" id="bulim_id"  required class="form-select">
                  <option>Tanlang</option>

	');
}
elseif (isset($_POST['bulim_id']) && $_POST['bulim_id'] == 3) {

echo('
		<label>Binoni tanlang</label>
        <select onchange="funkaf()"  name="bulim_id" id="bulim_id"  required class="form-select">
                  <option>Tanlang</option>

	');
}
elseif (isset($_POST['bulim_id']) && $_POST['bulim_id'] == 4) {

echo('
		<label>Grand nomini tanlang</label>
        <select onchange="funkaf()"  name="bulim_id" id="bulim_id"  required class="form-select">
                  <option>Tanlang</option>

	');
}
if (isset($_POST['bulim_id'])) {
	$id = filter($_POST['bulim_id']);
	$x=0;
	$fetch =Functions::getbytable("bulimlar","`kadrbulimi_id` = '$id'");
	foreach ($fetch as $value) {
		$x++;
    	echo"<option value=\"".$value['id']."\">".$value['name']."</option>";
  	}
  	if ($x==0) {
  		echo"<option value=\"0\">Mavjud emas</option>";
  	}
}
else{
	$fetch =Functions::getall("bulimlar");
	foreach ($fetch as $value) {
    	echo"<option value=\"".$value['id']."\">".$value['name']."</option>";
  	}
}
echo('
		</select>
        <div class="invalid-feedback">Tanlang</div>
	');


 ?>

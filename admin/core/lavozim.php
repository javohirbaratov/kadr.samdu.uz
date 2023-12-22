<?php 
require '../model.php';
echo('
		<label>Lavozimni tanlang</label>
                <select name="lavozim" id="lavozim"  required class="form-select">  
                <option>Tanlang</option>        
	');
if (isset($_POST['bulim_id'])) {
	$id = filter($_POST['bulim_id']);
	$x=0;
	$fetch =Functions::getbytable("lavozimlar","`bulim_id` = '$id'");
	foreach ($fetch as $value) {
		$x++;
    	echo"<option value=\"".$value['id']."\">".$value['lavozim']."</option>";
  	}
  	if ($x==0) {
  		echo"<option value=\"0\">Mavjud emas</option>";
  	}
}
else{
	$fetch =Functions::getall("bulimlar");
	foreach ($fetch as $value) {
    	echo"<option value=\"".$value['id']."\">".$value['lavozim']."</option>";
  	}
}
echo('
		</select>
        <div class="invalid-feedback">Lavozimnini tanlang</div>         
	');


 ?>
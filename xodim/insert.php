<?
	include_once 'ximoya.php';
	$ret = [];
	if($_POST['action']=="insertaddhistory"){
		$sana1 = strtotime($_POST['sanadan']);
		$sana2 = strtotime($_POST['sanagacha']);
		$ishjoyi = filter($_POST['ishjoyi']);
		$xodim_id = filter($_POST['xodim_id']);
		$sql = mysqli_query($link,"INSERT INTO history (sanadan,sanagacha,ishjoyi,user_id) VALUES ('$sana1','$sana2','$ishjoyi','$xodim_id')");

		if($sql){
			$ret = ['error' => 0, 'xabar' => "Muvaffaqqiyatli saqlandi"];
		}
		else{
			$ret = ['error' => 2, 'xabar' => "Bazaga yozilmadi. Ichki xatolik. Malumotlarda kamchilik bor"];
		}
	}
	if($_POST['action']=="insertuser"){
		$nomi = filter($_POST['nomi']);
		$login = filter($_POST['login']);
		$parol = filter($_POST['parol']);
		$tel_raq = filter($_POST['tel_raqam']);
		$vil_id = $_SESSION['viloyat_id'];
		$tuman_id = filter($_POST['tuman_id']);
		$rol = filter($_POST['rol']);
		if(strlen($nomi)<1){
			$ret = ['error' => 1, 'xabar' => "Foydalanuvchi nomi bo'sh bo'lishi mumkin emas"];
			echo json_encode($ret);
			exit;			
		}
		if(strlen($login)<1){
			$ret = ['error' => 1, 'xabar' => "Foydalanuvchi logini bo'sh bo'lishi mumkin emas"];
			echo json_encode($ret);
			exit;
		}
		else{
			$sql = mysqli_query($link,"SELECT * FROM user WHERE login='$login'");
			$fetch = mysqli_fetch_assoc($sql);
			if($fetch['id']>0){
				$ret = ['error' => 2, 'xabar' => "ushbu login nomi bazada mavjud"];
				echo json_encode($ret);
				exit;
			}
		}
		if(strlen($parol)<6){
			$ret = ['error' => 1, 'xabar' => "Foydalanuvchi paroli 6ta belgidan kam bo'lmasin"];
			echo json_encode($ret);
			exit;
		}
		$parol = md5($parol);
		if(strlen($tel_raq)!=17){
			$ret = ['error' => 1, 'xabar' => "Foydalanuvchi telefonini to'g'ri kiriting"];
			echo json_encode($ret);
			exit;
		}
		if($vil_id<1){
			$ret = ['error' => 1, 'xabar' => "Foydalanuvchi viloyatini to'g'ri tanlang"];
			echo json_encode($ret);
			exit;
		}
		if($tuman_id<1){
			$ret = ['error' => 1, 'xabar' => "Foydalanuvchi tumanini to'g'ri tanlang"];
			echo json_encode($ret);
			exit;
		}
		$sql = mysqli_query($link,"INSERT INTO user (nomi,login,parol,tel_raq,viloyat_id,tuman_id,rol) VALUES ('$nomi','$login','$parol','$tel_raq','$vil_id','$tuman_id','$rol')");
		if($sql){
			$ret = ['error' => 0, 'xabar' => "Muvaffaqqiyatli saqlandi"];
		}
		else{
			$ret = ['error' => 2, 'xabar' => "Bazaga yozilmadi. Ichki xatolik. Malumotlarda kamchilik bor"];
		}
	}
	
	if($_POST['action']=="insertbulim"){
		$kadr_bulim_id = filter($_POST['kadr_bulim_id']);
		$bulim_name = filter($_POST['bulim_name']);		
		$shtat = filter($_POST['shtat']);
		$sql = mysqli_query($link,"INSERT INTO bulimlar (name,kadrbulimi_id,shtat) VALUES ('$bulim_name','$kadr_bulim_id','$shtat')");
		if($sql){
			$ret = ['error' => 0, 'xabar' => "Muvaffaqqiyatli saqlandi"];
		}
		else{
			$ret = ['error' => 1, 'xabar' => "Kechirasiz ma'lumot kiritilmadi"];
		}
	}
	if($_POST['action']=="insertbulimma"){		
		$kadr_bulim_id = filter($_POST['kb_id']);
		$bulim_id = filter($_POST['bulim_id']);
		$bulim_name = filter($_POST['bulim_name']);
		$sql = mysqli_query($link,"INSERT INTO kafedra (name,bulim_id) VALUES ('$bulim_name','$bulim_id')");
		if($sql){
			$ret = ['error' => 0, 'xabar' => "Muvaffaqqiyatli saqlandi"];
		}
		else{
			$ret = ['error' => 1, 'xabar' => "Kechirasiz ma'lumot kiritilmadi"];
		}
	}
	// insertkadbulim
	if($_POST['action']=="insertkadbulim"){		
		$bulim_name = filter($_POST['bulim_name']);
		$sql = mysqli_query($link,"INSERT INTO kadrlarbulimi (name) VALUES ('$bulim_name')");
		if($sql){
			$ret = ['error' => 0, 'xabar' => "Muvaffaqqiyatli saqlandi"];
		}
		else{
			$ret = ['error' => 1, 'xabar' => "Kechirasiz ma'lumot kiritilmadi"];
		}
	}
	// insertlavozim
	if($_POST['action']=="insertlavozim"){
		
		$kadr_bulim_id = filter($_POST['kb_id']);
		$bulim_id = filter($_POST['bulim_id']);
		$bulimma_id = filter($_POST['bulinma']);
		$lavozim = filter($_POST['lavozim_name']);
		$turi = filter($_POST['turi']);
		$razryad = filter($_POST['razryad']);
		if($razryad==""){
			$razryad=0;
		}
		$tarifkoef = filter($_POST['koef']);
		if($tarifkoef==""){
			$tarifkoef=0;
		}
		$oylik = filter($_POST['oylik']);
		$shtat = filter($_POST['shtat']);
        
		$sql = mysqli_query($link,"INSERT INTO lavozimlar (lavozim,bulim_id,soni,kadr_bulim_id,turi,razryad,tarifkoef,oylik,shtat,kafedra_id) VALUES ('$lavozim','$bulim_id','$shtat','$kadr_bulim_id','$turi','$razryad','$tarifkoef','$oylik','$shtat','$bulimma_id')");
		if($sql){
			$ret = ['error' => 0, 'xabar' => "Muvaffaqqiyatli saqlandi"];
		}
		else{
			$ret = ['error' => 1, 'xabar' => "Kechirasiz ma'lumot kiritilmadi"];
		}
	}
	echo json_encode($ret);
?>
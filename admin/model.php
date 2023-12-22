<?php

	////*****  MYSQL CONNECT begin *****\\\\
	// $link =  mysqli_connect("localhost", "u1787253_kadr", "mX4eH4zV1kgH9p", "u1787253_kadr");
	// mysqli_connect("localhost", "u1787253_kadr", "mX4eH4zV1kgH9p", "u1787253_kadr");
	//$link = mysqli_connect("localhost", "root", "", "kadr");
    $link = mysqli_connect("localhost", "kadr_samdu.uz_User", "Kadrjon11$", "kadr_samdu.uz_DB");

	if (!$link) {
	    echo "Xato: MySQL bilan aloqa o'rnatib bo'lmadi.";
	    exit();

	}
	mysqli_set_charset($link, "utf8");
	function filter($s)
	{
		$s = trim($s);
        $s = htmlspecialchars($s, ENT_QUOTES);
        //$s = str_replace("'", "\'", $s);
        return $s;

	}


	function clean($string) {

		$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
		$string = htmlspecialchars($string, ENT_QUOTES);
		return preg_replace('/[^A-Za-z0-9_\-]/', '', $string); // Removes special chars.
	 }
	////***** MYSQL CONNECT end *****\\\\


	 function getmonth($ib)
	 {
	 	$full = DateTime::createFromFormat('Y-m-d', $ib);
	 	$oy = $full->format("m");
	 	$yil = $full->format("Y");
	 	$kun = $full->format("d");
	 		if($oy=='01')
	 			return $yil."-yil ".$kun." yanvar";
	 				else
	 		if($oy=='02')
	 			return $yil."-yil ".$kun." fevral";
	 				else
	 		if($oy=='03')
	 			return $yil."-yil ".$kun." mart";
	 				else
	 		if($oy=='04')
	 			return $yil."-yil ".$kun." aprel";
	 				else
	 		if($oy=='05')
	 			return $yil."-yil ".$kun." may";
	 				else
	 		if($oy=='06')
	 			return $yil."-yil ".$kun." iyun";
	 				else
	 		if($oy=='07')
	 			return $yil."-yil ".$kun." iyul";
	 				else
	 		if($oy=='08')
	 			return $yil."-yil ".$kun." avgust";
	 				else
	 		if($oy=='09')
	 			return $yil."-yil ".$kun." sentyabr";
	 				else
	 		if($oy=='10')
	 			return $yil."-yil ".$kun." oktyabr";
	 				else
	 		if($oy=='11')
	 			return $yil."-yil ".$kun." noyabr";
	 				else
	 		if($oy=='12')
	 			return $yil."-yil ".$kun." dekabr";



	 }


class Functions
{
	static function MyQuery($sql)
	{
		global $link;
		return mysqli_query($link,$sql);
	}
/////////////////******************GETS******************\\\\\\\\\\\\\\\\\\
	// GET ID VALUE  BEGIN \\
	static function getbytable($table,$val)
	{
		return Functions::MyQuery("SELECT * FROM `$table` WHERE $val");
	}
	// GET ID VALUE  END \\

	// GET ID VALUE  BEGIN \\
	static function getbyid($table,$id)
	{
		return Functions::MyQuery("SELECT * FROM `$table` WHERE `id` = '$id'");
	}
	// GET ID VALUE  END \\

	// GET ALL  BEGIN \\
	static function getall($table)
	{
		return Functions::MyQuery("SELECT * FROM `$table`");
	}
	// GET ALL  END \\


/////////////////******************GETS******************\\\\\\\\\\\\\\\\\\

























/////////////////******************ADDS******************\\\\\\\\\\\\\\\\\\




	// ADDALL BEGIN \\
	static function add($arr,$table)
	{
		$query = "INSERT INTO `$table` ";
		$vname = "";
		$val = "";
		foreach ($arr as $key => $value) {
			$vname .= " `$key` ,";
			$val .= " '$value' ,";
		}
		$vname= rtrim($vname,",");
		$val= rtrim($val,",");
		$query.= "($vname) VALUES ($val); ";
		return Functions::MyQuery($query);
	}
	// ADDALL END \\



	// KADRLAR BO'LIMI BEGIN \\
	static function addkadrb($name)
	{
		return Functions::MyQuery("INSERT INTO `kadrlarbulimi`(`name`) VALUES ('$name')");
	}
	// KADRLAR BO'LIMI END \\


	// DIPLOMTYPE BEGIN \\
	static function adddiplomtype($name)
	{
		return Functions::MyQuery("INSERT INTO `diplomtype`(`name`) VALUES ('$name')");
	}
	// DIPLOMTYPE END \\


	// LAVOZIM BEGIN \\
	static function addlavozim($name,$kadr_bulim_id,$bulim_id,$kafedra,$soni)
	{
		return Functions::MyQuery("INSERT INTO `lavozimlar`(`lavozim`, `kadr_bulim_id`, `bulim_id`,`kafedra_id`, `soni`) VALUES ('$name','$kadr_bulim_id','$bulim_id','$kafedra','$soni')");
	}
	// LAVOZIM END \\


	// BULIM BEGIN \\
	static function addbulim($name,$kadrbulimi_id,$izoh)
	{
		return Functions::MyQuery("INSERT INTO `bulimlar`(`name`, `kadrbulimi_id`, `izoh`) VALUES ('$name','$kadrbulimi_id','$izoh')");
	}
	// BULIM END \\


	// KAFEDRA BEGIN \\
	static function addkafedra($name,$bulim_id)
	{
		return Functions::MyQuery("INSERT INTO `kafedra`(`name`, `bulim_id`) VALUES ('$name','$bulim_id')");
	}
	// KAFEDRA END \\


	// MEHNATTATILI BEGIN \\
	static function addmehnattatili($braqam,$user_id,$bulim_id,$shtat,$yil,$kun,$sanadan,$sanagacha,$sana,$file)
	{
		return Functions::MyQuery("INSERT INTO `mehnattatili`( `braqam`, `user_id`, `bulim_id`, `shtat`, `yil`, `kun`, `sanadan`, `sanagacha`, `sana`, `file`) VALUES ( '$braqam', '$user_id', '$bulim_id', '$shtat', '$yil', '$kun', '$sanadan', '$sanagacha', '$sana', '$file')");
	}
	// MEHNATTATILI END \\




	// HOMILADORLIKTATILI BEGIN \\
	static function addhomiladorliktatili($braqam,$user_id,$bulim_id,$lavozim,$sanadan,$sanagacha,$file)
	{
		return Functions::MyQuery("INSERT INTO `homiladorliktatili`( `braqam`,`user_id`, `bulim_id`, `lavozim`, `sanadan`, `sanagacha`, `file`) VALUES ( '$braqam','$user_id', '$bulim_id', '$lavozim', '$sanadan', '$sanagacha', '$file')");
	}
	// HOMILADORLIKTATILI END \\



	// BOLAPARVARISHI BEGIN \\
	static function addbolaparvarishi($braqam,$user_id,$bulim_id,$lavozim,$sanadan,$sanagacha,$yosh,$hujjat,$file)
	{
		return Functions::MyQuery("INSERT INTO `bolaparvarishi`( `braqam`,`user_id`, `bulim_id`, `lavozim`, `sanadan`, `sanagacha`, `yosh`, `hujjat`, `file`) VALUES ( '$braqam', '$user_id', '$bulim_id', '$lavozim', '$sanadan', '$sanagacha', '$yosh', '$hujjat', '$file')");
	}
	// BOLAPARVARISHI END \\



	// HAQSIZTATIL BEGIN \\
	static function addhaqsiztatil($user_id,$braqam,$bulim_id,$sanadan,$sanagacha,$file)
	{
		return Functions::MyQuery("INSERT INTO `haqsiztatil`( `user_id`, `braqam`, `bulim_id`, `sanadan`, `sanagacha`, `file`) VALUES ( '$user_id', '$braqam', '$bulim_id', '$sanadan', '$sanagacha', '$file')");
	}
	// HAQSIZTATIL END \\



	// DIPLOM BEGIN \\
	static function adddiplom($user_id,$tur_id,$seriya,$berilgan,$otm,$talimturi,$raqam,$givedate,$mname,$mshifr,$ilova,$file)
	{
		return Functions::MyQuery("INSERT INTO `diplomlar`(`fayl`, `seriya`, `raqam`, `tur_id`, `user_id`, `berilgan`, `otm`, `talimturi`, `givedate`, `mname`, `mshifr`, `ilova`) VALUES ('$file', '$seriya', '$raqam', '$tur_id', '$user_id', '$berilgan', '$otm', '$talimturi', '$givedate', '$mname', '$mshifr', '$ilova')");
	}
	// DIPLOM END \\


	// QABUL BEGIN \\
	static function addish($user_id,$malumot,$shtat,$sana,$muddati,$muddattype,$sinov,$kadr_bulim_id,$bulim_id,$kafedra_id,$lavozim,$urindosh,$buyruq,$file,$shartnomaraqam)
	{
		return Functions::MyQuery("INSERT INTO `qabul`(`user_id`, `malumot`, `shtat`, `sana`, `muddati`, `muddattype`, `sinov`, `kadr_bulim_id`, `bulim_id`, `kafedra_id`, `lavozim`, `urindosh`, `ariza`, `buyruq`, `shartnomaraqam`) VALUES ('$user_id', '$malumot', '$shtat', '$sana', '$muddati', '$muddattype', '$sinov', '$kadr_bulim_id', '$bulim_id', '$kafedra_id', '$lavozim', '$urindosh', '$file', '$buyruq', '$shartnomaraqam')");
	}
	// QABUL END \\


	// MALAKA BEGIN \\
	static function addmalaka($user_id,$begin,$end,$file)
	{
		return Functions::MyQuery("INSERT INTO `malaka`(`user_id`, `begin`, `end`, `file`) VALUES ('$user_id','$begin', '$end', '$file')");
	}
	// MALAKA END \\



	// MUKOFOT BEGIN \\
	static function addmukofot($user_id,$name,$qaror,$file)
	{
		return Functions::MyQuery("INSERT INTO `mukofot`(`user_id`, `name`, `qaror`, `file`) VALUES ('$user_id','$name', '$qaror', '$file')");
	}
	// MUKOFOT END \\



	// MODDIY BEGIN \\
	static function addmoddiy($user_id,$sana,$buyruq,$file)
	{
		return Functions::MyQuery("INSERT INTO `moddiy`(`user_id`, `sana`, `buyruq`, `file`) VALUES ('$user_id','$sana', '$buyruq', '$file')");
	}
	// MODDIY END \\



	// TILLAR BEGIN \\
	static function addlang($user_id,$name,$daraja,$file)
	{
		$sqlcha="";
		$sqlcha1="";
		if (strlen($daraja)>1) {
			$sqlcha .= ",`daraja`";
			$sqlcha1 .= ",'$daraja'";
		}
		if (strlen($file)>1) {
			$sqlcha .= ",`file`";
			$sqlcha1 .= ",'$file'";
		}
		return Functions::MyQuery("INSERT INTO `tillar`(`user_id`, `name`".$sqlcha.") VALUES ('$user_id','$name'".$sqlcha1.")");
	}
	// TILLAR END \\



	// ADMIN BEGIN \\
	static function addadmin($familya,$ism,$otch,$login,$email,$parol,$telefon,$rol,$telegram_id)
	{
		return Functions::MyQuery("INSERT INTO `users`(`familya`, `ism`, `otch`, `login`, `email`, `parol`, `telefon`, `rol`, `rasm`,  `telegram_id`) VALUES ('$familya', '$ism', '$otch', '$login', '$email', '$parol', '$telefon', '$rol', 'user.jpg',  '$telegram_id')");
	}
	// ADMIN END \\


	// SHTAT BEGIN \\
	static function addshtat($teacher_id,$kadr_bulimi_id,$lavozim_id,$asosiy,$ichki,$tashqi,$soatbay,$sana,$buyruqsana,$kontraktnomer,$buyruqraqam)
	{
		return Functions::MyQuery("INSERT INTO `shtat`(`teacher_id`, `kadr_bulim_id`, `lavozim_id`, `asosiy`, `ichki`, `tashqi`, `soatbay`, `sana`, `buyruqsana`, `buyruqraqam`, `kontraktnomer`) VALUES ('$teacher_id', '$kadr_bulimi_id', '$lavozim_id', '$asosiy', '$ichki', '$tashqi', '$soatbay', '$sana', '$buyruqsana', '$buyruqraqam', '$kontraktnomer')");
	}
	// SHTAT END \\


	// XODIM BEGIN \\
	static function addxodim($familya, $ism, $otch, $jshir, $inn, $seriya, $nomer, $pasportdate, $pasportjoy, $pasportenddate, $passport, $birthdate, $birthplace, $jinsi, $millati, $fuqaroligi, $partiyaviyligi, $xarbiy, $mjshaxs, $tkmuddati, $tkguvohnoma, $manzil, $doimiy, $telefon, $telegram_id, $pochta, $rasm, $oilaviyahvoli, $viloyat_id, $tuman_id)
	{
		return Functions::MyQuery("INSERT INTO `xodimlar`(`familya`, `ism`, `otch`, `jshir`, `inn`, `seriya`, `nomer`, `pasportdate`, `pasportjoy`, `pasportenddate`, `passport`, `birthdate`, `birthplace`, `jinsi`, `millati`, `fuqaroligi`, `partiyaviyligi`, `xarbiy`, `mjshaxs`, `tkmuddati`, `tkguvohnoma`, `manzil`, `doimiy`, `telefon`, `telegram_id`, `pochta`, `rasm`, `oilaviyahvoli`, `viloyat_id`, `tuman_id`) VALUES ('$familya', '$ism', '$otch', '$jshir', '$inn', '$seriya', '$nomer', '$pasportdate', '$pasportjoy', '$pasportenddate', '$passport', '$birthdate', '$birthplace', '$jinsi', '$millati', '$fuqaroligi', '$partiyaviyligi', '$xarbiy', '$mjshaxs', '$tkmuddati', '$tkguvohnoma', '$manzil', '$doimiy', '$telefon', '$telegram_id', '$pochta', '$rasm', '$oilaviyahvoli', '$viloyat_id', '$tuman_id')");
	}
	// XODIM END \\


/////////////////******************ADDS******************\\\\\\\\\\\\\\\\\\



















/////////////////******************DELETES******************\\\\\\\\\\\\\\\\\\


	// DELETEALL BEGIN \\
	static function delete($table,$id)
	{
		return Functions::MyQuery("DELETE FROM `$table` WHERE `id` = '$id'");
	}
	// DELETEALL END \\



	// DIPLOMTYPE BEGIN \\
	static function deletedt($id)
	{
		return Functions::MyQuery("DELETE FROM `diplomtype` WHERE `id` = '$id'");
	}
	// DIPLOMTYPE END \\


	// DIPLOM BEGIN \\
	static function deletediplom($id)
	{
		return Functions::MyQuery("DELETE FROM `diplomlar` WHERE `id` = '$id'");
	}
	// DIPLOM END \\


	// SHTAT BEGIN \\
	static function deleteshtat($id)
	{
		return Functions::MyQuery("DELETE FROM `shtat` WHERE `id` = '$id'");
	}
	// SHTAT END \\



	// MODDIY BEGIN \\
	static function deletemoddiy($id)
	{
		return Functions::MyQuery("DELETE FROM `shtat` WHERE `id` = '$id'");
	}
	// MODDIY END \\


	// DIPLOMTYPE BEGIN \\
	static function deleteadmin($id)
	{
		return Functions::MyQuery("DELETE FROM `users` WHERE `id` = '$id'");
	}
	// DIPLOMTYPE END \\



	// BULIM BEGIN \\
	static function deletebulim($id)
	{
		return Functions::MyQuery("DELETE FROM `bulimlar` WHERE `id` = '$id'");
	}
	// BULIM END \\



	// KAFEDRA BEGIN \\
	static function deletekafedra($id)
	{
		return Functions::MyQuery("DELETE FROM `kafedra` WHERE `id` = '$id'");
	}
	// KAFEDRA END \\



	// KADRLAR BULIMI BEGIN \\
	static function deletekadrlarbulimi($id)
	{
		return Functions::MyQuery("DELETE FROM `kadrlarbulimi` WHERE `id` = '$id'");
	}
	// KADRLAR BULIMI END \\




	// LAVOZIM BEGIN \\
	static function deletelavozim($id)
	{
		return Functions::MyQuery("DELETE FROM `lavozimlar` WHERE `id` = '$id'");
	}
	// LAVOZIM END \\




	// XODIM BEGIN \\
	static function deletexodim($id)
	{
		return Functions::MyQuery("DELETE FROM `xodimlar` WHERE `id` = '$id'");
	}
	// XODIM END \\


	// HAQSIZTATIL BEGIN \\
	static function deletehaqsiztatil($id)
	{
		return Functions::MyQuery("DELETE FROM `haqsiztatil` WHERE `id` = '$id'");
	}
	// HAQSIZTATIL END \\



	// HOMILADORLIKTATILI BEGIN \\
	static function deletehomiladorliktatili($id)
	{
		return Functions::MyQuery("DELETE FROM `homiladorliktatili` WHERE `id` = '$id'");
	}
	// HOMILADORLIKTATILI END \\


	// MALAKA BEGIN \\
	static function deletemalaka($id)
	{
		return Functions::MyQuery("DELETE FROM `malaka` WHERE `id` = '$id'");
	}
	// MALAKA END \\


	// MUKOFOT BEGIN \\
	static function deletemukofot($id)
	{
		return Functions::MyQuery("DELETE FROM `mukofot` WHERE `id` = '$id'");
	}
	// MUKOFOT END \\



	// MEHNATTATILI BEGIN \\
	static function deletemehnattatili($id)
	{
		return Functions::MyQuery("DELETE FROM `mehnattatili` WHERE `id` = '$id'");
	}
	// MEHNATTATILI END \\



	// BOLAPARVARISHI BEGIN \\
	static function deletebolaparvarishi($id)
	{
		return Functions::MyQuery("DELETE FROM `bolaparvarishi` WHERE `id` = '$id'");
	}
	// BOLAPARVARISHI END \\



	// TILLAR BEGIN \\
	static function deletelang($id)
	{
		return Functions::MyQuery("DELETE FROM `tillar` WHERE `id` = '$id'");
	}
	// TILLAR END \\





	// QABUL BEGIN \\
	static function deleteish($id)
	{
		return Functions::MyQuery("DELETE FROM `qabul` WHERE `id` = '$id'");
	}
	// QABUL END \\



/////////////////******************DELETES******************\\\\\\\\\\\\\\\\\\

















/////////////////******************UPDATES******************\\\\\\\\\\\\\\\\\\






	// EDITALL BEGIN \\
	static function edit($arr,$table)
	{

		$query = "UPDATE $table SET ";
		$vname = "";
		$id = "";
		foreach ($arr as $key => $value) {
			$value1 = $value;
			if($key == "id"){
				$id = $value1;
			}else{
				$vname .= " `$key` = '$value1' ,";
			}
		}
		$query.= rtrim($vname,",");
		$query.= " WHERE `id` = $id";
		return Functions::MyQuery($query);
	}
	// EDITALL END \\





	// EDITALL BEGIN \\
	static function edituser($arr,$table)
	{

		$query = "UPDATE $table SET ";
		$vname = "";
		$id = "";
		foreach ($arr as $key => $value) {
			$value1 = $value;
			if($key == "user_id"){
				$id = $value1;
			}else{
				$vname .= " `$key` = '$value1' ,";
			}
		}
		$query.= rtrim($vname,",");
		$query.= " WHERE `user_id` = $id";
		return ($query);
	}
	// EDITALL END \\




	// DIPLOMTYPE BEGIN \\
	static function editdt($id,$name)
	{
		return Functions::MyQuery("UPDATE `diplomtype` SET `name` = '$name' WHERE `id` = '$id'");
	}
	// DIPLOMTYPE END \\



	// DIPLOMTYPE BEGIN \\
	static function editkadrlarbulimi($id,$name)
	{
		return Functions::MyQuery("UPDATE `kadrlarbulimi` SET `name` = '$name' WHERE `id` = '$id'");
	}
	// DIPLOMTYPE END \\


	// BULIM BEGIN \\
	static function editbulim($id,$name,$kadrbulimi_id,$izoh)
	{
		return Functions::MyQuery("UPDATE `bulimlar` SET `name` = '$name',`kadrbulimi_id` = '$kadrbulimi_id',`izoh` = '$izoh' WHERE `id` = '$id'");
	}
	// BULIM END \\


	// KAFEDRA BEGIN \\
	static function editkafedra($id,$name,$bulim_id)
	{
		return Functions::MyQuery("UPDATE `kafedra` SET `name` = '$name',`bulim_id` = '$bulim_id' WHERE `id` = '$id'");
	}
	// KAFEDRA END \\


	// LAVOZIM BEGIN \\
	static function editlavozim($id,$name,$bulim_id)
	{
		return Functions::MyQuery("UPDATE `lavozimlar` SET `lavozim` = '$name',`bulim_id` = '$bulim_id' WHERE `id` = '$id'");
	}
	// LAVOZIM END \\


	// ADMIN BEGIN \\
	static function editadmin($id,$familya,$ism,$otch,$login,$email,$telefon,$rol,$telegram_id)
	{
		return Functions::MyQuery("UPDATE `users` SET `familya`='$familya',`ism`='$ism',`otch`='$otch',`login`='$login',`email`='$email',`telefon`='$telefon',`rol`='$rol',`telegram_id`='$telegram_id' WHERE `id` = '$id'");
	}
	// ADMIN END \\


	// SHTAT BEGIN \\
	static function editshtat($id,$teacher_id, $kadr_bulim_id, $lavozim_id, $asosiy, $ichki, $tashqi, $soatbay, $sana, $buyruqsana, $buyruqraqam, $kontraktnomer)
	{
		return Functions::MyQuery("UPDATE `shtat` SET `teacher_id`='$teacher_id',`kadr_bulim_id`='$kadr_bulim_id',`lavozim_id`='$lavozim_id',`asosiy`='$asosiy',`ichki`='$ichki',`tashqi`='$tashqi',`soatbay`='$soatbay',`buyruqsana`='$buyruqsana',`buyruqraqam`='$buyruqraqam',`kontraktnomer`='$kontraktnomer' WHERE `id` = '$id'");

	}
	// SHTAT END \\


	// DIPLOM BEGIN \\
	static function editdiplom($id,$user_id,$tur_id,$seriya,$berilgan,$otm,$talimturi,$raqam,$givedate,$mname,$mshifr,$ilova,$file)
	{
		$sqlcha="";
		if (strlen($file)>1) {
			$sqlcha .= ",`fayl`='$file'";
		}
		if (strlen($ilova)>1) {
			$sqlcha .= ",`ilova`='$ilova'";
		}
		return Functions::MyQuery("UPDATE `diplomlar` SET `seriya`='$seriya',`raqam`='$raqam',`tur_id`='$tur_id',`user_id`='$user_id',`berilgan`='$berilgan',`otm`='$otm',`talimturi`='$talimturi',`givedate`='$givedate',`mname`='$mname',`mshifr`='$mshifr'".$sqlcha." WHERE `id` = '$id'");

	}
	// DIPLOM END \\


	// MEHNATTATILI BEGIN \\
	static function editmehnattatili($id,$braqam,$user_id,$bulim_id,$shtat,$yil,$kun,$sanadan,$sanagacha,$sana,$file)
	{
		$sqlcha="";
		if (strlen($file)>1) {
			$sqlcha .= ",`file`='$file'";
		}
		return Functions::MyQuery("UPDATE `mehnattatili` SET `braqam`='$braqam',`user_id`='$user_id',`bulim_id`='$bulim_id',`shtat`='$shtat',`yil`='$yil',`kun`='$kun',`sanadan`='$sanadan',`sanagacha`='$sanagacha' ,`sana`='$sana' ".$sqlcha." WHERE `id` = '$id'");

	}
	// MEHNATTATILI END \\



	// HOMILADORLIKTATILI BEGIN \\
	static function edithomiladorliktatili($id,$braqam,$user_id,$bulim_id,$lavozim,$sanadan,$sanagacha,$file)
	{
		$sqlcha="";
		if (strlen($file)>1) {
			$sqlcha .= ",`file`='$file'";
		}
		return Functions::MyQuery("UPDATE `homiladorliktatili` SET `braqam`='$braqam', `user_id`='$user_id',`bulim_id`='$bulim_id',`lavozim`='$lavozim',`sanadan`='$sanadan',`sanagacha`='$sanagacha' ".$sqlcha." WHERE `id` = '$id'");

	}
	// HOMILADORLIKTATILI END \\




	// BOLAPARARISHI BEGIN \\
	static function editbolaparvarishi($id,$braqam,$user_id,$bulim_id,$lavozim,$sanadan,$sanagacha,$yosh,$hujjat,$file)
	{
		$sqlcha="";
		if (strlen($file)>1) {
			$sqlcha .= ",`file`='$file'";
		}
		return Functions::MyQuery("UPDATE `bolaparvarishi` SET `braqam`='$braqam',`user_id`='$user_id',`bulim_id`='$bulim_id',`lavozim`='$lavozim',`sanadan`='$sanadan',`sanagacha`='$sanagacha',`yosh`='$yosh',`hujjat`='$hujjat' ".$sqlcha." WHERE `id` = '$id'");

	}
	// BOLAPARARISHI END \\



	// HAQSIZTATIL BEGIN \\
	static function edithaqsiztatil($id,$user_id,$bulim_id,$sanadan,$sanagacha,$file)
	{
		$sqlcha="";
		if (strlen($file)>1) {
			$sqlcha .= ",`file`='$file'";
		}
		return Functions::MyQuery("UPDATE `haqsiztatil` SET `user_id`='$user_id',`bulim_id`='$bulim_id',`sanadan`='$sanadan',`sanagacha`='$sanagacha' ".$sqlcha." WHERE `id` = '$id'");

	}
	// HAQSIZTATIL END \\


	// QABUL BEGIN \\
	static function editish($id,$user_id,$malumot,$shtat,$sana,$muddati,$sinov,$kadr_bulim_id,$bulim_id,$kafedra_id,$lavozim,$urindosh,$buyruq,$file)
	{
		$sqlcha="";
		if (strlen($file)>1) {
			$sqlcha .= ",`ariza`='$file'";
		}
		return Functions::MyQuery("UPDATE `qabul` SET `user_id`='$user_id',`malumot`='$malumot',`shtat`='$shtat',`sana`='$sana',`muddati`='$muddati',`sinov`='$sinov',`kadr_bulim_id`='$kadr_bulim_id',`bulim_id`='$bulim_id',`kafedra_id`='$kafedra_id',`lavozim`='$lavozim',`urindosh`='$urindosh',`buyruq`='$buyruq'".$sqlcha." WHERE `id` = '$id'");

	}
	// QABUL END \\


	// MALAKA BEGIN \\
	static function editmalaka($id,$user_id,$begin,$end,$file)
	{
		$sqlcha="";
		if (strlen($file)>1) {
			$sqlcha .= ",`file`='$file'";
		}
		return Functions::MyQuery("UPDATE `malaka` SET `begin`='$begin',`user_id`='$user_id',`end`='$end'".$sqlcha." WHERE `id` = '$id'");

	}
	// MALAKA END \\



	// MODDIY BEGIN \\
	static function editmoddiy($id,$user_id,$sana,$buyruq,$file)
	{
		$sqlcha="";
		if (strlen($file)>1) {
			$sqlcha .= ",`file`='$file'";
		}
		return Functions::MyQuery("UPDATE `moddiy` SET `sana`='$sana',`user_id`='$user_id',`buyruq`='$buyruq'".$sqlcha." WHERE `id` = '$id'");

	}
	// MODDIY END \\


	// MUKOFOT BEGIN \\
	static function editmukofot($id,$user_id,$name,$qaror,$file)
	{
		$sqlcha="";
		if (strlen($file)>1) {
			$sqlcha .= ",`file`='$file'";
		}
		return Functions::MyQuery("UPDATE `mukofot` SET `name`='$name',`user_id`='$user_id',`qaror`='$qaror'".$sqlcha." WHERE `id` = '$id'");

	}
	// MUKOFOT END \\


	// TILLAR BEGIN \\
	static function editlang($id,$user_id,$name,$daraja,$file)
	{
		$sqlcha="";
		if (strlen($file)>1) {
			$sqlcha .= ",`file`='$file'";
		}

		if (strlen($daraja)>1) {
			$sqlcha .= ",`daraja`='$daraja'";
		}
		return Functions::MyQuery("UPDATE `tillar` SET `name`='$name',`user_id`='$user_id'".$sqlcha." WHERE `id` = '$id'");

	}
	// TILLAR END \\



	// XODIM BEGIN \\
	static function editxodim($id,$familya, $ism, $otch, $jshir, $inn, $seriya, $nomer, $pasportdate, $pasportjoy, $pasportenddate, $passport, $birthdate, $birthplace, $jinsi, $millati, $fuqaroligi, $partiyaviyligi, $xarbiy,  $tkmuddati, $tkguvohnoma, $manzil, $doimiy, $telefon, $telegram_id, $pochta, $rasm,  $oilaviyahvoli, $viloyat_id, $tuman_id)
	{
		$sqlcha="";
		if (strlen($passport)>1) {
			$sqlcha .= ",`passport`='$passport'";
		}
		if (strlen($rasm)>1) {
			$sqlcha .= ",`rasm`='$rasm'";
		}
		if (strlen($tkguvohnoma)>1) {
			$sqlcha .= ",`tkguvohnoma`='$tkguvohnoma'";
		}
		return Functions::MyQuery("UPDATE `xodimlar` SET `familya`='$familya',`ism`='$ism',`otch`='$otch',`jshir`='$jshir',`inn`='$inn',`seriya`='$seriya',`nomer`='$nomer',`pasportdate`='$pasportdate',`pasportjoy`='$pasportjoy',`pasportenddate`='$pasportenddate',`birthdate`='$birthdate',`birthplace`='$birthplace',`jinsi`='$jinsi',`millati`='$millati',`fuqaroligi`='$fuqaroligi',`partiyaviyligi`='$partiyaviyligi',`xarbiy`='$xarbiy',`tkmuddati`='$tkmuddati',`manzil`='$manzil'".$sqlcha.",`doimiy`='$doimiy',`telefon`='$telefon',`telegram_id`='$telegram_id',`pochta`='$pochta',`oilaviyahvoli`='$oilaviyahvoli',`viloyat_id`='$viloyat_id',`tuman_id`='$tuman_id' WHERE `id` = '$id'");

	}
	// XODIM END \\



/////////////////******************UPDATES******************\\\\\\\\\\\\\\\\\\


}
 ?>

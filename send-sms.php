<?php
	session_start();
	if (isset($_SESSION['login'])) {
	    $rol = $_SESSION['rol'];
	    ?>
	    <script type="text/javascript">
	      window.location.href = '<?=$_SESSION['rol']?>/index.php';
	    </script>
	    <?
	    exit;
	}
	include_once 'config.php';
	$ret = [];
	if($_POST['_csrf']!=$_SESSION['_csrf']){
		$ret += ["error" => 1, "xabar" => "Kechirasiz token vaqti tugatilgan!", "urinish" => $_SESSION['urinish'] ];
	}
	else{
		if($_POST['action']=="sendsms"){
			$telefon = filter($_POST['telefon']);
			$sql = mysqli_query($link,"SELECT * FROM xodim_temp WHERE telefon='$telefon'");
			$fetch = mysqli_fetch_assoc($sql);
			if($fetch['id']>0){
				if($fetch['status']=="refused" && $_SESSION['action']!="checkcode"){
					//send sms
					// +998(97)927-54-52
					$_SESSION['id'] = $fetch['id'];
					$telefon = filterphone($fetch['telefon']);
					$_SESSION['sms_code'] = mt_rand(10000, 99999);
					$msg = sendsms($telefon,$_SESSION['sms_code']);
					$_SESSION['telefon'] = $telefon;
					$_SESSION['send_time'] = time();
					$_SESSION['urinish'] = 0;
					$_SESSION['action'] = "checkcode";
					$_SESSION['_csrf'] = md5(time());
					$ret += ["error" => 0, "xabar" => "Barchasi muvaffaqqiyatli sizga sms xabar yuborildi!", "urinish" => $_SESSION['urinish'], "_csrf" => $_SESSION['_csrf']];
				}
				else{
					if($fetch['status']=="success"){
						$ret += ["error" => 1, "xabar" => "Hujjatlaringiz qabul qilingan", "urinish" => $_SESSION['urinish'] ];	
					}
					if($fetch['status']=="nochecked"){
						$ret += ["error" => 1, "xabar" => "Kechirasiz sizning ma'lumotlaringiz tekshirilmoqda. SMS xabarnomani kuting!", "urinish" => $_SESSION['urinish'] ];	
					}
					if($_SESSION['action']=="checkcode"){
						$ret += ["error" => 1, "xabar" => "Siz tekshirish bosqichidasiz", "urinish" => $_SESSION['urinish'] ];	
					}
				}
			}
			else{
				$ret += ["error" => 1, "xabar" => "Kechirasiz sizning ma'lumotlaringiz bazadan topilmadi."];
			}	
		} else {
 			
 			if($_POST['action']=="checkcode" and $_SESSION['action']=="checkcode"){
				if($_SESSION['urinish']<5){
					if((time()-$_SESSION['send_time'])<=300){
						if($_POST['codeconfirm']==$_SESSION['sms_code']){
							$_SESSION['login'] = $_SESSION['telefon'];
							$_SESSION['rol'] = "user";
							$ret += ["error" => 0, "xabar" => "Tizimga muvaffaqqiyatli kirdingiz!"];
						}
						else{
							$_SESSION['urinish'] += 1;
							$ret += ["error" => 1, "xabar" => "Kechirasiz sms kod xato.", "urinish" => $_SESSION['urinish']];
						}	
					}
					else{
						$ret += ["error" => 1, "xabar" => "Vaqti tugatilgan", "urinish" => $_SESSION['urinish']];
					}
				}
				else{
					unset($_SESSION['action']);
					$ret += ["error" => 1, "xabar" => "Juda ko'p muvaffaqqiyatsiz urinish"];
				}
			} else {
				
				$ret += ["error" => 1, "xabar" => "Juda ko'p muvaffaqqiyatsiz urinish"];
			}
 			
        }
		
	}
	echo json_encode($ret);
?>
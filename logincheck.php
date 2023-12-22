<?
	session_start();
	if (isset($_GET['login']) && isset($_GET['parol'])) {
		$ret = [];

		if($_GET['_csrf']!=$_SESSION['_csrf']){
			$ret += ['auth' => "yes"];
			$ret += ['xatolik' => "1"];
			$ret += ['auth' => "no"];
			$ret += ['xabar' => "Taqiqlangan so'rov"];
			$ret += ['_csrf' => $_SESSION['_csrf']];
		}
		else{
			$_SESSION['_csrf'] = md5(time());
			require 'config.php';
			$login = filter($_GET['login']);
			$parol = md5($_GET['parol']);

			 
			$fetch = Logins::login($login,$parol);
			if($fetch['login']==$login and $parol==$fetch['parol']){
				$_SESSION['login'] = $fetch['login'];
				$_SESSION['id'] = $fetch['id'];
				$_SESSION['parol'] = $fetch['parol'];
				$_SESSION['rasm'] = $fetch['rasm'];
				$_SESSION['familya'] = $fetch['familya'];
				$_SESSION['ism'] = $fetch['ism'];
				$_SESSION['rol'] = $fetch['rol'];
				$_SESSION['otch'] = $fetch['otch'];
				$_SESSION['telefon'] = $fetch['telefon'];
				$_SESSION['telegram_id'] = $fetch['telegram_id'];
				$ret += ['xatolik' => "0"];
				$ret += ['auth' => "yes"];
				$ret += ['xabar' => "Hammasi joyida"];
			}
			else{
				$ret += ['xatolik' => "1"];
				$ret += ['auth' => "no"];
				$ret += ['xabar' => "Login yoki parol xato"];
				$ret += ['_csrf' => $_SESSION['_csrf']];
			}	
		}
		echo json_encode($ret);
	}
	else{
		
?>
    <script type="text/javascript">
      window.location.href = 'login.php';
    </script>
<?
    exit;
	}
?>
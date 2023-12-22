<?php include_once 'ximoya.php'; ?>
<!DOCTYPE html>
<html lang="uz">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Malumotlarni tahrirlash</title>
</head>
<body>
	<a href="../logoutuser">Chiqish</a>
	<?php 
		echo "<pre>";
		print_r($_SESSION);
		echo "</pre>";
	?>
</body>
</html>
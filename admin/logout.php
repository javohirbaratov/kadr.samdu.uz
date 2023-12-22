<?
	session_start();
	session_destroy();
	header("Location: ../login.php");
	echo('<script> localStorage.clear();</script>');
	exit;
?>
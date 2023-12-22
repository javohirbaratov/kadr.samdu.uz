<?
	session_start();
	session_destroy();
	header("Location: ./");
	echo('<script> localStorage.clear();</script>');
	exit;
?>

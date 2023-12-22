<?
    session_start();
    if ($_SESSION['rol']!="xodim") {
        //header("Location: index.php");
        ?>
        <script type="text/javascript">
            window.location.href = '../login.php';
        </script>
        <?
        exit();
    }
    
    include_once '../config.php';
?>
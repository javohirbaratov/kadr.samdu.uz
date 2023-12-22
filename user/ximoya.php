<?
    session_start();
    if ($_SESSION['rol']!="user") {
        //header("Location: index.php");
        ?>
        <script type="text/javascript">
            window.location.href = '../login.php';
        </script>
        <?
        exit();
    }
    $hamkor_id = $_SESSION['hamkor_id'];
    include_once '../config.php';
?>
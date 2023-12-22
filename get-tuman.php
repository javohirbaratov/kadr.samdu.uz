<?
 include'config.php';
?>

<option value="Boshqa">Boshqa</option>

<?

  $id = filter($_GET['viloyat_id']);
  $sql=mysqli_query($link,"SELECT * FROM tuman WHERE vil_id='$id'");

  while ($res=mysqli_fetch_assoc($sql)){?>              
    <option value="<?=$res['id'];?>"><?=$res['nomi'];?></option>
<?
  }
?>
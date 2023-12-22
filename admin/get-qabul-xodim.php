<? include_once '../config.php'; ?>
<?
	$ret = [];
	$id = $_GET['xodim_id'];
	$sql = mysqli_query($link,"SELECT * FROM qabul WHERE id='$id'");
	$fetch = mysqli_fetch_assoc($sql);
	$ret += ["nomer" => $fetch['id']]; 
	// {nomer}
	$ret += ["sana" => date("d.m.Y", strtotime($fetch['sana']))]; 
    // {sana}
    $xodim_id = $fetch['user_id'];
    $sql = mysqli_query($link,"SELECT * FROM xodimlar WHERE id='$xodim_id'");
    $xodim = mysqli_fetch_assoc($sql);
    // {fio}
    $ret += ["fio" => $xodim['familya']." ".$xodim['ism']." ".$xodim['otch']];
    // {bulim}
	$bulim_id = $fetch['bulim_id'];
    $sql = mysqli_query($link,"SELECT * FROM bulimlar WHERE id='$bulim_id'");
    $bulim = mysqli_fetch_assoc($sql);
    $ret += ["bulim" => $bulim['name']];
    // {lavozim}
    $lavozim_id = $fetch['lavozim'];
    $sql = mysqli_query($link,"SELECT * FROM lavozimlar WHERE id='$lavozim_id'");
    $lavozim = mysqli_fetch_assoc($sql);
    $ret += ["lavozim" => $lavozim['lavozim']];
    // {shtat}
    $ret += ["shtat" => $fetch['shtat']]; 
    // {shakl}
    $ret += ["shakl" => $fetch['urindosh']]; 
    // {sinov}
    $ret += ["sinov" => $fetch['muddati']]; 
    // {fam}
    $ret += ["fam" => $xodim['ism'][0].".".$xodim['otch'][0].".".$xodim['familya']];
    foreach ($ret as $key => $value) {
    	$ret[$key] = str_replace("&#039;","'",$value);
    }
    echo json_encode($ret);
?>
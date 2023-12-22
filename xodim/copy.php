<?
include_once 'ximoya.php';
?>

<?
$p=0;
$r=0;
$sql = mysqli_query($link,"SELECT * FROM xodim_temp ");
while($x = mysqli_fetch_assoc($sql)){
	
	$source1 = '../bot/uploads/'.$x['obyektivka'];
	//$source2 = '../bot/passport/'.$x['passport'];
	$destination1 = '../bot/uploads2/'.$x['obyektivka'];
	//$destination2 = '../bot/uploads/'.$x['passport'];
	if( copy($source1, $destination1) ) { 
		$r++;
	} else{
		$p++;
	}
}

print("$r,   $p");



?>         

	
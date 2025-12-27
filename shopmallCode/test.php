<?  $a = date("Y-m-d H:i:s");
	$b=substr($a, 0, 4) . substr($a, 5, 2). substr($a, 8, 2) ."-". substr($a, 11, 8);
echo("$b");	
?>
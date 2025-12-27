<?

$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

$result=mysql_query("select * from product where code='$code'",$con);

if (!$heart) {
	$heart=mysql_result($result,0,"heart");
	$heart=0;
} else {
	


mysql_query("update product set heart=0 where code='$code'",$con);}


echo("<meta http-equiv='Refresh' content='0; url=p-show.php?code=$code'>");
mysql_close($con);

?>

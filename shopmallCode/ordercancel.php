<?

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
	 
$result = mysql_query("select * from receivers where ordernum='$ordernum'", $con);
$total = mysql_num_rows($result);

if ($total) {
	$session = mysql_result($result, 0, "session");
 
	mysql_query("delete from receivers where ordernum='$ordernum'", $con);
	mysql_query("delete from orderlist where ordernum='$ordernum'" ,$con);
	//mysql_query포인트 사용한 주문내역을 취소할때 update로 포인트반환한다
}

echo ("<meta http-equiv='Refresh' content='0; url=main.html'>");

mysql_close($con);
	   
?>

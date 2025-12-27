<?

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
	 
$result = mysql_query("select * from receivers where ordernum='$ordernum'", $con);
$total = mysql_num_rows($result);

if ($total) {
	$session = mysql_result($result, 0, "session");
 
	mysql_query("delete from receivers where ordernum='$ordernum'", $con);
	mysql_query("delete from orderlist where session='$session'", $con);
}


mysql_close($con);
echo ("<script>
 	window.alert('구매가 정상적으로 취소처리되었습니다.')
    history.go(1)
    </script>
    <meta http-equiv='Refresh' content='0; url=main.html'>
");	   
?>

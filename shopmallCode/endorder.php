<style>
table,td{
	 border-collapse: collapse;
}
.t{
	border-bottom:2px solid gray;
}
.tt{
	border-top:2px solid gray;
}
.ttt{
	border-bottom:1px solid lightgray;
}
#buy:hover{
	border-radius:10px;
	background-color:#C3BEBC;
	color:white;
	width:120px;
	height:50px;
	border:0;
}
#buy{
	border-radius:10px;
	background-color:white;
	color:black;
	width:120px;
	height:50px;
	border:1px solid #C3BEBC;
	
}
</style>
<?
include ("top.html");
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

$result = mysql_query("select * from receivers where ordernum='$ordernum'", $con);
$total = mysql_num_rows($result);

$session = mysql_result($result, 0, "session");
$sender = mysql_result($result, 0, "sender");
$receiver = mysql_result($result, 0, "receiver");
$phone = mysql_result($result, 0, "phone");
$address = mysql_result($result, 0, "address");
$message = mysql_result($result, 0, "message");
$buydate = mysql_result($result, 0,  "buydate");

	 

	 
echo ("
     
	<table border=0 width=1000 align=center style='margin-top:200px;'>
	<tr><td width=400><hr style='border:3px solid #916D62;background-color:#916D62;'></td>
		<td><h2 align=center style='color:#916D62;margin:10px;' width=200>주문완료</h2></td>
		<td  width=400><hr style='border:3px solid #916D62;background-color:#916D62;'></td>
	</tr></table>
	<table border=0 width=900 align=center style='margin-top:10px;'>
	
	
");

echo ("
	<tr class='t'><td colspan=2><font style='color:gray;font-size:14px;'>&nbsp;&nbsp;&nbsp;&nbsp;주문번호:<b>$ordernum</b>&nbsp;주문날짜:$buydate</font></td></tr>
	<td align=center width=550>
		<table border=0 align=center width=100%>
			<tr class='ttt' ><td width=100 align=center><font size=2>상품명</td>
			<td width=380 align=center><font size=2>상품명</td>
			<td align=center width=50><font size=2>수량</td>
			<td align=center width=50><font size=2>단가</td>
			<td align=center width=70><font size=2>금액</td>
			</tr>
		</table></td>
	</tr>
");	

echo("
	<tr >
	<td>
");
	
$subresult = mysql_query("select * from orderlist where ordernum='$ordernum'", $con);
$subtotal = mysql_num_rows($subresult);

$subcounter=0;
$totalprice=0;
          
while ($subcounter < $subtotal) :
	$pcode = mysql_result($subresult, $subcounter, "pcode");
	$quantity = mysql_result($subresult, $subcounter, "quantity");
	   
	$tmpresult = mysql_query("select * from product where code='$pcode'", $con);
	$userfile= mysql_result($tmpresult, 0,   "userfile");
	$pname = mysql_result($tmpresult, 0,   "name");
	$price = mysql_result($tmpresult, 0,   "price2");
		   
	$subtotalprice = $quantity * $price;
	$totalprice = $totalprice + $subtotalprice;
	
	echo("
		<table border=0 align=center width=100%>
		<tr class='ttt'><td width=110 align=center><font size=2><img src='./photo/$userfile' style='width:80px;height:80px;border:1px solid;margin:10px;'></td>
		<td width=380><font size=2>$pname</td>
		<td align=right width=50><font size=2>$quantity</td>
		<td align=right width=50><font size=2>$price</td>
		<td align=right width=70><font size=2>$subtotalprice</td>
		</tr>
		</table>
	");
	
     $subcounter++;
endwhile;
	
echo ("
	</td>
	
	</tr>
	<tr class='t'><td align=left><font color=red size=3>결제금액 : <b>$totalprice</b>원</td></tr>
	</table>
");

echo ("<table border=0 width=900 align=center style='margin-top:50px;'> <tr><td><b>배송정보</b></td></tr></table>
	<table border=0 width=900 align=center style='margin-top:5px;border-top:2px solid gray;'>

	<tr class='ttt' ><td   align=center><font size=2>주문자명</td>
	<td align=center><font size=2>수신자명</td>
	<td align=center><font size=2>수신주소</td>
	<td align=center><font size=2>수신자연락처</td>
	</tr>
");

echo ("
	<tr  class='ttt' ><td align=center><font size=2>$sender</td>
	<td align=center><font size=2>$receiver</td>
	<td><font size=2>$address</td>
	<td align=center><font size=2>$phone</td></tr>
	<tr class='t' height=50> <td colspan=4><font size=2>주문 메시지: $message</td></tr>
	<tr><td align=center colspan=4><button id='buy' style='margin-top:10px;'>
	<a href='p-list.php' style='text-decoration:none; color:black;'>계속 쇼핑하기</a></button></td><tr>
	</table>
	<table  width=1000 align=center><tr><td><hr  style='border:3px solid #916D62;background-color:#916D62;margin-top:50px;'></td></tr></table>
");

mysql_close($con);
include ("bottom.html");
?>

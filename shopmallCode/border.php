<style>
table,td{
	 border-collapse: collapse;
}
.t{border-bottom:1px solid lightgray;
	
}
.tt{border-bottom:1px solid black;
	

	
}
.click{
	color:white;
	

	
}

a{
	text-decoration:none;
	color:black;
}
.bclick{
	border-radius:5px;
	border:1px solid black;
	background-color:black;
}
.bclick:hover{
	border-radius:5px;
	border:1px solid blue;
	background-color:blue;
	font-weight:bold;
}
</style>
<? include "top.html"; ?>
<?
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
	
$result = mysql_query("select * from receivers where phone='$mphone' and ordernum='$order'", $con);
$total=mysql_num_rows($result);
if (!$total)   {
   echo("<script>
      window.alert('입력하신 전화번호와 주문번호를 동시에 만족하는 주문내역이 없습니다')
      history.go(-1)
      </script>
   ");
   exit;
} else {
echo ("
	<table width=690 border=0  align=center style='margin-top:200px;border-top:3px solid black;border-bottom:2px solid black;'>
	<tr><td align=center colspan=5> <b>[구매내역]</b></td></tr>
	
	
	<tr  class='tt'><td align=center><font size=2>구매번호</td>
	<td align=center><font size=2>구매일자</td>
	<td align=center><font size=2>주문내역</td>
	<td align=center><font size=2>금액</td>
	<td align=center><font size=2>주문상태</td></tr>");	

		$session = mysql_result($result, 0, "session");
		$buydate = mysql_result($result, 0, "buydate");
		$ordernum = mysql_result($result, 0, "ordernum");
		$status = mysql_result($result, 0, "status");
		$oldstatus = $status;
	switch ($status) {
		  case 1:
				$status = "주문신청";
				break;
		  case 2:
				$status = "주문접수";
				break;
		  case 3: 
				$status = "배송준비중";
				break;
		  case 4:
				$status = "배송중";
				break;
		  case 5:
				$status = "배송완료";
				break;
		  case 6:
				$status = "구매완료";
				break;
		}

		$subresult = mysql_query("select * from orderlist where ordernum='$order'",   $con);
        $subtotal =  mysql_num_rows($subresult);
		$subcounter=0;
        $totalprice=0;
	while ($subcounter <   $subtotal) :
             $pcode = mysql_result($subresult, $subcounter, "pcode");
             $quantity = mysql_result($subresult, $subcounter, "quantity");
      
             $tmpresult = mysql_query("select * from product where code='$pcode'", $con);
             $pname = mysql_result($tmpresult, 0, "name");
			 $price = mysql_result($tmpresult, 0, "price2");
       
             $subtotalprice = $quantity * $price;
             $totalprice = $totalprice + $subtotalprice;
             $subcounter++;
        endwhile;
	
		$items = $subtotal - 1;
	
        echo ("<tr class='t'><td align=center><font size=2>
			<a href=# onclick=\"window.open('detailview.php?ordernum=$ordernum', '_new',   'width=940, height=250, scrollbars=yes');\">$ordernum</a></td><td   align=center><font size=2>$buydate</td>
			<td><font size=2>$pname 외 $items 종</td><td align=right><font   size=2>$totalprice 원</td>
			<td align=center><font size=2>$status");
      
		if ($oldstatus < 4) echo ("<br><button class='bclick'><a href='bordercancel.php?ordernum=$ordernum' class='click' >주문취소</a></button>");

		echo ("</td></tr>");

		$counter++;
	echo("<tr><td class='t' colspan=5 align=left>총액 : <font   style='font-size:14px; font-weight:bold;'>$totalprice 원</font></td></tr>");
}

echo ("</table>
<table width=690  border=0 align=center style='margin-top:10px;'>
<tr><td colspan=2>* <font color=red   size=2>주문 물품이 배송 이전 단계이면 온라인으로 주문   취소가 가능합니다.</td></tr>
	<tr><td colspan=2>* <font size=2>배송중이거나 구매 완료된 제품에 대한 반품 및 환불 요청은     당사 고객센터(전화: 070-4065-8670)로 문의바랍니다.</td></tr></table>");
mysql_close($con);
include ("bottom.html");
?>

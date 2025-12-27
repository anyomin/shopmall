<style>
table,td{
	 border-collapse: collapse;
}
.t{border-bottom:1px solid lightgray;
	
}
.tt{border-bottom:1px solid black;
	

	
}
a{
	text-decoration:none;
	color:black;
}
.p{
	padding:10px;
}
.click{
	color:white;
	

	
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
#my:hover{
	border-radius:10px;
	background-color:#C3BEBC;
	color:white;
	width:120px;
	height:50px;
	border:0;
}
#my{
	border-radius:10px;
	background-color:white;
	color:black;
	width:120px;
	height:50px;
	border:1px solid #C3BEBC;
	
}
</style>

<?

$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("shopmall",   $con);
$result = mysql_query("select * from member where uid='$UserID'", $con);
	
$uid = mysql_result($result, 0,   "UID");
$uname = mysql_result($result, 0,   "UNAME");
$email = mysql_result($result, 0,   "EMAIL");
$zip = mysql_result($result, 0,   "ZIPCODE");
$addr1 = mysql_result($result, 0,   "ADDR1");
$addr2 = mysql_result($result, 0,   "ADDR2");
$mphone = mysql_result($result, 0,   "MPHONE");

?>
 <?include "top.html"; ?>


<?
$con = mysql_connect("localhost", "root", "apmsetup");
$result = mysql_query("select * from receivers where id='$UserID' order by buydate desc", $con);
$total = mysql_num_rows($result);

echo ("
	<table width=70% border=0 align=center style='margin-top:190px;''>
	<tr style='border-bottom:3px solid black;' ><td  colspan=5 style='padding-bottom:20px;'><font style='font-size:24px; '><b>주문내역 조회</b></font></td></tr>
	
	
	<tr  class='tt'><td align=center class='p'><font size=2>구매번호</td>
	<td align=center class='p'><font size=2>구매일자</td>
	<td align=center class='p'><font size=2>주문내역</td>
	<td align=center class='p'><font size=2>금액</td>
	<td align=center class='p'><font size=2>주문상태</td>
");	

if ($total > 0) {	
	$counter = 0;
	while($counter < $total) :
		$session = mysql_result($result, $counter, "session");
		$buydate = mysql_result($result, $counter, "buydate");
		$ordernum = mysql_result($result, $counter, "ordernum");
		$status = mysql_result($result, $counter, "status");
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
				$status = "<font style='color:blue;'>구매완료</font>";
				break;
		}
	 
		$subresult = mysql_query("select * from orderlist where ordernum='$ordernum'",   $con);
        $subtotal =  mysql_num_rows($subresult);

        $subcounter=0;
        $totalprice=0;

        while ($subcounter <   $subtotal) :
             $pcode = mysql_result($subresult, $subcounter, "pcode");
             $quantity = mysql_result($subresult, $subcounter, "quantity");
      
             $tmpresult = mysql_query("select * from product where code='$pcode'", $con);
			 $rest=mysql_query("select * from orderlist where pcode='$pcode' and ordernum='$ordernum'",$con);
			 $reviewstate=mysql_result($rest,0,"reviewstate");
             $pname = mysql_result($tmpresult, 0, "name");
			 $price = mysql_result($tmpresult, 0, "price2");
       
             $subtotalprice = $quantity * $price;
             $totalprice = $totalprice + $subtotalprice;
             $subcounter++;
         echo ("<tr height=45><td align=center><font size=2>
			<a href=# onclick=\"window.open('detailview.php?ordernum=$ordernum', '_new',   'width=940, height=250, scrollbars=yes');\">$ordernum</a></td>
						<td align=center><font size=2>$buydate</td>
						<td align=center><font size=2>$pname</td>
						<td align=center><font size=2>$subtotalprice</td>
						<td align=center><font size=2>$status");
						if($reviewstate==0){
							if ($oldstatus < 4) echo ("<br><button class='bclick'><font size=2><a href='ordercancel.php?ordernum=$ordernum&pcode=$pcode' class='click' >주문취소</a></button>");
					
							if ($oldstatus == 6) echo ("<br><button class='bclick'><font size=2><a href='reviewinput.php?ordernum=$ordernum&pcode=$pcode' class='click'>리뷰달기</a></button>");
						}
						else{
							if ($oldstatus < 4) echo ("<br><button class='bclick'><font size=2>(<a href='ordercancel.php?ordernum=$ordernum&pcode=$pcode' class='click'>주문취소</a></button>");
							if ($oldstatus == 6) echo ("<br><button class='bclick'><font size=2><a href='myreviewcontent.php?ordernum=$ordernum&pcode=$pcode' class='click'>리뷰완료</a></button>");
						}
						
		
		endwhile;
		echo ("
			</td><td class='t' colspan=5 align=left>총액 : <font   style='font-size:14px; font-weight:bold;'>$totalprice 원</font></td><tr class='t'></td>"
			);
      
		//if ($oldstatus < 4) echo ("<br>(<a href='ordercancel.php?ordernum=$ordernum'>주문취소</a>)");
		//if ($oldstatus == 6) echo ("<br><a href='reviewinput.php?ordernum=$ordernum'>리뷰달기</a>");
		echo ("</td></tr>");
	

		

        

		$counter++;
	endwhile;

} else {

	echo ("<tr><td align=center colspan=5><font size=2><b>주문 내역이 존재하지 않습니다</b></td></tr>");

}

echo ("</table>
<table width=70% border=0 align=center style='margin-top:10px;'>
<tr><td colspan=2>* <font color=red   size=2>주문 물품이 배송 이전 단계이면 온라인으로 주문   취소가 가능합니다.</td>
<td align=right><button id='my'><a href='my.php' >Mypage</a></button></td>
<td align=right><button  id='my'><a href='myreview.php?pcode=$pcode' >Myreview</a></button></td></tr>
	<tr><td colspan=2>* <font size=2>배송중이거나 구매 완료된 제품에 대한 반품 및 환불 요청은     당사 고객센터(전화: 070-4065-8670)로 문의바랍니다.</td></tr></table>");

mysql_close($con);	

?>
<?echo("<table width=100% border=0 style='margin-top:500px;'<tr><td>");
include('bottom.html');
echo("</td></tr></table>");?>

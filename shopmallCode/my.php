<style>
table,td{
	 border-collapse: collapse;
}
.t{
	border-bottom:2px solid #DDB9AE;
}
.t2{
	border-bottom:1.5px solid #EFD9D7;
}
.r{
	border-right:2px solid lightgray;
}
#tfont{
	font-size:32px;
	font-weight:bold;
	color:gray;
	
}
#p{
	font-weight:bold;
}
a{
	text-decoration:none;
}
.click2
{
	background-color:#DDB9AE;
	border:0;
	height:50px;
	width:160px;
	border-radius:5px;
}
.click2:hover
{
	background-color:#916D62;
	border:0
	height:50px;
	width:160px;
border-radius:5px;	
	transition:0.3s;
	
}
</style>

<?

include ("top.html");


$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
	$result = mysql_query("select * from member where uid='$UserID'", $con);
	$point = mysql_result($result,0,"point");
	
	$result1=mysql_query("select * from receivers where id='$UserID' and status=1",$con);
	$total1=mysql_num_rows($result1);
	
	$result2=mysql_query("select * from receivers where id='$UserID' and status=2",$con);
	$total2=mysql_num_rows($result2);
	
	$result3=mysql_query("select * from receivers where id='$UserID' and status=3",$con);
	$total3=mysql_num_rows($result3);
	
	$result4=mysql_query("select * from receivers where id='$UserID' and status=4",$con);
	$total4=mysql_num_rows($result4);
	
	$result5=mysql_query("select * from receivers where id='$UserID' and status=5",$con);
	$total5=mysql_num_rows($result5);
	
	$result6=mysql_query("select * from receivers where id='$UserID' and status=6",$con);
	$total6=mysql_num_rows($result6);
	$result0 = mysql_query("select * from member where uid='$UserID'", $con);
	
$uid = mysql_result($result0, 0,   "UID");
$uname = mysql_result($result0, 0,   "UNAME");
$email = mysql_result($result0, 0,   "EMAIL");
$zip = mysql_result($result0, 0,   "ZIPCODE");
$addr1 = mysql_result($result0, 0,   "ADDR1");
$addr2 = mysql_result($result0, 0,   "ADDR2");
$mphone = mysql_result($result0, 0,   "MPHONE");
$class=mysql_result($result0, 0,   "class");
?>
<table width=75% cellspacing=0 cellpadding=0 border=0 align=center style='margin-top:230px;'>
<tr class='t' height=85 style='background-color: #DDB9AE;'><td align=center id='tfont' colspan=8><font style='color:white;'>마이페이지</font></td></tr>
<tr  height=50 ><td align=center colspan=8><b>[ 회원 정보 ]</b></td></tr>
<tr class='t2'><td height=100 width=100 align=center rowspan=3><img src="user1.png" style='width:200px; border:1px solid lightgray; margin:20px;'></td></td>
<td  colspan=3><b><?echo $UserName?></b>&nbsp;회원님 반갑습니다.</b></td>
<td colspan=2><font style='font-size:13px; color:gray;'>현재 등급 : <b  style='font-size:18px;' ><? echo $class?></b></font>
<?if ($class=='white'){
	echo("<font style='font-size:11px; color:#B8B4B4;'>구매금액의 1% 적립중</font>");
}?>
<?if ($class=='yellow'){
	echo("<font style='font-size:11px; color:#B8B4B4;'>구매금액의 2% 적립중</font>");
}?>
<?if ($class=='orange'){
	echo("<font style='font-size:11px; color:#B8B4B4;'>구매금액의 3% 적립중</font>");
}?>
<?if ($class=='red'){
	echo("<font style='font-size:11px; color:#B8B4B4;'>구매금액의 4% 적립중</font>");
}?>
<?if ($class=='vip'){
	echo("<font style='font-size:11px; color:#B8B4B4;'>구매금액의 5% 적립중</font>");
}?>

 </td>
<td align=left ><a href=umodify.php><font size=2>회원정보수정</a></td></tr>



<tr class='t2'><td width=100><font size=2>아이디</td>
<td width=120><font size=2><? echo $UserID; ?></td>
<td width=80><font size=2>휴대전화</td>
<td width=140><font size=2><? echo $mphone; ?></td>
<td width=80><font size=2>이메일</td>
<td width=170><font size=2><? echo $email; ?></td></tr>
<tr class='t'><td><font size=2>주소</td>
<td colspan=5><font   size=2><? echo $zip . " " . $addr1 . " " . $addr2;   ?></td></tr>
</table>
<?
echo("
<table width=75% cellspacing=0 cellpadding=0 border=0 align=center style='margin-top:50px;'> 

<tr height=50><td align=center colspan=6><b>[주문현황]</b></td></tr>

<tr height=100 >
	<td align=center class='r'>주문신청<p id='p'>$total1</p></td><td align=center class='r'>주문접수<p id='p'>$total2</p></td> <td align=center class='r'>배송준비중<p id='p'>$total3</p></td>
	<td align=center class='r'>배송중<p id='p'>$total4</p></td> <td align=center class='r'>배송완료<p id='p'>$total5</p></td> <td align=center>주문완료<p id='p'>$total6</p></td>
</tr>


<tr height=120><td align=center colspan=6>
포인트 : <a id='p'>$point</a></td></tr>
</table>
<center><p style='margin-top:50px;'><button class='click2'><a href=mypage.php style='color:white;'>주문내역 조회</a></button><button style='margin-left:40px;' class='click2'><a href=showbag.php style='color:white;'>장바구니</a></button></p>");
include ("bottom.html");
?>


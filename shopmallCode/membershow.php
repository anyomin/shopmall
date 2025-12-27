<style>
.tt{border-bottom:2px lightgray solid;
	
}
.ttt{border-bottom:2px black solid;
	
}
table,td{
	 border-collapse: collapse;
}
a{
	text-decoration:none;
	
}
#img:hover{
    transform:scale(1.1);
	   overflow:hidden;
		 opacity: 0.8;
		
}
</style>
<?
include ("top.html");
if ($UserID != 'admin') {
	echo ("<script>
		window.alert('관리자만 접근 가능한 기능입니다')
		history.go(-1)
		</script>");
    exit;
} 

$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("shopmall",   $con);
	
$result = mysql_query("select * from member order by uname", $con);
$total = mysql_num_rows($result);

echo ("
	<table border=0 width=750 align=center style='margin-top:200px;'>
    <tr><td align=center><font size=3><b>[회원 목록 조회]</b></td></tr>
	<tr><td align=right><font size=2>[<a href=p-adminlist.php>Back</a>]</td>
	</tr></table> ");
	   
$i = 0;	

echo ("
	<table border=0 width=750 align=center style='margin-top:20px;border-top:2px solid black;'>
	<tr class='ttt' height=35>
	<td align=center width=70><font size=2><b>ID</b></td>
	<td align=center width=100><font   size=2><b>이름</b></td>
	<td align=center width=340><font size=2><b>주소</b></td>
	<td align=center width=100><font size=2><b>전화번호</b></td>
	<td align=center width=100><font size=2><b>이메일</b></td>
	<td align=center width=40><font size=2><b>승인</b></td>
	<td align=center width=40><font size=2><b>등급</b></td></tr>
");	

while($i < $total):
	$uid = mysql_result($result, $i, "UID");
	$uname = mysql_result($result, $i, "UNAME");
	$zip = mysql_result($result, $i, "ZIPCODE");
	$addr1 = mysql_result($result, $i, "ADDR1");
	$addr2 = mysql_result($result, $i, "ADDR2");
	$mphone = mysql_result($result, $i, "MPHONE");
	$email = mysql_result($result, $i, "EMAIL");
	$approved = mysql_result($result, $i, "APPROVED");
	$class = mysql_result($result, $i, "class");
	$address = "(" . $zip .   ")" . "&nbsp;" . $addr1 . "&nbsp;" .   $addr2;
	
    echo ("<tr class='tt' height=30><td align=center><font size=2>$uid</td>
		<td align=center><font size=2>$uname</td>
		<td><font size=2>$address</td>
		<td align=center><font size=2>$mphone</td>
		<td align=center><font size=2>$email</td>");
		
	if ($approved == 0) {
		echo ("<td align=center><a href=memberchange.php?uid=$uid><font size=2>대기</a></td>");
	} else {
		echo ("<td align=center><a href=memberchange.php?uid=$uid><font size=2>완료</a></td>");
	}
	   echo ("<td align=center><font size=2>$class</td></tr>");   
	$i++;
endwhile;

echo ("</table>");
echo("<table border=0 align=center style='margin-top:50px;'>
		<tr><td  align=center><font size=3><b>[주 문 관 리]</b></td>
     <td></td>
      <td  align=center><font size=3><b>[상 품 리 스 트 관 리]</b></td>
<td></td>
	<td  align=center><font size=3><b>[상 품 관 리]</b></td>
	</tr>
		<tr ><td align=center width=300 style='border:5px solid lightgray;'><a href=orderlist.php><img src='주문내역1-removebg-preview.png' style='width:180px;filter: invert(89%) sepia(2%) saturate(56%) hue-rotate(335deg) brightness(104%) contrast(73%);' id='img'></a>
		<p >[주문내역]</p></td>
		<td  width=70></td>
			 <td align=center width=300 style='border:5px solid lightgray;'><a href=p-adminlist.php><img src='상품리스트-removebg-preview.png' style='width:220px;filter: invert(80%) sepia(57%) saturate(56%) hue-rotate(335deg) brightness(90%) contrast(73%);' id='img'></a>
			 <p >[상품리스트]</p></td>
			 <td  width=70></td>
			 <td align=center width=300 style='border:5px solid lightgray;'><a href='p-input.php'><img src='상품등록-removebg-preview.png' style='width:220px;filter: invert(89%) sepia(2%) saturate(56%) hue-rotate(335deg) brightness(104%) contrast(73%);' id='img'></a>
			 <p >[상품등록]</p></td>
		</tr>

		</table>
		");
mysql_close($con);
include ("bottom.html");
?>

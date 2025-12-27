<style>

#img:hover{
    transform:scale(1.1);
	   overflow:hidden;
		 opacity: 0.8;
		
}

a{
	text-decoration:none;
	color:black;
}
table,td{
	 border-collapse: collapse;
}
.t{border-bottom:1px solid #E3C8B5;
	
}
.tp{border-bottom:2px solid #AB8E86;
	
}
.tpp{border-bottom:1px solid gray;
	
}
</style>
<? include ("top.html"); ?>
<?

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
	
$result = mysql_query("select * from product order by name", $con);

$total = mysql_num_rows($result);

echo ("<table border=0 cellspacing='0'  width=80% style='margin-top:250px;' align=center>
	<tr class='tp' ><td colspan=6 align=center><h2 align=center>상품리스트</h2></td></tr>
	<tr  class='tp' ><td align=center ><font size=2>상품코드</td>
	<td colspan=2 align=center ><font size=2>상품명</td>
	<td align=center ><font size=2>권장가격</td>
	<td align=center ><font size=2>판매가격</td>
	<td align=center ><font size=2>수정/삭제</td></tr>");
							
if (!$total) {

  echo("
<tr ><td colspan=6  align=center>아직 등록된 상품이 없습니다</td></tr>");

} else {

	$counter = 0;

	while ($counter < $total) :

		$code=mysql_result($result,$counter,"code");
		$name=mysql_result($result,$counter,"name");
		$userfile=mysql_result($result,$counter,"userfile");
		$price1=mysql_result($result,$counter,"price1");
		$price2=mysql_result($result,$counter,"price2");

		echo ("
		   <tr class='t' ><td width=100 align=center ><font size=2>$code</td>
			 <td align=center width=30  ><img src=./photo/$userfile width=40 height=40 border=0></td>
			   <td width=350 align=left ><a href=p-show.php?code=$code><font size=2>$name</a></td>
			   <td align=right width=70 ><font size=2><strike>$price1&nbsp;원</strike></td>
			   <td align=right width=70 ><font size=2>$price2&nbsp;원</td>
			   <td width=70  align=center><font size=2><a href=p-modify.php?code=$code>수정</a>/<a href=p-delete.php?code=$code>삭제</a></td></tr>");

		$counter++;
	endwhile;
}

echo ("	
		</table>
		<table border=0 align=center style='margin-top:20px;'>
		<tr><td  align=center><font size=3><b>[주 문 관 리]</b></td>
     <td></td>
      <td  align=center><font size=3><b>[회 원 관 리]</b></td>
<td></td>
	<td  align=center><font size=3><b>[상 품 관 리]</b></td>
	</tr>
		<tr ><td align=center width=300 style='border:5px solid lightgray;'><a href=orderlist.php><img src='주문내역1-removebg-preview.png' style='width:180px;filter: invert(99%) sepia(91%) saturate(399%) hue-rotate(294deg) brightness(84%) contrast(89%);' id='img'></a>
		<p >[주문내역]</p></td>
		<td  width=70></td>
			 <td align=center width=300 style='border:5px solid lightgray;'><a href=membershow.php><img src='회원정보-removebg-preview.png' style='width:220px;filter: invert(99%) sepia(91%) saturate(399%) hue-rotate(294deg) brightness(84%) contrast(89%);' id='img'></a>
			 <p >[회원정보]</p></td>
			 <td  width=70></td>
			 <td align=center width=300 style='border:5px solid lightgray;'><a href='p-input.php'><img src='상품등록-removebg-preview.png' style='width:220px;filter: invert(99%) sepia(91%) saturate(399%) hue-rotate(294deg) brightness(84%) contrast(89%);' id='img'></a>
			 <p >[상품등록]</p></td>
		</tr>

		</table>
		");

	
mysql_close($con);

?>
<div style='margin-top:100px;'>
<? include ('bottom.html');?>
</div>

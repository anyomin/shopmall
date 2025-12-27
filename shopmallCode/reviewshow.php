<style>

table,td{
	 border-collapse: collapse;
}

#butt{
	background-color:white;
	font-size:13;
	color:gray;
	padding:12px;
	border:none;
}
#butt:hover{
	background-color:#EEECE9;
	font-size:13;
	color:black;
	padding:12px;
	border:none;
	font-weight:bold;


}
#gright{
	color:gray;
}
#gright:hover{
	color:black;
	font-weight:bold;
}
.t{border-bottom:1px solid lightgray;
	
}
.tt{border-bottom:1px solid black;
}
a{
		text-decoration:none;
	}
.aa{
	color:gray;
}
.aa:hover{
	font-weight:bold;
	color:black;
}
</style>
<script src="https:kit.fontawesome.com/acfe1c41fb.js" crossorigin="anonymous"></script>
<?
 include ("top.html");
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
$result = mysql_query("select * from testboard order by id desc", $con);
$total = mysql_num_rows($result);

echo("
<center>
	<table border=0 width=1200 style='margin-top:180px; align:center;'>
	<tr><td colspan=2 align=center><h1>후기글</h1></td></tr>
	<tr><td align=center>
	<form method=post action='reviewsearch.php'>
	<select  name='field'>
	<option value='writer'>아이디</option>
	<option value='topic'>제목</option>
	<option value='content'>내용</option>
	</select>
	<input type=text name='key' >
	<input  type=submit style='border-radius:5px;' value='검색하기'>
	</td>
	</form>
	<td align=right></td></tr>
	</table>
	<table border=0 width=1000  style='border-top:1px solid;' >
	<tr height=35 class='tt' ><td align=center width=50><b>번호</b></td>
		<td></td>
	<td align=center width=100><b>아이디</b></td>
	<td align=center width=400><b>제목</b></td>
	<td align=center width=150><b>날짜</b></td>
	<td align=center width=50><b>조회</b></td>
	<td align=center width=100><b>별점</b></td>
	</tr>
");

if (!$total){
	echo("
		<tr><td colspan=5 align=center>아직 등록된 글이 없습니다.</td></tr>
	");
} else {

	if   ($cpage=='') $cpage=1;    // $cpage -  현재 페이지 번호
	$pagesize = 5;                // $pagesize - 한 페이지에 출력할 목록 개수

	$totalpage = (int)($total/$pagesize);
	if (($total%$pagesize)!=0) $totalpage = $totalpage + 1;

	$counter=0;

	while($counter<$pagesize):
		$newcounter=($cpage-1)*$pagesize+$counter;
		if ($newcounter == $total) break;

		$id=mysql_result($result,$newcounter,"id");
		$writer=mysql_result($result,$newcounter,"writer");
		$topic=mysql_result($result,$newcounter,"topic");
		$hit=mysql_result($result,$newcounter,"hit");
		$wdate=mysql_result($result,$newcounter,"wdate");
		$space=mysql_result($result,$newcounter,"space");
		$filename = mysql_result($result, $newcounter, "filename");
		$star=mysql_result($result, $newcounter, "star");
		$code = mysql_result($result, $newcounter, "code");
		$cresult = mysql_query("select * from product where code='$code'", $con);
		$userfile=mysql_result($cresult,0,"userfile");
		$t="";

		if   ($space>0) {
			for ($i=0 ; $i<=$space ; $i++)
				$t = $t . "&nbsp;";     // 답변 글의 경우 제목 앞 부분에 공백을 채움
		}
		
			if ($filename):
				echo("
					<tr class='t'><td align=center>$id</td>
					<td align=center width=200><a href=# onclick=\"window.open('./photo/$userfile', '_new', 'width=200, height=200')\"><img src='./photo/$userfile' width=170 style='height:170px;margin:10px;' border=1></a></td>
					<td align=center>$writer</td>
					<td align=left>$t<a  href='reviewcontent.php?board=testboard&id=$id&cblock=$cblock&ccpage=$cpage&pcode=$code' class='aa'>$topic</a>&nbsp;<i  class='fa-solid fa-paperclip'></i></td>
					<td align=center>$wdate</td><td align=center>$hit</td>
					<td align=center><i class='fa-solid fa-star' style='color:#F6D505;'></i>X<a>$star</a></td>
					</tr>
					");
			else:
				echo("
					<tr class='t'><td align=center>$id</td>
					<td align=center width=200><a href=# onclick=\"window.open('./photo/$userfile', '_new', 'width=200, height=200')\"><img src='./photo/$userfile' width=170 style='height:170px;margin:10px;' border=1></a></td>
					<td align=center>$writer</td>
					<td align=left>$t<a href='reviewcontent.php?board=testboard&id=$id&cblock=$cblock&ccpage=$cpage&pcode=$code'  class='aa'>$topic&nbsp;</a></td>
					<td align=center>$wdate</td><td align=center>$hit</td>
					<td align=center><i class='fa-solid fa-star' style='color:#F6D505;'></i>X<a>$star</a></td>
					</tr>
					");
			endif;

		
		
		$counter = $counter + 1;

	endwhile;

	echo("</table>");

	echo ("<table border=0 width=700>
		  <tr><td align=center>");
		   
	// 화면 하단에 페이지 번호 출력
	if ($cblock=='') $cblock=1;   // $cblock - 현재 페이지 블록값
	$blocksize = 5;             // $blocksize - 화면상에 출력할 페이지 번호 개수

	$pblock = $cblock - 1;      // 이전 블록은 현재 블록 - 1
	$nblock = $cblock + 1;     // 다음 블록은 현재 블록 + 1

	// 현재 블록의 첫 페이지 번호
	$startpage = ($cblock - 1) * $blocksize + 1;	

	$pstartpage = $startpage - 1;  // 이전 블록의 마지막 페이지 번호
	$nstartpage = $startpage + $blocksize;  // 다음 블록의 첫 페이지 번호
	$f =($totalpage/$blocksize);
	$ff=ceil($f);
	if ($cpage==1)     //현재 페이지가 1인 경우 맨앞블록 비활성화
		echo("");
	else
		echo("<a href=reviewshow.php?board=testboard&cblock=1&cpage=1><i class='fas fa-angle-double-left' id='gright'></i></a> ");
	if ($pblock > 0)        // 이전 블록이 존재하면 [이전블록] 버튼을 활성화
		echo ("<a href=reviewshow.php?board=testboard&cblock=$pblock&cpage=$pstartpage><i class='fa-solid fa-chevron-left' id='gright'></i></a> ");

	// 현재 블록에 속한 페이지 번호를 출력	
	$i =   $startpage;
	while($i < $nstartpage):
	   if ($i > $totalpage) break;  // 마지막 페이지를 출력했으면 종료함
	   if ($cpage==$i){
	   echo ("<a href=reviewshow.php?board=testboard&cblock=$cblock&cpage=$i><button style='font-weight:bold;color:balck;background-color:white;font-size:15px;padding:12px;border:none;' >$i</button></a>");
	   $i = $i + 1;}
	   else{
		   echo ("<a href=reviewshow.php?board=testboard&cblock=$cblock&cpage=$i><button  id='butt'>$i</button></a>");
	   $i = $i + 1;} 
	   
	endwhile;
	 
	// 다음 블록의 시작 페이지가 전체 페이지 수보다 작으면 [다음블록] 버튼 활성화  
	if ($nstartpage <= $totalpage)   
		echo ("<a href=reviewshow.php?board=testboard&cblock=$nblock&cpage=$nstartpage><i class='fa-solid fa-chevron-right' id='gright'></i></a> ");
	if ($totalpage<=$cpage)
		echo("");
	else
		
	echo ("<a href=reviewshow.php?board=testboard&cpage=$totalpage&cblock=$ff><i class='fas fa-angle-double-right' id='gright'></i></a> ");//모르겠다수박

	echo ("</td></tr></table>");
}
	
mysql_close($con);
 include ("bottom.html");
?>


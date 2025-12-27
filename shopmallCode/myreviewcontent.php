<?
include ("top.html");
$con=mysql_connect("localhost","root","apmsetup");

mysql_select_db("shopmall",$con);
$presult=mysql_query("select * from product where code='$pcode'",$con);
$name=mysql_result($presult,0,"name");
$userfile=mysql_result($presult,0,"userfile");
echo("
<table align=center border=0 style='margin-top:200px;' >
	<tr><td> <img src='./photo/$userfile' width=110 style='height:110px;margin-bottom:5px;float:left;margin-right:10px;' border=1>
	<p style='color:#9E9A99;'>ALMOND</p>
	<p style='float:left;'>$name</p></td></tr><tr><td>");


$result=mysql_query("select * from testboard where code='$pcode' and ordernum='$ordernum' ",$con);

// 각 필드에 해당하는 데이터를 뽑아 내는 과정
$id=mysql_result($result,0,"id");
$writer=mysql_result($result,0,"writer");
$topic=mysql_result($result,0,"topic");
$hit=mysql_result($result,0,"hit");
$code=mysql_result($result,0,"code");
$star=mysql_result($result,0,"star");
$hit = $hit +1;   //조회수를 하나 증가
mysql_query("update testboard set hit=$hit where id=$id",$con);

$wdate=mysql_result($result,0,"wdate");
$content=mysql_result($result,0,"content");
$filename = mysql_result($result, 0, "filename");

// 테이블로부터 읽은 내용을 화면에 디스플레이
echo("
	

	<table border=0 width=750 align=center  style='margin-top:10px; border-top:2px solid gray;'>
	
	<tr><td  width=700 >");
	$j=0;
	while ($j < $star) :
	echo("<i class='fa-solid fa-star' style='color:#F6D505;'></i>");
		$j++;
	endwhile;
	
	echo("&nbsp;<font style='font-weight:bold;'>$star</font>
	<font style='color:#9E9A99;font-size:13px;'>&nbsp;|&nbsp;"); echo (substr($writer,0,3) . '***' );
	echo("&nbsp;|&nbsp; $wdate</font></td>
	<td width=100><font style='font-size:12px;'>조회수: $hit</font></td>
	</tr>
	<tr><td colspan=2></td>
	");
	
	
	if($filename){
	  echo("<tr><td  align=left colspan=6 style='border-top:2px solid lightgray;border-bottom:2px solid lightgray;'>제목: <b>$topic<pre>$content</pre>
	  <img src='./reviewphoto/$filename' width=350 style='height:250px;margin-bottom:20px;' border=1>
	  
	</td></tr>");}
	else{
	  echo("<tr><td  align=left colspan=6 style='border-top:2px solid lightgray;border-bottom:2px solid lightgray;'>제목: <b>$topic<pre>$content</pre>
	  
	  
	</td></tr>");}
	echo("

	
	<tr  height=50><td align=left ><a href='mypage.php?code=$code' style='text-decoration:none; border-radius:5px;'>목록</a></td>
	<td align=right><a href=pass.php?board=testboard&id=$id&mode=0 style='text-decoration:none; border-radius:5px;'>수정</a>
	<a href='pass.php?board=testboard&id=$id&mode=1' style='text-decoration:none;border-radius:5px;'>삭제</a>
	
	
	</td></tr>
	</table></td></tr>
	</table>
");
	


include ("bottom.html");
?>
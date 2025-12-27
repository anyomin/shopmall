<?
include "top.html";
$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

$result = mysql_query("select * from product where code='$code'", $con);

$class=mysql_result($result,0,"class");
$class2=mysql_result($result,0,"class2");
$name=mysql_result($result,0,"name");
$price1=mysql_result($result,0,"price1");
$price2=mysql_result($result,0,"price2");
$content=mysql_result($result,0,"content");
$userfile=mysql_result($result,0,"userfile");
$fileexplain=mysql_result($result,0,"fileexplain");	
echo ("
    <table align=center border=0 width=650 style='position:absolute; top:350px; left:500px;'>     
	<form method=post action=p-modify2.php?code=$code enctype='multipart/form-data'>
	<tr><td width=100 align=center>상품코드</td>
	<td width=550><b>$code</b></td></tr>
	<tr><td align=center>상품분류</td>
	<td><select name=class id='productSelect' >");
	
	switch($class) {
    case 1:
		echo ("<option value=1 selected>목걸이</option>
			<option value=2>귀걸이</option>
            <option value=3>팔찌</option>)
			<option value=4>반지</option>
			<option value=5>세트</option>");
		break;
	case 2:
		echo ("<option value=1 >목걸이</option>
			<option value=2 selected>귀걸이</option>
            <option value=3>팔찌</option>)
			<option value=4>반지</option>
			<option value=5>세트</option>");
		break;
	case 3:
       echo ("<option value=1>목걸이</option>
			<option value=2>귀걸이</option>
            <option value=3 selected>팔찌</option>)
			<option value=4>반지</option>
			<option value=5>세트</option>");
		break;
	case 4:
       echo ("<option value=1>목걸이</option>
			<option value=2>귀걸이</option>
            <option value=3>팔찌</option>)
			<option value=4 selected>반지</option>
			<option value=5>세트</option>");
		break;
	case 5:
       echo ("<option value=1>목걸이</option>
			<option value=2>귀걸이</option>
            <option value=3>팔찌</option>)
			<option value=4>반지</option>
			<option value=5 selected>세트</option>");
		break;
}
	
	
	
	echo("
	</select>
    <select name=class2 id='mallSelect'>");
	
	switch($class2) {
    case 1:
		echo ("<option value='1' selected  class='mall1'>진주목걸이</option>
				<option value='2' class='mall1'>두줄목걸이</option>
				<option value='3' class='mall1'>심플목걸이</option>
				<option value='4' class='mall2'>진주귀걸이</option>
				<option value='5' class='mall2'>큐빅귀걸이</option>
				<option value='6' class='mall2'>링귀걸이</option>
				<option value='7' class='mall3'>한줄팔찌</option>
				<option value='8' class='mall3'>두줄팔찌</option>
				<option value='9' class='mall3'>뱅글팔찌</option>
				<option value='10' class='mall4'>심플반지</option>
				<option value='11' class='mall4'>큐빅반지</option>
				<option value='12' class='mall5'>팔찌/반지 세트</option>");
		break;
	case 2:
		echo ("<option value='1' class='mall1'>진주목걸이</option>
				<option value='2' selected  class='mall1'>두줄목걸이</option>
				<option value='3' class='mall1'>심플목걸이</option>
				<option value='4' class='mall2'>진주귀걸이</option>
				<option value='5' class='mall2'>큐빅귀걸이</option>
				<option value='6' class='mall2'>링귀걸이</option>
				<option value='7' class='mall3'>한줄팔찌</option>
				<option value='8' class='mall3'>두줄팔찌</option>
				<option value='9' class='mall3'>뱅글팔찌</option>
				<option value='10' class='mall4'>심플반지</option>
				<option value='11' class='mall4'>큐빅반지</option>
				<option value='12' class='mall5'>팔찌/반지 세트</option>");
		break;
	case 3:
		echo ("<option value='1' class='mall1'>진주목걸이</option>
				<option value='2' class='mall1'>두줄목걸이</option>
				<option value='3'  selected  class='mall1'>심플목걸이</option>
				<option value='4' class='mall2'>진주귀걸이</option>
				<option value='5' class='mall2'>큐빅귀걸이</option>
				<option value='6' class='mall2'>링귀걸이</option>
				<option value='7' class='mall3'>한줄팔찌</option>
				<option value='8' class='mall3'>두줄팔찌</option>
				<option value='9' class='mall3'>뱅글팔찌</option>
				<option value='10' class='mall4'>심플반지</option>
				<option value='11' class='mall4'>큐빅반지</option>
				<option value='12' class='mall5'>팔찌/반지 세트</option>");
		break;
	case 4:
		echo ("<option value='1' class='mall1'>진주목걸이</option>
				<option value='2' class='mall1'>두줄목걸이</option>
				<option value='3' class='mall1'>심플목걸이</option>
				<option value='4' select class='mall2'>진주귀걸이</option>
				<option value='5' class='mall2'>큐빅귀걸이</option>
				<option value='6' class='mall2'>링귀걸이</option>
				<option value='7' class='mall3'>한줄팔찌</option>
				<option value='8' class='mall3'>두줄팔찌</option>
				<option value='9' class='mall3'>뱅글팔찌</option>
				<option value='10' class='mall4'>심플반지</option>
				<option value='11' class='mall4'>큐빅반지</option>
				<option value='12' class='mall5'>팔찌/반지 세트</option>");
		break;
	case 5:
		echo ("<option value='1' class='mall1'>진주목걸이</option>
				<option value='2' class='mall1'>두줄목걸이</option>
				<option value='3' class='mall1'>심플목걸이</option>
				<option value='4' class='mall2'>진주귀걸이</option>
				<option value='5' selected   class='mall2'>큐빅귀걸이</option>
				<option value='6' class='mall2'>링귀걸이</option>
				<option value='7' class='mall3'>한줄팔찌</option>
				<option value='8' class='mall3'>두줄팔찌</option>
				<option value='9' class='mall3'>뱅글팔찌</option>
				<option value='10' class='mall4'>심플반지</option>
				<option value='11' class='mall4'>큐빅반지</option>
				<option value='12' class='mall5'>팔찌/반지 세트</option>");
		break;
	case 6:
		echo ("<option value='1' class='mall1'>진주목걸이</option>
				<option value='2' class='mall1'>두줄목걸이</option>
				<option value='3'  class='mall1'>심플목걸이</option>
				<option value='4' class='mall2'>진주귀걸이</option>
				<option value='5' class='mall2'>큐빅귀걸이</option>
				<option value='6'  selected  class='mall2'>링귀걸이</option>
				<option value='7' class='mall3'>한줄팔찌</option>
				<option value='8' class='mall3'>두줄팔찌</option>
				<option value='9' class='mall3'>뱅글팔찌</option>
				<option value='10' class='mall4'>심플반지</option>
				<option value='11' class='mall4'>큐빅반지</option>
				<option value='12' class='mall5'>팔찌/반지 세트</option>");
		break;
	case 7:
		echo ("<option value='1' class='mall1'>진주목걸이</option>
				<option value='2' class='mall1'>두줄목걸이</option>
				<option value='3'  class='mall1'>심플목걸이</option>
				<option value='4' class='mall2'>진주귀걸이</option>
				<option value='5' class='mall2'>큐빅귀걸이</option>
				<option value='6' class='mall2'>링귀걸이</option>
				<option value='7' selected  class='mall3'>한줄팔찌</option>
				<option value='8' class='mall3'>두줄팔찌</option>
				<option value='9' class='mall3'>뱅글팔찌</option>
				<option value='10' class='mall4'>심플반지</option>
				<option value='11' class='mall4'>큐빅반지</option>
				<option value='12' class='mall5'>팔찌/반지 세트</option>");
		break;
	case 8:
		echo ("<option value='1' class='mall1'>진주목걸이</option>
				<option value='2' class='mall1'>두줄목걸이</option>
				<option value='3'  class='mall1'>심플목걸이</option>
				<option value='4' class='mall2'>진주귀걸이</option>
				<option value='5' class='mall2'>큐빅귀걸이</option>
				<option value='6' class='mall2'>링귀걸이</option>
				<option value='7' class='mall3'>한줄팔찌</option>
				<option value='8'  selected class='mall3'>두줄팔찌</option>
				<option value='9' class='mall3'>뱅글팔찌</option>
				<option value='10' class='mall4'>심플반지</option>
				<option value='11' class='mall4'>큐빅반지</option>
				<option value='12' class='mall5'>팔찌/반지 세트</option>");
		break;
	case 9:
		echo ("<option value='1' class='mall1'>진주목걸이</option>
				<option value='2' class='mall1'>두줄목걸이</option>
				<option value='3'  class='mall1'>심플목걸이</option>
				<option value='4' class='mall2'>진주귀걸이</option>
				<option value='5' class='mall2'>큐빅귀걸이</option>
				<option value='6' class='mall2'>링귀걸이</option>
				<option value='7' class='mall3'>한줄팔찌</option>
				<option value='8' class='mall3'>두줄팔찌</option>
				<option value='9'  selected  class='mall3'>뱅글팔찌</option>
				<option value='10' class='mall4'>심플반지</option>
				<option value='11' class='mall4'>큐빅반지</option>
				<option value='12' class='mall5'>팔찌/반지 세트</option>");
		break;	
	case 10:
		echo ("<option value='1' class='mall1'>진주목걸이</option>
				<option value='2' class='mall1'>두줄목걸이</option>
				<option value='3'  class='mall1'>심플목걸이</option>
				<option value='4' class='mall2'>진주귀걸이</option>
				<option value='5' class='mall2'>큐빅귀걸이</option>
				<option value='6' class='mall2'>링귀걸이</option>
				<option value='7' class='mall3'>한줄팔찌</option>
				<option value='8' class='mall3'>두줄팔찌</option>
				<option value='9' class='mall3'>뱅글팔찌</option>
				<option value='10' selected  class='mall4'>심플반지</option>
				<option value='11' class='mall4'>큐빅반지</option>
				<option value='12' class='mall5'>팔찌/반지 세트</option>");
		break;	
	case 11:
		echo ("<option value='1' class='mall1'>진주목걸이</option>
				<option value='2' class='mall1'>두줄목걸이</option>
				<option value='3'  class='mall1'>심플목걸이</option>
				<option value='4' class='mall2'>진주귀걸이</option>
				<option value='5' class='mall2'>큐빅귀걸이</option>
				<option value='6' class='mall2'>링귀걸이</option>
				<option value='7' class='mall3'>한줄팔찌</option>
				<option value='8' class='mall3'>두줄팔찌</option>
				<option value='9' class='mall3'>뱅글팔찌</option>
				<option value='10' class='mall4'>심플반지</option>
				<option value='11' selected  class='mall4'>큐빅반지</option>
				<option value='12' class='mall5'>팔찌/반지 세트</option>");
		break;
	case 12:
		echo ("<option value='1' class='mall1'>진주목걸이</option>
				<option value='2' class='mall1'>두줄목걸이</option>
				<option value='3'  class='mall1'>심플목걸이</option>
				<option value='4' class='mall2'>진주귀걸이</option>
				<option value='5' class='mall2'>큐빅귀걸이</option>
				<option value='6' class='mall2'>링귀걸이</option>
				<option value='7' class='mall3'>한줄팔찌</option>
				<option value='8' class='mall3'>두줄팔찌</option>
				<option value='9' class='mall3'>뱅글팔찌</option>
				<option value='10' class='mall4'>심플반지</option>
				<option value='11' class='mall4'>큐빅반지</option>
				<option value='12'  selected   class='mall5'>팔찌/반지 세트</option>");
		break;				
}
	
	
	echo("
	
	</select></td></tr>");



echo ("
	<tr><td align=center>상품이름</td><td><input type=text name=name size=70 value='$name'></td></tr>
	<tr><td align=center>상품설명사진</td><td><input type=file size=30 name=fileexplain><-- $fileexplain</td></tr>
	<tr><td align=center>상품설명</td><td><textarea name=content rows=15 cols=75>$content</textarea></td></tr>
	<tr><td align=center>정상가격</td><td><input type=text name=price1 size=15 value=$price1>원</td></tr>
	<tr><td align=center>할인가격</td><td><input type=text name=price2 size=15 value=$price2>원</td></tr>
	<tr><td align=center>상품사진</td><td><input type=file size=30 name=userfile><-- $userfile</td></tr>
	<tr><td align=center colspan=2><input type=submit value=수정완료></tr>
	</form>
	</table>");

mysql_close($con);

?>

  <script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
<script>
var malls = false;

function update_selected() {
  $("#mallSelect").val(0);
  $("#mallSelect").find("option[value!=0]").detach();

  $("#mallSelect").append(malls.filter(".mall" + $(this).val()));
}

$(function() {
  malls = $("#mallSelect").find("option[value!=0]");
  malls.detach();

  $("#productSelect").change(update_selected);
  $("#productSelect").trigger("change");
});
</script>
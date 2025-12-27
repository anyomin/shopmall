<style>
#my{
	border-radius:10px;
	background-color:#C3BEBC;
	color:white;
	width:120px;
	height:50px;
	border:0;
}
#my:hover{
	border-radius:10px;
	background-color:white;
	color:#C3BEBC;
	width:120px;
	height:50px;
	border:1px solid #C3BEBC;
	
}
</style>

<? include ("top.html"); ?>
<table border=0 width=650 align=center style='margin-top:200px;border-bottom:2px solid #C3BEBC;'>
<tr><td colspan=2 align=center><h1>신규 상품등록</h1></td></tr></table>
<table border=0 width=650 align=center style='margin-top:20px; border-collapse: collapse;'>
<form method=post action=p-process.php enctype='multipart/form-data'>
<tr>
<td width=100 align=right>상품분류</td>
<td width=550>
	<select id="productSelect" selected="selected" name=class>
	<option value='0'>대분류 선택</option>
	<option value='1'>목걸이</option>
	<option value='2'>귀걸이</option>
	<option value='3'>팔찌</option>
	<option value='4'>반지</option>
	<option value='5'>세트</option>
	</select>
	
		<select id="mallSelect" name=class2>
		<option value='0'>소분류 선택</option>
	<option value='1' class='mall1'>진주목걸이</option>
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
	
	<option value='12' class='mall5'> 세트</option>
	
	</select>
	
</td>
</tr>
<tr>
<td align=right>상품코드</td>
<td><input type=text name=code size=20></td>
</tr>
<tr>
<td align=right>상품이름</td>
<td><input type=text name=name size=70></td>
</tr>
<td align=right>상품설명사진</td>
<td><input type=file size=30 name=fileexplain></td>
</tr>
<tr>
<td align=right>상품설명</td>
<td><textarea name=content rows=15 cols=75></textarea></td>
</tr>
<tr>
<td align=right>정상가격</td>
<td><input type=text name=price1 size=15>원</td>
</tr>
<tr>
<td align=right>할인가격</td>
<td><input type=text name=price2 size=15>원</td>
</tr>
<tr height=50>
<td align=right>상품사진</td>
<td><input type=file size=30 name=userfile></td>
</tr>
<tr  height=70 style='border-top:2px solid #C3BEBC;'>
<td align=center colspan=5 >
<input id='my' type=submit value=등록하기></td>
</tr>
</form>
</table>

<? include ('bottom.html');?>

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
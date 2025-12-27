<style>
/* component */

.star-rating {
  border:solid 1px #ccc;
  display:flex;
  flex-direction: row-reverse;
  font-size:1.5em;
  justify-content:space-around;
  padding:0 .2em;
  text-align:center;
  width:5em;
}

.star-rating input {
  display:none;
}

.star-rating label {
  color:#ccc;
  cursor:pointer;
}

.star-rating :checked ~ label {
  color:#f90;
}

.star-rating label:hover,
.star-rating label:hover ~ label {
  color:#fc0;
}
</style>
<html>
    <script src="//cdn.ckeditor.com/4.5.6/standard/ckeditor.js"></script>
	<style>

</style>
<?

include ("top.html");
$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

$result=mysql_query("select *   from testboard where id=$id",$con);

// 수정하고자 하는 원본 게시물에서 수정 가능한 항목을 추출함
$writer=mysql_result($result,0,"writer");
$topic=mysql_result($result,0,"topic");
$content=mysql_result($result,0,"content");
$code=mysql_result($result,0,"code");
$filename=mysql_result($result,0,"filename");

if($UserID != $writer){
	echo ("<script>
		window.alert('본인만 접근 가능합니다')
		history.go(-2)
		</script>");
    exit;
} 
echo("
	<form method=post action='reviewprocess.php?board=testboard&id=$id&code=$code' enctype='multipart/form-data'>
	<center><table width=700 border=0 1align=center style='margin-top:180px;'> 
	<tr>
	<td width=100 align=right>아이디 </td>
	<td width=600><b>$UserID</b></td>
	</tr>

	<tr>
	<td align=right>제목 </td>
	<td><input  type=text name=topic size=60 value='$topic'></td>
	</tr>");
		if( $filename):
			echo("<tr><td  align=right>후기사진</td><td  align=left colspan=3><font size=2></font><a href=./reviewphoto/$filename style='text-decoration:none;'>$filename</a></td></tr>
			<tr><td></td><td ><input type=file name='userfile' size=45 maxlength=80></td></tr>");
	
		else:
			echo("<tr>
			<td align=right nowrap><font size=2><b>후기사진&nbsp;</b></font></td>
			<td><input type=file name='userfile' size=45 maxlength=80></td>
			</tr>
			");
		endif;
	
	echo("
	<tr><td align=right>내용 </td>
	<td><textarea id='editor1' name='content' rows=12 cols=60>$content</textarea>
	<script>
	CKEDITOR.replace('editor1');
	</script></td>
	</tr>
	<td align=right>별점</td>
	<td><div class='star-rating' >
  <input type='radio' id='5-stars' name='rating' value='5' />
  <label for='5-stars' class='star'>&#9733;</label>
  <input type='radio' id='4-stars' name='rating' value='4' />
  <label for='4-stars' class='star'>&#9733;</label>
  <input type='radio' id='3-stars' name='rating' value='3' />
  <label for='3-stars' class='star'>&#9733;</label>
  <input type='radio' id='2-stars' name='rating' value='2' />
  <label for='2-stars' class='star'>&#9733;</label>
  <input type='radio' id='1-star' name='rating' value='1' />
  <label for='1-star' class='star'>&#9733;</label>
	</div></td>
	<tr>
	<td align=right>암호 </td>
	<td><input type=password name='passwd' size=15></td>
	</tr>
	<tr>
	<td align=center colspan=2>
	<input type=submit value=수정완료>
	</td>
	</tr>
	</table>
	</form>
");
mysql_close($con);
include ("bottom.html");
?>

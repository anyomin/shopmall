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

<script src="//cdn.ckeditor.com/4.5.6/standard/ckeditor.js"></script>
<?
include "top.html";

echo ("<center><h1 style='margin-top:180px;'>리뷰</h1></center>
	<form method=post action='r-process.php?pcode=$pcode&ordernum=$ordernum' enctype='multipart/form-data'>
	<center><table style='margin-top:10px;' width=750 border=0>
	<tr>
	<td width=100 align=right>아이디 </td>
	<td width=600><b>$UserID</b></td>
	</tr>
	



	<tr>
	<td align=right>제목 </td>
	<td><input type=text name=topic size=60></td>
	</tr>
	
	<tr>
	<td align=right nowrap><font size=2><b>사진&nbsp;</b></font></td>
    <td><input type=file name='userfile' size=45 maxlength=80></td>
	</tr>
	<tr>
	<td align=right>내용 </td>
	<td><textarea id='editor1' name=content rows=12 cols=60></textarea>
	<script>
		CKEDITOR.replace('editor1');
	</script>
	</td>
	
	</tr><tr>
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
	<td><input type=password name=passwd size=15></td>
	</tr>
	<tr>
	<td align=center colspan=2>
	<input type=submit value=리뷰쓰기>
	<input type=reset value=지우기></td>
	</tr>
	</table>
	</form>
");
?>

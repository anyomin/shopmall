 <?include "top.html"; ?>
 <table align=center border=0 width=400 style='position:absolute;top:300px;left:600px; '>
<tr><td><center><font size=3><b>사용자 ID 찾기</b></center></td></tr></table>
<table align=center border=0 width=400 style='position:absolute;top:350px;left:600px; '>
<form method=post action=findid.php onsubmit="if(!this.uname.value ||   !this.mphone.value) return false;">
<tr><td align=right><font size=2>이름(실명)</td>
<td align=left><input type=text   size=20 name=uname></td></tr>
<tr><td align=right><font size=2>전화번호</td>
<td align=left><input type=text   size=40 name=mphone></td></tr>
<tr><td align=center colspan=2><input type=submit value='아이디 확인'></tr>
</form>
</table>
<br><br>
<table align=center border=0 width=400 style='position:absolute;top:500px;left:600px; '>
<tr><td><center><font size=3><b>사용자 비밀번호 찾기</b></center></td></tr></table>
<table align=center border=0 width=400 style='position:absolute;top:550px;left:600px;'>
<form method=post action=findpw.php onsubmit="if(!this.uid.value ||   !this.uname.value || !this.mphone.value) return false;">
<tr><td align=right><font size=2>사용자ID</td>
<td align=left><input type=text size=20 name=uid></td></tr>
<tr><td align=right><font size=2>이름(실명)</td>
<td align=left><input type=text size=20 name=uname></td></tr>
<tr><td   align=right><font style='font-size:10pt; font-family:Tahoma;'>전화번호</td>
<td align=left><input type=text size=40 name=mphone></td></tr>
<tr><td align=center colspan=2><input type=submit value='비밀번호 확인'></tr>
</form>
</table>

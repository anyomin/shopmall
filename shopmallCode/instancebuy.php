<style>
table,td{
	 border-collapse: collapse;
}
.t{border-bottom:2px solid gray;
	
}
.tp{border-bottom:1px solid lightgray;
	
}
.tpp{border-bottom:1px solid gray;
	
}
a{
	text-decoration:none;
	
}
#buy:hover{
	border-radius:10px;
	background-color:#C3BEBC;
	color:white;
	width:120px;
	height:50px;
	border:0;
}
#buy{
	border-radius:10px;
	background-color:white;
	color:black;
	width:120px;
	height:50px;
	border:1px solid #C3BEBC;
	
}
</style>
<script language='Javascript'>
	function go_zip(){
		window.open('zipcode2.php', 'zipcode',   'width=470, height=180, scrollbars=yes');
	}
</script>



<?

include "top.html";
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

// 상품코드를 불러와서 상품테이블의 해당 상품을 찾는다 
$result = mysql_query("select * from product where code='$code'", $con);

if (!$UserID){
	echo ("
		<table  width=800 border=0 align=center style=' margin-top:180px;'>
	<tr><td align=center  colspan=6><font size=6.5><b>주문상품</b></td></tr>
	<tr><td align=right colspan=6><font size=2><b> 비회원 </b>님의 현재 쇼핑 카트 내용</td>
		<table border=0 width=750 align=center  style='margin-top:10px; border-top:2px solid gray;' >
		<tr class='tpp'><td width=100 align=center><font size=2>상품사진</td>
		<td width=300 align=center><font size=2>상품이름</td>
		<td width=90 align=center><font size=2>가격(단가)</td>
		<td width=50 align=center><font ssize=2>수량</td>
		<td width=100 align=center><font size=2>품목별합계</td></tr>
		");

	

		
		
			$pcode = mysql_result($result, 0,"code");
			$quantity = 1;
			$userfile = mysql_result($result, 0, "userfile");
			$pname = mysql_result($result, 0, "name");
			$price = mysql_result($result, 0, "price2");
       
	
	  
			echo("<tr class='tp'><td align=center><a href=#   onclick=\"window.open('./photo/$userfile', '_new', 'width=450, height=450')\"><img src='./photo/$userfile' width=50 style='border:1px solid lightgray;margin:5px;'></a></td>
			<td align=left><font size=2><a href=p-show.php?code=$pcode>$pname</a></td>
			<td align=right><font size=2>$price&nbsp;원</td>
			<td align=center><font size=2>$quantity&nbsp;개</td>
			<td align=right><font size=2>$price&nbsp;원</td></tr>");
echo("<tr><td colspan=6 align=left> <font style='font-size:20px; font-weight:bold;color:red; '>최종 결제 금액 :$price&nbsp;원</p></font></td></tr>");
	
		
		
		mysql_close($con);	//데이터베이스 연결해제

	

		echo("
			<br><br>
			 <form method=post action='iendshopping.php?pcode=$pcode' name=buy>
		<table width=690 border=0	align=center style='margin-top:5px;' >
		<tr class='t'><td colspan=2 align=center><font size=3><b>배송정보 입력</b></td></tr>
	

	
	
	
	<tr><td align=right><font size=2>받는이</td>
	<td><input type=text name=receiver size=10 style='margin-bottom:5px;margin-top:10px;'></td>
	</tr>
	<tr>
	<td align=right><font size=2>전화번호</td>
	<td><input type=text name=phone   size=20></td>
	</tr>
	<tr><td height=30 align=right><font size=2>배송주소</td>
	<td align=left><input type=text size=6 name=zip readonly=readonly  style='margin-bottom:5px;'>
	<font size=2>[<a href='javascript:go_zip()'>우편번호검색</a>]<br>
	<input type=text size=65 name=addr1 readonly=readonly style='font-size:10pt; font-family:Tahoma;margin-bottom:5px;'>
	<input type=text size=30 name=addr2   style='font-size:10pt; font-family:Tahoma;margin-bottom:5px;'></td>
	<tr class='t'><td align=right width=100><font size=2>주문요구사항</td>
	<td><textarea name=message rows=3 cols=65 style='margin-bottom:5px;'></textarea></td></tr>
	<tr><td style='margin-bottom:50px;' align=center colspan=2>
	<input  id='buy' type=submit value=구매완료 style='margin-top:30px;'></td></tr>
	</table>
	</form>
	</center>
");
	echo ("<br>
		<table width=780 border=0	align=center  style='margin-top:20px;'>
        <tr><td align=center><font size=2>입금 계좌: <b>하나은행 595-910154-33707 (예금주: 홍길동)</b><br><br>
		* 구입하신 물품은 입금 확인후 배송되며, 주문 진행 상황은 My Page에서 확인하실 수 있습니다.<br>
		* 물품 배송 이전에 주문 취소를 원하시면 My Page에서 직접 주문 취소 요청을 하시면 됩니다.<br>
		* 물품을 배송 받으신 후에 구매 취소를 원하시면 고객센터(전화:070-8236-4423)로 연락주세요.
       </td></tr>
       </table>");
}		


else{	
	$presult=mysql_query("select * from member where uid='$UserID'",$con);
	$point=mysql_result($presult,0,"point");
	
echo ("
<table width=800 border=0 align=center style=' margin-top:180px;'>
	<tr><td align=center  colspan=6><font size=6.5><b>주문상품</b></td></tr>
	<tr><td align=right colspan=6><font size=2><b> $UserName </b>님의 현재 쇼핑 카트 내용</td>
	<table border=0 width=750 align=center  style='margin-top:10px;border-top:2px solid gray;' >
    <tr class='tpp'><td width=100 align=center><font size=2>상품사진</td>
	<td width=300 align=center><font size=2>상품이름</td>
	<td width=90 align=center><font size=2>가격(단가)</td>
	<td width=50 align=center><font ssize=2>수량</td>
	<td width=100 align=center><font size=2>품목별합계</td></tr>
	");

$result = mysql_query("select * from product where code='$code'", $con);
		
		$pcode = mysql_result($result, 0,"code");
			$quantity = 1;
			$userfile = mysql_result($result, 0, "userfile");
			$pname = mysql_result($result, 0, "name");
			$price = mysql_result($result, 0, "price2");
      
	  
		echo("<tr><td align=center><a href=#   onclick=\"window.open('./photo/$userfile', '_new', 'width=450, height=450')\"><img src='./photo/$userfile' width=50 style='border:1px solid lightgray;margin:5px;'></a></td>
			<td align=left><font size=2><a href=p-show.php?code=$pcode>$pname</a></td>
			<td align=right><font size=2>$price&nbsp;원</td>
			<td align=center><font size=2>$quantity&nbsp;개</td>
			<td align=right><font size=2>$price&nbsp;원</td></tr>");

	
    echo("
	<colgroup>
    <col width='90px'/>
    <col width='*'  />
  </colgroup>
  <tbody>
    <tr class='tpp'>
      <td>결제금액</td>
      <td colspan=4><span class='bold txt_blue'>$price<a>원</a></span></td>
    </tr>
    <tr class='tp'>
      <td>포인트 </td>
      <td colspan=4>
        <p>사용가능 포인트 : <span name='left_pnt'>$point</span>p <span><input  type='checkbox' id='chk_use' onclick='chkPoint($price,$point,1000,100)'>포인트 사용</span></p>
        <span style='float:left'><font size=2>포인트는 최소 1000p부터 100p단위로 사용 가능합니다.</font></span>
      </td>
    </tr>
    <tr class='t'>
      <td></td>
      <td colspan=4>
	  <form method=post action='iendshopping.php?pcode=$code' name=buy>
        <span> <input type='number' name='use_pnt' id='use_pnt' min='0' max='$price' onchange='changePoint($price,$point,1000,100)'></span> p 
        <span> ( 남은포인트 : </span><span name='left_pnt' id='left_pnt'>$point</span>p )
      </td>
    </tr>
    <tr>
      <td></td>
      <td colspan=4>
      	<font style='font-size:20px; font-weight:bold;color:red; '><p class='bold txt_red'> 최종 결제 금액 : <span class='bold txt_red' id='result_pnt'><b>$price</b></span> 원</p></font>
      </td>
    </tr>
  </tbody>
</table>");


mysql_close($con);	//데이터베이스 연결해제


echo("
    <br><br>
	<table width=780 border=0	align=center  style='margin-top:20px;'>
	<tr  class='t'><td colspan=2 align=center><font size=3><b>배송정보 입력</b></td></tr>
	

	
	
	<tr><td align=right><font size=2>받는이</td>
	<td><input type=text name=receiver size=10 style='margin-bottom:5px;margin-top:10px;'></td>
	</tr>
	<tr>
	<td align=right><font size=2>전화번호</td>
	<td><input type=text name=phone   size=20></td>
	</tr>
	<tr><td height=30 align=right><font size=2>배송주소</td>
	<td align=left><input type=text size=6 name=zip readonly=readonly style='margin-bottom:5px;'>
	<font size=2>[<a href='javascript:go_zip()'>우편번호검색</a>]<br>
	<input type=text size=65 name=addr1 readonly=readonly style='font-size:10pt; font-family:Tahoma;margin-bottom:5px;'>
	<input type=text size=30 name=addr2   style='font-size:10pt; font-family:Tahoma;margin-bottom:5px;'></td>
	<tr class='t'><td align=right><font size=2>주문요구사항</td>
	<td><textarea name=message rows=3 cols=65 style='margin-bottom:5px;'></textarea></td></tr>
	<tr><td style='margin-bottom:50px;' align=center colspan=2>
	<input    id='buy' type=submit value=구매완료 style='margin-top:30px;'></td></tr>
	</table>
	</form>
	</center>
");
echo ("<br>
		<table border=0 width=690 align=center style='margin-top:5px;'>
        <tr><td align=center><font size=2>입금 계좌: <b>하나은행 595-910154-33707 (예금주: 홍길동)</b><br><br>
		* 구입하신 물품은 입금 확인후 배송되며, 주문 진행 상황은 My Page에서 확인하실 수 있습니다.<br>
		* 물품 배송 이전에 주문 취소를 원하시면 My Page에서 직접 주문 취소 요청을 하시면 됩니다.<br>
		* 물품을 배송 받으신 후에 구매 취소를 원하시면 고객센터(전화:070-8236-4423)로 연락주세요.
       </td></tr>
       </table>");

}
include ("bottom.html");
?>

<script>
	function chkPoint(amt,pnt,min,unit) {
		//input값을 전체 마일리지로 설정 > minusPoint 
		//amt : 최초 결제 금액 / pnt : 사용가능,남은 포인트 / min : 사용 가능 최소 포인트 / unit : 사용단위
		var v_point = 0; //사용할 포인트 (input 입력값)
	
		if (document.getElementById("chk_use").checked)  
		{
			if (pnt < min)  //최소 사용 단위보다 작을 때
			{
				v_point = 0; 
			}else {
				v_point = pnt - pnt%unit; //사용할 포인트 = 전체 마일리지 중 최소단위 이하 마일리지를 뺀 포인트
			}

			if(pnt > amt ){ //결제금액보다 포인트가 더 클 때
				v_point = amt; //사용할 포인트는 결제금액과 동일하게 설정
			}
			
		}
		document.getElementById("use_pnt").value = v_point; //input 값 설정

		changePoint(amt,pnt,min,unit);
	}
	
	function changePoint(amt,pnt,min,unit){
		//input값을 불러옴 > left_pnt 변경 > 최종결제 변경
		//amt : 최초 결제 금액 / pnt : 사용가능,남은 포인트 / min : 사용 가능 최소 포인트 / unit : 사용단위
		var v_point = parseInt(document.getElementById("use_pnt").value); //사용할 포인트 (input 입력값)
		if (v_point > pnt) //입력값이 사용가능 포인트보다 클때
		{
			v_point = pnt;
			document.getElementById("use_pnt").value = v_point; //input 값 재설정
		}

		if(v_point > amt ){ //결제금액보다 포인트가 더 클 때
			v_point = amt; //사용할 포인트는 결제금액과 동일하게 설정
			document.getElementById("use_pnt").value = v_point; //input 값 재설정
		}

		if (v_point < min)  //최소 사용 단위보다 작을 때
		{
			v_point = 0; 
			document.getElementById("use_pnt").value = v_point; //input 값 재설정
		}else {
			v_point = v_point - v_point%unit; //사용할 포인트 = 사용할 마일리지 중 최소단위 이하 마일리지를 뺀 포인트
		}

		var v_left = document.getElementsByName("left_pnt"); //사용가능 마일리지, 남은 포인트 값 설정
		for (var i = 0; i < v_left.length; i++) {

			v_left[i].innerHTML = pnt - v_point; //= 전체 포인트 중에 사용할 포인트빼고 남은 포인트

		}
		document.getElementById("result_pnt").innerHTML = amt - v_point; //최종 결제금액 = 결제금액 - 사용할 포인트
	}
 </script> 
<style>
a{
	text-decoration:none;
	
}
.click
{
	background-color:#DDB9AE;
	border:0;
	height:40px;
	width:90px;

}
.click:hover
{
	background-color:#DBADA1;
	border:0;
	height:40px;
	width:90px;	
	transition:0.3s;
}
.click2
{
	background-color:white;
	border:1px solid #DDB9AE;
	height:40px;
	width:90px;

}
.click2:hover
{
	background-color:white;
	border:1px solid #916D62;
	height:40px;
	width:90px;	
	transition:0.3s;
	
}
.dclick
{
		background-color:white;
	border:1px solid lightgray;
	height:40px;
	width:90px;
	

}

.dclick:hover
{
	background-color:white;
	border:2px solid lightgray;
	height:40px;
	width:90px;	
	font-weight:bold;
	
}
table,td{
	 border-collapse: collapse;
}
.t{border-bottom:2px solid lightgray;
	
}
.tt{border-bottom:2px solid black;
border-top:1px solid black;
}
input[type=checkbox] {

transform : scale(1.2);

}
#bb{
	background-color:white;
	border:1px solid gray;
	border-radius:3px;
}
#bb:hover{
	background-color:lightgray;
	border:1px solid gray;
	border-radius:3px;
}	

</style>

<? include "top.html"; ?>
<?if (!$UserID) {?> 
	<table width=800 border=0 align=center style=' margin-top:180px; '>
	<tr><td align=center colspan=6><font size=6.5><b>쇼핑 카트</b></td></tr>
	<tr><td align=right colspan=6><font size=2><b>비회원</b>님의 현재 쇼핑 카트 내용</td>
	

 <?} else {?> 
	<table width=800 border=0  align=center style=' margin-top:180px;'>
	<tr><td align=center  colspan=6><font size=6.5><b>쇼핑 카트</b></td></tr>
	<tr><td align=right colspan=6><font size=2><b><? echo $UserName; ?></b>님의 현재 쇼핑 카트 내용</td>
	
 <?}?>
	

<?
$con =   mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

// 전체 쇼핑백 테이블에서 특정 사용자의 구매 정보만을 읽어낸다
$result = mysql_query("select * from shoppingbag where session='$Session'", $con);
$total = mysql_num_rows($result);

echo ("
	
    <tr  class='tt'><td  width=50 align=center><input type='checkbox' name='all' class='check-all'  style='zoom:1.6;'></td><td width=200  align=center > <font size=3>상품사진</td>
	<td width=300 align=center><font size=3>상품이름</td>
	<td width=90 align=center><font size=3>가격(단가)</td>
	<td width=60 align=center><font size=3>수량</td>
	<td width=100 align=center><font size=3>품목별합계</td>
	<td width=50 align=center><font size=3>삭제</td></tr>
");

if (!$total) {
     echo("<tr ><td colspan=6  height=100 align=center ><font size=2 style='color:red;'>쇼핑백에 담긴 상품이 없습니다.</td></tr></table>");
} else {

    $counter=0;
    $totalprice=0;    // 총 구매 금액  

    while ($counter < $total) :
       $pcode = mysql_result($result, $counter, "pcode");
       $quantity = mysql_result($result, $counter, "quantity");
   
       $subresult = mysql_query("select * from product where code='$pcode'", $con);
       $userfile = mysql_result($subresult, 0, "userfile");
       $pname = mysql_result($subresult, 0, "name");

       $price = mysql_result($subresult, 0, "price2");
       
       $subtotalprice = $quantity * $price;
       $totalprice = $totalprice + $subtotalprice; 

		echo ("<tr  class='t'><td width=30 align=center><input type=checkbox name='check1' class='ab'style='zoom:1.3;'></td>
			<td align=center>
			<a href=# onclick=\"window.open('./photo/$userfile', '_new', 'width=450,   height=450')\"><img src='./photo/$userfile' width=120 height=120   border=0 style='margin:5px;'></a></td>
			<td align=left><font size=2><a   href=p-show.php?code=$pcode>$pname </a></td>
			<td align=right><font size=2>$price&nbsp;원</td>
			<td align=center>
			<form method=post action='qmodify.php?pcode=$pcode'><input type=text name=newnum size=3 value='$quantity'>&nbsp;<input type=submit value=변경 id='bb' style='color:gray;'></input>
			</td></form>
			<td align=right><font size=2>$subtotalprice&nbsp;원</td>
			
			<td align=center>
			<form method=post action=itemdelete.php?pcode=$pcode><input type=submit value=삭제  id='bb' style='color:gray;'></td></form>
			</tr>");

		$counter++;
    endwhile;
	
 	if(!$UserID){
     echo("<tr class='tt'><td align=left colspan=2>총 장바구니 상품 갯수 : $total</td><td colspan=5 align=right><font style='font-size:20px;'>총 구매 금액: <b>$totalprice</b> 원</td></tr>
	</table>");}
	
	else{
		 echo("<tr class='tt'><td align=left colspan=2>총 장바구니 상품 갯수 : $total</td>
		
		 <td colspan=5 align=right><font style='font-size:20px;'>총 구매 금액: <b>$totalprice</b> 원</td></tr>
	</table>");
	}
	 
	 echo("
	 <table align=center width=800 style=' margin-top:10px; '>
	 <tr><td colspan=6 align=left><button class='dclick' ><font size=2><a href=alldelete.php style='color:gray; ' >모두삭제</a></button></td></tr>
	 <tr><td colspan=6><font style='font-size:12px; color:gray;'>
	 
	-결제 시 각종 할인 적용이 달라질 수 있습니다.<br>
	-장바구니 상품은 최대 1년 보관(비회원 2일)되며 담은 시점과 현재의 판매 가격이 달라질 수 있습니다.<br>
	-장바구니에는 최대 100개의 상품을 보관할 수 있으며, 주문당 한번에 주문 가능한 상품수는 100개로 제한됩니다.</font></tr></td>

	<tr><td align=center colspan=6><button class='click'><font size=2><a href=buy.php style='color:white;' >구매결정</a></button> &nbsp;
												<button  class='click2'><a href=p-list.php style='color:#916D62;'>쇼핑계속</a></font></button></td></tr></table>");

}

mysql_close($con);	//데이터베이스 연결해제

include ("bottom.html");
?>
<script>
$( document ).ready( function() {
  $( '.check-all' ).click( function() {
    $( '.ab' ).prop( 'checked', this.checked );
  });
});
</script>

<style>
#bag{
	border-radius:5px;
	background-color:#4A413E;
	color:white;
	width:170px;
	height:60px;
	border:0;
}
#bag:hover{
	border-radius:5px;
	background-color:#2C2422;
	color:white;
	width:170px;
	height:60px;
	border:0;
	font-weight:bold;
}
#bag2{
	border-radius:5px;
	background-color:white;
	color:#8D685E;
	width:170px;
	height:60px;
	border:1px solid #4A413E;
}
#bag2:hover{
	border-radius:5px;
	background-color:white;
	color:#8D685E;
	font-weight:bold;
	width:170px;
	height:60px;
	border:2px solid #8D685E;
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
a{
	text-decoration:none;
	color:black;
}
table,td{
	 border-collapse: collapse;
}
.t{border-bottom:1px solid lightgray;
	
}
.tt{border-bottom:1px solid black;
}	
.aa{
	color:gray;
}
.aa:hover{
	font-weight:bold;
	color:black;
}
.ttt{
	border-bottom:2px solid #8F6C6A;
}
</style>

<? include ("top.html"); ?>
<?

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

$result = mysql_query("select * from product where code='$code'", $con);
$total = mysql_num_rows($result);

$sresult=mysql_query("select * from testboard where code='$code'",$con);
$t=mysql_num_rows($sresult);

$name=mysql_result($result,0,"name");
$content=mysql_result($result,0,"content");
$content=nl2br($content);

$price1=mysql_result($result,0,"price1");
	switch(strlen($price1)) {
		  case 6: 
			 $price1 = substr($price1, 0, 3) . "," . substr($price1, 3, 3);
			 break;
		  case 5:
			 $price1 = substr($price1, 0, 2) . "," . substr($price1, 2, 3);
			 break;
		  case 4:
			 $price1 = substr($price1, 0, 1) . "," . substr($price1, 1, 3);
			 break;		   
		}
$price2=mysql_result($result,0,"price2");
	switch(strlen($price2)) {
		  case 6: 
			 $price2 = substr($price2, 0, 3) . "," . substr($price2, 3, 3);
			 break;
		  case 5:
			 $price2 = substr($price2, 0, 2) . "," . substr($price2, 2, 3);
			 break;
		  case 4:
			 $price2 = substr($price2, 0, 1) . "," . substr($price2, 1, 3);
			 break;		   
		}
$userfile=mysql_result($result,0,"userfile");
$fileexplain=mysql_result($result,0,"fileexplain");

// 상품의 조회수를 읽어와서 1 증가시킨 다음 업데이트 쿼리를 적용
$hit=mysql_result($result,0,"hit");
$hit++;
mysql_query("update product set hit=$hit where code='$code'", $con);

echo ("<table border=0 width=900 align=center style='margin-top:200px;'><tr><td>
<a href='p-list.php'>[리스트]</a>
	<table width=900 border=0 >
    <tr><td width=750 align=center>
	<a href=# onclick=\"window.open('./photo/$userfile', '_new', 'width=450, height=450')\"><img src='./photo/$userfile' width=300 style='height:280px;color:black;margin-right:30px;'  border=1 ></a></td>
    <td width=750 valign=top>
    <table border=0 width=100%>
	  <tr><td width=150><font style='font-size:20px;'>$name</td></tr>
	  <tr><td colspan=2><hr size=1 width=600></hr></td></tr>
	  <tr><td >상품가격: </td>
	  <td><strike>$price1&nbsp;원</strike></td></tr>
	  <tr><td>할인가격: </td>
	  <td><b>$price2&nbsp;원</b></td></tr>
    	  <tr><td colspan=2 height=120 valign=bottom align=left>
	     <form method=post action=tobag.php?code=$code>
	     <input type=text size=5 name=quantity value=1 style='margin-top:20px;'>&nbsp;
		 <div style='display: flex;margin-top:20px;'>
			<div style='margin:5px;'>
			<input type=submit id='bag' value='장바구니 담기'></input></div></form>
		 
			<form method=post action=instancebuy.php?code=$code>
			<div style='margin:5px;'>
			<input type=submit id='bag2' value='바로 구매하기'></input></div></form>
			
			
			
		</div>
	     </td></tr>
	</table>
	</td>
	</tr>
	</table>	
	<br>
	</table>
	");
	if($smode==1 or !$smode){
	echo("<table width=80% border=0 align=center style='margin-top:10px;border-top:1px solid lightgray;'>
		<tr height=50><td align=center width=33% style='border-bottom:4px solid #DAAE80;'><a href='p-show.php?smode=1&code=$code' style='color:#DAAE80'><b>[상품 상세 설명]</b></a></td><td align=center width=33%><a href='p-show.php?smode=2&code=$code'>상품 후기&nbsp;($t)</a></td><td align=center width=33%><a href='p-show.php?smode=3&code=$code'>배송 및 교환</a></td></tr>");
		
		    
		echo("<table width=80% border=0 align=center style='margin-top:35px;'><tr><td colspan=3 align=center><img src='./photo/$fileexplain' style='height:100%;' width=80% border=0></td></tr>
		<tr><td colspan=3 align=center>$content</td></tr>
		</table>
		
		<table border=0 width=90% align=center style='margin-top:150px;border-bottom:2px solid #8F6C6A'>
		<tr class='ttt' height=50 ><td><font style='font-size:25px; font-weight:bold;color:#8F6C6A;'>BEST ITEM</font></td></tr><tr>
		");
$result2 = mysql_query("select * from product order by hit desc", $con);
	
		  $c=0;
		  while ($c < 5):
		$code1=mysql_result($result2,$c,"code");
		$name1=mysql_result($result2,$c,"name");
		$userfile1=mysql_result($result2,$c,"userfile");
		$price21=mysql_result($result2,$c,"price2");
$reviewnumre=mysql_query("select * from testboard where code='$code'",$con);
		$reviewnum=mysql_num_rows($reviewnumre);
		echo("
		<td width=260><a href=p-show.php?code=$code1>
		<img src='./photo/$userfile1' width=250 height=200 border=0 style='margin:25px;'><br><font color=blue style='text-decoration:none; align:left;color:black; font-size:11pt;'>&nbsp;$name1</font></a>
		<form method=post action=heart.php?code=$code>
	    <span style='line-height:50%'><br><button  value='' style='position:relative;width:20px;cursor:pointer;background-color:white;border:0'>
		<img src='cart.png' style='position:absolute;top:-3px;width:25px;margin-left:0px;filter:invert(66%) sepia(2%) saturate(20%) hue-rotate(320deg) brightness(100%) contrast(86%);'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style='font-size:14px;'>cart</font></button></form></span>
		<hr><font color=black style='font-weight:bold;font-size:18px;' >$price2&nbsp;원&nbsp;</font> <i class='fa-regular fa-comment' style='background-color:white;color:gray;'></i><font style='color:gray;'>리뷰($reviewnum)</font></td>
		</td>
		");
		
		$c++;
		endwhile;
		echo("
		</tr></table>
		</table>");
		}
	if($smode==2){
			echo("<table width=80% border=0 align=center style='margin-top:10px; border-top:1px solid lightgray;'>
			<tr height=50><td align=center width=33% ><a href='p-show.php?smode=1&code=$code' >[상품 상세 설명]</a></td><td align=center width=33% style='border-bottom:4px solid #DAAE80;'><a href='p-show.php?smode=2&code=$code' style='color:#DAAE80'>상품 후기&nbsp;($t)</a></td><td align=center width=33%><a href='p-show.php?smode=3&code=$code'>배송 및 교환</a></td></tr>");
		
			echo("<table width=80% border=0  align=center style='margin-top:35px;''><tr><td colspan=3 align=center> ");

 
		$con = mysql_connect("localhost","root","apmsetup");
		mysql_select_db("shopmall",$con);
		$result = mysql_query("select * from testboard where code='$code' order by id desc", $con);
		$total = mysql_num_rows($result);

		echo("
		<table border=0 width=90%  >
		<tr height=35  class='tt' ><td align=center width=50><b>번호</b></td>
		<td></td>
		<td align=center width=150><b>글쓴이</b></td>
		<td align=center width=400><b>제목</b></td>
		<td align=center width=200><b>날짜</b></td>
		<td align=center width=50><b>조회</b></td>
		<td align=center width=100><b>별점</b></td>
		</tr>
		");

		if (!$total){
			echo("
			<tr><td colspan=5 align=center>아직 등록된 글이 없습니다.</td></tr>
			");
		}
		else {

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
				$star=mysql_result($result, $newcounter, "star");
				$filename = mysql_result($result, $newcounter, "filename");
		
		$t="";

		if   ($space>0) {
			for ($i=0 ; $i<=$space ; $i++)
				$t = $t . "&nbsp;";     // 답변 글의 경우 제목 앞 부분에 공백을 채움
		}
		
			if ($filename):
				echo("
					<tr class='t'><td align=center>$id</td>
							<td align=center width=200><a href=# onclick=\"window.open('./photo/$userfile', '_new', 'width=200, height=200')\"><img src='./photo/$userfile' width=170 style='height:170px;margin:10px;'  border=1 ></a></td>
					<td align=center>$writer</td>
					<td align=left>$t<a  href='reviewcontent.php?board=testboard&id=$id&cblock=$cblock&ccpage=$cpage&pcode=$code' class='aa'>$topic</a>&nbsp;<i style='color:blue' class='fa-solid fa-paperclip'></i></td>
					<td align=center>$wdate</td><td align=center>$hit</td>
					<td align=center><i class='fa-solid fa-star' style='color:#F6D505;'></i>X<a>$star</a></td>
					</tr>
					");
			else:
				echo("
					<tr class='t'><td align=center>$id</td>
					<td align=center width=200><a href=# onclick=\"window.open('./photo/$userfile', '_new', 'width=200, height=200')\"><img src='./photo/$userfile' width=170 style='height:170px;margin:10px;'  border=1 ></a></td>
					<td align=center>$writer</td>
					<td align=left>$t<a href='reviewcontent.php?board=testboard&id=$id&pcode=$code' class='aa'>$topic&nbsp;</a></td>
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
		echo("<a href='p-show.php?board=testboard&cblock=1&cpage=1&code=$code&smode=2'><i class='fas fa-angle-double-left' id='gright'></i></a> ");
	if ($pblock > 0)        // 이전 블록이 존재하면 [이전블록] 버튼을 활성화
		echo ("<a href='p-show.php?board=testboard&cblock=$pblock&cpage=$pstartpage&code=$code&smode=2'><i class='fa-solid fa-chevron-left' id='gright'></i></a> ");

	// 현재 블록에 속한 페이지 번호를 출력	
	$i =   $startpage;
	while($i < $nstartpage):
	   if ($i > $totalpage) break;  // 마지막 페이지를 출력했으면 종료함
	   if ($cpage==$i){
	   echo ("<a href='p-show.php?board=testboard&cblock=$cblock&cpage=$i&code=$code&smode=2'><button style='font-weight:bold;color:balck;background-color:white;font-size:15px;padding:12px;border:none;'>$i</button></a>");
	   $i = $i + 1;}
	   else{
		   echo ("<a href=p-show.php.php?board=testboard&cblock=$cblock&cpage=$i&code=$code&smode=2'><button id='butt'>$i</button></a>");
	   $i = $i + 1;} 
	   
	endwhile;
	 
	// 다음 블록의 시작 페이지가 전체 페이지 수보다 작으면 [다음블록] 버튼 활성화  
	if ($nstartpage <= $totalpage)   
		echo ("<a href=p-show.php?board=testboard&cblock=$nblock&cpage=$nstartpage&code=$code&smode=2'><i class='fa-solid fa-chevron-right' id='gright'></i></a> ");
	if ($totalpage<=$cpage)
		echo("");
	else
		
	echo ("<a href=p-show.php?board=testboard&cpage=$totalpage&cblock=$ff&code=$code&smode=2'><i class='fas fa-angle-double-right' id='gright'></i></a> ");//모르겠다수박

	echo ("</td></tr></table>");
}
	



			
			
			
			
			
			
			
			echo("</td></tr></table></table>");
		}
		if($smode==3){
			echo("<table width=80% border=0  align=center style='margin-top:10px;  border-top:1px solid lightgray;'>
		<tr height=50><td align=center width=33% ><a href='p-show.php?smode=1&code=$code'>[상품 상세 설명]</a></td><td align=center width=33%><a href='p-show.php?smode=2&code=$code'>상품 후기&nbsp;($t)</a></td><td align=center width=33% style='border-bottom:4px solid #DAAE80;'><a href='p-show.php?smode=3&code=$code' style='color:#DAAE80'>배송 및 교환</a></td></tr>");
		
		
			
		echo("<table width=70% border=0  align=center style='margin-top:35px;'>
		<tr ><td colspan=3>배송/교환정보</td></tr>
		<tr><td colspan=3>배송</td></tr>
			
		<tr><td colspan=3>
		<b>[ 배송 안내 ]</b> 
			</td></tr>

	<tr><td colspan=3><br>
	ㅇ 상품은 CJ 대한통운 택배(1588-1255)를 통해 발송 됩니다. (10만원 이상 무료배송, 도서, 산간 추가비용 3,000~10,000)
		</td></tr>

	<tr><td colspan=3> 
	&nbsp;· 당일출고상품 : 오후 2시 이전 결제완료 건에 한하여 다음날 수령 가능합니다. (단, 금, 토, 일, 휴일 주문 건 제외)
		</td></tr>
		
	<tr><td colspan=3>
   &nbsp;· 주문제작상품 : 당일출고상품이 아닌 모든 상품은 제작기간 4~8일정도 소요됩니다.(제작기간에서 휴일은 제외)  
		</td></tr>
		
	<tr><td colspan=3>
   &nbsp;· 재고보유상품 : 주문완료 후 2~3일 이내 수령 가능합니다. (상품보유문의 02-6953-8469) 
		</td></tr>
		
	<tr><td colspan=3>
   &nbsp;· 당일 발송 제품과 주문 제작 제품을 함께 주문 하시는 경우, 주문 제작 제품 제작완료 후 합배송 됩니다. 
		</td></tr>
		
	<tr><td colspan=3>	
		ㅇ 수령인이나 주소지를 잘못 쓰신 경우 배송 사고에 대한 책임은 고객님께 있습니다. 
		</td></tr>
	<tr><td colspan=3>
		ㅇ 간혹 택배사의 상황에 따라 배송이 지연될 수 있습니다. (제주도, 도서, 산간지역) 고객님의 많은 양해 바랍니다.
		</td></tr>
		
	<tr><td colspan=3>
	ㅇ 주문취소 및 변경
	</td></tr>
	
	<tr><td colspan=3>
	&nbsp;· 주문 당일 오후 1시 이전까지 고객센터로 전화 주시면 주문취소 및 내용 변경이 가능합니다. 
	</td></tr>
	
	<tr><td colspan=3>
	&nbsp;· 오후 1시 이후 주문 및 토, 일, 공휴일 주문은 다음날 연락 주시면 주문취소 및 내용 변경이 가능합니다. 
	</td></tr>
	
	<tr><td colspan=3>
	&nbsp;· 그 이후에는 상품이 주문제작에 들어가므로 취소가 불가능합니다. 꼭 고객센터로 전화 주셔야 합니다.
	</td></tr>
	
<tr><td colspan=3>
<br><br>
교환
</td></tr>

<tr><td colspan=3>
<b>[ 교환 및 반품 ]</b>
</td></tr>

<tr><td colspan=3>
<br>
<font style='color:red; font-size:15px;'>▷▶ 쥬얼리는 상품에 따라 교환 및 반품이 가능한 경우가 있으며, 주문제작상품은 교환 및 반품이 되지 않습니다. ◀◁ </font>
</td></tr>

<tr><td colspan=3>
<font style='color:#CB9F74; font-size:15px;font-weight:bold;'> ◇교환 및 반품 시 꼭 지켜주세요  </font>
</td></tr>

<tr><td colspan=3>
   &nbsp;· 반품이나 교환 시는 고객센터를 통해 먼저 신청해 주시고 상품을 반품하여 주시기 바랍니다. 
   </td></tr>
<tr><td colspan=3>
   &nbsp;· 임의로 반품하시는 경우 처리가 지연될 수 있습니다.
   </td></tr>
<tr><td colspan=3>
   &nbsp;· 상품 반품 시에는 상품 발송 시 동봉되었던 구성품들을 훼손 없이 전부 보내주셔야 합니다. 
   </td></tr>
<tr><td colspan=3>
   &nbsp;· 상품, 케이스, 보증서, 쇼핑백, 사은품 등, 누락 / 훼손 시 비용을 부담하셔야 합니다.
   </td></tr>
<tr><td colspan=3>
   &nbsp;· 교환 및 반품은 반품 상품이 도착된 이후 처리해 드립니다. 꼭 CJ 대한통운 택배를 통해 보내주시기 바랍니다. 
   </td></tr>
<tr><td colspan=3>
   &nbsp;· 반품 및 교환 주소 : (우)03136 서울특별시 종로구 창경궁로 135-1 3층 (주)퓨리골드 
   </td></tr>


<tr><td colspan=3>
<font style='color:#CB9F74; font-size:15px;font-weight:bold;'>◇ 교환 및 반품이 가능한 경우</font>
  </td></tr>
  <tr><td colspan=3>
    &nbsp;· 소비자 피해보상 규정에 의해 구입 후 7일 이내에 반품 및 교환이 가능합니다. 
   </td></tr>
<tr><td colspan=3>
      &nbsp; &nbsp; (단, 주문제작상품 제외, 7일 이내라도 제품 착용 및 고객님의 부주의로 훼손된 경우 불가합니다.)
	  </td></tr>
<tr><td colspan=3>
    &nbsp;· 단순변심, 착오로 인한 교환/반품의 경우 배송비는 고객님께서 부담하셔야 합니다. (왕복배송비 8,000원) 
   </td></tr>
<tr><td colspan=3>
   &nbsp; · 상품정보와 다른 상품, 하자가 있는 상품의 경우 모든 배송비는 판매자 부담입니다. 
   </td></tr>
<tr><td colspan=3>
   &nbsp; · 재고보유상품 (주문제작상품이나 당일 발송해 드린 상품)은 반품이나 교환이 가능합니다. (왕복배송비 8,000원)
   </td></tr>
<tr><td colspan=3>
   &nbsp; · 교환이나 반품의 경우는 꼭 CJ 대한통운 택배 착불로 보내주셔야 합니다.
   </td></tr>
<tr><td colspan=3>
   &nbsp; · 일부 도서산간 지역의 경우 지역에 따라 왕복배송비(8,000원)에 추가 배송료(3,000~10,000)가 합산 됩니다. 
</td></tr>   

  
<tr><td colspan=3>
<font style='color:#CB9F74; font-size:15px;font-weight:bold;'>◇ 교환 및 반품이 불가능한 경우</font>
</td></tr>
<tr><td colspan=3>
   &nbsp; · 소비자보호 관련법률 제 21조(청약철회등의 제안)에 의거 주문제작상품은 교환, 반품이 불가합니다. 
   </td></tr>
<tr><td colspan=3>
   &nbsp; · 상품 수령 후 7일을 초과한 경우, 착용한 상품에 손상이 있는 경우, 미착용 했어도 상품을 훼손시킨 경우,  
   </td></tr>
<tr><td colspan=3>
      &nbsp; &nbsp; 반지, 이니셜 상품, 길이 변경, 보석 변경 등 주문 제작된 상품은 반품 및 교환이 불가능합니다.
	  </td></tr>
<tr><td colspan=3>
   &nbsp; · 모니터 사양에 따른 실제 상품과의 색상 차이는 교환, 반품, 환불의 사유가 아닙니다.
</td></tr>   
<tr><td colspan=3>
    &nbsp;· 귀금속 제작 특성상 중량, 사이즈(오차±10%)는 다소 차이가 있을 수 있으며, 이는 상품 불량이 아니며 교환, 반품, 환불의 사유가 되지 않습니다. 
	  </td></tr>
<tr><td colspan=3>
   &nbsp; · 제품 색상, 반지 호수 차이, 사은품 또는 포장 케이스 이미지와의 불일치는 반품, 교환, 환불의 사유가 아닙니다.
   </td></tr>
<tr><td colspan=3>
   &nbsp; · 주문제작이 시작된 시점부터 교환 및 반품이 불가능하며, 사이즈 변경 등은 꼭 고객센터로 전화 주시기 바랍니다.
   </td></tr>

  </td></tr>

 </td></tr></table></table>");
		}
		
		
			 
mysql_close($con);
include ("bottom.html");
?>

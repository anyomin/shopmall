
<style>
#zoom{
	  transform: scale(1);
  -webkit-transform: scale(1);
  -moz-transform: scale(1);
  -ms-transform: scale(1);
  -o-transform: scale(1);
  transition: all 0.3s ease-in-out; 
}
#zoom:hover{
	  transform: scale(1.2);
  -webkit-transform: scale(1.2);
  -moz-transform: scale(1.2);
  -ms-transform: scale(1.2);
  -o-transform: scale(1.2);

}
a{
	text-decoration:none;
}

#rr{
	color:black;

	
}

.img {width:260px; height:200px; overflow:hidden } 
</style>

<?include ("top.html");
echo("<table border=0 align=center style='margin-top:220px;width:70%'>
<tr><td ><font style='font-size:12px;font-weight:bold;'> Home > Promotion > 글로리 크리스마스 이벤트</font></td>
	</tr></table>
<table border=0  style='margin-top:10px;width:100%'>	
<tr><td style='width:100%' align=center  ><img src='event1.gif'  ></td>
	</tr>
	<tr><td style='width:100%' align=center  ><img src='event11.jpg'  ></td>
	</tr>
	");
	$con = mysql_connect("localhost","root","apmsetup");
	mysql_select_db("shopmall",$con);
	$result=mysql_query("select * from product where name like '%글로리%'",$con);

//if (!isset($class)) $class=0;

		switch($mode) {
   case 0:        // 초기화면에 출력할 인기 상품 목록
       $result = mysql_query("select * from product where name like '%글로리%' order by name", $con);
		break;
   case 1:        // 초기화면에 출력할 인기 상품 목록
       $result = mysql_query("select * from product where name like '%글로리%' order by price2", $con);
		break;
	case 2:        // 초기화면에 출력할 인기 상품 목록
       $result = mysql_query("select * from product where name like '%글로리%' order by price2 desc", $con);
		break;
	case 3:        // 초기화면에 출력할 인기 상품 목록
       $result = mysql_query("select * from product where name like '%글로리%' order by hit desc", $con);
		break;
}
$total=mysql_num_rows($result);	


		if (!$total){
				echo ("<td align=center><font color=red>아직 등록된 상품이 없습니다</td></tr></table>");}
 
		else {
			
			echo("	</table>
			<table border=0 align=center width=70% style='margin-top:50px;border-top:1px solid;border-bottom:1px solid;background-color:lightgray; '  id='bi'>
			<tr><td>Total &nbsp;<a>$total</a></td>
			");
			
	
			if($mode==0){
			echo("
			<td align=right><a href='event1.php?mode=0&#bi' id='rr' style='font-weight:bold;' >상품명</a>
			| <a href='event1.php?mode=1&#bi' id='rr'>낮은 가격</a>
		|<a href='event1.php?mode=2&#bi'  id='rr'>높은 가격</a> | <a href='event1.php?mode=3&#bi'  id='rr'>인기순</a></td></tr></table>
		");
			}
			else if($mode==1){
			echo("
			<td align=right><a href='event1.php?mode=0&#bi' id='rr'  >상품명</a>
			| <a href='event1.php?mode=1&#bi' id='rr' style='font-weight:bold;'>낮은 가격</a>
		|<a href='event1.php?mode=2&#bi'  id='rr'>높은 가격</a> | <a href='event1.php?mode=3&#bi'  id='rr'>인기순</a></td></tr></table>
		");
			}
					else if($mode==2){
			echo("
			<td align=right><a href='event1.php?mode=0&#bi' id='rr'  >상품명</a>
			| <a href='event1.php?mode=1&#bi' id='rr' >낮은 가격</a>
		|<a href='event1.php?mode=2&#bi'  id='rr' style='font-weight:bold;'>높은 가격</a> | <a href='event1.php?mode=3&#bi'  id='rr'>인기순</a></td></tr></table>
		");
			}
						else if($mode==3){
			echo("
			<td align=right><a href='event1.php?mode=0&#bi' id='rr'  >상품명</a>
			| <a href='event1.php?mode=1&#bi' id='rr' >낮은 가격</a>
		|<a href='event1.php?mode=2&#bi'  id='rr'>높은 가격</a> | <a href='event1.php?mode=3&#bi'  style='font-weight:bold;'  id='rr'>인기순</a></td></tr></table>
		");
			}
						else{
			echo("
			<td align=right><a href='event1.php?mode=0&#bi' id='rr'  >상품명</a>
			| <a href='event1.php?mode=1&#bi' id='rr' >낮은 가격</a>
		|<a href='event1.php?mode=2&#bi'  id='rr'>높은 가격</a> | <a href='event1.php?mode=3&#bi'  id='rr'>인기순</a></td></tr></table>
		");
			}
		
		
		echo("<table border=0 align=center style='margin-top:50px;'>
	");		
		if   ($cpage=='') $cpage=1;    // $cpage -  현재 페이지 번호
	$pagesize = 4;                // $pagesize - 한 페이지에 출력할 목록 개수

	$totalpage = (int)($total/8);
	if (($total%8)!=0) $totalpage = $totalpage + 1;

	$subcounter=0;

		$counter = 0;
		
		while ($counter < $total && $counter < 15 && $subcounter < $pagesize) :
		$newcounter=($cpage-1)*8+$counter;
		if($newcounter==$total) break;
			if ($newcounter > 0 && ($newcounter % 5) == 0){
			$subcounter = $subcounter + 1;
			if($subcounter>=$pagesize){
				break;
			}
			else{
				
			echo ("	
			<tr><td colspan=5></td></tr><tr height=200>");
			}
		}
		$code=mysql_result($result,$newcounter,"code");
		$name=mysql_result($result,$newcounter,"name");
		$userfile=mysql_result($result,$newcounter,"userfile");
		$price2=mysql_result($result,$newcounter,"price2");
$price3=$price2+($price2*0.1);
	switch(strlen($price3)) {
		  case 6: 
			 $price3 = substr($price3, 0, 3) . "," . substr($price3, 3, 3);
			 break;
		  case 5:
			 $price3 = substr($price3, 0, 2) . "," . substr($price3, 2, 3);
			 break;
		  case 4:
			 $price3 = substr($price3, 0, 1) . "," . substr($price3, 1, 3);
			 break;		   
		}
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
		
		
		echo ("<td width=260 align=center colspan=2><a href=p-show.php?code=$code style='text-decoration:none;'> 
		<div class='img'><img src='./photo/$userfile' width=260 height=200 border=0 id='zoom'></div><br>
		<font color=black style=' font-size:10pt;'>$name</a></font><br><hr width=200>");
		echo ("<del style='font-size:12px; font-color:gray;'>$price3 원</del> <font color=red size=2>10% $price2&nbsp;원</font></td>");

		$counter++;
	endwhile;
	echo("</tr></table>");
	echo ("<table border=0 width=700 align=center style='margin-top:40px;'>
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
		echo("<a href=event1.php?cblock=1&cpage=1&class=$class&mode=$mode><i class='fas fa-angle-double-left' id='gright'></i></a> ");
	if ($pblock > 0)        // 이전 블록이 존재하면 [이전블록] 버튼을 활성화
		echo ("<a href=event1.php?cblock=$pblock&cpage=$pstartpage&class=$class&mode=$mode><i class='fa-solid fa-chevron-left' id='gright'></i></a> ");

	// 현재 블록에 속한 페이지 번호를 출력	
	$i =   $startpage;
	while($i < $nstartpage):
	   if ($i > $totalpage) break;  // 마지막 페이지를 출력했으면 종료함
	   if ($cpage==$i){
	   echo ("<a href=event1.php?cblock=$cblock&cpage=$i&class=$class&mode=$mode><button style='font-size:13; border-radius:5px; background-color:black; color:white; padding:10px;'>$i</button></a>");
	   $i = $i + 1;}
	   else{
		   echo ("<a href=event1.php?cblock=$cblock&cpage=$i&class=$class&mode=$mode><button class='c'>$i</button></a>");
	   $i = $i + 1;} 
	   
	endwhile;
	 
	// 다음 블록의 시작 페이지가 전체 페이지 수보다 작으면 [다음블록] 버튼 활성화  
	if ($nstartpage <= $totalpage)   
		echo ("<a href=event1.php?board=testboard&cblock=$nblock&cpage=$nstartpage&class=0><i class='fa-solid fa-chevron-right' id='gright'></i></a> ");
	if ($totalpage<=$cpage)
		echo("");
	else
		
	echo ("<a href=event1.php?board=testboard&cpage=$totalpage&cblock=$ff&class=0><i class='fas fa-angle-double-right' id='gright'></i></a> ");//모르겠다수박

	echo ("</td></tr></table>");

	
}

	



echo ("</tr></table>");
	



 
mysql_close($con);
include ("bottom.html");
?>

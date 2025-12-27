<style>
#gright{color:lightgray;
		font-size:12;
	
}
#gright:hover{color:black;
		font-size:12;
	
}
.c{background-color:white; color:black; border:0px; padding:10px;
	
}
.c:hover{background-color:black; color:white; padding:10px; border-radius:5px; 
}
a{
	text-decoration:none;
	
}


#rr{
	color:black;

	
}
</style>
<?						

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
	   
if (!isset($class)) $class=0;

/*switch($class) {
   case 0:        // 초기화면에 출력할 인기 상품 목록
       $result = mysql_query("select * from product order by hit desc", $con);
		break;
   default:       // 카테고리별 메뉴 화면에 출력할 상품 목록
       $result = mysql_query("select * from product where class=$class order by hit desc", $con);
		break;
}*/
switch($class2) {
   case 0:        // 초기화면에 출력할 인기 상품 목록
       $result2 = mysql_query("select * from product order by hit desc", $con);
		break;
   default:       // 카테고리별 메뉴 화면에 출력할 상품 목록
       $result2 = mysql_query("select * from product where class2=$class2 order by hit desc", $con);
		break;
}

switch ($mode){
			
			case 1:
				$result2	= mysql_query("select * from product where class2=$class2 order by name desc",$con);
				break;
			case 2:
				$result2	=mysql_query("select * from product where class2=$class2 order by price2",$con);
				break;
			case 3:
				$result2	=mysql_query("select * from product where class2=$class2 order by price2 desc",$con);
				break;
			case 4:
				$result2	=mysql_query("select * from product where class2=$class2 order by hit desc",$con);
				break;
			case 5:
				$result2 = mysql_query("select * from product where class2=$class2 order by hit desc", $con);
				break;
	}


$total2=mysql_num_rows($result2);	
 include "top.html"; 
echo ("<center><table border=0 width=1000 style='margin-top:250px;'><tr>");
echo("<div style='position:absolute; top:280px;left:100px;'><font style=' font-size:25px;font-weight:bold;color:#A78178;'>$classname
 ></font> <font style=' font-size:22px;font-weight:bold;color:#A78178;'>$class2name</font></div>");

		if (!$total2){
				echo ("<td align=center><font color=red>아직 등록된 상품이 없습니다</td></tr>");}
 
		else {
				echo("<td align=right colspan=5><a href='p-list2.php?class2=$class2&mode=1&classname=$classname&class2name=$class2name' id='rr'> 상품명 </a>| <a href='p-list2.php?class2=$class2&mode=2&classname=$classname&class2name=$class2name'>낮은 가격</a> |
				<a href='p-list2.php?class2=$class2&mode=3&classname=$classname&class2name=$class2name'>높은 가격</a> | <a href='p-list2.php?class2=$class2&mode=4&classname=$classname&class2name=$class2name'>인기순</a></td></tr>");
		if   ($cpage=='') $cpage=1;    // $cpage -  현재 페이지 번호
				$pagesize = 3;                // $pagesize - 한 페이지에 출력할 목록 개수

				$totalpage = (int)($total2/12);
				if (($total2%12)!=0) $totalpage = $totalpage + 1;

				$subcounter=0;
				$counter = 0;
		
				while ($counter < $total2 && $counter < 15 && $subcounter < $pagesize) :
					$newcounter=($cpage-1)*12+$counter;
					if($newcounter==$total2) break;
					if ($newcounter > 0 && ($newcounter % 4) == 0){
						$subcounter = $subcounter + 1;
					if($subcounter>=$pagesize){
					break;
					}
					else{
				
						echo ("<tr><td colspan=5><hr style='border: solid 10px white;' width=100%></td></tr><tr height=200>");
						}
					}
		$code=mysql_result($result2,$newcounter,"code");
		$name=mysql_result($result2,$newcounter,"name");
		$userfile=mysql_result($result2,$newcounter,"userfile");
		$price2=mysql_result($result2,$newcounter,"price2");
$reviewnumre=mysql_query("select * from testboard where code='$code'",$con);
		$reviewnum=mysql_num_rows($reviewnumre);
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
		
		echo ("<td width=260><a href=p-show.php?code=$code> <img src='./photo/$userfile' width=250 height=200 border=0 style='margin:25px;'><br><font color=blue style='text-decoration:none; align:left;color:black; font-size:11pt;'>&nbsp;$name</font></a>
		<form method=post action=heart.php?code=$code>
	    <span style='line-height:50%'><br><button  value='' style='position:relative;width:20px;cursor:pointer;background-color:white;border:0'>
		<img src='cart.png' style='position:absolute;top:-3px;width:25px;margin-left:0px;filter:invert(66%) sepia(2%) saturate(20%) hue-rotate(320deg) brightness(100%) contrast(86%);'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style='font-size:14px;'>cart</font></button></form></span>");
		echo ("<font color=black style='font-weight:bold;font-size:18px;' >$price2&nbsp;원&nbsp;</font> <i class='fa-regular fa-comment' style='background-color:white;color:gray;'></i><font style='color:gray;'>리뷰($reviewnum)</font></td>");

		$counter++;
	endwhile;
	echo("</tr></table>");
	echo ("<table border=0 width=700 align=center style='margin-top:30px;'>
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
		echo("<a href=p-list2.php?cblock=1&cpage=1&class2=$class2&mode=$mode&classname=$classname&class2name=$class2name><i class='fas fa-angle-double-left' id='gright'></i></a> ");
	if ($pblock > 0)        // 이전 블록이 존재하면 [이전블록] 버튼을 활성화
		echo ("<a href=p-list2.php?cblock=$pblock&cpage=$pstartpage&class2=$class2&mode=$mode&classname=$classname&class2name=$class2name><i class='fa-solid fa-chevron-left' id='gright'></i></a> ");

	// 현재 블록에 속한 페이지 번호를 출력	
	$i =   $startpage;
	while($i < $nstartpage):
	   if ($i > $totalpage) break;  // 마지막 페이지를 출력했으면 종료함
	   if ($cpage==$i){
	   echo ("<a href=p-list2.php?cblock=$cblock&cpage=$i&class2=$class2&mode=$mode&classname=$classname&class2name=$class2name><button style='font-size:13; border-radius:5px; background-color:black; color:white; padding:10px;'>$i</button></a>");
	   $i = $i + 1;}
	   else{
		   echo ("<a href=p-list2.php?cblock=$cblock&cpage=$i&class2=$class2&mode=$mode&classname=$classname&class2name=$class2name><button class='c'>$i</button></a>");
	   $i = $i + 1;} 
	   
	endwhile;
	 
	// 다음 블록의 시작 페이지가 전체 페이지 수보다 작으면 [다음블록] 버튼 활성화  
	if ($nstartpage <= $totalpage)   
		echo ("<a href=p-list2.php?cblock=$nblock&cpage=$nstartpage&class2=$class2&mode=$mode&classname=$classname&class2name=$class2name><i class='fa-solid fa-chevron-right' id='gright'></i></a> ");
	if ($totalpage<=$cpage)
		echo("");
	else
		
	echo ("<a href=p-list.php?cpage=$totalpage&cblock=$ff&class2=$class2&mode=$mode><i class='fas fa-angle-double-right' id='gright'></i></a> ");//모르겠다수박

	echo ("</td></tr></table>");

	
}

echo ("</tr></table>");
 


 
mysql_close($con);
include ("bottom.html");
?>

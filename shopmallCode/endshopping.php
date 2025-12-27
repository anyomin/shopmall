<?

if (!$receiver){
	echo("
		<script>
		window.alert('수신자 이름이 없습니다. 다시 입력하세요.')
		history.go(-1)
		</script>
	");
	exit;
}

if(!$phone){
	echo("
		<script>
		window.alert('수신자의 전화번호가 없습니다. 다시 입력하세요.')
		history.go(-1)
		</script>
	");
	exit;
}

if(!$addr1){
	echo("
		<script>
		window.alert('배송 주소가 없습니다. 다시 입력하세요.')
		history.go(-1)
		</script>
	");
	exit;
}

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

$buydate = date("Y-m-d H:i:s");	// 구매 날짜 저장

$ordernum = strtoupper(substr($UserID, 0, 3)) . substr($buydate, 0, 4) . substr($buydate, 5, 2). substr($buydate, 8, 2) ."-". substr($buydate, 11, 8);

$address = "(" . $zip .  ")" . "&nbsp;" . $addr1 . "&nbsp;" . $addr2;

// 배송지 주소와 구매 번호를 테이블에 저장
mysql_query("insert into   receivers(id, session, sender, receiver, phone, address, message, buydate,   ordernum, status) values ('$UserID', '$Session', '$UserName',   '$receiver','$phone', '$address', '$message', '$buydate', '$ordernum', 1)", $con);

mysql_query("update member set point=point-'$use_pnt' where uid='$UserID'",$con);

$result = mysql_query("select * from shoppingbag where session='$Session'", $con);
$total = mysql_num_rows($result);

$counter=0;

while ($counter < $total) :
	$pcode = mysql_result($result, $counter, "pcode");
    $quantity = mysql_result($result, $counter, "quantity");
      
    // 쇼핑백 내용을 하나씩 구매 완료 리스트에 복사
    mysql_query("insert into orderlist(id, session, pcode, quantity,ordernum,reviewstate)   values ('$UserID', '$Session', '$pcode','$quantity','$ordernum',0)", $con);
	 	 	 
    $counter++;
endwhile;

$subresult = mysql_query("select * from orderlist where ordernum='$ordernum'",   $con);
        $subtotal =  mysql_num_rows($subresult);

        $subcounter=0;
        $totalprice=0;

        while ($subcounter <   $subtotal) :
             $pcode = mysql_result($subresult, $subcounter, "pcode");
             $quantity = mysql_result($subresult, $subcounter, "quantity");
      
             $tmpresult = mysql_query("select * from product where code='$pcode'", $con);
             $pname = mysql_result($tmpresult, 0, "name");
			 $price = mysql_result($tmpresult, 0, "price2");
       
             $subtotalprice = $quantity * $price;
             $totalprice = $totalprice + $subtotalprice;
             $subcounter++;
        endwhile;
		
// 구매 완료한 정보는 쇼핑백 테이블에서 모두 삭제
if(!$UserID){
mysql_query("delete from shoppingbag   where session='$Session'",$con);
}
else{
		$cresult= mysql_query("select * from member where uid='$UserID'",   $con);
		 $class=mysql_result($cresult,0,"class");
		 if($class=='vip'){
			$point = (int) $totalprice*0.05;
			mysql_query("update member set point=point+'$point' where uid='$UserID'",$con);
			mysql_query("delete from shoppingbag   where session='$Session'",$con);}
		 else if($class=='red'){
			$point = (int) $totalprice*0.04;
			mysql_query("update member set point=point+'$point' where uid='$UserID'",$con);
			mysql_query("delete from shoppingbag   where session='$Session'",$con);}
		 else if($class=='orange'){
			$point = (int) $totalprice*0.03;
			mysql_query("update member set point=point+'$point' where uid='$UserID'",$con);
			mysql_query("delete from shoppingbag   where session='$Session'",$con);}
		 else if($class=='yellow'){
			$point = (int) $totalprice*0.02;
			mysql_query("update member set point=point+'$point' where uid='$UserID'",$con);
			mysql_query("delete from shoppingbag   where session='$Session'",$con);}
		 else if($class=='white'){
			$point = (int) $totalprice*0.01;
			mysql_query("update member set point=point+'$point' where uid='$UserID'",$con);
			mysql_query("delete from shoppingbag   where session='$Session'",$con);}
}
mysql_close($con);	 

echo ("<script>
 	window.alert('구매가 정상적으로 처리되었습니다. \\n주문 번호는 $ordernum 이며  My Page에서 주문 조회가 가능합니다')
    history.go(1)
    </script>
    <meta http-equiv='Refresh' content='0; url=endorder.php?ordernum=$ordernum'>
");

?>

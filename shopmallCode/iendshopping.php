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


     
             $quantity = 1;
      
             $tmpresult = mysql_query("select * from product where code='$pcode'", $con);
            
			 $price = mysql_result($tmpresult, 0, "price2");
			 
$buydate = date("Y-m-d H:i:s");	// 구매 날짜 저장

$ordernum = strtoupper(substr($UserID, 0, 3)) . substr($buydate, 0, 4) . substr($buydate, 5, 2). substr($buydate, 8, 2) ."-". substr($buydate, 11, 8);

$address = "(" . $zip .  ")" . "&nbsp;" . $addr1 . "&nbsp;" . $addr2;

// 배송지 주소와 구매 번호를 테이블에 저장
mysql_query("insert into   receivers(id, session, sender, receiver, phone, address, message, buydate,   ordernum, status) values ('$UserID', '$Session', '$UserName',   '$receiver','$phone', '$address', '$message', '$buydate', '$ordernum', 1)", $con);

mysql_query("update member set point=point-'$use_pnt' where uid='$UserID'",$con);
  

 // 쇼핑백 내용을 하나씩 구매 완료 리스트에 복사
    mysql_query("insert into orderlist(id, session, pcode, quantity,ordernum,reviewstate)   values ('$UserID', '$Session', '$pcode','$quantity','$ordernum',0)", $con);

      
	
$point = (int) $price*0.05;
		mysql_query("update member set point=point+'$point' where uid='$UserID'",$con);
// 구매 완료한 정보는 쇼핑백 테이블에서 모두 삭제


mysql_close($con);	 

echo ("<script>
 	window.alert('구매가 정상적으로 처리되었습니다. \\n주문 번호는 $ordernum 이며 My Page에서 주문 조회가 가능합니다')
    history.go(1)
    </script>
    <meta http-equiv='Refresh' content='0; url=endorder.php?ordernum=$ordernum'>
");

?>

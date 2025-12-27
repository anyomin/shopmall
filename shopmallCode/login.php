<?
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
	
$result = mysql_query("select * from member where uid='$uid'", $con);
$total = mysql_num_rows($result);
$reviewresult=mysql_query("select * from testboard where writer='$uid'",$con);
$review=mysql_num_rows($reviewresult);
if($uid=='admin'){
	mysql_query("update member set class='admin'  where uid='$uid'",$con);
}
else{
	if($review >=50){
	mysql_query("update member set class='vip'  where uid='$uid'",$con);
		}
	elseif($review >=40 and $review < 50){
	mysql_query("update member set class='red'  where uid='$uid'",$con);
	}
	elseif($review >= 20 and $review < 40){
	mysql_query("update member set class='orange'  where uid='$uid'",$con);
	}
	elseif($review >=5 and $review < 20){
	mysql_query("update member set class='yellow'  where uid='$uid'",$con);
	}
	elseif($review<5){
	mysql_query("update member set class='white'  where uid='$uid'",$con);
	}
}
if (!$total){
	echo("<script>
		window.alert('아이디가 존재하지 않습니다')
		history.go(-1)
		</script> ");
	 exit;
} else {
	$pass = mysql_result($result, 0, "upass");
	$uname = mysql_result($result, 0, "uname");
	$approved = mysql_result($result, 0, "approved");

	if ($approved == 0) {
		echo("<script>
				window.alert('관리자의 회원 승인이 완료되지 않았습니다')
				history.go(-1)
				</script> ");
		exit;
	} 
		
	if ($pass != $upass) {
		echo("<script>
			window.alert('비밀번호가 맞지 않습니다')
			history.go(-1)
			</script> ");
		exit;
	} else {
		SetCookie("UserID", "$uid", 0);
		SetCookie("UserName", "$uname", 0);
		 
		$session = md5(uniqid(rand()));
		 SetCookie("Session", $session, 0);
				
		 mysql_query("delete from shoppingbag where id='$uid'", $con);
			 
		echo ("<meta http-equiv='Refresh' content='0; url=main.html'>"); 
	}
}
mysql_close($con);

?>

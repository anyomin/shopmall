<?



if (!$topic){
	echo("
		<script>
		window.alert('제목이 없습니다. 다시 입력하세요')
		history.go(-1)
		</script>
	");
	exit;
}

if (!$content){
	echo("
		<script>
		window.alert('내용이 없습니다. 다시 입력하세요')
		history.go(-1)
		</script>
	");
	exit;
}

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
$result = mysql_query("select * from testboard where id=$id", $con);

// 기존 필드값을 유지할 항목을 추출함
$space = mysql_result($result, 0, "space");
$hit = mysql_result($result, 0, "hit");
$filename=mysql_result($result, 0, "filename");

$wdate = date("Y-m-d");	//글 수정한 날짜 저장

//만약 새로운 사진으로 수정되면 원래 사진 삭제
if ($userfile and $userfile != $filename) {	
   $savedir = "./reviewphoto";	//첨부 파일이 저장될 폴더
   $temp = ereg_replace(" ", "_", $userfile_name); 
   copy($userfile, "$savedir/$temp");
   unlink($userfile);
   unlink("$savedir/$filename");
   }


// 만약 새로운 사진으로 수정이 안됐다면 원래사진그대로
if (!$userfile){
mysql_query("update testboard set   passwd='$passwd', topic='$topic', content='$content', hit=$hit, wdate='$wdate', space=$space, star='$rating'  where  id=$id", $con);
}
// 변경 내용을 테이블에 저장함
else{
	mysql_query("update testboard set   passwd='$passwd', topic='$topic', content='$content', hit=$hit, wdate='$wdate', space=$space, star='$rating', filename='$temp'  where  id=$id", $con);

}
echo("<meta http-equiv='Refresh' content='0; url=myreviewcontent.php?board=testboard&pcode=$code&id=$id'>");

mysql_close($con);

?>

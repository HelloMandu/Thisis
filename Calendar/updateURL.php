<?php
include 'connect.php';
$url = "http://www.donga.ac.kr/WebApp/BOARD/BASIC/Read.asp?BIDX=19&CAT=&PG=1&ORD=&KEY=&NUM=6615200&KWD=";
$sql = "UPDATE calendar_time_url SET url = '$url' WHERE id = 1";
if(mysqli_query($connect, $sql)){echo "update_url success";}
else{echo "update_url success";}
?>
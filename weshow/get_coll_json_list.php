<?php  
header('Content-Type: application/json; charset=utf-8');
include "connect.php";

$sql_select_Coll_list =  "SELECT DISTINCT Coll,Coll_ko FROM sugang_ddl_depth";
$result_select_Coll = mysqli_query($connect,$sql_select_Coll_list);
$Coll_list_array = array();
while($row_Coll = mysqli_fetch_array($result_select_Coll))
{
	array_push($Coll_list_array,array('Coll'=>$row_Coll['Coll'],'Coll_ko'=>$row_Coll['Coll_ko']));
}
echo json_encode(array("result"=>$Coll_list_array),JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
mysqli_close($connect);

?>
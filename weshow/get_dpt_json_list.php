<?php 
header('Content-Type: application/json; charset=utf-8');
include "connect.php";
if(isset($_POST['college']))
{
	$ddlcollege = $_POST['college'];
}

$sql_select_Dpt_list =  "SELECT Dpt,Dpt_ko FROM sugang_ddl_depth WHERE Coll = '".$ddlcollege."'";
$result_select_Dpt = mysqli_query($connect,$sql_select_Dpt_list);
$Dpt_list_array = array();
while($row_Dpt = mysqli_fetch_array($result_select_Dpt))
{
	array_push($Dpt_list_array,array('Dpt'=>$row_Dpt['Dpt'],'Dpt_ko'=>$row_Dpt['Dpt_ko']));
}
echo json_encode(array("result"=>$Dpt_list_array),JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
mysqli_close($connect);



 ?>
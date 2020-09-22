<?php
function getSQL($campus){
    switch($campus){
        case "승학":
            return $sql = "SELECT *FROM call_number_sh";
        case "부민":
            return $sql = "SELECT *FROM call_number_bm";
        case "구덕":
           return $sql = "SELECT *FROM call_number_gd";
    }
}

function getCallNumber($campus){
    include "connect.php";
    $sql = getSQL($campus);
    $result = mysqli_query($connect, $sql);
    $callNumber = array();
    while($row = mysqli_fetch_array($result)){
        $CallInfo = array(
            "organization" => $row[1],
            "office" => $row[2],
            "number" => $row[3]
        );
        array_push($callNumber, $CallInfo);
    }
    return $callNumber;
}
header('Content-Type: application/json; charset=utf-8');
$allCallNumber = array("SeungHak" => getCallNumber("승학"), "Bumin" => getCallNumber("부민"), "Gudeuk" => getCallNumber("구덕"));
echo json_encode($allCallNumber, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
?>
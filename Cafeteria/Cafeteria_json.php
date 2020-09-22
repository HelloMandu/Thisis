<?php
header('Content-Type: application/json; charset=utf-8');
function printMenu($table){
    include 'connect.php';
    $sql = "SELECT *FROM ".$table.";";
    $menuList = array();
    if($result = mysqli_query($connect, $sql)){
        while($row = mysqli_fetch_array($result)){
            $menu = array(
                'setMenu' => $row[1],
                'oneMenu' => $row[2],
                'snackMenu' => $row[3],
                'date' => $row[4]
            );
            array_push($menuList, $menu);
        }
    }
    else{
        echo "Connection failed";
    }
    return $menuList;
}

$tables = array(
    'cafeteria_professor_sh',
    'cafeteria_student_sh',
    'cafeteria_library_sh',
    'cafeteria_domitory_bm',
    'cafeteria_professor_bm',
    'cafeteria_student_bm',
    'cafeteria_domitory_sh'
);
$allList = array();
foreach ($tables as $table){
    array_push($allList, printMenu($table));
}
$Cafeteria = array(
    'cafeteria_professor_sh'=>$allList[0],
    'cafeteria_student_sh'=>$allList[1],
    'cafeteria_library_sh'=>$allList[2],
    'cafeteria_domitory_bm'=>$allList[3],
    'cafeteria_professor_bm'=>$allList[4],
    'cafeteria_student_bm'=>$allList[5],
    'cafeteria_domitory_sh'=>$allList[6]
);
echo json_encode($Cafeteria, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
?>

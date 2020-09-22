<?php
    function getSQL($numberInfo, $id){
        switch($numberInfo[0]){
            case "승학":
                return $sql = "UPDATE call_number_sh organization = '{$numberInfo[1]}', office = '{$numberInfo[2]}', number = '{$numberInfo[3]}' WHERE id = $id";
                //return $sql = "INSERT INTO call_number_sh(organization, office, number) VALUES('{$numberInfo[1]}', '{$numberInfo[2]}', '{$numberInfo[3]}')";
            case "부민":
                return $sql = "UPDATE call_number_bm organization = '{$numberInfo[1]}', office = '{$numberInfo[2]}', number = '{$numberInfo[3]}' WHERE id = $id";
                //return $sql = "INSERT INTO call_number_bm(organization, office, number) VALUES('{$numberInfo[1]}', '{$numberInfo[2]}', '{$numberInfo[3]}')";
            case "구덕":
                return $sql = "UPDATE call_number_gd organization = '{$numberInfo[1]}', office = '{$numberInfo[2]}', number = '{$numberInfo[3]}' WHERE id = $id";
                //return $sql = "INSERT INTO call_number_gd(organization, office, number) VALUES('{$numberInfo[1]}', '{$numberInfo[2]}', '{$numberInfo[3]}')";
        }
    }
    //while문으로 바꿔서 페이지 끝까지 -> 페이지에 아무 결과도 파싱되지 않을 때 까지
    include "connect.php";
    include "simplehtmldom_1_8_1.php";
    $shId = 1; $bmId = 1; $gdId = 1;
    for($index = 1; $index < 45; $index++){
        if($index < 44){
            $range = 15;
        }
        else{
            $range = 3;
        }
        $url = "https://www.donga.ac.kr/gzSub_007005006.aspx?PG=".$index."&OPT=1&KWD=";
        $html = file_get_html($url);
        for($i = 1; $i <= $range; $i++){
            $numberInfo = array();
            for($j = 0; $j < 4; $j++){
                array_push($numberInfo, $html->find("table", 0)->find("tr", $i)->find("td", $j)->plaintext);
            }
            $numberInfo[3] = str_replace("051-", "", $numberInfo[3]);
            $numberInfo[3] = str_replace("051)", "", $numberInfo[3]);
            $numberInfo[3] = substr($numberInfo[3], 0, 8);
            $sql = getSQL($numberInfo);
            if($numberInfo[2] != "홍보팀"){ 
                if(mysqli_query($connect, $sql)){
                    echo "insert success";
                }
                else{
                    echo "insert failed";
                }
            }
            echo "<br>";
        }
        echo "<br>";
    }
?>
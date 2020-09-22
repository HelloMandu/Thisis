<?php
    $shId = 0; $bmId = 0; $gdId = 0;
    function getSQL($numberInfo){
        global $shId, $bmId, $gdId;
        switch($numberInfo[0]){
            case "승학":
                $shId++;
                return $sql = "UPDATE call_number_sh SET organization = '{$numberInfo[1]}', office = '{$numberInfo[2]}', number = '{$numberInfo[3]}' WHERE id = $shId";
                //return $sql = "INSERT INTO call_number_sh(organization, office, number) VALUES('{$numberInfo[1]}', '{$numberInfo[2]}', '{$numberInfo[3]}')";
            case "부민":
                $bmId++;
                return $sql = "UPDATE call_number_bm SET organization = '{$numberInfo[1]}', office = '{$numberInfo[2]}', number = '{$numberInfo[3]}' WHERE id = $bmId";
                //return $sql = "INSERT INTO call_number_bm(organization, office, number) VALUES('{$numberInfo[1]}', '{$numberInfo[2]}', '{$numberInfo[3]}')";
            case "구덕":
                $gdId++;
                return $sql = "UPDATE call_number_gd SET organization = '{$numberInfo[1]}', office = '{$numberInfo[2]}', number = '{$numberInfo[3]}' WHERE id = $gdId";
                //return $sql = "INSERT INTO call_number_gd(organization, office, number) VALUES('{$numberInfo[1]}', '{$numberInfo[2]}', '{$numberInfo[3]}')";
        }
    }
    include "connect.php";
    include "simplehtmldom_1_8_1.php";
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
                $text = $html->find("table", 0)->find("tr", $i)->find("td", $j)->plaintext;
                $text = str_replace("&#183;","·",$text);
                $text = str_replace("&amp;","&",$text);
                array_push($numberInfo, $text);
            }
            $numberInfo[3] = str_replace("051-", "", $numberInfo[3]);
            $numberInfo[3] = str_replace("051)", "", $numberInfo[3]);
            $numberInfo[3] = substr($numberInfo[3], 0, 8);
            $sql = getSQL($numberInfo);
            if($numberInfo[2] != "홍보팀"){
                if(mysqli_query($connect, $sql)){
                    echo "update success";
                }
                else{
                    echo "update failed";
                }
            }
            echo "<br>";
        }
        echo "<br>";
    }
?>
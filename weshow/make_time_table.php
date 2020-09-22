<?php

function printResult($sugangList){
    foreach ($sugangList as $row) {
        if(is_array($row)){
            echo $row[0]->Class_num;
            echo ' ';
            foreach ($row as $list){
                echo $list->Class;
                echo ' ';
                echo $list->Title;
                echo ' ';
                foreach ($list->Time as $time){
                    echo $time->day;
                    echo $time->start;
                    echo $time->end;
                    echo ' ';
                }
                echo ' / ';
            }
        }
        else{
            echo $row->Class_num;
            echo ' ';
            echo $row->Class;
            echo ' ';
            echo $row->Title;
            echo ' ';
            foreach ($row->Time as $time){
                echo $time->day;
                echo $time->start;
                echo $time->end;
                echo ' ';
            }
        }
        echo '<br>';
    }
}

function init(&$sugangList, &$timeTable, &$testcase, &$selectedList){
    $zeros = array();
    for($i = 0; $i < 31; $i++){
        array_push($zeros, 0);
    }
    $timeTable = array("월"=>$zeros, "화"=>$zeros, "수"=>$zeros, "목"=>$zeros, "금"=>$zeros);
    // foreach($testcase as $class){
    //     foreach($sugangList as $row){
    //         if(is_array($row)){
    //             if($row[0]->Class_num === $class){
    //                 array_push($selectedList, $row);
    //                 break;
    //             }
    //         }
    //         else if($row->Class_num === $class){
    //                 array_push($selectedList, $row);
    //                 break;
    //         }
    //     }
    // }
    foreach($testcase as $class){
        foreach($sugangList as $row){
                if($row->Lecture->Class_num === $class){
                    array_push($selectedList, $row);
                    echo $class.' ';
                    break;
                }
        }
    }
}

/*해당된 시간에 이미 선택된 강의가 있는지 검사*/
function canTakeit($timeTable, $selected){
    foreach($selected->Time as $time){
        for($i = $time->start; $i <= $time->end; $i++){
            if($timeTable[$time->day][$i] != 0){
                return false;
            }
        }
    }
    return true;
}

/*강의시간 추가*/
function paintSchedule(&$timeTable, &$schedules, &$selected){
    foreach($selected->Time as $time){
        for($i = $time->start; $i <= $time->end; $i++){
            $timeTable[$time->day][$i] = 1;
        }
    }
    array_push($schedules, $selected);
}

/*강의시간 삭제*/
function eraseSchedule(&$timeTable, &$schedules, &$selected){
    foreach($selected->Time as $time){
        for($i = $time->start; $i <= $time->end; $i++){
            $timeTable[$time->day][$i] = 0;
        }
    }
    array_pop($schedules);
}

/*선택된 시간표를 이용해 만들 수 있는 강의시간 경우의 수 추출*/
function findScheduleCases(&$result, &$schedules, &$selectedList, &$timeTable, $count){
    if($count == count($selectedList)){
        printResult($schedules);
        echo '<br>';
        array_push($result, $schedules); //result push
        return;
    }
    if(is_array($selectedList[$count])){
        for($i = 0; $i < count($selectedList[$count]); $i++){
            if(canTakeit($timeTable, $selectedList[$count][$i])){
                paintSchedule($timeTable, $schedules, $selectedList[$count][$i]);
                findScheduleCases($result, $schedules, $selectedList, $timeTable, $count + 1);
                eraseSchedule($timeTable, $schedules, $selectedList[$count][$i]);
            }
        } 
    }
    else if(canTakeit($timeTable, $selectedList[$count])){
        paintSchedule($timeTable, $schedules, $selectedList[$count]);
        findScheduleCases($result, $schedules, $selectedList, $timeTable, $count + 1);
        eraseSchedule($timeTable, $schedules, $selectedList[$count]);
    }
}

$timeTable;
$result = array();
$selectedList = array();
$schedules = array();
$testcase = array(
    "CSE300", //프언
    "CSE301", //디비
    "CSE302", //컴네
    "CSE303", //os
    "CSE305", //소실
    "MSC044" //수치해석
);
$post = file_get_contents("php://input");
$post = json_decode($post);
init($post->lecture_list_result, $timeTable, $testcase, $selectedList);

?>
<?php
function init(&$sugangList, &$timeTable, &$selectedList){
    $zeros = array();
    for($i = 0; $i < 31; $i++){
        array_push($zeros, 0);
    }
    $timeTable = array("월"=>$zeros, "화"=>$zeros, "수"=>$zeros, "목"=>$zeros, "금"=>$zeros);
   for($i = 0; $i < count($sugangList); $i++){
        array_push($selectedList, $sugangList[$i]->Lecture);
   }
}

/*해당된 시간에 이미 선택된 강의가 있는지 검사*/
function canTakeit($timeTable, $selected){
    foreach($selected->Time as $time){
        for($i = $time->Start; $i <= $time->End; $i++){
            if($timeTable[$time->Day][$i] != 0){
                return false;
            }
        }
    }
    return true;
}

/*강의시간 추가*/
function paintSchedule(&$timeTable, &$schedules, &$selected){
    foreach($selected->Time as $time){
        for($i = $time->Start; $i <= $time->End; $i++){
            $timeTable[$time->Day][$i] = 1;
        }
    }
    array_push($schedules, $selected);
}

/*강의시간 삭제*/
function eraseSchedule(&$timeTable, &$schedules, &$selected){
    foreach($selected->Time as $time){
        for($i = $time->Start; $i <= $time->End; $i++){
            $timeTable[$time->Day][$i] = 0;
        }
    }
    array_pop($schedules);
}

/*선택된 시간표를 이용해 만들 수 있는 강의시간 경우의 수 추출*/
function findScheduleCases(&$result, &$schedules, &$selectedList, &$timeTable, $count){
    if($count == count($selectedList)){
        array_push($result, array('TimeTable'=>$schedules)); //result push
        return;
    }
    for($i = 0; $i < count($selectedList[$count]->Time_List); $i++){
        if(canTakeit($timeTable, $selectedList[$count]->Time_List[$i])){
            paintSchedule($timeTable, $schedules, $selectedList[$count]->Time_List[$i]);
            findScheduleCases($result, $schedules, $selectedList, $timeTable, $count + 1);
            eraseSchedule($timeTable, $schedules, $selectedList[$count]->Time_List[$i]);
        }
    } 
}

$timeTable;
$result = array();
$schedules = array();
$selectedList = array();
$post = json_decode(file_get_contents("php://input"));

init($post->lecture_list_result, $timeTable, $selectedList);
findScheduleCases($result, $schedules, $selectedList, $timeTable, 0);
echo json_encode(array('TimeTableList'=>$result),JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
?>
<?php
/*강의시간을 연산하기 편하게 가공*/
function changeTimeForm(&$class){
    if($class->Time){ // 시간표가 존재하는 경우
        $days = array('월', '화', '수', '목', '금');
        foreach($days as $day){
           if(strpos($class->Time, $day) !== false){ // 해당요일을 찾았을시
                $str = $class->Time;
                $str = substr($str, 3); // 요일정보제외
                $temp = explode('(', $str); // 시간표만 추출
                // print_r($temp);
                if(isset($temp[2]))
                {
                    $building_temp = $temp[1]."(".$temp[2];
                }
                else
                {
                    $building_temp = $temp[1];
                }
                
                $building_temp = substr($building_temp,0,-1);
                $building = $building_temp;
                $time = $temp[0];
                $time = explode('-', $time);
                $classTime = (object)array(
                    'day' => $day,
                    'start' => (int)$time[0],
                    'end' => (int)$time[1],
                    'building' => $building
                );
                $class->Time = array($classTime);
                return;
           } 
        }
    }
}

/*같은 강의인지 검사*/
function isSameClass($class1, $class2){
    if(is_array($class1)){
        return $class1[0]->Class_num === $class2->Class_num;
    }
    return $class1->Class_num === $class2->Class_num;
}

/*같은 분반인지 검사*/
function isSameClassNum($class1, $class2){
    return $class1->Class === $class2->Class;
}

/*강의시간을 연결*/
function connectTime(&$class1, &$class2){
    array_push($class1->Time, $class2->Time[0]);
}

/*강의번호, 분반이 같은 강의를 join*/
function connectClassTime(&$sugangList){
    for($i = 0; $i < count($sugangList) - 1; $i++){
        if(isSameClass($sugangList[$i], $sugangList[$i + 1])){
            if(isSameClassNum($sugangList[$i], $sugangList[$i + 1])){
                connectTime($sugangList[$i], $sugangList[$i + 1]);
                array_splice($sugangList, $i + 1, 1);
            }
        }
    }
}

/*같은 강의 연결*/
function connectClass(&$class1, &$class2){
    if(is_array($class1)){
        array_push($class1, $class2);
    }
    else{
        $class1 = array($class1, $class2);
    }
}

/*강의번호가 같은 강의를 join*/
function connectSameClass(&$sugangList){
    for($i = 0; $i < count($sugangList) - 1; $i++){
        if(isSameClass($sugangList[$i], $sugangList[$i + 1])){
            connectClass($sugangList[$i], $sugangList[$i + 1]);
            array_splice($sugangList, $i + 1, 1);
            $i-=1;
        }
    }
}

/*start main*/
// $url = 'https://dsisteam.com/thisis/student_info/sugang_test.php';
// $json_string = file_get_contents($url);
// $sugangList = json_decode($json_string,true);
// $sugangList = $sugangList['lecture_list_result'];

// /*object형으로 변환*/
// for($i = 0; $i < count($sugangList); $i++){
//     $sugangList[$i] = (object)$sugangList[$i];
// }

// /*시간정보가공*/
// for($i = 0; $i < count($sugangList); $i++){
//     changeTimeForm($sugangList[$i]);
// }

// /*같은 분반 합병*/
// connectClassTime($sugangList);

// /*같은 class 합병*/
// connectSameClass($sugangList);

?>
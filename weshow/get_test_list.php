<?php  
header('Content-Type: application/json; charset=utf-8');
include "connect.php";

mysqli_set_charset($connect,"utf8");
$query = "SELECT * FROM sugang_test";
$res = mysqli_query($connect,$query);
$list_arr = array();
while($row = mysqli_fetch_array($res))
{
	array_push($list_arr,array("Department"=>$row['Department'],"Grade"=>$row['Grade'],"Division"=>$row['Division'],"Class_num"=>$row['Class_num'],"Class"=>$row['Class'],"Title"=>$row['Title'],"Day_night"=>$row['Day_night'],"Unit"=>$row['Unit'],"Theory_training"=>$row['Theory_training'],"Professor"=>$row['Professor'],"Department_limit"=>$row['Department_limit'],"Seventyfive"=>$row['Seventyfive'],"Grade_limit"=>$row['Grade_limit'],"Teaching"=>$row['Teaching'],"Language"=>$row['Language'],"Virtual"=>$row['Virtual'],"Continuous_lecture"=>$row['Continuous_lecture'],"People_limit"=>$row['People_limit'],"Now_people"=>$row['Now_people'],"Closure_lecture"=>$row['Closure_lecture'],"Time"=>$row['Time'],"Remarks"=>$row['Remarks']));
}




$json_string = json_encode(array("lecture_list_result"=>$list_arr),JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);

include "edit_sugang_list.php";
$sugangList = json_decode($json_string,true);
$sugangList = $sugangList['lecture_list_result'];

for($i = 0; $i < count($sugangList); $i++){
    $sugangList[$i] = (object)$sugangList[$i];
}

for($i = 0; $i < count($sugangList); $i++){
    changeTimeForm($sugangList[$i]);
}

connectClassTime($sugangList);

connectSameClass($sugangList);

$result_arr = array();
foreach($sugangList as $sugang_row)
{
	if(is_array($sugang_row)){
			$sugang_arr = array();
			$department = $sugang_row[0]->Department;
			$grade = $sugang_row[0]->Grade;
			$division = $sugang_row[0]->Division;
            $class_num = $sugang_row[0]->Class_num;
            $class = $sugang_row[0]->Class;
            $title = $sugang_row[0]->Title;
            $day_night = $sugang_row[0]->Day_night;
            $unit = $sugang_row[0]->Unit;
            $theory_training = $sugang_row[0]->Theory_training;
            $professor = $sugang_row[0]->Professor;
            $department_limit = $sugang_row[0]->Department_limit;
            $seventyfive = $sugang_row[0]->Seventyfive;
            $grade_limit = $sugang_row[0]->Grade_limit;
            $teaching = $sugang_row[0]->Teaching;
            $language = $sugang_row[0]->Language;
            $virtual = $sugang_row[0]->Virtual;
            $continuous_lecture = $sugang_row[0]->Continuous_lecture;
            $people_limit = $sugang_row[0]->People_limit;
            $now_people = $sugang_row[0]->Now_people;
            $closure_lecture = $sugang_row[0]->Closure_lecture;
            $remarks = $sugang_row[0]->Remarks;
            $link = "";
            $sugang_arr = array_merge($sugang_arr,array('Department'=>$department));
            $sugang_arr = array_merge($sugang_arr,array('Grade'=>$grade));
            $sugang_arr = array_merge($sugang_arr,array('Division'=>$division));
            $sugang_arr = array_merge($sugang_arr,array('Class_num'=>$class_num));
            $sugang_arr = array_merge($sugang_arr,array('Title'=>$title));
            $sugang_arr = array_merge($sugang_arr,array('Day_night'=>$day_night));
            $sugang_arr = array_merge($sugang_arr,array('Unit'=>$unit));
            $sugang_arr = array_merge($sugang_arr,array('Theory_training'=>$theory_training));
            $sugang_arr = array_merge($sugang_arr,array('Professor'=>$professor));
            $sugang_arr = array_merge($sugang_arr,array('Department_limit'=>$department_limit));
            $sugang_arr = array_merge($sugang_arr,array('Seventyfive'=>$seventyfive));
            $sugang_arr = array_merge($sugang_arr,array('Grade_limit'=>$grade_limit));
            $sugang_arr = array_merge($sugang_arr,array('Teaching'=>$teaching));
            $sugang_arr = array_merge($sugang_arr,array('Language'=>$language));
            $sugang_arr = array_merge($sugang_arr,array('Virtual'=>$virtual));
            $sugang_arr = array_merge($sugang_arr,array('Continuous_lecture'=>$continuous_lecture));
            $sugang_arr = array_merge($sugang_arr,array('Closure_lecture'=>$closure_lecture));
            $sugang_arr = array_merge($sugang_arr,array('Remarks'=>$remarks));
            $sugang_arr = array_merge($sugang_arr,array('Link'=>$link));
            $list_arr = array();
            foreach ($sugang_row as $list){
                $class = $list->Class;
				$now_people = $list->Now_people;
           	 	$people_limit = $list->People_limit;
				
            	$time_arr = array();
				foreach ($list->Time as $time){
					$day = $time->day;
                    $start = $time->start;
                    $end = $time->end;
                    $building = $time->building;
                    array_push($time_arr,array('Day'=>$day,'Start'=>$start,'End'=>$end,'Building'=>$building));
                }
              
                array_push($list_arr,array('Class'=>$class,'Now_people'=>$now_people,'People_limit'=>$people_limit,'Time'=>$time_arr));
            }
            $sugang_arr = array_merge($sugang_arr,array('Time_List'=>$list_arr));
         
            array_push($result_arr,array('Lecture'=>$sugang_arr));
        }
        else{
        	$sugang_arr = array();
        	$list_arr = array();
            $department = $sugang_row->Department;
			$grade = $sugang_row->Grade;
			$division = $sugang_row->Division;
            $class_num = $sugang_row->Class_num;
            $class = $sugang_row->Class;
            $title = $sugang_row->Title;
            $day_night = $sugang_row->Day_night;
            $unit = $sugang_row->Unit;
            $theory_training = $sugang_row->Theory_training;
            $professor = $sugang_row->Professor;
            $department_limit = $sugang_row->Department_limit;
            $seventyfive = $sugang_row->Seventyfive;
            $grade_limit = $sugang_row->Grade_limit;
            $teaching = $sugang_row->Teaching;
            $language = $sugang_row->Language;
            $virtual = $sugang_row->Virtual;
            $continuous_lecture = $sugang_row->Continuous_lecture;
            $people_limit = $sugang_row->People_limit;
            $now_people = $sugang_row->Now_people;
            $closure_lecture = $sugang_row->Closure_lecture;
            $remarks = $sugang_row->Remarks;
            $link = "";
            $sugang_arr = array_merge($sugang_arr,array('Department'=>$department));
            $sugang_arr = array_merge($sugang_arr,array('Grade'=>$grade));
            $sugang_arr = array_merge($sugang_arr,array('Division'=>$division));
            $sugang_arr = array_merge($sugang_arr,array('Class_num'=>$class_num));
            $sugang_arr = array_merge($sugang_arr,array('Title'=>$title));
            $sugang_arr = array_merge($sugang_arr,array('Day_night'=>$day_night));
            $sugang_arr = array_merge($sugang_arr,array('Unit'=>$unit));
            $sugang_arr = array_merge($sugang_arr,array('Theory_training'=>$theory_training));
            $sugang_arr = array_merge($sugang_arr,array('Professor'=>$professor));
            $sugang_arr = array_merge($sugang_arr,array('Department_limit'=>$department_limit));
            $sugang_arr = array_merge($sugang_arr,array('Seventyfive'=>$seventyfive));
            $sugang_arr = array_merge($sugang_arr,array('Grade_limit'=>$grade_limit));
            $sugang_arr = array_merge($sugang_arr,array('Teaching'=>$teaching));
            $sugang_arr = array_merge($sugang_arr,array('Language'=>$language));
            $sugang_arr = array_merge($sugang_arr,array('Virtual'=>$virtual));
            $sugang_arr = array_merge($sugang_arr,array('Continuous_lecture'=>$continuous_lecture));
            $sugang_arr = array_merge($sugang_arr,array('Closure_lecture'=>$closure_lecture));
            $sugang_arr = array_merge($sugang_arr,array('Remarks'=>$remarks));
			$sugang_arr = array_merge($sugang_arr,array('Link'=>$link));
            $time_arr = array();
            $list_arr = array();
            foreach ($sugang_row->Time as $time){
                $day = $time->day;
                $start = $time->start;
                $end = $time->end;
                $building = $time->building;
                array_push($time_arr,array('Day'=>$day,'Start'=>$start,'End'=>$end,'Building'=>$building));
            }
			array_push($list_arr,array('Class'=>$class,'Now_people'=>$now_people,'People_limit'=>$people_limit,'Time'=>$time_arr));
			$sugang_arr = array_merge($sugang_arr,array('Time_List'=>$list_arr));
            array_push($result_arr,array('Lecture'=>$sugang_arr));
        }
}

echo json_encode(array("lecture_list_result"=>$result_arr),JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);

mysqli_close($connect);
?>
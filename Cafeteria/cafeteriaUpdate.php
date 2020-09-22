<?php
function cleanUpString($String){
    $String = str_replace("&lt;","<",$String);
    $String = str_replace("&gt;",">",$String);
    $String = str_replace("&nbsp;","",$String);
    $String = str_replace("X","",$String);
    $String = str_replace("&amp;","&",$String);
    return $String;
}

function sliceMenu($String){ // 국제회관 기숙사 정리
    $strTok = sliceLunchtoDinner($String);
    $strTok2 = sliceBreakFasttoLunch($strTok[0]);
    array_push($strTok2, $strTok[1]);
    return $strTok2;
}

function sliceLunchtoDinner($String){ // 국제회관 기숙사 점심, 석식
    $strTok = explode('석식' , $String);
    $strTok[1] = str_replace("(4000)","",$strTok[1]);
    $strTok[1] = substr($strTok[1], 3);
    return $strTok;
}

function sliceBreakFasttoLunch($String){ // 국제회관 기숙사 조식, 정식
    $strTok = explode('중식' , $String);
    $strTok[0] = str_replace("조식","",$strTok[0]);
    $strTok[1] = str_replace("(4000)","",$strTok[1]);
    $strTok[0] = substr($strTok[0], 3);
    $strTok[1] = substr($strTok[1], 3);
    return $strTok;
}


include 'connect.php';
include 'simple_html_dom.php';

date_default_timezone_set('Asia/Seoul');

for($id = -1; $id < 7; $id++){//어제날짜부터~일주일
    $day = date("Ymd",strtotime ($id." days"));
    $html = file_get_html("http://www.donga.ac.kr/gzSub_007005005.aspx?DT=".$day);
    $date = date("Y-m-d",strtotime($id." days"));

    $foodList = array(); // 교수회관 Cafeteria_Professor_sh
    for($j = 1; $j < 4; $j++){
        $food = $html->find('table', 1)->find('tr',$j)->children(1)->plaintext;
        $food = cleanUpString($food);
        array_push($foodList, $food);
    }
    $sql = "UPDATE cafeteria_professor_sh SET setMenu = '$foodList[0]', oneMenu = '$foodList[1]', snackMenu = '$foodList[2]', date = '$date' WHERE id = $id + 2";
    //$sql = "INSERT into cafeteria_professor_sh(setMenu, oneMenu, snackMenu, date) VALUES('$foodList[0]', '$foodList[1]', '$foodList[2]', '$date');";
    if(mysqli_query($connect, $sql)) { 
        echo "cafeteria_professor_sh update success<br>";
        $time = date("Y-m-d  H:i:s");
        $sql = "UPDATE cafeteria_update_time SET time = '$time' WHERE id = 1";
        if(mysqli_query($connect, $sql)) { echo "cafeteria_update_time update success<br>";}
        else { echo "cafeteria_update_time update fail<br>"; }
    }
    else { echo "cafeteria_professor_sh update fail<br>"; }

    $foodList = array(); // 학생회관 Cafeteria_Student_sh
    for($j = 1; $j < 4; $j++){
        $food = $html->find('table', 1)->find('tr',$j)->children(2)->plaintext;
        $food = cleanUpString($food);
        array_push($foodList, $food);
    }
    $sql = "UPDATE cafeteria_student_sh SET setMenu = '$foodList[0]', oneMenu = '$foodList[1]', snackMenu = '$foodList[2]', date = '$date' WHERE id = $id + 2";
    //$sql = "INSERT into cafeteria_student_sh(setMenu, oneMenu, snackMenu, date) VALUES('$foodList[0]', '$foodList[1]', '$foodList[2]', '$date');";
    if(mysqli_query($connect, $sql)) { 
        echo "cafeteria_student_sh update success<br>";
        $time = date("Y-m-d  H:i:s");
        $sql = "UPDATE cafeteria_update_time SET time = '$time' WHERE id = 2";
        if(mysqli_query($connect, $sql)) { echo "cafeteria_update_time update success<br>";}
        else { echo "cafeteria_update_time update fail<br>"; }
    }
    else { echo "cafeteria_student_sh update fail<br>"; }

    $foodList = array(); // 공과대학 Cafeteria_Library_sh
    for($j = 1; $j < 4; $j++){
        $food = $html->find('table', 1)->find('tr',$j)->children(4)->plaintext;
        $food = cleanUpString($food);
        array_push($foodList, $food);
    }
    $sql = "UPDATE cafeteria_library_sh SET setMenu = '$foodList[0]', oneMenu = '$foodList[1]', snackMenu = '$foodList[2]', date = '$date' WHERE id = $id + 2";    
    //$sql = "INSERT into cafeteria_library_sh(setMenu, oneMenu, snackMenu, date) VALUES('$foodList[0]', '$foodList[1]', '$foodList[2]', '$date');";
    if(mysqli_query($connect, $sql)) { 
        echo "cafeteria_library_sh update success<br>";
        $time = date("Y-m-d  H:i:s");
        $sql = "UPDATE cafeteria_update_time SET time = '$time' WHERE id = 3";
        if(mysqli_query($connect, $sql)) { echo "cafeteria_update_time update success<br>";}
        else { echo "cafeteria_update_time update fail<br>"; }
    }
    else { echo "cafeteria_library_sh update fail<br>"; }

    $foodList = array(); // 국제회관 기숙사 Cafeteria_Domitory_bm
    $food = $html->find('table', 2)->find('tr',1)->children(2)->plaintext;
    $food = cleanUpString($food);
    $foodList = sliceMenu($food);
    $sql = "UPDATE cafeteria_domitory_bm SET Breakfast = '$foodList[0]', Lunch = '$foodList[1]', Dinner = '$foodList[2]', date = '$date' WHERE id = $id + 2";    
    //$sql = "INSERT into cafeteria_domitory_bm(setMenu, oneMenu, snackMenu, date) VALUES('$foodList[0]', '$foodList[1]', '$foodList[2]', '$date');";
    if(mysqli_query($connect, $sql)) { 
        echo "cafeteria_domitory_bm update success<br>";
        $time = date("Y-m-d  H:i:s");
        $sql = "UPDATE cafeteria_update_time SET time = '$time' WHERE id = 4";
        if(mysqli_query($connect, $sql)) { echo "cafeteria_update_time update success<br>";}
        else { echo "cafeteria_update_time update fail<br>"; }
    }
    else { echo "cafeteria_domitory_bm update fail<br>"; }

    $foodList = array(); // 교직원 식당 Cafeteria_Professor_bm
    for($j = 1; $j < 4; $j++){
        $food = $html->find('table', 2)->find('tr',$j)->children(3)->plaintext;
        $food = cleanUpString($food);
        array_push($foodList, $food);
    }
    $sql = "UPDATE cafeteria_professor_bm SET setMenu = '$foodList[0]', oneMenu = '$foodList[1]', snackMenu = '$foodList[2]', date = '$date' WHERE id = $id + 2";    
    //$sql = "INSERT into cafeteria_professor_bm(setMenu, oneMenu, snackMenu, date) VALUES('$foodList[0]', '$foodList[1]', '$foodList[2]', '$date');";
    if(mysqli_query($connect, $sql)) { 
        echo "cafeteria_professor_bm update success<br>";
        $time = date("Y-m-d  H:i:s");
        $sql = "UPDATE cafeteria_update_time SET time = '$time' WHERE id = 5";
        if(mysqli_query($connect, $sql)) { echo "cafeteria_update_time update success<br>";}
        else { echo "cafeteria_update_time update fail<br>"; }
    }
    else { echo "cafeteria_professor_bm update fail<br>"; }
    
    $foodList = array(); // 강의동 학생회관 Cafeteria_Student_bm
    for($j = 1; $j < 4; $j++){
        $food = $html->find('table', 2)->find('tr',$j)->children(4)->plaintext;
        $food = cleanUpString($food);
        array_push($foodList, $food);
    }
    $sql = "UPDATE cafeteria_student_bm SET setMenu = '$foodList[0]', oneMenu = '$foodList[1]', snackMenu = '$foodList[2]', date = '$date' WHERE id = $id + 2";    
    //$sql = "INSERT into cafeteria_student_bm(setMenu, oneMenu, snackMenu, date) VALUES('$foodList[0]', '$foodList[1]', '$foodList[2]', '$date');";
    if(mysqli_query($connect, $sql)) { 
        echo "cafeteria_student_bm update success<br>";
        $time = date("Y-m-d  H:i:s");
        $sql = "UPDATE cafeteria_update_time SET time = '$time' WHERE id = 6";
        if(mysqli_query($connect, $sql)) { echo "cafeteria_update_time update success<br>";}
        else { echo "cafeteria_update_time update fail<br>"; }
    }
    else { echo "cafeteria_student_bm update fail<br>"; }

    $html = file_get_html("http://hanlim.donga.ac.kr/SubPage/SUB001002/SUB001002007.asp?seldate=".date("Y-m-d",strtotime ("+".$id." days")));
    $foodList = array();
    for($j = 1; $j < 4; $j++){
        $food = $html->find('table', 14)->find('tr', $j)->find('td', 1)->plaintext;
        $food = cleanUpString($food);
        array_push($foodList, $food);
    }
    /*원래는 조식, 중식, 양식이지만 일관성을 위해 정식, 일품, 양분식으로 통일*/
    $sql = "UPDATE cafeteria_domitory_sh SET Breakfast = '$foodList[0]', Lunch = '$foodList[1]', Dinner = '$foodList[2]', date = '$date' WHERE id = $id + 2";    
    //$sql = "INSERT into cafeteria_domitory_sh(setMenu, oneMenu, snackMenu, date) VALUES('$foodList[0]', '$foodList[1]', '$foodList[2]', '$date');";
    if(mysqli_query($connect, $sql)) { 
        echo "cafeteria_domitory_sh update success<br>";
        $time = date("Y-m-d  H:i:s");
        $sql = "UPDATE cafeteria_update_time SET time = '$time' WHERE id = 7";
        if(mysqli_query($connect, $sql)) { echo "cafeteria_update_time update success<br>";}
        else { echo "cafeteria_update_time update fail<br>"; }
    }
    else { echo "cafeteria_domitory_sh update fail<br>"; }
}
?>
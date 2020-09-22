<?php
include 'connect.php';
include 'simplehtmldom_1_8_1.php';
date_default_timezone_set('Asia/Seoul');
$sql = "SELECT url FROM calendar_time_url";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result);
$url = $row['url'];
$html = file_get_html($url);
$semester1 = 11; // 1학기 일정 갯수
$semester2 = 12; // 2학기 일정 갯수
$calendarSize = $semester1 + $semester2; // 전체학기 일정 갯수
$calendarTable = array(
    "1학기일정" => 9,
    "1학기업무" => 10,
    "2학기일정" => 11,
    "2학기업무" => 12,
);

for($id = 0; $id < $calendarSize; $id++){
    if($id < $semester1){
        $date_ex[0] = 0;
        $date_ex2[0] = 0;
        $date = $html->find('table', $calendarTable["1학기일정"])->find('td', $id)->plaintext;
        $calendar = $html->find('table', $calendarTable["1학기업무"])->find('td', $id)->plaintext;
        $date = str_replace("&#8729; ", "", $date);
        $date = str_replace(".","-",$date);
        $date = explode('~', $date);
        $date_ex = explode('-',$date[0]);
        $date_ex2 = explode('-',$date[1]);
        $date = $date_ex[0]."-".$date_ex[1]."-".$date_ex[2];
        $date = str_replace(" ","",$date);
        $date = date('Y-m-d',strtotime($date));
        $week = array("(일)","(월)","(화)","(수)","(목)","(금)","(토)");
        $date_week = $week[(date('w',strtotime($date)))];
        if($date_ex2[0]!="")
        {
            if(isset($date_ex2[3]))
            {
                $date2 = $date_ex2[0]."-".$date_ex2[1]."-".$date_ex2[2];
                $date2 = str_replace(" ","",$date2);
                $date2 = date('Y-m-d',strtotime($date2));
                $date_week2 = $week[(date('w',strtotime($date2)))];
            }
            else
            {
                $date2 = $date_ex[0]."-".$date_ex2[0]."-".$date_ex2[1];
                $date2 = str_replace(" ","",$date2);
                $date2 = date('m-d',strtotime($date2));
                $date2_week_temp = '2020-'.$date2;
                $date2_week_temp = date('Y-m-d',strtotime($date2_week_temp));
                $date_week2 = $week[(date('w',strtotime($date2_week_temp)))];
            }

            $date_ans = $date.$date_week." ~ ".$date2.$date_week2;
        }
        else
        {
            $date2 = "";
            $date_week2 = "";
            $date_ans = $date.$date_week;
        }

        $sql = "UPDATE calendar_info SET semester = 1, date = '$date_ans', calendar = '$calendar' WHERE id = $id + 1";
        if(mysqli_query($connect, $sql)){
            echo "update success ";
            $time = date("Y-m-d  H:i:s");
            $sql = "UPDATE calendar_time_url SET time = '$time' WHERE id = 1";
            if(mysqli_query($connect, $sql)){echo "update_time success";}
            else{echo "update_time success";}
        }
        else{echo "update failed";}
    }
    else {
        $date = $html->find('table', $calendarTable["2학기일정"])->find('td', $id - $semester1)->plaintext;
        $calendar = $html->find('table', $calendarTable["2학기업무"])->find('td', $id - $semester1)->plaintext;
        $date = str_replace("&#8729; ", "", $date);
        $date = str_replace(".","-",$date);
        $date = explode('~', $date);
        $date_ex = explode('-',$date[0]);
        $date_ex2 = explode('-',$date[1]);
        $date = $date_ex[0]."-".$date_ex[1]."-".$date_ex[2];
        $date = str_replace(" ","",$date);
        $date = date('Y-m-d',strtotime($date));
        $week = array("(일)","(월)","(화)","(수)","(목)","(금)","(토)");
        $date_week = $week[(date('w',strtotime($date)))];
        if($date_ex2[0]!="")
        {
            if(isset($date_ex2[3]))
            {
                $date2 = $date_ex2[0]."-".$date_ex2[1]."-".$date_ex2[2];
                $date2 = str_replace(" ","",$date2);
                $date2 = date('Y-m-d',strtotime($date2));
                $date_week2 = $week[(date('w',strtotime($date2)))];
            }
            else
            {
                $date2 = $date_ex[0]."-".$date_ex2[0]."-".$date_ex2[1];
                $date2 = str_replace(" ","",$date2);
                $date2 = date('m-d',strtotime($date2));
                $date2_week_temp = '2020-'.$date2;
                $date2_week_temp = date('Y-m-d',strtotime($date2_week_temp));
                $date_week2 = $week[(date('w',strtotime($date2_week_temp)))];
            }

            $date_ans = $date.$date_week." ~ ".$date2.$date_week2;
        }
        else
        {
            $date2 = "";
            $date_week2 = "";
            $date_ans = $date.$date_week;
        }

        $sql = "UPDATE calendar_info SET semester = 2, date = '$date_ans', calendar = '$calendar' WHERE id = $id + 1";
        if(mysqli_query($connect, $sql)){
            echo "update success ";
            $time = date("Y-m-d  H:i:s");
            $sql = "UPDATE calendar_time_url SET time = '$time' WHERE id = 1";
            if(mysqli_query($connect, $sql)){echo "update_time success";}
            else{echo "update_time success";}
        }
        else{echo "update failed";}
    }
    echo "<br>";
}
?>
<?php
header('Content-Type: application/json; charset=utf-8');
    function createCalendarJson(){
        include 'connect.php';
        $sql = "SELECT *FROM calendar_info";
        $calendar = array();
        if($result = mysqli_query($connect, $sql)){
            while($row = mysqli_fetch_array($result)){
                $calendar_info = array(
                    "date" => $row["date"],
                    "calendar" => $row["calendar"]
                );
                array_push($calendar, $calendar_info);
            }
        return $calendar;
        }
        else{
            echo "Connection failed";
        }
    }
    $calendar = array(
        "result" => createCalendarJson()
    );
    echo json_encode($calendar, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
?>

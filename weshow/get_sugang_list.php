<?php
include "year_smt_set.php";
$url = "https://sugang.donga.ac.kr/Login.aspx";
$ckfile = tempnam("/tmp", "CURLCOOKIE");
$useragent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0 Safari/605.1.15';

if(isset($_POST['college']))
{
	$ddlcollege = $_POST['college'];
}
if(isset($_POST['depart']))
{
	$ddldepart = $_POST['depart'];
}
if(isset($_POST['maj']))
{
	$ddlmaj = $_POST['maj'];
}
if(isset($_POST['id']))
{
	$username = $_POST['id'];
}
if(isset($_POST['pwd']))
{
	$password = $_POST['pwd'];
}



//------------------------------------------viewstate 파싱
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_COOKIEJAR, $ckfile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, $useragent);

$html = curl_exec($ch);

curl_close($ch);

preg_match('~<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="(.*?)" />~', $html, $viewstate);
preg_match('~<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="(.*?)" />~', $html, $eventValidation);

$viewstate = $viewstate[1];
$eventValidation = $eventValidation[1];

//------------------------------------------viewstate 파싱

//------------------------------------------로그인 파트
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, $ckfile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $ckfile);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_REFERER, $url);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_STDERR, $f);
curl_setopt($ch, CURLOPT_USERAGENT, $useragent);

$postfields = array();
$postfields['__EVENTTARGET'] = '';
$postfields['__EVENTARGUMENT'] = "";
$postfields['__VIEWSTATE'] = $viewstate;
$postfields['__EVENTVALIDATION'] = $eventValidation;
$postfields['ID'] = $username;
$postfields['PASSWD'] = $password;
$postfields['ibtnLogin.x'] = '0';
$postfields['ibtnLogin.y'] = '0';

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
curl_exec($ch);
$url = "http://sugang.donga.ac.kr/SUGANGLECTIME.aspx";
curl_setopt ($ch, CURLOPT_URL, $url);   // 로그인후 이동할 페이지
curl_setopt($ch, CURLOPT_COOKIEFILE, $ckfile); 

//------------------------------------------viewstate 파싱
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_COOKIEJAR, $ckfile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $ckfile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, $useragent);

$html = curl_exec($ch);

curl_close($ch);

preg_match('~<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="(.*?)" />~', $html, $viewstate);
preg_match('~<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="(.*?)" />~', $html, $eventValidation);


$viewstate = $viewstate[1];
$eventValidation = $eventValidation[1];

//------------------------------------------viewstate 파싱

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, $ckfile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $ckfile);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_REFERER, $url);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_STDERR, $f);
curl_setopt($ch, CURLOPT_USERAGENT, $useragent);

$postfields = array();
$postfields['__EVENTTARGET'] = '';
$postfields['__EVENTARGUMENT'] = '';
$postfields['__VIEWSTATE'] = $viewstate;
$postfields['__LASTFOCUS'] = '';
$postfields['__EVENTVALIDATION'] = $eventValidation;
$postfields['radiosel'] = '';
$postfields['YEAR'] = '';
$postfields['SMT'] = '';
$postfields['COLL'] = '';
$postfields['DPT'] = '';
$postfields['MAJOR'] = '';
$postfields['COMDIV'] = '';
$postfields['txtCuri'] = '';
$postfields['txtCuriNm'] = '';



$ch = curl_init($url);
curl_setopt($ch, CURLOPT_COOKIEJAR, $ckfile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $ckfile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
$html = curl_exec($ch);

curl_close($ch);

preg_match('~<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="(.*?)" />~', $html, $viewstate);
preg_match('~<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="(.*?)" />~', $html, $eventValidation);


$viewstate1 = $viewstate[1];
$eventValidation1 = $eventValidation[1];

//------------------------------------------viewstate 파싱
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, $ckfile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $ckfile);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_REFERER, $url);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_STDERR, $f);
curl_setopt($ch, CURLOPT_USERAGENT, $useragent);

$postfields = array();
$postfields['__EVENTTARGET'] = '';
$postfields['__EVENTARGUMENT'] = '';
$postfields['__VIEWSTATE'] = $viewstate;
$postfields['__LASTFOCUS'] = '';
$postfields['__EVENTVALIDATION'] = $eventValidation;
$postfields['radiosel'] = '';
$postfields['YEAR'] = '';
$postfields['SMT'] = '';
$postfields['COLL'] = '';
$postfields['DPT'] = '';
$postfields['MAJOR'] = '';
$postfields['COMDIV'] = '';
$postfields['txtCuri'] = '';
$postfields['txtCuriNm'] = '';

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_COOKIEJAR, $ckfile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $ckfile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
$html = curl_exec($ch);

curl_close($ch);

preg_match('~<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="(.*?)" />~', $html, $viewstate2);
preg_match('~<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="(.*?)" />~', $html, $eventValidation2);


$viewstate2 = $viewstate2[1];
$eventValidation2 = $eventValidation2[1];

//------------------------------------------viewstate 파싱

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, $ckfile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $ckfile);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_REFERER, $url);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_STDERR, $f);
curl_setopt($ch, CURLOPT_USERAGENT, $useragent);

$postfields = array();
$postfields['__EVENTTARGET'] = '';
$postfields['__EVENTARGUMENT'] = '';
$postfields['__VIEWSTATE'] = $viewstate;
$postfields['__LASTFOCUS'] = '';
$postfields['__EVENTVALIDATION'] = $eventValidation;
$postfields['radiosel'] = '';
$postfields['YEAR'] = '';
$postfields['SMT'] = '';
$postfields['COLL'] = '';
$postfields['DPT'] = '';
$postfields['MAJOR'] = '';
$postfields['COMDIV'] = '';
$postfields['txtCuri'] = '';
$postfields['txtCuriNm'] = '';



$ch = curl_init($url);
curl_setopt($ch, CURLOPT_COOKIEJAR, $ckfile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $ckfile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
$html = curl_exec($ch);

curl_close($ch);

preg_match('~<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="(.*?)" />~', $html, $viewstate3);
preg_match('~<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="(.*?)" />~', $html, $eventValidation3);


$viewstate3 = $viewstate3[1];
$eventValidation3 = $eventValidation3[1];

//------------------------------------------viewstate 파싱
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, $ckfile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $ckfile);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_REFERER, $url);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_STDERR, $f);
curl_setopt($ch, CURLOPT_USERAGENT, $useragent);

$postfields = array();
$postfields['__EVENTTARGET'] = '';
$postfields['__EVENTARGUMENT'] = '';
$postfields['__VIEWSTATE'] = $viewstate;
$postfields['__LASTFOCUS'] = '';
$postfields['__EVENTVALIDATION'] = $eventValidation;
$postfields['radiosel'] = '';
$postfields['YEAR'] = '';
$postfields['SMT'] = '';
$postfields['COLL'] = '';
$postfields['DPT'] = '';
$postfields['MAJOR'] = '';
$postfields['COMDIV'] = '';
$postfields['txtCuri'] = '';
$postfields['txtCuriNm'] = '';
$postfields['ibtnSearch.x'] = '20';
$postfields['ibtnSearch.y'] = '18';


curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
$html = curl_exec($ch);

curl_close($ch);

preg_match('~<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="(.*?)" />~', $html, $viewstate4);
preg_match('~<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="(.*?)" />~', $html, $eventValidation4);


$viewstate4 = $viewstate4[1];
$eventValidation4 = $eventValidation4[1];

curl_close($ch);
unlink($ckfile);
unset($ch);
header('Content-Type:text/html;charset=utf8');
$dom = new DOMDocument();
$dom->loadHTML($html);
$xpath = new DOMXPath($dom);
$htmltd = $xpath->query("//td");
$htmlonclick = $xpath->query("//@onclick");
// print_r($ans_kyo_link);
$for_cnt = 1;
$change_flag = 0;
$arr_cnt = 0;
$json_list_arr = array();
$link_count = 1;
for($i=3; $i<$htmltd->length; $i+=$for_cnt)
{
	if(utf8_decode($htmltd->item($i)->nodeValue) === "비고")
	{
		$print_flag = 1;
		continue;
	}
	if($print_flag == 1 && $change_flag == 0)
	{
		$for_cnt = 22;
		$change_flag = 1;
	}
	if($print_flag == 1)
	{
		$kyo_link_dump = utf8_decode($htmlonclick->item($link_count)->nodeValue);
		$kyo_link_dump = explode("'", $kyo_link_dump); //1,3,5,7,9
		$kyo_link = "http://student.donga.ac.kr/Univ/SUE/SSUE0052.aspx?gd=01&year=".$kyo_link_dump[1]."&smt=".$kyo_link_dump[3]."&cn=".$kyo_link_dump[5]."&cc=".$kyo_link_dump[7]."&gbn=".$kyo_link_dump[9];
		$link_count++;
		$ans0 = utf8_decode($htmltd->item($i)->nodeValue);
		$ans1 = utf8_decode($htmltd->item($i+1)->nodeValue);
		$ans2 = utf8_decode($htmltd->item($i+2)->nodeValue);
		$ans3 = utf8_decode($htmltd->item($i+3)->nodeValue);
		$ans4 = utf8_decode($htmltd->item($i+4)->nodeValue);
		$ans5 = utf8_decode($htmltd->item($i+5)->nodeValue);
		$ans6 = utf8_decode($htmltd->item($i+6)->nodeValue);
		$ans7 = utf8_decode($htmltd->item($i+7)->nodeValue);
		$ans8 = utf8_decode($htmltd->item($i+8)->nodeValue);
		$ans9 = utf8_decode($htmltd->item($i+9)->nodeValue);
		$ans10 = utf8_decode($htmltd->item($i+10)->nodeValue);
		$ans11 = utf8_decode($htmltd->item($i+11)->nodeValue);
		$ans12 = utf8_decode($htmltd->item($i+12)->nodeValue);
		$ans13 = utf8_decode($htmltd->item($i+13)->nodeValue);
		$ans14 = utf8_decode($htmltd->item($i+14)->nodeValue);
		$ans15 = utf8_decode($htmltd->item($i+15)->nodeValue);
		$ans16 = utf8_decode($htmltd->item($i+16)->nodeValue);
		$ans17 = utf8_decode($htmltd->item($i+17)->nodeValue);
		$ans18 = utf8_decode($htmltd->item($i+18)->nodeValue);
		$ans19 = utf8_decode($htmltd->item($i+19)->nodeValue);
		$ans20 = utf8_decode($htmltd->item($i+20)->nodeValue);
		$ans21 = utf8_decode($htmltd->item($i+21)->nodeValue);

		$ans0 = preg_replace('/\r\n|\r|\n|\t|\s+/','',$ans0);
		$ans1 = preg_replace('/\r\n|\r|\n|\t|\s+/','',$ans1);
		$ans2 = preg_replace('/\r\n|\r|\n|\t|\s+/','',$ans2);
		$ans3 = preg_replace('/\r\n|\r|\n|\t|\s+/','',$ans3);
		$ans4 = preg_replace('/\r\n|\r|\n|\t|\s+/','',$ans4);
		$ans5 = preg_replace('/\r\n|\r|\n|\t|\s+/','',$ans5);
		$ans6 = preg_replace('/\r\n|\r|\n|\t|\s+/','',$ans6);
		$ans7 = preg_replace('/\r\n|\r|\n|\t|\s+/','',$ans7);
		$ans8 = preg_replace('/\r\n|\r|\n|\t|\s+/','',$ans8);
		$ans9 = preg_replace('/\r\n|\r|\n|\t|\s+/','',$ans9);
		$ans10 = preg_replace('/\r\n|\r|\n|\t|\s+/','',$ans10);
		$ans11 = preg_replace('/\r\n|\r|\n|\t|\s+/','',$ans11);
		$ans12 = preg_replace('/\r\n|\r|\n|\t|\s+/','',$ans12);
		$ans13 = preg_replace('/\r\n|\r|\n|\t|\s+/','',$ans13);
		$ans14 = preg_replace('/\r\n|\r|\n|\t|\s+/','',$ans14);
		$ans15 = preg_replace('/\r\n|\r|\n|\t|\s+/','',$ans15);
		$ans16 = preg_replace('/\r\n|\r|\n|\t|\s+/','',$ans16);
		$ans17 = preg_replace('/\r\n|\r|\n|\t|\s+/','',$ans17);
		$ans18 = preg_replace('/\r\n|\r|\n|\t|\s+/','',$ans18);
		$ans19 = preg_replace('/\r\n|\r|\n|\t|\s+/','',$ans19);
		$ans20 = preg_replace('/\r\n|\r|\n|\t|\s+/','',$ans20);
		$ans21 = preg_replace('/\r\n|\r|\n|\t|\s+/','',$ans21);

		array_push($json_list_arr,array("Department"=>$ans0,"Grade"=>$ans1,"Division"=>$ans2,"Class_num"=>$ans3,"Class"=>$ans4,"Title"=>$ans5,"Day_night"=>$ans6,"Unit"=>$ans7,"Theory_training"=>$ans8,"Professor"=>$ans9,"Department_limit"=>$ans10,"Seventyfive"=>$ans11,"Grade_limit"=>$ans12,"Teaching"=>$ans13,"Language"=>$ans14,"Virtual"=>$ans15,"Continuous_lecture"=>$ans16,"People_limit"=>$ans17,"Now_people"=>$ans18,"Closure_lecture"=>$ans19,"Time"=>$ans20,"Remarks"=>$ans21,"Link"=>$kyo_link));

		$arr_cnt++;
	}

}
header('Content-Type: application/json; charset=utf-8');

$json_string = json_encode(array("lecture_list_result"=>$json_list_arr),JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
include "edit_sugang_list.php";
$sugangList = json_decode($json_string,true);
$sugangList = $sugangList['lecture_list_result'];
/*object형으로 변환*/
for($i = 0; $i < count($sugangList); $i++){
    $sugangList[$i] = (object)$sugangList[$i];
}

/*시간정보가공*/
for($i = 0; $i < count($sugangList); $i++){
    changeTimeForm($sugangList[$i]);
}
/*같은 분반 합병*/
connectClassTime($sugangList);

/*같은 class 합병*/
connectSameClass($sugangList);

// $json_res = json_encode(array("lecture_list_result"=>$sugangList),JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
// var_dump($sugangList);
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
            $link = $sugang_row[0]->Link;
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
                // array_push($list_arr,array());
                array_push($list_arr,array('Class'=>$class,'Now_people'=>$now_people,'People_limit'=>$people_limit,'Time'=>$time_arr));
            }
            $sugang_arr = array_merge($sugang_arr,array('Time_List'=>$list_arr));
            // var_dump($sugang_arr);
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
            $link = $sugang_row->Link;
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
            // var_dump($sugang_arr);
            array_push($result_arr,array('Lecture'=>$sugang_arr));
            // var_dump($list_arr);
            // array_push($result_arr,array('Lecture'=>$list_arr));
        }
}
echo json_encode(array("lecture_list_result"=>$result_arr),JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
?>

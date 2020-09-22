<?php
include "year_smt_set.php";
if(isset($_POST['college']))
{
	$ddlcollege = $_POST['college'];
}
if(isset($_POST['depart']))
{
	$ddldepart = $_POST['depart'];
}
if(isset($_POST['id']))
{
	$username = $_POST['id'];
}
if(isset($_POST['pwd']))
{
	$password = $_POST['pwd'];
}
	$url = "https://sugang.donga.ac.kr/Login.aspx";
	$ckfile = tempnam("/tmp", "CURLCOOKIE");
	$useragent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0 Safari/605.1.15';
	//------------------------------------------viewstate 파싱
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $ckfile);
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
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
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
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
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
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
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
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
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
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
	$html = curl_exec($ch);
	$dom = new DOMDocument();
	$dom->loadHTML($html);
	$xpath = new DOMXPath($dom);
	$htmlMajor = $xpath->query("//select[@name='ddlMajor']/option/@value");
	$htmlMajor_ko = $xpath->query("//select[@name='ddlMajor']/option");
	$Major_list_array = array();
	$k=0;
	for($j=1; $j<$htmlMajor->length; $j++)
	{
		$htmlMajor_result_arrtemp = $htmlMajor->item($j)->nodeValue;

		$htmlMajor_ko->item($j)->nodeValue;
		$htmlMajor_ko_result_temp = $htmlMajor_ko->item($j)->nodeValue;
		$htmlMajor_ko_result_temp = str_replace("·", "?", $htmlMajor_ko_result_temp);
		$htmlMajor_ko_result_temp = utf8_decode($htmlMajor_ko_result_temp);
		$htmlMajor_ko_result_temp = str_replace("?", "·", $htmlMajor_ko_result_temp);
		$htmlMajor_ko_result_arrtemp = $htmlMajor_ko_result_temp;
		array_push($Major_list_array,array("Major"=>$htmlMajor_result_arrtemp,"Major_ko"=>$htmlMajor_ko_result_arrtemp));
		// echo $htmlMajor_ko_result_temp."<br>";
		$k++;
	}
	
	curl_close($ch);

	preg_match('~<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="(.*?)" />~', $html, $viewstate3);
	preg_match('~<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="(.*?)" />~', $html, $eventValidation3);


	$viewstate3 = $viewstate3[1];
	$eventValidation3 = $eventValidation3[1];

	curl_close($ch);
	unlink($ckfile);
	// print_r($htmlMajor_result);
	// print_r($htmlMajor_ko_result);
	header('Content-Type: application/json; charset=utf-8');
	if(count($Major_list_array) == 0)
	{
		array_push($Major_list_array,array("Major"=>"-1","Major_ko"=>"-1"));
		echo json_encode(array("result"=>$Major_list_array),JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
	}
	else
	{
		echo json_encode(array("result"=>$Major_list_array),JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
	}
	
	



?>

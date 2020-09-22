<?php
header('Content-Type:text/html;charset=utf8');
$url = "https://sugang.donga.ac.kr/Login.aspx";
$ckfile = tempnam("/tmp", "CURLCOOKIE");
$useragent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0 Safari/605.1.15';



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
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
$html = curl_exec($ch);
// $html = mb_convert_encoding($html, 'HTML-ENTITIES', "UTF-8");
// $html = htmlspecialchars_decode($html);
curl_close($ch);
unlink($ckfile);
unset($ch);

preg_match('~<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="(.*?)" />~', $html, $viewstate);
preg_match('~<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="(.*?)" />~', $html, $eventValidation);


$viewstate1 = $viewstate[1];
$eventValidation1 = $eventValidation[1];

header('Content-Type:text/html;charset=utf8');
$dom = new DOMDocument();
$dom->loadHTML($html);
$xpath = new DOMXPath($dom);
$htmlColl = $xpath->query("//select[@name='college']/option/@value");
$htmlColl_ko = $xpath->query("//select[@name='college']/option");
$j = 0;
for($i=1; $i<$htmlColl->length; $i++)
{
	$college_result[$j] = $htmlColl->item($i)->nodeValue;
	$htmlColl_ko_result_temp = $htmlColl_ko->item($i)->nodeValue;
	$htmlColl_ko_result_temp = str_replace("·", "?", $htmlColl_ko_result_temp);
	$htmlColl_ko_result_temp = utf8_decode($htmlColl_ko_result_temp);
	$htmlColl_ko_result_temp = str_replace("?", "·", $htmlColl_ko_result_temp);
	$htmlColl_ko_result[$j] = $htmlColl_ko_result_temp;
	$j++;
}
// print_r($college_result);
// var_dump($htmlColl_ko_result);
?>

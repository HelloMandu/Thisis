<?php
include "connect.php";
include "year_smt_set.php";
include "get_coll_list.php";

if(isset($_POST['id']))
{
	$username = $_POST['id'];
}
if(isset($_POST['pwd']))
{
	$password = $_POST['pwd'];
}



for($i=0; $i<count($ddlColl_result); $i++)
{
	$url = "https://sugang.donga.ac.kr/Login.aspx";
	$ckfile = tempnam("/tmp", "CURLCOOKIE");
	$useragent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0 Safari/605.1.15';

	
	$ddlDpt_result = array();
	echo $htmlColl_ko_result[$i]."(단과대학 코드 : ".$ddlColl_result[$i].") 소속학과 파싱 Processing...<br>";
	$ddlColl = $ddlColl_result[$i];
	$ddlColl_ko = $htmlColl_ko_result[$i];

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
	$dom = new DOMDocument();
	$dom->loadHTML($html);
	$xpath = new DOMXPath($dom);
	$htmlDpt = $xpath->query("//select[@name='ddlDpt']/option/@value");
	$htmlDpt_ko = $xpath->query("//select[@name='ddlDpt']/option");
	$k=0;
	echo ($htmlDpt->length);
	if(($htmlDpt->length) == 1)
	{
		$sql_select = "SELECT * FROM sugang_ddl_depth WHERE Coll ='".$ddlColl."' AND Dpt = '0'";
		$result_select = mysqli_query($connect, $sql_select);
		if(mysqli_num_rows($result_select) == 0)
		{
			$sql_insert = "INSERT INTO sugang_ddl_depth(Coll,Coll_ko,Dpt,Dpt_ko) VALUES('".$ddlColl."','".$ddlColl_ko."','-1','-1')";
			mysqli_query($connect, $sql_insert);
		}
	}
	for($j=1; $j<$htmlDpt->length; $j++)
	{
		$ddlDpt_result[$k] = $htmlDpt->item($j)->nodeValue;
		$htmlDpt_ko_result_temp = $htmlDpt_ko->item($j)->nodeValue;
		$htmlDpt_ko_result_temp = str_replace("·", "?", $htmlDpt_ko_result_temp);
		$htmlDpt_ko_result_temp = utf8_decode($htmlDpt_ko_result_temp);
		$htmlDpt_ko_result_temp = str_replace("?", "·", $htmlDpt_ko_result_temp);
		// echo $htmlDpt_ko_result_temp;
		$htmlDpt_ko_result[$k] = $htmlDpt_ko_result_temp;
		$ddlDpt_temp = $htmlDpt->item($j)->nodeValue;
		$sql_select = "SELECT * FROM sugang_ddl_depth WHERE Coll ='".$ddlColl."' AND Dpt = '".$ddlDpt_temp."'";
		$result_select = mysqli_query($connect, $sql_select);
		if(mysqli_num_rows($result_select) == 0)
		{
			$sql_insert = "INSERT INTO sugang_ddl_depth(Coll,Coll_ko,Dpt,Dpt_ko) VALUES('".$ddlColl."','".$ddlColl_ko."','".$ddlDpt_temp."','".$htmlDpt_ko_result_temp."')";
			mysqli_query($connect, $sql_insert);
		}
		$k++;
	}
	print_r($ddlDpt_result);
	print_r($htmlDpt_ko_result);
	echo "<br><br>";
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
	// echo $html;
	curl_close($ch);
	unlink($ckfile);
	unset($ch);
	
}

mysqli_close($connect);

?>

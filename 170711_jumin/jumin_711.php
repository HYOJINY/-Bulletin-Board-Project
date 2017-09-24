<?php
/**
 * Created by PhpStorm.
 * User: Jiny
 * Date: 2017-07-11
 * Time: 오후 3:58
 */
phpinfo();
$jumin = $_GET['jumin'];


$splitJumin = explode("-", $jumin);
$newJumin = $splitJumin[0] . $splitJumin[1];

//유효성 검사
//과제 : 정규 표현식 사용
$isCorrect = false;
$sum = 0;
for ($count = 0; $count < 12; $count++) {
    if ($count <= 7)
        $sum += $newJumin[$count] * ($count + 2);
    else
        $sum += $newJumin[$count] * ($count - 6);
}

$check = 11 - ($sum % 11);

if ($check >= 10)
    $check -= 10;


if ($check != $newJumin[12])
    $isCorrect = false;
else
    $isCorrect = true;

/*
 * if($isCorrect)
 *  func_correct();
 * else
 *  echo '유효하지 않은 주민등록 번호입니다.";
 * */

//과제 : 함수쓰기기/*여기서 부터는 func_correct()에 들어갈 내용*/

//남녀 판별
$isMale = false;
if ($newJumin[6] == 1 || $newJumin[6] == 3)
    $isMale = true;
else
    $isMale = false;


//생년월일
if ($newJumin[6] == 3 || $newJumin[6] == 4)
    $birthY = 2000 + substr($newJumin, 0, 2);
else
    $birthY = 1900 + substr($newJumin, 0, 2);

$birthMD = substr($newJumin, 2, 4);
$birthTs = strtotime($birthY.$birthMD);


//D-day
$nowY = date("Y");
$nowbirthTs = strtotime($nowY.$birthMD);

if (date('z', time()) <= date('z', $nowbirthTs)) {
    $dDay = date('z', $nowbirthTs) - date('z', time());
    $gijun = "올해";
} else {
    $dDay = date('z', strtotime("+1 years", $nowbirthTs) - time()) + 1;
    $gijun = "내년";
}


//만 나이

//개월 수
$i=0;
for ($i = 1; ; $i++) {
    $t = strtotime("+$i months", $birthTs);
    if (time()< $t)
        break;
}

$dal = $i - 1;
$il = intval((time() - strtotime("+$dal months",$birthTs)) / 86400);
//echo $dal."개월 ".$il."일을 사셨습니다.";


//출력
if ($isCorrect) {
    echo $jumin . " : " . ($isMale ? "남성" : "여성") . "<br>";
    echo "유효한 주민번호 입니다.<br>";
    echo "생년월일은 " . date("Y년 n월 j일 입니다.", $birthTs) . "<br>";
    echo $dDay == 0 ? "생일 축하합니다!!!" : $gijun . " 생일 D-day : " . $dDay."일<br>";
    echo $dal."개월 ".$il."일을 사셨습니다.";

} else
    echo "유효하지 않은 주민번호";

//과제
//예외처리 : 전체 길이 , 하이픈있을 수도 있고 없을 수도 있고 == 정규 표현식으로 예외처리
//현재 시간 출력해보기 초마다 갱신되게




<?php
/**
 * Created by PhpStorm.
 * User: Jiny
 * Date: 2017-07-10
 * Time: 오후 3:21
 */
$str = $_GET['send'];

$array = explode(" ", $str);

$strNew = "";


//\, * 계산
for ($i = 0; $i < count($array); $i++) {
    if ($array[$i] == '/' || $array[$i] == '*') {
        if ($array[$i] == '/')
            $array[$i + 1] = $array[$i - 1] / $array[$i + 1];
        else
            $array[$i + 1] = $array[$i - 1] * $array[$i + 1];

        $array[$i - 1] = null;
        $array[$i] = null;
    }
}

//파싱
for ($i = 0; $i < count($array); $i++) {
    if (!empty($array[$i]))
        $strNew .= $array[$i];
}


$strNew = str_replace("-", "+-", $strNew);
$array = explode("+", $strNew);
$result = 0;
for ($i = 0; $i < count($array); $i++)
    $result += $array[$i];
echo $str;
echo " = ";
echo $result;
/*
 *
$arrayGi = array();
$arrayNew = array();
for ($i = 0; $i < count($array); $i++) {
    if(!empty($array[$i])) {
        if (preg_match('/^(0|[1-9][0-9]*)$/', $array[$i]))
            array_push($arrayNew, $array[$i]);
        else
            array_push($arrayGi, $array[$i]);
    }
}


//+, - 계산
$op1 = 0;
$op2 = 0;
$result = 0;
for ($i = 0; $i <= count($arrayGi); $i++) {
    $op2 = array_pop($arrayNew);
    $op1 = array_pop($arrayNew);

    switch (array_pop($arrayGi)){
        case '+':
            $result=$op1+$op2;
            break;
        case '-':
            $result=$op1-$op2;
            break;
    }

    array_push($arrayNew, $result);
}
*/
//현우 방식으로도 해보기

/*echo  $str;
echo  " = ";
echo  array_pop($arrayNew);*/

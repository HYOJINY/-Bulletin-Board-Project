<?php
/*
$a = 'jin';
Function pf(){
    global $a;
    echo $a;
}

pf();
?>

<?php
echo $a;


class cyka{
    function __construct($arg){

        echo $arg."sansungja";
    }

    function __distruct($arg){

        echo $arg."somyurja";
    }
}

$a = new cyka("arg");*/
/*
$a = "a";
echo chr(ord($a)+1);
*/
/*
$test = array(0 => 0);
$test[] = 5;
var_dump($test);
$test[0] = "Sss";

var_dump($test);
*/
/*
echo "<meta charset='UTF-8'>";
$output = `dir`;
echo $output;
*/
/*
$arr[5] = "cyka1";
$arr[6] = "cyka2";
$arr['apple'] = 'red';
$arr['mango']='yellow';
$arr['watermelon']='green';
$arr[]='cyka4';

foreach($arr as $k=>$v)
    echo $k.$v."<br>";

$arr2 =array('a'=>"안녕하세요..1",  5=>"안녕하세요..3", "안녕하세요..2");
$arr2[4] = "안녕하세요..4";
foreach ($arr2 as $a=>$b)
    echo $a." : ".$b."<br>";

*/
/*
$a[][] = "국어 0 0";
$a[] = "수학 0 1";

$a[2][2] = "hoho 2 2";
var_dump($a);
*/
/*
for($i = 0; $i < count($a); $i++)
    for($k=0; $k < count($a[$i]); $k++)
        echo $a[$i][$k]."<br>";

echo "<br>";
*/
/*
$a[0] = 0;
$a[2] = 2;
$a[5] = 5;
$a[3] = 1;
//인덱스와 밸류의 쌍이 무너진다
//값을 기준으로 오름차순
//sort($a);

//인덱스와 밸류의 쌍을 유지
//값을 기준으로 오름차순
//asort($a);

//인덱스와 밸류의 쌍이 무너진다
//값을 기준으로 내림차순
//rsort($a);

//인덱스와 밸류의 쌍을 유지
//값을 기준으로 내림차순
//arsort($a);


//인덱스와 밸류의 쌍을 유지
//값을 기준으로 내림차순
//ksort($a);

//인덱스와 밸류의 쌍을 유지
//키값을 기준으로 오름차순
//ksort($a);

//인덱스와 밸류의 쌍을 유지
//키값을 기준으로 내림차순
//krsort($a);
//print_r($a);
/*
$b[] = 1;
$b[] = 11;
$b[] = 2;
$b[] = 23;

natsort($b);
print_r($b);
*/
/*
$info = '1601232_이효진.txt';
list($num, $name, $file) = sscanf($info, '%d_%[^.].%s');


echo '<pre>';
print($num);
echo '<hr />';
print($name);
echo '<hr />';
print($file);
echo '</pre>';*/


//echo disk_free_space("/")."<br>";


echo $_SESSION['ttt'];

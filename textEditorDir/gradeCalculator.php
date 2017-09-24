<?php
include 'mysqlUserInfo.php';
include 'view.php';
include 'model.php';

$op   = $_POST['op'];

@$pname = $_POST['pname'];
@$kor  = $_POST['kor'];
@$eng  = $_POST['eng'];
@$math = $_POST['math'];


//예외 처리
//에러 - 1.이름을 입력하지 않았을때, 2.과목점수를 입력하지 않았을때, 숫자가 아닐때
$model = model($op, $pname , $kor , $eng, $math);

if(is_string($model))
    echo $model;
else
    echo makeHtmlElement($model);
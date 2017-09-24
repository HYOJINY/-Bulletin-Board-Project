<?php

include 'model2.php';
include 'info.php';
include "view2.php";
/**
 * Created by PhpStorm.
 * User: Jiny
 * Date: 2017-07-19
 * Time: 오후 2:51
 */
//dbms 연결

//값 받아오기
@$mode = $_POST['op'];

@$pname = $_POST['pname'];
@$kor = $_POST['kor'];
@$eng = $_POST['eng'];
@$math = $_POST['math'];
$delId = '';


try {

    $dataArr = [$pname, $kor, $eng, $math];
    //db 연결 -> link identifier 반환
    $linkId = getLinkId(SERVER, ID, PWD, DB);

    //쿼리 실행
    //쿼리의 결과 값이 boolean이면 (insert, delete)
    $delId = ($mode == 'del' ? $_POST['delId'] : '');

    @$recordsArr = query($mode, TABLE, $dataArr, $delId, $linkId);

    //값 출력하기
    echo view($recordsArr);

    //쿼리의 결과 값이 records of false이면 (select)


} catch (Exception $e) {
    echo $e->getMessage();
} finally {
    //연결 닫기
    //echo @mysql_close($linkId);
}

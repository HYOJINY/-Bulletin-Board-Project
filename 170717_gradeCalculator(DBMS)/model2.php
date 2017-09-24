<?php
/**
 * Created by PhpStorm.
 * User: Jiny
 * Date: 2017-07-19
 * Time: 오후 4:47
 */

//값 에러 확인
function errorCheck($pname, $kor, $eng, $math)
{
    try {
        //이름이 없는 경우
        if ($pname == "")
            throw new Exception('이름을 입력하세요.');

        //숫자를 입력하지 않은 경우
        $kor = $kor ? $kor : 0;
        $eng = $eng ? $eng : 0;
        $math = $math ? $math : 0;

        //숫자 외 다른 문자가 들어간 경우/수가 범위를 넘었을 때
        if (!preg_match('/^(\d{1}|\d{2}|100)$/', $kor) || !preg_match('/^(\d{1}|\d{2}|100)$/', $eng) || !preg_match('/^(\d{1}|\d{2}|100)$/', $math))
            throw new Exception('올바른 성적 값을 입력하세요.');

    } catch (Exception $e) {
        throw $e;
    }

    $dataArr = [$pname, $kor, $eng, $math];
    return $dataArr;
}


//db연결
function getLinkId($SERVER, $ID, $PWD, $DB)
{
    if (!(@$linkId = mysql_connect($SERVER, $ID, $PWD))) {
        throw new Exception('DBMS 연결실패');
    } else {
        if (!mysql_select_db($DB, $linkId))
            throw new Exception('DB 선택 실패 : ' . mysql_error($linkId));
    }
    return $linkId;
}


function query($mode, $table, $dataArr, $delId, $linkId)
{
    $query = "";
    $returnSet = array();

    try {

        if ($mode == 'ins' || $mode == 'del') {

            if ($mode == 'ins') {
                $dataArr = errorCheck($dataArr[0], $dataArr[1], $dataArr[2], $dataArr[3]);
                $query = "insert into $table values('','" . $dataArr[0] . "', $dataArr[1], $dataArr[2], $dataArr[3])";
            }else
                $query = "delete from $table where id = $delId";

            if (!mysql_query($query, $linkId))
                throw new Exception('쿼리 실패 : ' . mysql_error($linkId));
        }


        $query = "select *, kor+math+eng SUM, round((kor+math+eng)/3, 2) AVG  from $table";
        if ($mode == 'des')
            $query .= 'order by sum desc';
        else if ($mode == 'asc')
            $query .= 'order by sum';

        if (!($recordSet = mysql_query($query, $linkId)))
            throw new Exception('select 쿼리 실패 : ' . mysql_error($linkId));


        while ($value = mysql_fetch_row($recordSet))
            $returnSet[] = $value;

    } catch (Exception $e) {
        throw $e;
    }

    return $returnSet;

}



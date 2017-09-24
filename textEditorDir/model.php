<?php
/**
 * Created by PhpStorm.
 * User: Jiny
 * Date: 2017-07-18
 * Time: 오후 8:17
 */

function model($op, $pname, $kor, $eng, $math)
{
    try {

        $select_query = "";
        $insert_query = "";
        $delete_query = "";
        //매개 변수, 리턴값
        //option, name, kor, eng, math / 리턴 성공 : 2차원 배열 실패 : 익셉션 객체

        //dbms연결
        @$dbHandler = mysql_connect(SERVER, USER1, USER1_PW);

        //db선택
        @$db = mysql_select_db(DB1, $dbHandler);


        if ($op == 'insert') {

            if (!$pname)
                throw new Exception('이름을 입력하세요.');

            //점수 입력값이 아무것도 없을때 0점 처리
            $kor = $kor ? $kor : 0;
            $eng = $eng ? $eng : 0;
            $math = $math ? $math : 0;


            //숫자가 아닐때 & 숫자가 범위를 벗어났을 때
            if (!preg_match('/^(\d{1}|\d{2}|100)$/', $kor) || !preg_match('/^(\d{1}|\d{2}|100)$/', $eng) || !preg_match('/^(\d{1}|\d{2}|100)$/', $math))
                throw new Exception( '올바른 숫자를 입력하세요.');

            $insert_query = "insert into " . TABLE_STD_GRADE . "(name, kor, eng, math) values('" . $pname . "'," . $kor . "," . $eng . "," . $math . ")";
            if (@!mysql_query($insert_query, $dbHandler))
                throw new Exception('insert 실패하였습니다.');

        } else if ($op == 'delete') {
            $id = $_POST['id'];
            $delete_query = 'delete from ' . TABLE_STD_GRADE . " where id=$id";
            @mysql_query($delete_query, $dbHandler);
        }


        //select 쿼리, 레코드 출력 - 모든 옵션 공통 작업
        $select_query = 'select *, (kor+eng+math) AS sum, round((kor+eng+math)/3,2) AS avg  from ' . TABLE_STD_GRADE;
        if ($op == 'ascend')
            $select_query .= ' order by sum';
        else if ($op == 'descend')
            $select_query .= ' order by sum desc';

        @$result = mysql_query($select_query, $dbHandler);

        if(!$result)
            throw new Exception('select 실패하였습니다.');

        $resultArr = array();
        while (@$record = mysql_fetch_row($result))
            $resultArr[] = $record;

        return $resultArr;

    } catch (Exception $e) {
        return $e->getMessage();
    } finally {
        //db 연결 해지
        @mysql_close($dbHandler);
    }
}
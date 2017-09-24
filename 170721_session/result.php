<?php
include 'info.php';
/**
 * Created by PhpStorm.
 * User: Jiny
 * Date: 2017-07-21
 * Time: 오후 4:52
 */

//id pw 값 확인
@$id = $_GET['id'];
@$pw = $_GET['pw'];

session_destroy();


try {
    //값을 제대로 넣지 않았을 경우
    if (!isset($id) || !isset($pw))
        throw new Exception('로그인에 실패하셨습니다.');

    //값을 넣은 경우
    //dbms 연결
    @$link_id = mysql_connect(SERVER, ID, PW);
    //db 선택
    @mysql_select_db(DB_NAME, $link_id);

    //쿼리 실행
    @$records = mysql_query("select * from " . TABLE_NAME . " where id='$id' AND password='$pw'", $link_id);

    if (@mysql_num_rows($records) != 1)
        throw new Exception('로그인에 실패하셨습니다.');


    session_start();

    $_SESSION['login'] = true;

    @$record = mysql_fetch_row($records);

    $_SESSION['name']  = $record[2];
    $_SESSION['age']   = $record[4];
    $_SESSION['level'] = $record[3];


    //성공적 로그인
    echo "성공적으로 로그인 하였습니다.<br>";
    echo "<input type='button' value='회원정보 보기' onclick='(function() {
  location.href = \"index.php\";
})()'>";

} catch (Exception $e) {
    //로그인 실패시
    echo $e->getMessage()."<br>";
    echo "<input type='button' value='다시 입력하기' onclick=
'(function () {location.href = \"index.php\";})()'>";
}






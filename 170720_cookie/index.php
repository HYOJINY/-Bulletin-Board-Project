<?php
/**
 * Created by PhpStorm.
 * User: Jiny
 * Date: 2017-07-20
 * Time: 오후 3:05
 */

//총 방문자 수 - db에서 가져오기
//dbms연결
@$link_id = mysql_connect('localhost', 'user1', 'user1');
//db선택
@mysql_select_db('db1', $link_id);
@$records = mysql_query('select * from idex_count', $link_id);

//총 방문자 수 읽기
@$current = mysql_num_rows($records);
//*var_dump($current);
//쿠키 읽어 오기
@$isset = $_COOKIE['count'];
//*echo $isset.'hhh';
//쿠키가 없으면
if (@!$isset) {
    //쿠키생성
    $current++;
    //*echo $current;
    setcookie('count', $current);
    //echo $current.'hhh';

    if(@!mysql_query("insert into idex_count value('',1)"))
        echo '쿼리 실패'.mysql_error();
}


echo $current;
?>
<?php
/**
 * Created by PhpStorm.
 * User: Jiny
 * Date: 2017-07-17
 * Time: 오후 3:53
 */
$db_con = mysql_connect('localhost','root', 'autoset');

if($db_con)
    echo 'db연결 성공<br>';
else
    echo 'db연결 실패<br>';

if(mysql_close($db_con))
    echo 'db연결 해지 성공<br>';
else
    echo 'db연결 해지 실패<br>';
<?php
/**
 * Created by PhpStorm.
 * User: Jiny
 * Date: 2017-07-26
 * Time: 오후 7:39
 */

include 'connectDB.php';
$board_id = 1;
$link = mysqli_connect(HOST, USER, PWD, DB);
$query = "SELECT subject, user_name, content from ".TABLE." WHERE board_id = $board_id";
$result = mysqli_query($link,$query);
var_dump($result);
echo "<hr>";
$record = mysqli_fetch_row($result);
//var_dump($record);

echo " ' \" $record[0] \",";
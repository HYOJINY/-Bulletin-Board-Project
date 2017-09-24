<?php

/*const HOST = 'localhost';
const USER = 'user1';
const PWD = 'user1';
const DB = 'db1';
const TABLE = 'ci_board';*/
//        0             1           2           3         4          5       6       7
$col = ['board_id', 'board_pid', 'user_id', 'user_name', 'subject', 'content', 'hits', 'reg_date'];

//권한(id) 확인
function connectDB()
{
    $link = mysqli_connect(HOST, USER, PWD, DB);
    return $link;
}


function isExistUser($user_id)
{

}


//select list


//get content
function getContent($board_id)
{
    $link = connectDB();
    $query = "SELECT subject, user_name, content, board_id, hits from " . TABLE . " WHERE board_id = $board_id";
    $result = mysqli_query($link, $query);
    $record = mysqli_fetch_row($result);
    return $record;
}


//insert record
function insert($user_id, $user_name, $subject, $content){

    $link = connectDB();
    $query = "INSERT INTO ". TABLE .  " VALUES(0, 0, '$user_id', '$user_name', '$subject', '$content', 0, '" . date('Y-m-d H:i:s') . "')";

    $result = [mysqli_query($link, $query), mysqli_error($link)];
    return $result;
}
//update - 수정
function update($subject, $content, $board_id)
{
    $link = connectDB();
    global $col;
    //제목 // 시간 // 내용 수정
    $query = "UPDATE " . TABLE . " SET $col[4]='$subject', $col[5]='$content', $col[7]='" . date('Y-m-d H:i:s') . "' WHERE board_id = $board_id";
    $result = [mysqli_query($link, $query), mysqli_error($link)];
    return $result;
}



//delete - 삭제
function delete($board_id)
{
    $link = connectDB();
    $query = "DELETE FROM " . TABLE . " WHERE board_id = $board_id";
    $bool = mysqli_query($link, $query);
    $result = [$bool, mysqli_error($link)];
    return $result;
}
?>
<?php
/**
 * Created by PhpStorm.
 * User: Jiny
 * Date: 2017-09-13
 * Time: 오후 12:29
 */
//db정보
define('DB', 'db2');
define('HOST', 'localhost');
define('USER', 'user2');
define('PWD', 'user2');
define('BOARD_TABLE', 'board');
define('USER_TABLE', 'users');
define('COMMENT_TABLE', 'comment');

//db연결
function connectDB()
{
    $link = mysqli_connect(HOST, USER, PWD, DB);
    return $link;
}

//페이지 네이션
const BOARDS_NUM = 5;

//게시글 리스트
function select($search, $keyword, $pageNum)
{
    //db연결
    $link = connectDB();

    //쿼리 작성
    $query = "SELECT * FROM " . BOARD_TABLE;
    if (!is_null($search)) {
        if ($search == 'all') {
            $query .= " WHERE title like '%$keyword%' OR user like '%$keyword%' OR content like '%$keyword%'";
        } else
            $query .= " WHERE $search like '%$keyword%'";
    }
    $query .= " ORDER BY date DESC";

    //쿼리1 -- 페이지 네이션
    $result = mysqli_query($link, $query);
    //총 레코드 수
    $records_num = mysqli_num_rows($result);
    //총 페이지 수
    $PAGES_NUM = ceil($records_num / BOARDS_NUM);


    //쿼리2 -- 한 페이지
    $query .= " limit " . $pageNum * BOARDS_NUM . ", " . BOARDS_NUM;
    $result = mysqli_query($link, $query);
    $row_num = mysqli_num_rows($result);
    for ($i = 0; $i < $row_num; $i++)
        $records[$i] = mysqli_fetch_row($result);

    if (mysqli_error($link) != '')
        echo mysqli_error($link);

    mysqli_close($link);
    return array($PAGES_NUM, $records);
}

//로그인
function login($user_id, $user_pwd)
{
    $link = connectDB();
    $query = "SELECT * FROM " . USER_TABLE . " WHERE user_id = '$user_id'";
    $result = mysqli_query($link, $query);
    //없는 아이디
    if (mysqli_num_rows($result) == 0)
        return [false, '존재하지 않는 아이디입니다.'];
    else {
        $record = mysqli_fetch_row($result);
        mysqli_close($link);

        //비번 틀림
        if ($record[1] != $user_pwd)
            return [false, '비밀번호를 확인해주세요.'];
        else
            return [true, "{$user_id}님이 로그인 하셨습니다.", $user_id];
    }
}

//쿼리
function insert($title, $contents, $user)
{
    $link = connectDB();
    $query = "INSERT INTO " . BOARD_TABLE . " (title, content, user_id) VALUES('$title', '$contents', '$user')";
    $bool = mysqli_query($link, $query);
    $error = mysqli_error($link);
    mysqli_close($link);

    return [$bool, $error];
}

function delete($board_id)
{
    $link = connectDB();
    $query = "DELETE FROM " . BOARD_TABLE . " WHERE board_id = $board_id";
    $bool = mysqli_query($link, $query);
    $error = mysqli_error($link);
    mysqli_close($link);

    return [$bool, $error];
}

function update($title, $content, $board_id)
{
    $link = connectDB();
    $query = "UPDATE " . BOARD_TABLE . " SET title='$title', content='$content' WHERE board_id = $board_id";
    $bool = mysqli_query($link, $query);
    $error = mysqli_error($link);
    mysqli_close($link);

    return [$bool, $error];
}

//조회수 증가
function lookup($board_id)
{
    $link = connectDB();
    $query = "UPDATE " . BOARD_TABLE . " SET hit = hit+1 WHERE board_id = $board_id";
    mysqli_query($link, $query);
    mysqli_close($link);
    // return mysqli_error($link);
}

//게시판 글 가지고 오기
function getBoard($board_id)
{
    $link = connectDB();
    $query = 'SELECT * FROM ' . BOARD_TABLE . " WHERE board_id = $board_id";
    $result = mysqli_query($link, $query);
    mysqli_error($link);
    mysqli_close($link);
    $record = mysqli_fetch_row($result);
    return $record;
}

//댓글 달기
function comment($board_id, $comment_pid, $comment, $user_id)
{
    $link = connectDB();
    $query = "INSERT INTO " . COMMENT_TABLE . "(board_id, comment_pid, comment, user_id) VALUES($board_id, $comment_pid, '$comment', '$user_id')";
    mysqli_query($link, $query);
}

//댓글 가져오기
function getComments($board_id)
{
    $link = connectDB();
    $query = "SELECT user_id, comment, date, comment_id, comment_pid FROM " . COMMENT_TABLE . " WHERE board_id = $board_id ORDER BY date DESC";
    $result = mysqli_query($link, $query);

    $num = mysqli_num_rows($result);

    $records = [];
    for ($i = 0; $i < $num; $i++)
        $records[$i] = mysqli_fetch_row($result);

    //작성자 ,내용, 수정, 삭제, 댓글

    // print_r($records);
    return $records;
}

//댓글 삭제하기
function deleteComment($comment_id)
{
    $link = connectDB();
    $query = "DELETE FROM " . COMMENT_TABLE . " WHERE comment_id = $comment_id";
    mysqli_query($link, $query);
    echo mysqli_error($link);
}

//댓글 수정하기
function updateComment($comment_id, $comment)
{
    $link = connectDB();
    $query = "UPDATE " . COMMENT_TABLE . " SET comment='$comment' WHERE comment_id=$comment_id";
    mysqli_query($link, $query);
    echo mysqli_error($link);
}

//db 연결
//쿼리 전송
//레코드 받기


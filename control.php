<?php
/**
 * Created by PhpStorm.
 * user_id: Jiny
 * Date: 2017-09-14
 * Time: 오전 11:31
 */
include 'model.php';


if (isset($_SERVER['HTTP_REFERER']))
    $postPage = $_SERVER['HTTP_REFERER'];
else
    $postPage = "./";

//모드 확인
@$mode = $_GET['mode'];
@$title = $_GET['title'];
@$content = $_GET['content'];
@$board_id = $_GET['board_id'];
@$writer_id = $_GET['writer_id'];

$user_id = null;
$login_Condition = null;

//세션 확인
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $login_Condition = true;
} else {
    $user_id = 'anonymous';
    $login_Condition = false;
}


//권한 확인
@$currPage = $_GET['currPage'];
if ($user_id == $writer_id)
    $match = true;
else
    $match = false;

//로그인 템플릿 만들기
function mk_login_template()
{
    global $user_id;
    if ($user_id != 'anonymous') {
        echo "{$user_id}님 접속중";
        echo "<input type='submit' value='로그아웃'>";
        echo "<input type='hidden' name='mode' value='logout'>";
    } else {
        echo "
        <label><input type = 'text' name = 'user_id' required placeholder='아이디'></label >
        <label><input type = 'password' name = 'user_pwd' required placeholder='비밀번호' required ></label >
        <input type = 'hidden' name = 'mode' value = 'login' >
        <input type = 'submit' value = '로그인' >";
    }
}

//로그인
if ($mode == 'login') {
    $result = login($_GET['user_id'], $_GET['user_pwd']);
    //로그인 됐으면 세션 찍기
    if ($result[0]) {
        @session_start();
        $_SESSION['user_id'] = $result[2];
        //echo "location.replace('$postPage&login=true');";
    }
    echo "<script>
            alert('$result[1]');
            location.replace('$postPage');
          </script>";

    //로그인 상태 확인 -- 페이지 마다 세션 정보 얻음 writePage, contentPage, index.php
    //세션 존재 -- 00님 접속중  + logout 버튼
    //세션 없슴 -- login정보 입력창 + login 버튼
}

//로그아웃
if ($mode == 'logout') {
    session_unset();
    session_destroy();
    echo "<script>
            alert('로그아웃 되었습니다.');
            location.replace('$postPage');
          </script>";
}

//조회수
if ($mode == 'lookup') {

    echo "<script>";
    //쿠키확인
    if (!isset($_COOKIE["$board_id"])) {
        //없으면 쿠키 찍고
        @setcookie("$board_id", "hit!");
        //조회수 증가;
        lookup($board_id);
    }

    echo "location.replace('./contentPage.html?currPage=$currPage&board_id=$board_id&user_id=$user_id&writer_id=$writer_id');";
    echo "</script>";
}


// 글쓰기, 수정, 삭제, 댓글   결과 --목록으로
echo "<script>";
if ($mode == 'insert' || $mode == 'delete' || $mode == 'update') {

    $result_arr = array();

    if ($mode == 'insert')
        $result_arr = insert($title, $content, $user_id);
    elseif ($mode == 'delete')
        $result_arr = delete($board_id);
    elseif ($mode == 'update')
        $result_arr = update($title, $content, $board_id);

    $result_bool = $result_arr[0];
    $result_error = $result_arr[1];
    if ($result_bool)
        $result_bool = "$mode 성공";
    else
        $result_bool = "$mode 실패 : ";

    echo "alert('$result_bool $result_error');";

    if ($mode == 'update')
        echo "location.replace('$postPage');";
    else
        echo "location.replace('./');";
}


@$comment = $_GET['comment'];
@$comment_id = $_GET['comment_id'];
@$comment_pid = $_GET['comment_pid'];
@$comment_writer_id = $_GET['comment_writer_id'];


//댓글
if ($mode == 'comment') {
    comment($board_id, $comment_pid, $comment, $user_id);
    echo "alert('댓글이 등록되었습니다.'); location.replace('$postPage');";
}

if ($mode == 'commentDelete') {
    deleteComment($comment_id);
    echo "alert('댓글이 삭제되었습니다.');";
    echo "location.replace('$postPage');";
}
if($mode == 'commentUpdate') {
    updateComment($comment_id, $comment);
    echo "alert('댓글이 수정되었습니다.');";
    echo "location.replace('$postPage');";
}


echo "</script>";




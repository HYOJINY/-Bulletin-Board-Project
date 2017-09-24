<?php
/**
 * Created by PhpStorm.
 * User: Jiny
 * Date: 2017-07-24
 * Time: 오후 2:14
 */
include "connectDB.php";

@$query = $_GET['query'];
@$board_id = $_GET['board_id'];

@$user_id = $_GET['user_id'];
@$user_name = $_GET['user_name'];

@$subject = $_GET['subject'];
@$content = $_GET['content'];


if (@$query == 'delete')
    $result = delete($board_id);
else if (@$query == 'insert') {

//html 엔터티로 전환, 오른쪽 공백/엔터 제거
    @$content = nl2br(rtrim(htmlentities($content)));
    @$subject = nl2br(rtrim(htmlentities($subject)));

//쿼리 실행
    $result = insert($user_id, $user_name, $subject, $content);
}

echo "<style>
    body{
    margin: 0 auto;
    text-align: center;
    }
</style>";

if ($result[0])
    echo "<h1>$query Succeeded!!</h1>";
else
    echo "$query Failed : " . $result[1];
echo "<input type = 'button' value = '목록으로' onclick = '(function () {
        location.replace(inindex.php})()'>";


//로그인, 검색, 날씨(http 긁어오는 함수써서 가져와서 html태그 파싱)
// (($temp = ($currentPage - floor(NUM_PAGES / 2))) > $NUM_ALL_PAGES ? $NUM_ALL_PAGES - NUM_PAGES + 1 : $temp)
//(($temp = ($currentPage - floor(NUM_PAGES / 2))) <= 0 ? 1 : $temp)
<?php
/**
 * Created by PhpStorm.
 * User: Jiny
 * Date: 2017-07-25
 * Time: 오후 1:38
 */
include 'info.php';
const NUM_CONTANTS = 5;
const NUM_PAGES = 5;
const NUM_COLUMN = 5;


//list info
$startContent = 0;
if (isset($_GET['currentPage'])) {
    $currentPage = $_GET['currentPage'];
    $startContent = NUM_CONTANTS * ($currentPage - 1);
} else
    $currentPage = 1;


if (isset($_GET['startPage']))
    $startPage = $_GET['startPage'];
else
    $startPage = 1;


//DBMS 연결
$link = mysqli_connect($host, $user, $pwd, $db);

//select  where 절의 조건
$whereCondition = "board_pid = 0";
if (isset($_GET['mode'])) {
    $mode = $_GET['mode'];

    if ($mode == 'search') {
        $search = $_GET['search'];
        if (isset($_GET['keyword']))
            $keyword = $_GET['keyword'];
        else
            $keyword = "''";

        $whereCondition .= " AND $search LIKE '%$keyword%'";
    }
}

//총 레코드 갯수 구하기
$query = "SELECT * FROM $table WHERE $whereCondition";
$result = mysqli_query($link, $query);
$NUM_ALL_CONTENTS = mysqli_num_rows($result);
$NUM_ALL_PAGES = ceil($NUM_ALL_CONTENTS / NUM_CONTANTS);

if ($NUM_ALL_CONTENTS == 0)
    echo "<script>
var count = 3;
setTimeout(location.reload, 3000); 
setInterval(function() {
  document.getElementById('timer').innerHTML = count+'초 후에 목록으로 이동';
  count--;
},1000)
</script>
<td colspan='5'>찾으시는 게시물이 없습니다.</td><td colspan='5' id='timer'></td>";

else {
//쿼리 실행
    $query = "SELECT board_id, subject, user_name, reg_date, hits, user_id FROM $table WHERE $whereCondition ORDER BY reg_date DESC LIMIT $startContent, " . NUM_CONTANTS;
    $result = mysqli_query($link, $query);
    $records = array();
    while ($record = mysqli_fetch_array($result))
        $records[] = $record;

//****************************view contents list
//한 페이지 레코드 갯수
    $num_page_records = count($records);
    $print_cont_list = "";
    for ($r = 0; $r < $num_page_records; $r++) {
        $print_cont_list .= "<tr>";

        $print_cont_list .= "<td>" . $records[$r][0] . "</td>";
        $print_cont_list .=
            "<td><a href='./read&modify.html?owner_id={$records[$r]['user_id']}&board_id={$records[$r][0]}'>" . $records[$r][1] . "</a></td>";
        $print_cont_list .= "<td>" . $records[$r][2] . "</td>";
        $print_cont_list .= "<td>" . $records[$r][3] . "</td>";
        $print_cont_list .= "<td>" . $records[$r][4] . "</td>";

        $print_cont_list .= "</tr>";
    }

//****************************빈 레코드 출력 생성
    if ($num_page_records < NUM_CONTANTS) {
        for ($i = $num_page_records; $i < NUM_CONTANTS; $i++)
            $print_cont_list .= "<tr><td>&nbsp;</td><td> &nbsp;</td><td> &nbsp;</td><td> &nbsp;</td><td> &nbsp;</td></tr>";
    }


//***************************view page list
    $print_page_list = "<tr><td colspan='5'>";
    $print_page_list .= "<input type='button' onclick='toServer()' value='<<'>";

    if (NUM_PAGES < $NUM_ALL_PAGES) {

        $lastPage = $startPage + NUM_PAGES - 1;

        $strtNUM = $startPage - floor((NUM_PAGES / 2));
        $strtNUM = (($strtNUM <= 0) ? 1 : $strtNUM);

        $endNUM = $lastPage - floor(NUM_PAGES / 2);
        $endNUM = $endNUM > ($tmp = $NUM_ALL_PAGES - NUM_PAGES + 1) ? $tmp : $endNUM;

//start
        $print_page_list .= "<a href='#' onclick='toServer(\"listUp\",\"startPage=$strtNUM&currentPage=$startPage\")'>$startPage</a>";

        for ($i = $startPage + 1; $i < $lastPage; $i++)
            $print_page_list .= "<a href='#' onclick='toServer(\"listUp\",\"startPage=$startPage&currentPage=$i \")'>$i</a>";

//last
        $print_page_list .= "<a href='#' onclick='toServer(\"listUp\",\"startPage=$endNUM&currentPage=$lastPage\")'>$lastPage</a>";


        $print_page_list .= "<input type='button' onclick='toServer(\"listUp\",\"startPage=" . ($NUM_ALL_PAGES - NUM_PAGES + 1) . "&currentPage=$NUM_ALL_PAGES\")' value='>>'></td></tr>";

    } else {
        $lastPage = $NUM_ALL_PAGES;
        for ($i = $startPage; $i <= $lastPage; $i++)
            $print_page_list .= "<a href='#' onclick='toServer(\"listUp\",\"currentPage=$i\")'>$i</a>";
        $print_page_list .= "<input type='button' onclick='toServer(\"listUp\",\"currentPage=$lastPage\")' value='>>'>";
    }

    $print_page_list .= "</td></tr>";
    /*
    $print_page_list = "<tr><td colspan='5'>";
    $print_page_list .= "<input type='button' onclick='toServer()' value='<<'>";
    for($i = $startPage ; $i <= $lastPage; $i++)
        $print_page_list .= "<a href='#' onclick='toServer()'>$i</a>";
    $print_page_list .= "<input type='button' onclick='toServer()' value='>>'>";
    $print_page_list = "</td></tr>";
    */
//******************************출력 부분
    $dom = new DOMDocument('1.0', 'UTF-8');
    $print_list = "<meta charset='UTF-8'>" . $print_cont_list . $print_page_list;
    libxml_use_internal_errors(true);
    $dom->loadHTML($print_list);
    $a_tags = $dom->getElementsByTagName('a');

    foreach ($a_tags AS $tag) {
        if ($currentPage == $tag->nodeValue)
            $tag->setAttribute('style', 'color:red');
    }

    echo $dom->saveHTML();
}


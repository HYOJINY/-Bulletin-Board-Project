<?
include 'control.php';
//session_destroy();
@$currPage = $_GET['currPage'] ? $_GET['currPage'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<style>

    body {
        margin: auto 0;
    }

    div {
        margin: 2%;
        border: 0.5px black solid;
        padding: 1%;
    }
</style>
<script>


    var currPage =  <? echo $currPage; ?>;
    var user_id  = "<? echo $user_id;  ?>";

/*
    //권환 확인하고 write페이지 이동
   function toWritePage() {
        if (user_id != 'anonymous')
            location.replace('./writePage.html');
        else
            alert('로그인 하세요');
    }
*/


    //페이지 네이션
    function setCurrPage() {
        if (!location.href.match('currPage'))
            location.href = 'index.php?currPage=0';
    }

    function getHref(i) {
        location.href = location.href.replace(currPage, i);
    }


</script>
<body onload="setCurrPage()">
<div name="listUp">

    <div>
        <h1>게시판</h1>
    </div>

    <!--      로그인 div 부분 세션 확인     -->
    <div id='login'>
        <form action='control.php' method='get'><? mk_login_template(); ?></form>
    </div>

    <div>
        <table border="1">
            <thead>
            <tr>
                <th>Num</th>
                <th>title</th>
                <th>id</th>
                <th>hits</th>
                <th>date</th>
            </tr>
            </thead>
            <tbody>
            <?
            $array = @select($_GET['search'], $_GET['keyword'], $_GET['currPage']);

            $record = $array[1];

            for ($i = 0; $i < count($record); $i++) {
                echo "<tr>";
                echo "<td>" . $record[$i][0] . "</td>";
                echo "<td><a href='./control.php?mode=lookup&board_id={$record[$i][0]}&currPage={$currPage}&writer_id={$record[$i][2]}'>" . $record[$i][1] . "</a></td>";
                echo "<td>" . $record[$i][2] . "</td>";
                echo "<td>" . $record[$i][3] . "</td>";
                echo "<td>" . $record[$i][4] . "</td>";
                echo "</tr>";
            }

            ?>
            <tr>
                <td colspan="5">
                    <?php
                    $PAGES_NUM = $array[0];
                    echo "<a href='#'> << </a>";
                    for ($i = 0; $i < $PAGES_NUM; $i++)
                        echo "<a href='javascript:getHref($i);'>" . ($i + 1) . " </a>";
                    echo "<a href='#'> >> </a>";
                    ?>
                </td>
            </tr>

            </tbody>
        </table>
    </div>
   <? if($user_id != 'anonymous'){
echo"<div>
        <button onclick='toWritePage()'>글쓰기</button>
    </div>";
   }

?>
    <div>
        <form method="get" action="index.php">
            <input type="hidden" name="currPage" value="0">
            <select name="search">
                <option value="title">title</option>
                <option value="user_id">id</option>
                <option value="content">content</option>
                <option value="all">all</option>
            </select>
            <input type="text" name="keyword" required>
            <input type="submit" value="검색">
        </form>
    </div>

</body>
</html>
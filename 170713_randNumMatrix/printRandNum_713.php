<style>
    td {
        text-align: center;
    }

<?php


/**
 * Created by PhpStorm.
 * User: Jiny
 * Date: 2017-07-13
 * Time: 오후 1:42
 */
// 스타일주기
if (!empty($_GET['markTriple']))
    echo ".color{ background-color: aqua;}";

?>

</style>

<body>
<table border='1'>

    <?php

    $row = $_GET['row'];
    $col = $_GET['col'];

    $stNum = $_GET['stNum'];
    $edNum = $_GET['edNum'];

    //랜덤 넘버 생성하기, 중복 제거
    Function mkRandNum($st, $ed, $range)
    {
        $randArr = array();

        for ($i = 0; $i < $range; $i++) {

            $randArr[$i] = rand($st, $ed);

            for ($c = 0; $c < count($randArr) - 1; $c++) {
                if ($randArr[$i] == $randArr[$c]) {
                    $i--;
                    break;
                }
            }
        }
        return $randArr;
    }


    $randArr = mkRandNum($stNum, $edNum, $row * $col);


    //테이블에 값넣기
    for ($count = 0; $count < $row * $col;) {

        for ($r = 0; $r < $row; $r++) {
            echo "<tr>";

            for ($c = 0; $c < $col; $c++, $count++) {

                if ($randArr[$count] % 3 == 0)
                    echo "<td class='color'>";
                else
                    echo "<td>";

                echo $randArr[$count] . "</td>";
            }

            echo "</tr>";
        }
    }
    ?>
</table>
<input type="button" value="돌아가기" onclick="goBack()">
</body>

<script>
    function goBack() {
        location.replace('printRandNum_713.html');
    }
</script>

//3의 배수 깜빡깜빡하게 만들기
//3의 배수 물음표 클릭하면 숫자 나오게
//mvc 모델로 해보기
//Ajax로 해보기
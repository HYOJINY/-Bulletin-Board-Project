<html>
<style>

    #timer {
        display: block;
        font-size: 50px;
        border: solid 1px black;
        height: 60px;
    }

    #field div {
        width: 15px;
        height: 15px;
        display: block;
        float: left;

        text-align: center;
    }

    body {
        font-size: 15px;
    }

</style>
<body>
<div id=timer>

</div>

<div id="field">
    <?php
    $option = $_GET['option'];
    define('ALPHA_NUM', 26);


    Function kireini($arg)
    {
        return "<div>$arg</div>";
    }

    //다중열 알파벳
    Function NUM_1($cs, $row)
    {
        if ($cs == "1")
            $A = "a";
        else
            $A = "A";

        for ($r = 0; $r < ALPHA_NUM; $r++) {
            echo "<p>";
            for ($c = 0; $c < $row; $c++)
                echo kireini(chr(ord($A) + $r));

            echo "</p>";
            echo "<br>";

        }
    }


    //직각 삼각형
    Function NUM_2()
    {
        for ($r = 0; $r < ALPHA_NUM; $r++) {
            echo "<p>";
            for ($c = 0; $c <= $r; $c++) {
                $A = "A";
                echo kireini(chr(ord($A) + $c));
            }
            echo "</p>";
            echo "<br>";

        }
    }


    //역직각 삼각형
    Function NUM_3()
    {
        for ($r = 0; $r < ALPHA_NUM; $r++) {
            echo "<p>";
            for ($c = 0; $c < $r; $c++) {
                echo kireini("");
            }

            for ($c = 0; $c < ALPHA_NUM - $r; $c++) {
                $A = "A";
                echo kireini(chr(ord($A) + $c));
            }
            echo "</p>";
            echo "<br>";

        }
    }


    //이등변 삼각형
    Function NUM_4()
    {
        for ($r = 0, $s = 0; $r < ALPHA_NUM * 2 - 1; $r++) {
            echo "<p>";

            for ($c = 0; $c <= $s; $c++) {
                $A = "A";
                echo kireini(chr(ord($A) + $c));
            }

            if ($r < ALPHA_NUM - 1)
                $s++;
            else
                $s--;
            echo "</p>";
            echo "<br>";

        }
    }


    //나비 넥타이
    Function NUM_5()
    {
        for ($r = 0, $s = 0; $r < ALPHA_NUM * 2 - 1; $r++) {
            echo "<p>";

            $A = "A";
            for ($c = 0; $c < ALPHA_NUM * 2; $c++) {

                if ($c <= $s)
                    echo kireini(chr(ord($A) + $c));
                else if ($c >= ALPHA_NUM * 2 - 1 - $s)
                    echo kireini(chr(ord($A) + (ALPHA_NUM * 2 - 1 - $c)));
                else
                    echo kireini("");

            }

            if ($r < ALPHA_NUM - 1)
                $s++;
            else
                $s--;

            echo "</p>";
            echo "<br>";

        }
    }


    //방패연
    Function NUM_6()
    {
        for ($r = 0, $s = 0; $r < ALPHA_NUM * 2 - 1; $r++) {
            echo "<p>";

            $A = "A";
            for ($c = 0; $c < ALPHA_NUM * 2; $c++) {

                if ($c == $s || $c == 0 || ($r == ALPHA_NUM - 1 && $c <= ALPHA_NUM - 1))
                    echo kireini(chr(ord($A) + $c));
                else if ($c == ALPHA_NUM * 2 - 1 - $s || $c == ALPHA_NUM * 2 - 1 || ($r == ALPHA_NUM - 1 && $c > ALPHA_NUM - 1))
                    echo kireini(chr(ord($A) + (ALPHA_NUM * 2 - 1 - $c)));
                else
                    echo kireini("");
            }

            if ($r < ALPHA_NUM - 1)
                $s++;
            else
                $s--;

            echo "</p>";
            echo "<br>";

        }
    }


    switch ($option) {
        case "1":
            NUM_1($_GET['cs'], $_GET['col']);
            break;

        case "2":
            NUM_2();
            break;

        case "3":
            NUM_3();
            break;

        case "4":
            NUM_4();
            break;

        case "5":
            NUM_5();
            break;

        case "6":
            NUM_6();
            break;
    };

    //p태그 안의 div태그에서 텍스트 가운데 정렬하기.
    ?>
</div>

</body>

<script>

    var count = 10;
    var timer_div = document.getElementById("timer");
    setInterval(function () {
        timer_div.innerHTML = count;
        count--;
        if (count == 0)
            location.replace('printTheStars_712.html');
    }, 1000);

</script>


</html>

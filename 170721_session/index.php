<?php
if(@!$_SESSION['login'] || @$_GET['logout'] == '로그아웃'){
   // session_unset();
    session_destroy();

    var_dump($_SESSION);
echo $_SESSION['login'];
    echo
    "<html>
<head>
</head>
<body>
<form action='result.php' method='get'>
    <p>
        ID : <input type='text' name='id'>
    </p>
    <p>
        PW : <input type='text' name='pw'>
    </p>
    <p>
        <input type='submit' value='로그인 하기'>
    </p>
</form>
</body>
</html>";
}

if (@$_SESSION['login']) {
    echo "<form action='index.php' method='get'>";
    echo "{$_SESSION['name']} 님이 로그인 하셨습니다. <br>";
    echo "나이 : {$_SESSION['age']} <br>";
    echo "회원 등급 : {$_SESSION['level']} <br>";
    echo "<input type='submit' name='logout' value='로그아웃'>";
    echo "</form>";
}





<?php
$op1 = $_GET['op1'];
$op2 = $_GET['op2'];
$result = $op1 + $op2;

echo "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Title</title>
</head>
<body>
<form action='calculator.php'>
    <input type='text' name='op1' value=$op1> +
    <input type='text' name='op2' value=$op2> =
    <input type='text' name='value' value=$result>
    <input type='submit'>
</form>
</body>
</html>";
?>

<?php
/**
 * Created by PhpStorm.
 * User: Jiny
 * Date: 2017-07-16
 * Time: 오후 9:07
 */

$path = "E:\AutoSet9\public_html";
$dir = dir($path);
$txtList = array();

while (($entry = $dir->read())) {
    if (substr($entry, -3) == "txt")
        $txtList[] = $entry;
};

foreach ($txtList as $value) {

    echo "<a href='$value' download=''>$value</a><br>";
}
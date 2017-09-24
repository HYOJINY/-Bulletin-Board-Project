<?php
/**
 * Created by PhpStorm.
 * User: Jiny
 * Date: 2017-07-19
 * Time: 오후 3:32
 */

function view($dataArr){
    $returnStr = "";
    foreach ($dataArr as $record){
        $returnStr .= "<tr>";
        foreach ($record as $cell){
            $returnStr .= "<td>$cell</td>";
        }
        $returnStr .= "<td><a href='#' id='$record[0]' name='del' onclick='toServer(this)'>삭제</a></td></tr>";
    }
    return $returnStr;
}
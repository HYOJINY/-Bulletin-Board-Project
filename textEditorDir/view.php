<?php
/**
 * Created by PhpStorm.
 * User: Jiny
 * Date: 2017-07-18
 * Time: 오후 6:57
 */
function makeHtmlElement($arr){
    $str = "";

   foreach($arr as $value){
       $str.="<tr>";
       $sum = 0;
       foreach ($value as $cell){
           $str.= "<td>".$cell."</td>";
       }
       $str.= "<td><a href='#' name='delete' onclick='toServer(event)' type='button' id='$value[0]'>"."삭제"."</a></td>";
       $str.="</tr>";
   }

   return $str;
}
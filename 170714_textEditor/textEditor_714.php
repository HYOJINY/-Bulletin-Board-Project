<?php
/**
 * Created by PhpStorm.
 * User: Jiny
 * Date: 2017-07-15
 * Time: 오후 10:52
 */
const USER_DIR = "textEditorDir/";

$text   = $_POST['txt'];
$option = $_POST['op'];

switch ($option){
    case "1":
        $search = $_POST['search'];
        $replace = $_POST['replace'];
        echo str_replace($search, $replace, $text);
        break;
    case "2":
        print strtoupper($text);
        break;
    case "3":
        print strtoupper($text);
        break;
    case "4":
        $fileName = $_POST['fileName'];
        if(!is_null($fileName)){
           $handle = fopen(/*getcwd()."\\textEditorDir\\".*/$fileName.".txt", "w");
           //chmod(getcwd()."\\textEditorDir\\".$fileName.".txt",0777);
           //chmod(getcwd()."\\textEditorDir",0000);
           fwrite($handle, $text);
           fclose($handle);
           echo $text;

        }
        //있으면 "이미 존재하는 파일입니다. 덮어쓰시겠습니까?"
        //
        break;
}


<?php
/**
 * Created by PhpStorm.
 * User: Jiny
 * Date: 2017-07-23
 * Time: 오후 5:21
 */

$CREATOR = 'LEEHYOJIN';


//받은 파일 업로드 하기
$upload_dir = 'upload_nokia/';


if (!is_dir('upload_nokia'))
    mkdir($upload_dir, 0777);

$upload_file = $upload_dir . basename($_FILES['userfile']['name']);
$table_name = basename($_FILES['userfile']['name'], '.txt');

move_uploaded_file($_FILES['userfile']['tmp_name'], $upload_file);


//dbms연결
$link = mysqli_connect('localhost', 'root', 'autoset');


//쿼리 실행
$result = mysqli_multi_query($link, "
DROP DATABASE IF EXISTS $CREATOR;
create database $CREATOR;
use $CREATOR;
DROP TABLE IF EXISTS $table_name;
CREATE TABLE $table_name (
enbid int(10) not null,
lncel int(10) not null,
cellid int(10) not null,
frequency int(10) not null,
pci int(10) not null
);
");


do {
    // Store first result set
    if ($result = mysqli_store_result($link)) {

        // Free result set
        mysqli_free_result($result);
    }
} while (mysqli_next_result($link));


//db선택
mysqli_select_db($link, $CREATOR);


//파일 읽어서 ,가 많으면  query + FIELDS TERMINATED BY ','
//???????????????????????????????????


//받은 파일 테이블로 생성
//로우 구하기
mysqli_query($link, "LOAD DATA LOCAL INFILE '$upload_file' INTO TABLE $table_name");

//데이터 가공 시작
$result_table = $table_name . '_result';


//ca 구하기
$query = "select o.enbid, o.lncel , t.ca from nokia o, (select enbid, pci, count(pci) ca from nokia group by enbid, pci) t
where o.enbid=t.enbid AND o.pci = t.pci";
$result = mysqli_query($link,$query);
$ca_arr = array();

while($record = mysqli_fetch_row($result))
    $ca_arr[] = $record;


//enbid 구하기
$count = 0;
$enbid_arr = array();

foreach ($ca_arr AS $value){
    $i = 0;
    for(; $i<$count ; $i++) {
        if (@$enbid_arr[$i] == $value[0])
            break;
    }
    if($i == $count)
        $enbid_arr[] = $value[0];
    $count++;
}



//"select where enbid = $enbid_arr[$i]";
//"alter table $table_name add column CA int(10)" ;


//??????????????????????????????????/? 멀티 쿼리다음에 쿼리를 할 수 없는 이유???
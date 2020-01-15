<?php

$host = filter_input(INPUT_GET, 'h');
$port = filter_input(INPUT_GET, 'p');
$name = filter_input(INPUT_GET, 'n');
$user = filter_input(INPUT_GET, 'u');
$pass = filter_input(INPUT_GET, 'p');

try {
	//DB接続
	$dbh = new PDO("pgsql:host=$host;port=$port;dbname=$name;user=$user;password=$pass");
	print("接続成功".'<br>');
  
	//SQL作成
	// $sql = 'select * from x';
	// //SQL例
	// //$sql = 'select * from "SchemeName"."TableName"';
  
	// //SQL実行
	// foreach ($dbh->query($sql) as $row) {
	// 	//指定Columnを一覧表示
	// 	print($row['ColumnName'].'<br>');
	// }
  
} catch(PDOException $e) {
	print("接続失敗".'<br>');
	print($e.'<br>');
	die();
}

exit();
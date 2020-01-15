<?php

$host = filter_input(INPUT_GET, 'hs');
$port = filter_input(INPUT_GET, 'pr');
$name = filter_input(INPUT_GET, 'nm');
$user = filter_input(INPUT_GET, 'us');
$pass = filter_input(INPUT_GET, 'ph');

try {
	// DB接続
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
<?php

$host = filter_input(INPUT_GET, 'hs');
$port = filter_input(INPUT_GET, 'pr');
$name = filter_input(INPUT_GET, 'nm');
$user = filter_input(INPUT_GET, 'us');
$pass = filter_input(INPUT_GET, 'ph');

try {
	print("pgsql:host=$host;port=$port;dbname=$name;user=$user;password=$pass<br>");

	//DB接続
	// $dbh = new PDO("pgsql:host=$host;port=$port;dbname=$name;user=$user;password=$pass");
	$dbh = new PDO("pgsql:host=ec2-174-129-32-215.compute-1.amazonaws.com;port=61ed9e2ce7d69bef04462de6d3d375b6572c5172a6ad0b73f12cd5364aa9ea68;dbname=dddpsv8go542b8;user=tcjetarfhrhdcg;password=61ed9e2ce7d69bef04462de6d3d375b6572c5172a6ad0b73f12cd5364aa9ea68");
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
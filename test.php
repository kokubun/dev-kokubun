<?php

$DBHOST = "ec2-174-129-32-215.compute-1.amazonaws.com";
$DBPORT = "5432";
$DBNAME = "dddpsv8go542b8";
$DBUSER = "tcjetarfhrhdcg";
$DBPASS = "61ed9e2ce7d69bef04462de6d3d375b6572c5172a6ad0b73f12cd5364aa9ea68";

try {
	//DB接続
	$dbh = new PDO("pgsql:host=$DBHOST;port=$DBPORT;dbname=$DBNAME;user=$DBUSER;password=$DBPASS");
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
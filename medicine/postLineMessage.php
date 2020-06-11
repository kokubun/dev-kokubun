<?php

include_once './db.inc';
include_once './Line.inc';

const ERROR_STATUS = 900;
const SUCCESS_STATUS = 200;
$LINE_ID = getenv('LINE_ID_1');


if (empty($LINE_ID)) {
	$response_body = createResponseBody(ERROR_STATUS, 'error #1');
	response($response_body);
	exit();
}

$tp = filter_input(INPUT_POST, 'tp');
$ta = filter_input(INPUT_POST, 'ta');
$u = filter_input(INPUT_POST, 'u');

if (!isset($tp) || !isset($ta) || !isset($u)) {
	$response_body = createResponseBody(ERROR_STATUS, 'error #2');
	response($response_body);
	exit();
}

$u_list = explode(',', $u);
if (array_search($LINE_ID, $u_list) === false) {
	$response_body = createResponseBody(ERROR_STATUS, 'error #3');
	response($response_body);
	exit();
}

$line = new Line($tp, $ta, $u_list);
$line->multicastMessage('薬飲みました。');

$response_body = createResponseBody(SUCCESS_STATUS, 'OK');
response($response_body);

// DB にインサート
// $db = new db();

// try {
// 	// DB接続
// 	$db_name = $db->getDBName();
// 	$db_host = $db->getDBHost();
// 	$db_port = $db->getDBPort();
// 	$db_user = $db->getDBUser();
// 	$db_pass = $db->getDBPass();
// 	$db_connect = new PDO("pgsql:host=$db_host;port=$db_port;dbname=$db_name;user=$db_user;password=$db_pass");

// 	$db_connect->beginTransaction();

// 	// insert
// 	// $db_connect->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
// 	$db_connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// 	$sql = "insert into medicine(create_at) VALUES(current_timestamp)";
// 	$db_connect->query($sql);
// 	$db_connect->commit();

// } catch(PDOException $e) {
// 	print($e->getMessage());
// }

exit();


/**
 * レスポンスデータ作成
 *
 * @param int $status		ステータスコード
 * @param string $message	メッセージ
 * @return void
 */
function createResponseBody($status, $message) {
	$arr = array(
		'status' 	=> $status,
		'message'	=> $message,
	);
	return json_encode($arr);
}

function response($response_body) {
	// 指定されたステータスコードで返却
	header('Content-type: text/plain');
	echo $response_body;
}

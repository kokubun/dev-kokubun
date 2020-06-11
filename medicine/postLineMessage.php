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

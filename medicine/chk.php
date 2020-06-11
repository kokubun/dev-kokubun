<?php
// 朝-> AM 9:00 以降、登録がなかったらアラート
// 夜-> PM 23:00 以降、登録がなかったらアラート

include_once './db.inc';
include_once './Line.inc';

date_default_timezone_set("Asia/Tokyo");

const NOTHING_STATUS	= 0;
const MORNING_STATUS	= 1;
const NIGHT_STATUS		= 2;

$LINE_ID = getenv('LINE_ID_1');
$now_microtime = time();
$now_datetime = date('YmdHis', $now_microtime);
$now_day = date('d', $now_microtime);
$now_hour = date('H', $now_microtime);

echo "check!!!<br>";

$db_connect = new db();

// TODO: 毎月1日にデータ削除
if ($now_day === '1' || $now_day === '15') {
	$sql = "DELETE FROM medicine WHERE create_at <= current_timestamp + '-3 day'";
	$db_connect->query($sql);
	$db_connect->commit();
}

// 
$time_status = chkTimeStatus($now_hour);
echo "{$time_status}<br>";


if ($time_status === NOTHING_STATUS) {
	exit();
}

$result = false;

// 24時間以内の登録データを取得
$sql = "SELECT create_at FROM medicine WHERE create_at >= current_timestamp + '-1 day'";
$db_data = $db_connect->query($sql);
foreach ($db_data as $row) {
	print_r($row['create_at']);
	switch ($time_status) {
		case MORNING_STATUS:
			# code
			break;
		case NOTHING_STATUS:
			# code...
			break;
		default:
			# code...
			break;
	}
}



exit();

/**
 * 
 */
function chkTimeStatus($hour) {
	$res = NOTHING_STATUS;
	switch ($hour) {
		case 0:
		case 1:
		case 2:
		case 22:
		case 23:
		case 24:
			$res = NIGHT_STATUS;
			break;
		case 9:
		case 10:
		case 11:
		case 12:
		case 13:
		case 14:
			$res = MORNING_STATUS;
			break;
		default:
			break;
	}

	return $res;
	
}
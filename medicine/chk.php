<?php
// 朝-> AM 9:00 以降、登録がなかったらアラート
// 夜-> PM 23:00 以降、登録がなかったらアラート

include_once './db.inc';

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

// TODO: 毎月1日にデータ削除

// 
$time_status = chkTimeStatus($now_hour);
echo "{$time_status}<br>";


// if ($time_status === NOTHING_STATUS) {
// 	exit();
// }

$db_connect = new db();
$sql = "select * from medicine";
$a = $db_connect->query($sql);
foreach ($a as $row) {
    print_r($row);
}

exit();


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

<?php
// 朝-> AM 9:00 以降、登録がなかったらアラート
// 夜-> PM 23:00 以降、登録がなかったらアラート

include_once './db.inc';

$LINE_ID = getenv('LINE_ID_1');
$now_microtime = time();
$now_datetime = date('YmdHis', strtotime($now_microtime));


echo "check!!!\n";
echo "{$now_datetime}\n";


exit();
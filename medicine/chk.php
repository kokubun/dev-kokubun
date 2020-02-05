<?php
// 朝-> AM 9:00 以降、登録がなかったらアラート
// 夜-> PM 23:00 以降、登録がなかったらアラート

include_once './db.inc';

$LINE_ID = getenv('LINE_ID_1');
$now_ymdh = date('YmdH');


echo "check!!!\n";
echo "{$now_ymdh}\n";


exit();
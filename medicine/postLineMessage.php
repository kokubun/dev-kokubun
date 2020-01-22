<?php

// print_r($_POST);

include_once './db.inc';

const ERROR_STATUS = 900;
const SUCCESS_STATUS = 200;

$tp = filter_input(INPUT_POST, 'tp');
$ta = filter_input(INPUT_POST, 'ta');
$u = filter_input(INPUT_POST, 'u');

if (!isset($tp) || !isset($ta) || !isset($u)) {
	$response_body = createResponseBody(ERROR_STATUS, 'パラメータ不足です');
	response($response_body);
	exit();
}

$u_list = explode(',', $u);
print_r($u_list);
$line = new Line($tp, $ta, $u_list);
$line->multicastMessage('[test]薬飲みました。');

$response_body = createResponseBody(SUCCESS_STATUS, 'OK');
response($response_body);

// TODO: DB にインサート

exit();

class Line {

	// 複数アカウントにメッセージ送信API
	const MULTICAST_URL = 'https://api.line.me/v2/bot/message/multicast';
	
	protected $access1;
	protected $access2;
	protected $to;
	
	public function __construct($tp, $ta, $u) {
		$this->access1 = $tp;
		$this->access2 = $ta;
		$this->to = $u;
	}

	/**
	 * LINE メッセージ
	 *
	 * @param [type] $message
	 * @return void
	 */
	public function multicastMessage($message) {
		$multicast_setting = [
			'url'	=> self::MULTICAST_URL,
			'to'	=> [$this->to],
		];
		$header = array(
			'Content-Type: application/json',
			'Authorization: Bearer '.$this->access1.'+'.$this->access2,
		);
		$messages = array('type' => 'text', 'text' => $message);
		$body = json_encode(
			array(
				'to'		=> $this->to,
				'messages'	=> [$messages],
			)
		);
		print_r($body);

		$options = array(
			CURLOPT_URL				=> self::MULTICAST_URL,
			CURLOPT_CUSTOMREQUEST	=> 'POST',
			CURLOPT_RETURNTRANSFER	=> true,
			CURLOPT_HTTPHEADER		=> $header,
			CURLOPT_POSTFIELDS		=> $body
		);
		print_r($options);
		$curl = curl_init();
		curl_setopt_array($curl, $options);
		$response = curl_exec($curl);
		$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		print_r($response);
		print_r($code);
		curl_close($curl);

		return true;
	}
}

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

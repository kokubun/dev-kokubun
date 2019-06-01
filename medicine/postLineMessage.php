<?php

// print_r($_POST);

const ERROR_STATUS = 900;
const SUCCESS_STATUS = 200;

$t = filter_input(INPUT_POST, 't');
$u = filter_input(INPUT_POST, 'u');

if (!isset($t) || !isset($u)) {
	$response_body = createResponseBody(ERROR_STATUS, 'パラメータ不足です');
	response($response_body);
	exit();
}

$line = new Line($t, $u);
$line->multicastMessage('薬飲みました。');

$response_body = createResponseBody(SUCCESS_STATUS, 'OK');
response($response_body);
exit();

class Line {

	// 複数アカウントにメッセージ送信API
	const MULTICAST_URL = 'https://api.line.me/v2/bot/message/multicast';
	
	protected $access;
	protected $to;
	
	public function __construct($t, $u) {
		$this->access = $t;
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
			'Authorization: Bearer '.$this->access,
		);
		$messages = array('type' => 'text', 'text' => mb_convert_encoding($message, 'UTF-8'));
		$body = json_encode(
			array(
				'to'		=> $this->to,
				'messages'	=> [$messages],
			)
		);
		print_r($body);

		// $options = array(
		// 	CURLOPT_URL				=> self::MULTICAST_URL,
		// 	CURLOPT_CUSTOMREQUEST	=> 'POST',
		// 	CURLOPT_RETURNTRANSFER	=> true,
		// 	CURLOPT_HTTPHEADER		=> $header,
		// 	CURLOPT_POSTFIELDS		=> $body
		// );
		// $curl = curl_init();
		// curl_setopt_array($curl, $options);
		// $response = curl_exec($curl);
		// $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		// curl_close($curl);

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
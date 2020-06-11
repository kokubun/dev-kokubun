<?php

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

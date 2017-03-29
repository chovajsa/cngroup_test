<?php
namespace mirec\cngroup\Request;

require_once 'RequestInterface.php';

class CurlRequest extends Request {
	
	private $data;
	private $url;

	public function __construct() {
	}

	public function setUrl($url) {
		$this->url = $url;
	}

	public function setData($data) {
		$this->data = $data;
	}

	public function call() {
		$ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->data);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);

        return json_decode(curl_exec($ch), 1);
	}
}
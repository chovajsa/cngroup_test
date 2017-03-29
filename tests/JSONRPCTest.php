<?php 


require_once '../vendor/autoload.php';
require_once '../src/JSON_RPC.php';
require_once '../src/Request/CurlRequest.php';

use PHPUnit\Framework\TestCase;

final class JSONRPCTest extends TestCase {

	public function testRequestCall() {

		$jsonRpc = new \mirec\cngroup\JSONRPC(time());

		$jsonRpc->setMethod('guru.test');
		$jsonRpc->addParam('Guru');
		$jsonRpc->setRequest(new \mirec\cngroup\Request\CurlRequest());

		$result = $jsonRpc->request('https://gurujsonrpc.appspot.com/guru');

		$this->assertTrue(isset($result['result']) && $result['result'] == 'Hello Guru!');

		
	}

}




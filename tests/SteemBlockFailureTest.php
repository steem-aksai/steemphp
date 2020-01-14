<?php

include (__DIR__).'/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class SteemBlockFailureTest extends TestCase
{
	protected function setUp(): void
	{
		$this->SteemBlock = new \SteemPHP\SteemBlock('https://rpc.steem.com/');
	}

	// public function testGetApi()
	// {
	// 	$this->assertArrayHasKey('instance', $this->SteemBlock->getApi('login_api'));
	// }

	public function testGetBlock()
	{
		$this->assertArrayHasKey('instance', $this->SteemBlock->getBlock(1));
	}

	public function testGetBlockHeader()
	{
		$this->assertArrayHasKey('instance', $this->SteemBlock->getBlockHeader(1));
	}

	public function testGetOpsInBlock()
	{
		$this->assertArrayHasKey('instance', $this->SteemBlock->getOpsInBlock(15082480));
	}

	public function testGetTransactionHex()
	{
		$this->assertArrayHasKey('instance', $this->SteemBlock->getTransactionHex('22e7151e8dbf10c8342cf174db4d18788dbede28'));
	}

	public function testGetTransaction()
	{
		$this->assertArrayHasKey('instance', $this->SteemBlock->getTransaction('22e7151e8dbf10c8342cf174db4d18788dbede28'));
	}

	public function testGetKeyReferences()
	{
		$this->assertArrayHasKey('instance', $this->SteemBlock->getKeyReferences('STM8TkTHDY5ayet6JHyktY9ghV8PwiZ8FSgKSGaSM9PHEdtvCdxBK'));
	}

}

?>

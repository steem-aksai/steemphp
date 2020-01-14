<?php

include (__DIR__).'/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class SteemChainFailureTest extends TestCase
{
	protected function setUp(): void
	{
		$this->SteemChain = new \SteemPHP\SteemChain('https://rpc.steem.com/');
	}

	// public function testGetApi()
	// {
	// 	$this->assertArrayHasKey('instance', $this->SteemChain->getApi('login_api'));
	// }

	public function testGetVersion()
	{
		$this->assertArrayHasKey('instance', $this->SteemChain->getVersion());
	}

	public function testGetAccountCount()
	{
		$this->assertArrayHasKey('instance', $this->SteemChain->getAccountCount());
	}

	public function testGetChainProperties()
	{
		$this->assertArrayHasKey('instance', $this->SteemChain->getChainProperties());
	}

	public function testGetConfig()
	{
		$this->assertArrayHasKey('instance', $this->SteemChain->getConfig());
	}

	public function testGetDynamicGlobalProperties()
	{
		$this->assertArrayHasKey('instance', $this->SteemChain->getDynamicGlobalProperties());
	}

	public function testGetFeedHistory()
	{
		$this->assertArrayHasKey('instance', $this->SteemChain->getFeedHistory());
	}

	public function testGetCurrentMeidanHistoryPrice()
	{
		$this->assertArrayHasKey('instance', $this->SteemChain->getCurrentMeidanHistoryPrice());
	}

	public function testGetHardforkVersion()
	{
		$this->assertArrayHasKey('instance', $this->SteemChain->getHardforkVersion());
	}

	public function testGetNextScheduledHardfork()
	{
		$this->assertArrayHasKey('instance', $this->SteemChain->getNextScheduledHardfork());
	}
}

?>

<?php

include (__DIR__).'/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class SteemAccountFailureTest extends TestCase
{
	protected function setUp(): void
	{
		$this->SteemAccount = new \SteemPHP\SteemAccount('https://rpc.steem.com/');
	}

	// public function testGetApi()
	// {
	// 	$this->assertArrayHasKey('instance', $this->SteemAccount->getApi('login_api'));
	// }

	public function testGetProps()
	{
		$this->assertArrayHasKey('instance', $this->SteemAccount->getProps());
	}

	public function testGetAccountHistory()
	{
		$this->assertArrayHasKey('instance', $this->SteemAccount->getAccountHistory('davidk', 2));
	}

	public function testGetAccount()
	{
		$this->assertArrayHasKey('instance', $this->SteemAccount->getAccount('davidk'));
	}

	public function testGetReputation()
	{
		$this->assertArrayHasKey('instance', $this->SteemAccount->getReputation('davidk'));
	}

	public function testVestToSteemByAccount()
	{
		$this->assertArrayHasKey('instance', $this->SteemAccount->vestToSteemByAccount('davidk'));
	}

	public function testGetFollowing()
	{
		$this->assertArrayHasKey('instance', $this->SteemAccount->getFollowing('davidk'));
	}

	public function testGetFollowers()
	{
		$this->assertArrayHasKey('instance', $this->SteemAccount->getFollowers('davidk'));
	}

	public function testCountFollows()
	{
		$this->assertArrayHasKey('instance', $this->SteemAccount->countFollows('davidk'));
	}

	public function testGetAccountReputations()
	{
		$this->assertArrayHasKey('instance', $this->SteemAccount->getAccountReputations('davidk', 2));
	}

}

?>

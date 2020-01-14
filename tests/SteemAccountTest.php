<?php

include (__DIR__).'/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class SteemAccountTest extends TestCase
{
	protected function setUp(): void
	{
		$this->SteemAccount = new \SteemPHP\SteemAccount('https://anyx.io');
	}

	// public function testGetApi()
	// {
	// 	$this->assertIsInt($this->SteemAccount->getApi('login_api'));
	// }

	public function testGetProps()
	{
		$this->assertArrayHasKey('head_block_number', $this->SteemAccount->getProps());
	}

	public function testGetAccountHistory()
	{
		$this->assertArrayHasKey('trx_id', $this->SteemAccount->getAccountHistory('davidk', 2)[0][1]);
	}

	public function testGetAccount()
	{
		$this->assertArrayHasKey('name', $this->SteemAccount->getAccount('davidk')[0]);
	}

	public function testGetReputation()
	{
		$this->assertIsInt($this->SteemAccount->getReputation('davidk'));
	}

	public function testVestToSteemByAccount()
	{
		$this->assertIsFloat($this->SteemAccount->vestToSteemByAccount('davidk'));
	}

	public function testGetFollowing()
	{
		$this->assertArrayHasKey('follower', $this->SteemAccount->getFollowing('davidk')[0]);
	}

	public function testGetFollowers()
	{
		$this->assertArrayHasKey('follower', $this->SteemAccount->getFollowers('davidk')[0]);
	}

	public function testCountFollows()
	{
		$this->assertArrayHasKey('account', $this->SteemAccount->countFollows('davidk'));
	}

	public function testGetAccountReputations()
	{
		$this->assertArrayHasKey('account', $this->SteemAccount->getAccountReputations('davidk', 2)[0]);
	}

}

?>

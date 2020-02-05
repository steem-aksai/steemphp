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

	public function testGetAccounts()
	{
		$accounts = $this->SteemAccount->getAccounts(['davidk', 'robertyan']);
		$this->assertArrayHasKey('name', $accounts[0]);
		$this->assertArrayHasKey('name', $accounts[1]);
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
		$this->assertIsArray($this->SteemAccount->getFollowing('davidk'));
	}

	public function testGetFollowers()
	{
		$this->assertIsArray($this->SteemAccount->getFollowers('davidk'));
	}

	public function testCountFollows()
	{
		$this->assertArrayHasKey('account', $this->SteemAccount->countFollows('davidk'));
	}

	public function testGetAccountReputations()
	{
		$this->assertArrayHasKey('account', $this->SteemAccount->getAccountReputations('davidk', 2)[0]);
	}

	public function testFollow()
	{
		$this->assertIsInt($this->SteemAccount->follow("...", "koei", "robertyan"));
	}

	public function testUnfollow()
	{
		$this->assertIsInt($this->SteemAccount->unfollow("...", "koei", "robertyan"));
	}

}

?>

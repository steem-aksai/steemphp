<?php

include (__DIR__).'/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class SteemWitnessTest extends TestCase
{
	protected function setUp(): void
	{
		$this->SteemWitness = new \SteemPHP\SteemWitness('https://api.steemit.com');
	}

	// public function testGetApi()
	// {
	// 	$this->assertInternalType('int', $this->SteemWitness->getApi('login_api'));
	// }

	public function testGetWitnessCount()
	{
		$this->assertInternalType('int', $this->SteemWitness->getWitnessCount());
	}

	public function testLookupWitnessAccounts()
	{
		$this->assertEquals('admin', $this->SteemWitness->lookupWitnessAccounts('admin', 10)[0]);
	}

	public function testGetWitnessSchedule()
	{
		$this->assertArrayHasKey('median_props', $this->SteemWitness->getWitnessSchedule());
	}

	public function testGetWitnesses()
	{
		$this->assertEquals('admin', $this->SteemWitness->getWitnesses('1')[0]['owner']);
	}

	public function testGetWitnessByAccount()
	{
		$this->assertEquals('admin', $this->SteemWitness->getWitnessByAccount('admin')['owner']);
	}

	public function testGetWitnessesByVote()
	{
		$this->assertEquals('good-karma', $this->SteemWitness->getWitnessesByVote('good-karma', 1)[0]['owner']);
	}

	public function testGetActiveWitnesses()
	{
		$this->assertArrayHasKey('0', $this->SteemWitness->getActiveWitnesses());
	}

	public function testGetMinerQueue()
	{
		$this->assertArrayHasKey('0', $this->SteemWitness->getMinerQueue());
	}

}

?>

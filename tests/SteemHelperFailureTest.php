<?php

include (__DIR__).'/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

use SteemPHP\SteemHelper;

class SteemHelperFailureTest extends TestCase
{

	public function testReputation()
	{
		$this->assertEquals(0, SteemHelper::reputation('fail'));
	}

	public function testEstimateAccountValue()
	{
		$this->assertEquals(null, SteemHelper::estimateAccountValue('', '', ''));
	}

	public function testHandleError()
	{
		try {
			if ('a' !== 'b') {
				throw new Exception('Empty exception for phpunit');
			}
		} catch (Exception $e) {
			$this->assertArrayHasKey('instance', SteemHelper::handleError($e));
		}
	}

	public function testSlice()
	{
		$this->assertEquals(['error' => 'Invalid start or length'] ,SteemHelper::slice(['a','b','c','d','e','f','g'], 10, 10));
	}

}

?>

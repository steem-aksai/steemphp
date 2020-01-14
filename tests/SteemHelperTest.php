<?php

include (__DIR__).'/../vendor/autoload.php';

use SteemPHP\SteemHelper;
use PHPUnit\Framework\TestCase;

class SteemHelperTest extends TestCase
{

	public function testToInt()
	{
		$this->assertIsString(SteemHelper::toInt('500 STEEM'));
	}

	public function testNodes()
	{
		$this->assertIsArray(SteemHelper::nodes());
	}

	public function testFilterInt()
	{
		$this->assertIsInt(SteemHelper::filterInt(500));
	}

	public function testReputation()
	{
		$this->assertIsInt(SteemHelper::reputation(3000000));
	}

	public function testFilterDate()
	{
		$this->assertEquals(SteemHelper::now(), SteemHelper::filterDate(SteemHelper::now()));
	}

	public function testNow()
	{
		$this->assertEquals(date('Y-m-d\TH:i:s'), SteemHelper::now());
	}

	public function testBlockTime()
	{
		$this->assertEquals(date('Y-m-d\TH:i:s', strtotime('+1 minute')), SteemHelper::BlockTime(SteemHelper::now(), 'PT1M'));
	}

	public function testVestToSteem()
	{
		$this->assertIsFloat(SteemHelper::vestToSteem('24477.640182 VESTS', '369735200112.175967 VESTS', '178661603.552 STEEM'));
	}

	public function testContains()
	{
		$this->assertEquals('1', SteemHelper::contains('davidk', 'd'));
	}

	public function testCharAt()
	{
		$this->assertEquals('a', SteemHelper::charAt('abcd', 0));
	}

	public function testHandleError()
	{
		$this->assertEquals([], SteemHelper::handleError(''));
	}

	public function testStr_slice()
	{
		$this->assertEquals('abc', SteemHelper::str_slice('abcdefg', 0, 3));
	}

	public function testSlice()
	{
		$this->assertEquals(['result' => ['d','e','f','g']] ,SteemHelper::slice(['a','b','c','d','e','f','g'], -4, 7));
	}

}

?>

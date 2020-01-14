<?php

include (__DIR__).'/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class SteemPostFailureTest extends testCase
{

	protected function setUp(): void
	{
		$this->SteemPost = new \SteemPHP\SteemPost('https://rpc.steem.com/');
	}

	// public function testGetApi()
	// {
	// 	$this->assertArrayHasKey('instance', $this->SteemPost->getApi('login_api'));
	// }

	public function testGetTrendingTags()
	{
		$this->assertArrayHasKey('instance', $this->SteemPost->getTrendingTags('steemit', 10));
	}

	public function testGetContent()
	{
		$this->assertArrayHasKey('instance', $this->SteemPost->getContent('davidk', 'steemphp-new-functions-added-part-1'));
	}

	public function testGetcontentReplies()
	{
		$this->assertArrayHasKey('instance', $this->SteemPost->getContentReplies('davidk', 'steemphp-new-functions-added-part-1'));
	}

	public function testGetDiscussionsByTrending()
	{
		$this->assertArrayHasKey('instance', $this->SteemPost->getDiscussionsByTrending('life', 2));
	}

	public function testGetDiscussionsByCreated()
	{
		$this->assertArrayHasKey('instance', $this->SteemPost->getDiscussionsByCreated('life', 2));
	}

	public function testGetDiscussionsByActive()
	{
		$this->assertArrayHasKey('instance', $this->SteemPost->getDiscussionsByActive('life', 2));
	}

	public function testGetDiscussionsByPromoted()
	{
		$this->assertArrayHasKey('instance', $this->SteemPost->getDiscussionsByPromoted('life', 2));
	}

	public function testGetDiscussionsByCashout()
	{
		$this->assertArrayHasKey('instance', $this->SteemPost->getDiscussionsByCashout('life', 2));
	}

	public function testGetDiscussionsByPayout()
	{
		$this->assertArrayHasKey('instance', $this->SteemPost->getDiscussionsByPayout('life', 2));
	}

	public function testGetDiscussionsByVotes()
	{
		$this->assertArrayHasKey('instance', $this->SteemPost->getDiscussionsByVotes('life', 2));
	}

	public function testGetDiscussionsByChildren()
	{
		$this->assertArrayHasKey('instance', $this->SteemPost->getDiscussionsByChildren('life', 2));
	}

	public function testGetDiscussionsByHot()
	{
		$this->assertArrayHasKey('instance', $this->SteemPost->getDiscussionsByHot('life', 2));
	}

	public function testGetDiscussionsByFeed()
	{
		$this->assertArrayHasKey('instance', $this->SteemPost->getDiscussionsByFeed('davidk', 2));
	}

	public function testGetDiscussionsByBlog()
	{
		$this->assertArrayHasKey('instance', $this->SteemPost->getDiscussionsByBlog('davidk', 2));
	}

	public function testGetDiscussionsByComments()
	{
		$this->assertArrayHasKey('instance', $this->SteemPost->getDiscussionsByComments('davidk', '', 2));
	}

	public function testGetDiscussionsByAuthorBeforeDate()
	{
		$this->assertArrayHasKey('instance', $this->SteemPost->getDiscussionsByAuthorBeforeDate('davidk', '', '2017-06-29', 2));
	}

	public function testGetRepliesByLastUpvote()
	{
		$this->assertArrayHasKey('instance', $this->SteemPost->getRepliesByLastUpvote('davidk', '', 2));
	}

	public function testGet()
	{
		$this->assertArrayHasKey('instance', $this->SteemPost->getActiveVotes('davidk', 'steemphp-new-functions-added-part-1'));
	}

	public function testGetState()
	{
		$this->assertArrayHasKey('instance', $this->SteemPost->getState('/@davidk'));
	}

}

?>

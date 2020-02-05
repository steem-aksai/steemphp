<?php

include (__DIR__).'/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class SteemPostTest extends TestCase
{

	protected function setUp(): void
	{
		$this->SteemPost = new \SteemPHP\SteemPost('https://anyx.io');
	}

	// public function testGetApi()
	// {
	// 	$this->assertIsInt($this->SteemPost->getApi('login_api'));
	// }

	public function testGetTrendingTags()
	{
		$this->assertArrayHasKey('name', $this->SteemPost->getTrendingTags('steemit', 10)[0]);
	}

	public function testGetContent()
	{
		$this->assertArrayHasKey('author', $this->SteemPost->getContent('davidk', 'steemphp-new-functions-added-part-1'));
	}

	public function testGetcontentReplies()
	{
		$this->assertArrayHasKey('author', $this->SteemPost->getContentReplies('davidk', 'steemphp-new-functions-added-part-1')[0]);
	}

	public function testGetDiscussionsByTrending()
	{
		$this->assertArrayHasKey('author', $this->SteemPost->getDiscussionsByTrending('life', 2)[0]);
	}

	public function testGetDiscussionsByCreated()
	{
		$this->assertArrayHasKey('author', $this->SteemPost->getDiscussionsByCreated('life', 2)[0]);
	}

	public function testGetDiscussionsByActive()
	{
		$this->assertArrayHasKey('author', $this->SteemPost->getDiscussionsByActive('life', 2)[0]);
	}

	public function testGetDiscussionsByPromoted()
	{
		$this->assertIsArray($this->SteemPost->getDiscussionsByPromoted('life', 2));
	}

	public function testGetDiscussionsByCashout()
	{
		$this->assertIsArray($this->SteemPost->getDiscussionsByCashout('life', 2));
	}

	public function testGetDiscussionsByPayout()
	{
		$this->assertArrayHasKey('author', $this->SteemPost->getDiscussionsByPayout('life', 2)[0]);
	}

	public function testGetDiscussionsByVotes()
	{
		$this->assertArrayHasKey('author', $this->SteemPost->getDiscussionsByVotes('life', 2)[0]);
	}

	public function testGetDiscussionsByChildren()
	{
		$this->assertArrayHasKey('author', $this->SteemPost->getDiscussionsByChildren('life', 2)[0]);
	}

	public function testGetDiscussionsByHot()
	{
		$this->assertArrayHasKey('author', $this->SteemPost->getDiscussionsByHot('life', 2)[0]);
	}

	public function testGetDiscussionsByFeed()
	{
		$this->assertArrayHasKey('author', $this->SteemPost->getDiscussionsByFeed('davidk', 2)[0]);
	}

	public function testGetDiscussionsByBlog()
	{
		$this->assertArrayHasKey('author', $this->SteemPost->getDiscussionsByBlog('davidk', 2)[0]);
	}

	public function testGetDiscussionsByComments()
	{
		$this->assertArrayHasKey('author', $this->SteemPost->getDiscussionsByComments('davidk', '', 2)[0]);
	}

	public function testGetDiscussionsByAuthorBeforeDate()
	{
		$this->assertArrayHasKey('author', $this->SteemPost->getDiscussionsByAuthorBeforeDate('davidk', '', '2017-06-29', 2)[0]);
	}

	public function testGetRepliesByLastUpvote()
	{
		$this->assertArrayHasKey('author', $this->SteemPost->getRepliesByLastUpvote('davidk', '', 2)[0]);
	}

	public function testGet()
	{
		$this->assertArrayHasKey('voter', $this->SteemPost->getActiveVotes('davidk', 'steemphp-new-functions-added-part-1')[0]);
	}

	public function testGetState()
	{
		$this->assertArrayHasKey('props', $this->SteemPost->getState('/@davidk'));
	}

	public function testComment()
	{
		$this->assertIsInt($this->SteemPost->comment("...", "koei", "steempeak-cn", "koei", null, "", "Test with SteemPHP", "{}"));
	}

	public function testDeleteComment()
	{
		$this->assertIsInt($this->SteemPost->deleteComment("...", "koei",  "re-koei-steempeak-cn-20200204t091738252z"));
	}

	public function testVote()
	{
		$this->assertIsInt($this->SteemPost->vote("...", "koei", "koei", "re-koei-steempeak-cn-20200203t130104730z", 20));
	}

	public function testUnVote()
	{
		$this->assertIsInt($this->SteemPost->unvote("...", "koei", "koei", "re-koei-steempeak-cn-20200203t130104730z"));
	}

	public function testReblog()
	{
		$this->assertIsInt($this->SteemPost->reblog("...", "koei", "robertyan", "awesome-steem-for-steem-developers"));
	}

}

?>

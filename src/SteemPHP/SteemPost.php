<?php

namespace SteemPHP;

use JsonRPC\Client;
use JsonRPC\HttpClient;
use SteemPHP\SteemHelper;

/**
* SteemPost
*
* This Class contains functions for fetching articles from steeemit blockchain
*/
class SteemPost
{

	/**
	 * @var $host
	 *
	 * $host will be where our script will connect to fetch the data
	 */
	protected $host;

	/**
	 * @var $client
	 *
	 * $client is part of JsonRPC which will be used to connect to the server
	 */
	protected $client;

	/**
	 * @var $steemBroadcast
	 *
	 * $steemBroadcast is the SteemBroadcast object for sending broadcast
	 */
	protected $steemBroadcast;

	/**
	 * Initialize the connection to the host
	 *
	 * @param      string  $host   The node you want to connect
	 */
	public function __construct($host = 'https://api.steemit.com')
	{
		$this->host = trim($host);
		$this->httpClient = new HttpClient($this->host);
		$this->httpClient->withoutSslVerification();
		$this->client = new Client($this->host, false, $this->httpClient);
		$this->steemBroadcast = new SteemBroadcast($this->host);
	}

	/**
	 * @deprecated
	 *
	 * Gets the api number by api $name
	 *
	 * @param      sting  $name   The name of the api
	 *
	 * @return     integer        The api number
	 */
	public function getApi($name)
	{
		try{
			return $this->client->call(1, 'get_api_by_name', [$name]);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Gets the list of trending tags after $afterTag.
	 *
	 * @param      string   $afterTag  The after tag
	 * @param      integer  $limit     The limit
	 *
	 * @return     array    The trending tags.
	 */
	public function getTrendingTags($afterTag, $limit = 100)
	{
		try {
			return $this->client->call('database_api', 'get_trending_tags', [$afterTag, SteemHelper::filterInt($limit)]);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Gets the content of an article.
	 *
	 * @param      string  $author    The author
	 * @param      string  $permlink  The permlink
	 *
	 * @return     array   The content.
	 */
	public function getContent($author, $permlink)
	{
		try {
			return $this->client->call('database_api', 'get_content', [$author, $permlink]);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Gets the content replies.
	 *
	 * @param      string  $author    The author
	 * @param      string  $permlink  The permlink
	 *
	 * @return     array   The content replies.
	 */
	public function getContentReplies($author, $permlink)
	{
		try {
			return $this->client->call('database_api', 'get_content_replies', [$author, $permlink]);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Gets the list of trending articles (content/votes/replies) posted under the $tag.
	 * Start author and start permlink are for pagination.
	 *
	 * @param      string   $tag            The tag
	 * @param      integer  $limit          The limit
	 * @param      string   $startAuthor    The start author
	 * @param      string   $startPermlink  The start permlink
	 *
	 * @return     array    The list of trending articles.
	 */
	public function getDiscussionsByTrending($tag, $limit = 100, $startAuthor = null, $startPermlink = null)
	{
		try {
			$query = ['tag' => $tag, 'limit' => SteemHelper::filterInt($limit), 'start_author' => $startAuthor, 'start_permlink' => $startPermlink];
			return $this->client->call('database_api', 'get_discussions_by_trending', [$query]);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Gets the list of articles created under the $tag
	 * Start author and start permlink are for pagination.
	 *
	 * @param      string   $tag            The tag
	 * @param      integer  $limit          The limit
	 * @param      string   $startAuthor    The start author
	 * @param      string   $startPermlink  The start permlink
	 *
	 * @return     array    The list of articles.
	 */
	public function getDiscussionsByCreated($tag, $limit = 100, $startAuthor = null, $startPermlink = null)
	{
		try {
			$query = ['tag' => $tag, 'limit' => SteemHelper::filterInt($limit), 'start_author' => $startAuthor, 'start_permlink' => $startPermlink];
			return $this->client->call('database_api', 'get_discussions_by_created', [$query]);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Gets the list of active articles under the $tag
	 * active article: an article that has just recieved an upvote/comment/reblog
	 * Start author and start permlink are for pagination
	 *
	 * @param      string   $tag            The tag
	 * @param      integer  $limit          The limit
	 * @param      string   $startAuthor    The start author
	 * @param      string   $startPermlink  The start permlink
	 *
	 * @return     array    The list of active articles.
	 */
	public function getDiscussionsByActive($tag, $limit = 100, $startAuthor = null, $startPermlink = null)
	{
		try {
			$query = ['tag' => $tag, 'limit' => SteemHelper::filterInt($limit), 'start_author' => $startAuthor, 'start_permlink' => $startPermlink];
			return $this->client->call('database_api', 'get_discussions_by_active', [$query]);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Gets the list of articles which are promoted under the tag $tag
	 * Start author and start permlink are for pagination
	 *
	 * @param      string   $tag            The tag
	 * @param      integer  $limit          The limit
	 * @param      string   $startAuthor    The start author
	 * @param      string   $startPermlink  The start permlink
	 *
	 * @return     array    The list of promoted articles
	 */
	public function getDiscussionsByPromoted($tag, $limit = 100, $startAuthor = null, $startPermlink = null)
	{
		try {
			$query = ['tag' => $tag, 'limit' => SteemHelper::filterInt($limit), 'start_author' => $startAuthor, 'start_permlink' => $startPermlink];
			return $this->client->call('database_api', 'get_discussions_by_promoted', [$query]);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Gets the list of articles where the rewards will be payed in less than 12 hour.
	 * Start author and start permlink are for pagination.
	 *
	 * @param      string   $tag            The tag
	 * @param      integer  $limit          The limit
	 * @param      string   $startAuthor    The start author
	 * @param      string   $startPermlink  The start permlink
	 *
	 * @return     array    The list of articles by cashout.
	 */
	public function getDiscussionsByCashout($tag, $limit = 100, $startAuthor = null, $startPermlink = null)
	{
		try {
			$query = ['tag' => $tag, 'limit' => SteemHelper::filterInt($limit), 'start_author' => $startAuthor, 'start_permlink' => $startPermlink];
			return $this->client->call('database_api', 'get_discussions_by_cashout', [$query]);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Gets the list of articles which have the highest payout under the $tag.
	 * Start author and start permlink are for pagination.
	 *
	 * @param      string   $tag            The tag
	 * @param      integer  $limit          The limit
	 * @param      string   $startAuthor    The start author
	 * @param      string   $startPermlink  The start permlink
	 *
	 * @return     array    The list of articles by payout.
	 */
	public function getDiscussionsByPayout($tag, $limit = 100, $startAuthor = null, $startPermlink = null)
	{
		try {
			$query = ['tag' => $tag, 'limit' => SteemHelper::filterInt($limit), 'start_author' => $startAuthor, 'start_permlink' => $startPermlink];
			return $this->client->call('database_api', 'get_discussions_by_payout', [$query]);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Get list of articles that has recieved the highest upvotes using the tag $tag
	 * Start author and start permlink are for pagination
	 *
	 * @param      string   $tag            The tag
	 * @param      integer  $limit          The limit
	 * @param      string   $startAuthor    The start author
	 * @param      string   $startPermlink  The start permlink
	 *
	 * @return     array    The discussions by votes.
	 */
	public function getDiscussionsByVotes($tag, $limit = 100, $startAuthor = null, $startPermlink = null)
	{
		try {
			$query = ['tag' => $tag, 'limit' => SteemHelper::filterInt($limit), 'start_author' => $startAuthor, 'start_permlink' => $startPermlink];
			return $this->client->call('database_api', 'get_discussions_by_votes', [$query]);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Get articles by childer
	 * Start author and start permlink are for pagination
	 *
	 * @param      string   $tag            The tag
	 * @param      integer  $limit          The limit
	 * @param      string   $startAuthor    The start author
	 * @param      string   $startPermlink  The start permlink
	 *
	 * @return     array    The discussions by children.
	 */
	public function getDiscussionsByChildren($tag, $limit = 100, $startAuthor = null, $startPermlink = null)
	{
		try {
			$query = ['tag' => $tag, 'limit' => SteemHelper::filterInt($limit), 'start_author' => $startAuthor, 'start_permlink' => $startPermlink];
			return $this->client->call('database_api', 'get_discussions_by_children', [$query]);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Get list of articles which are hot and using tha tag $tag
	 * Start author and start permlink are for pagination
	 *
	 * @param      string   $tag            The tag
	 * @param      integer  $limit          The limit
	 * @param      string   $startAuthor    The start author
	 * @param      string   $startPermlink  The start permlink
	 *
	 * @return     array    The discussions by hot.
	 */
	public function getDiscussionsByHot($tag, $limit = 100, $startAuthor = null, $startPermlink = null)
	{
		try {
			$query = ['tag' => $tag, 'limit' => SteemHelper::filterInt($limit), 'start_author' => $startAuthor, 'start_permlink' => $startPermlink];
			return $this->client->call('database_api', 'get_discussions_by_hot', [$query]);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Get list of articles in the feed section for the author $author
	 * Start author and start permlink are for pagination
	 *
	 * @param      string   $author         The author
	 * @param      integer  $limit          The limit
	 * @param      string   $startAuthor    The start author
	 * @param      string   $startPermlink  The start permlink
	 *
	 * @return     array    The discussions by feed.
	 */
	public function getDiscussionsByFeed($author, $limit = 100, $startAuthor = null, $startPermlink = null)
	{
		try {
			$query = ['tag' => $author, 'limit' => SteemHelper::filterInt($limit), 'start_author' => $startAuthor, 'start_permlink' => $startPermlink];
			return $this->client->call('database_api', 'get_discussions_by_feed', [$query]);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Get list of articles written/reblogged by the author $author
	 * $startPermlink are null by default and the data can be used for pagination
	 *
	 * @param      string   $author         The author
	 * @param      integer  $limit          The limit
	 * @param      string   $startPermlink  The start permlink
	 *
	 * @return     array    The discussions by blog.
	 */
	public function getDiscussionsByBlog($author, $limit = 100, $startPermlink = null)
	{
		try {
			$startAuthor = !is_null($startPermlink) ? $author : null;
			$query = ['tag' => $author, 'limit' => SteemHelper::filterInt($limit), 'start_author' => $startAuthor, 'start_permlink' => $startPermlink];
			return $this->client->call('database_api', 'get_discussions_by_blog', [$query]);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Get list of articles the $author has commented on
	 *
	 * @param      string   $author    The author
	 * @param      string   $permlink  The permlink
	 * @param      integer  $limit     The limit
	 *
	 * @return     array    The discussions by comments.
	 */
	public function getDiscussionsByComments($author, $permlink, $limit = 100)
	{
		try {
			$query = ['start_author' => $author, 'start_permlink' => $permlink, 'limit' => SteemHelper::filterInt($limit)];
			return $this->client->call('database_api', 'get_discussions_by_comments', [$query]);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Get the list of articles written by the $author before the date $beforeDate
	 *
	 * @param      string   $author         The author
	 * @param      string   $startPermlink  The start permlink
	 * @param      date     $beforeDate     The before date
	 * @param      integer  $limit          The limit
	 *
	 * @return     array    The discussions by author before date.
	 */
	public function getDiscussionsByAuthorBeforeDate($author, $startPermlink, $beforeDate, $limit = 100)
	{
		try {
			return $this->client->call('database_api', 'get_discussions_by_author_before_date', [$author, $startPermlink, SteemHelper::filterDate($beforeDate), SteemHelper::filterInt($limit)]);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Get list of replies for where the article has recieved the most upvotes for the author $author
	 * where the article has been posted less than a week ago
	 *
	 * @param      string   $startAuthor    The start author
	 * @param      string   $startPermlink  The start permlink
	 * @param      integer  $limit          The limit
	 *
	 * @return     array    The replies by last upvote.
	 */
	public function getRepliesByLastUpvote($startAuthor, $startPermlink, $limit = 100)
	{
		try {
			return $this->client->call('database_api', 'get_replies_by_last_update', [$startAuthor, $startPermlink, SteemHelper::filterInt($limit)]);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Get the list of upvotes the article $startPermlink has received
	 *
	 * @param      string  $startAuthor    The start author
	 * @param      string  $startPermlink  The start permlink
	 *
	 * @return     array   The active votes.
	 */
	public function getActiveVotes($startAuthor, $startPermlink)
	{
		try {
			return $this->client->call('database_api', 'get_active_votes', [$startAuthor, $startPermlink]);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Get state for $path eg: /@davidk
	 *
	 * @param      string  $path   The path
	 *
	 * @return     array   The state.
	 */
	public function getState($path)
	{
		try {
			return $this->client->call('database_api', 'get_state', [$path]);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Send a comment
	 *
	 * @param      string  $wif   The private key for the action
	 * @param      string  $parentAuthor   	The author of the parent comment
	 * @param      string  $parentPermlink  The permlink of the parent comment
	 * @param      string  $author   				The author of the comment
	 * @param      string  $permlink   			The permlink of the comment
	 * @param      string  $title   				The title of the comment
	 * @param      string  $body   					The body of the comment
	 * @param      string  $jsonMetadata   	The json data of the comment
	 *
	 * @return     array   The state.
	 */
	public function comment($wif, $parentAuthor, $parentPermlink, $author, $permlink, 		$title, $body, $jsonMetadata) {
		if ($parentAuthor && $parentPermlink && !$permlink) {
			$permlink = SteemHelper::commentPermlink($parentAuthor, $parentPermlink);
		}
		return $this->steemBroadcast->send(array(
			"extensions" => [],
			"operations" => [["comment", [
				'parent_author' => $parentAuthor,
				'parent_permlink' => $parentPermlink,
				'author' => $author,
				'permlink' => $permlink,
				'title' => $title,
				'body' => $body,
				'json_metadata' => $jsonMetadata
			]]]
		), array(
			"posting" => $wif
		));

	}

}

?>

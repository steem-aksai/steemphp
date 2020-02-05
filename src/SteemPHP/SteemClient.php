<?php

namespace SteemPHP;

use JsonRPC\Client;
use JsonRPC\HttpClient;
use JsonRPC\Exception\ConnectionFailureException;
use SteemPHP\SteemHelper;

/**
* SteemPost
*
* This Class contains functions for fetching articles from steeemit blockchain
*/
class SteemClient
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
	 * @var $maxTries
	 *
	 * The max number of retries of a single call
	 */
  protected $maxTries = 10;

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
	}

  /**
   * Execute the function by calling Client->__call
   *
   * @param  int      $tries   Retry times
   * @param  array    $params   Procedure arguments
   *
   * @return Exception|Client
   *
   * @throws Exception
   */
  public function __execute($tries, array $params)
	{
		try{
			return $this->client->call(...$params);
		} catch (ConnectionFailureException $e) {
      if ($tries < $this->maxTries) {
        $tries ++;
        return $this->__execute($tries, $params);
      } else {
        throw $e;
      }
		} catch (\Exception $e) {
      return SteemHelper::handleError($e);
    }
  }


  /**
   * Call the function with variable length arguments
   *
   * @param  array    $params   Procedure arguments
   *
   * @return Exception|Client
   *
   * @throws Exception
   */
  public function call(...$params)
	{
		return $this->__execute(0, $params);
  }

}

?>

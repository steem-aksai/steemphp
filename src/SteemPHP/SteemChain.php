<?php

namespace SteemPHP;

use SteemPHP\SteemClient;

/**
* SteemChain
*
* This Class is contains only Steemit BlockChain Methods
*/
class SteemChain
{

	/**
	 * @var $client
	 *
	 * $client is part of JsonRPC which will be used to connect to the server
	 */
	protected $client;

	/**
	 * Initialize the connection to the host
	 *
	 * @param      string  $host   The node you want to connect
	 */
	public function __construct($host = 'https://node.steem.ws')
	{
		$this->client = new SteemClient($host);
	}

	/**
	 * @deprecated
	 * Get Api number
	 * @param String $name
	 * @return int
	 */
	public function getApi($name)
	{
		try {
			return $this->client->call(1, 'get_api_by_name', [$name]);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Get Current blockchain version with steem and fc revision
	 * @return array
	 */
	public function getVersion()
	{
		try {
			return $this->client->call('login_api', 'get_version', []);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Get the total number of registered steem accounts
	 * @return int
	 */
	public function getAccountCount()
	{
		try {
			return $this->client->call('database_api', 'get_account_count', []);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Get currency blockchain properties
	 * @return array
	 */
	public function getChainProperties()
	{
		try {
			return $this->client->call('database_api', 'get_chain_properties', []);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Get blockchain configuration
	 * @return array
	 */
	public function getConfig()
	{
		try {
			return $this->client->call('database_api', 'get_config', []);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Get Dynamic Global Properties
	 * @return array
	 */
	public function getDynamicGlobalProperties()
	{
		try {
			return $this->client->call('database_api', 'get_dynamic_global_properties', []);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Get Feed History
	 * @return array
	 */
	public function getFeedHistory()
	{
		try {
			return $this->client->call('database_api', 'get_feed_history', []);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Get Current Median History Price
	 * @return array
	 */
	public function getCurrentMeidanHistoryPrice()
	{
		try {
			return $this->client->call('database_api', 'get_current_median_history_price', []);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Get current Hardfork version
	 * @return version
	 */
	public function getHardforkVersion()
	{
		try {
			return $this->client->call('database_api', 'get_hardfork_version', []);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Get next scheduled hardfork version and date
	 * @return array
	 */
	public function getNextScheduledHardfork()
	{
		try {
			return $this->client->call('database_api', 'get_next_scheduled_hardfork', []);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

}

?>

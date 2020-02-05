<?php

namespace SteemPHP;

use SteemPHP\SteemClient;
use SteemPHP\SteemHelper;

/**
* SteemWitness
*
* SteemWitness contains witness functions
*/
class SteemWitness
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
	 * Initialize the connection to the host
	 * @param String $host
	 */
	public function __construct($host = 'https://api.steemit.com')
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
	 * Get total withness count
	 * @return int
	 */
	public function getWitnessCount()
	{
		try {
			return $this->client->call('database_api', 'get_witness_count', []);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Get list of witness account names similar to $account
	 * @param String $account
	 * @param int $limit
	 * @return array
	 */
	public function lookupWitnessAccounts($lowerBoundName, $limit = 100)
	{
		try {
			return $this->client->call('database_api', 'lookup_witness_accounts', [$lowerBoundName, SteemHelper::filterInt($limit)]);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Get the next witness schedule
	 * @return array
	 */
	public function getWitnessSchedule()
	{
		try {
			return $this->client->call('database_api', 'get_witness_schedule', []);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Get witness information by ID
	 * @param int|array $accounts
	 * @return array
	 */
	public function getWitnesses($accounts = [])
	{
		try {
			$accounts = !is_array($accounts) ? [$accounts] : $accounts;
			return $this->client->call('database_api', 'get_witnesses', [$accounts]);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Get witness information by account name
	 * @param String $account
	 * @return array
	 */
	public function getWitnessByAccount($account)
	{
		try {
			return $this->client->call('database_api', 'get_witness_by_account', [$account]);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Get Witnesses by vote where the names are similar to $account name
	 * @param String $account
	 * @param int $limit
	 * @return array
	 */
	public function getWitnessesByVote($account, $limit = 100)
	{
		try {
			return $this->client->call('database_api', 'get_witnesses_by_vote', [$account, SteemHelper::filterInt($limit)]);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Get list of active witnesses
	 * @return array
	 */
	public function getActiveWitnesses()
	{
		try {
			return $this->client->call('database_api', 'get_active_witnesses', []);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

	/**
	 * Get list of miners queue
	 * @return array
	 */
	public function getMinerQueue()
	{
		try {
			return $this->client->call('database_api', 'get_miner_queue', []);
		} catch (\Exception $e) {
			return SteemHelper::handleError($e);
		}
	}

}

?>

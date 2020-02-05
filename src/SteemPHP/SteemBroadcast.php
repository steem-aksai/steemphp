<?php

namespace SteemPHP;

use t3ran13\ByteBuffer\ByteBuffer;
use SteemPHP\SteemClient;
use SteemPHP\SteemBlock;
use SteemPHP\SteemChain;

/**
* SteemAuth
*
* This Class contains functions for steem auth
*/
class SteemBroadcast
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
	 * @var $steemBlock
	 *
	 * $steemBlock SteemBlock object for block manipulations
	 */
  protected $steemBlock;

  /**
	 * @var $steemChain
	 *
	 * $steemChain SteemChain object for chain manipulations
	 */
	protected $steemChain;

  /**
	 * Initialize the connection to the host
	 *
	 * @param      string  $host   The node you want to connect
	 */
	public function __construct($host = 'https://anyx.io')
	{
		$this->client = new SteemClient($host);
		$this->steemBlock = new SteemBlock($host);
		$this->steemChain = new SteemChain($host);
	}

	/**
	 * Send broadcast transaction
	 *
	 * @param      object 		 $trx  The transaction object
	 * @param      array  		 $privKeys  The keys for signing the transaction
	 */
	public function send($tx, $privKeys)
	{
    $transaction = $this->prepareTransaction($tx);
		$signedTransaction = SteemAuth::signTransaction($transaction, $privKeys);
		// fwrite(STDOUT, print_r("\nBROADCAST:\n", TRUE));
		// fwrite(STDOUT, print_r($signedTransaction, TRUE));
    $result = $this->steemBlock->broadcastTransactionSynchronous($signedTransaction);
    return array_merge($result, $signedTransaction);
  }

  /**
	 * Prepare transaction for broadcasting
	 *
	 * @param      string 		 $trx  The transaction ID
	 */
	private function prepareTransaction($tx)
	{
    $properties = $this->steemChain->getDynamicGlobalProperties();
		// Set defaults on the transaction
    $chainDate = (new \DateTime($properties['time']." +10 minutes"))->format('Y-m-d\TH:i:s');
    $refBlockNum = ($properties['last_irreversible_block_num'] - 1) & 0xFFFF;
		$block = $this->steemBlock->getBlockHeader($properties['last_irreversible_block_num']);
		$headBlockId = $block ? $block['previous'] : '0000000000000000000000000000000000000000';
		$buf = new ByteBuffer();
    $buf->write(hex2bin($headBlockId));
    return array_merge([
			"ref_block_num" => $refBlockNum,
			"ref_block_prefix" => $buf->readInt32lE(4),
      "expiration" => $chainDate
		], $tx);
	}

	/**
	 * Broadcast an operation with a transaction
	 *
	 * @param      string 		 $name   The operation name
	 * @param      array 		   $params   The operation parameters
	 * @param      array  		 $privKeys    The keys for signing the transaction
	 */
	public function execute($name, $params, $privKeys)
	{
		return $this->send(array(
			"extensions" => [],
			"operations" => [[$name, $params]]
		), $privKeys);
  }


	/**
	 * Send a comment
	 *
	 * @param      string  $wif   The private key for the action
	 * @param      string  $id   				Identifier for the custom json (max length 32 bytes)
	 * @param      string  $json   			The json data to put into the custom_json operation
	 * @param      string  $requiredAuths   	The required auths
	 * @param      string  $requiredPostingAuths  The required posting auths
	 *
	 * @return     array   The response of the action.
	 */
	public function customJson($wif, $id, $json, $requiredAuths = [], $requiredPostingAuths = [])
	{
		if (gettype($json) != "string") {
			$json = json_encode($json);
		}
		return $this->execute("custom_json", [
				'wif' => $wif,
				'required_auths' => $requiredAuths,
				'required_posting_auths' => $requiredPostingAuths,
				'id' => $id,
				'json' => $json
			], [
				"posting" => $wif
			]);
	}


}

?>

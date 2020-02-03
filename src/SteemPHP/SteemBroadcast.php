<?php

namespace SteemPHP;

use JsonRPC\Client;
use JsonRPC\HttpClient;
use t3ran13\ByteBuffer\ByteBuffer;
use SteemPHP\SteemHelper;
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
		$this->host = trim($host);
		$this->httpClient = new HttpClient($this->host);
		$this->httpClient->withoutSslVerification();
    $this->client = new Client($this->host, false, $this->httpClient);
    $this->steemBlock = new SteemBlock($this->host);
    $this->steemChain = new SteemChain($this->host);
	}

	/**
	 * Send broadcast transaction
	 *
	 * @param      string 		 $trx  The transaction ID
	 * @param      array  		 $privKeys  The keys for signing the transaction
	 */
  public function send($tx, $privKeys) {
    $transaction = $this->prepareTransaction($tx);
		$signedTransaction = SteemAuth::signTransaction($transaction, $privKeys);
		fwrite(STDOUT, print_r("\nBROADCAST:\n", TRUE));
		fwrite(STDOUT, print_r($signedTransaction, TRUE));
    $result = $this->steemBlock->broadcastTransactionSynchronous($signedTransaction);
    return array_merge($result, $signedTransaction);
  }

  /**
	 * Prepare transaction for broadcasting
	 *
	 * @param      string 		 $trx  The transaction ID
	 */
  private function prepareTransaction($tx) {
    $properties = $this->steemChain->getDynamicGlobalProperties();
		// Set defaults on the transaction
		fwrite(STDOUT, print_r($properties, TRUE));
    $chainDate = (new \DateTime($properties['time']." +10 minutes"))->format('Y-m-d\TH:i:s');
    $refBlockNum = ($properties['last_irreversible_block_num'] - 1) & 0xFFFF;
		$block = $this->steemBlock->getBlockHeader($properties['last_irreversible_block_num']);
		fwrite(STDOUT, print_r($block, TRUE));
		$headBlockId = $block ? $block['previous'] : '0000000000000000000000000000000000000000';
		$buf = new ByteBuffer();
    $buf->write(hex2bin($headBlockId));
    return array_merge(array(
			"ref_block_num" => $refBlockNum,
			"ref_block_prefix" => $buf->readInt32lE(4),
      // "ref_block_prefix" => unpack("V*", hex2bin($headBlockId), 4), // unsigned long (always 32 bit, little endian byte order)
      "expiration" => $chainDate
    ), $tx);
  }
}

?>

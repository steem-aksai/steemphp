<?php

include (__DIR__).'/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use SteemPHP\SteemAuth;

class SteemAuthTest extends TestCase
{

	protected function setUp(): void
	{

	}

	public function testSignTransaction()
	{
    $transaction = array(
      "ref_block_num" => 53292,
      "ref_block_prefix" => 2936360620,
      "expiration" => "2020-02-03T06:58:36",
      "extensions" => [],
      "operations" => [["comment", array(
        "parent_author" => "koei",
        "parent_permlink" => "steempeak-cn",
        "author" => "koei",
        "permlink" => "re-koei-steempeak-cn-20200203t064833723z",
        "title" => "",
        "body" => "Test with SteemPHP",
        "json_metadata" => "{}"
      )]]
    );
    $privKeys = array(
      "posting" => "..."
    );
		$signedTransaction = SteemAuth::signTransaction($transaction, $privKeys);
		fwrite(STDOUT, print_r("\nBROADCAST: \t\t", TRUE));
    fwrite(STDOUT, print_r($signedTransaction, TRUE));

    $this->assertEquals("...", $signedTransaction["signatures"][0]);
	}

}

?>

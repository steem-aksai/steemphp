<?php

namespace SteemPHP;

use SteemPHP\SteemHelper;
use BitWasp\Buffertools\Buffer;
use BitWasp\Bitcoin\Key\Factory\PrivateKeyFactory;
use BitWasp\Bitcoin\Base58;
use t3ran13\ByteBuffer\ByteBuffer;

/**
* SteemPrivate
*
* This Class contains functions for steem private key
*/
class SteemPrivate
{

	/**
	 * @var $prefix
	 *
	 * $prefix is the address prefix for public keys
	 */
	public $prefix = "STM";

	/**
	 * Sets the address prefix.
	 *
	 * @param      string  $prefix  The prefix
	 */
	public function setPrefix($prefix)
	{
		$this->prefix = trim($prefix);
	}

	/**
	 * password to private WIF
	 *
	 * @param      string  $name      The username
	 * @param      string  $password  The password
	 * @param      string  $role      The role
	 *
	 * @return     array   private wif
	 */
	public function toWif($name, $password, $role)
	{
		$seed = $name.$role.$password;
		$brainKey = implode(" ", explode("/[\t\n\v\f\r ]+/", trim($seed)));
		$hashSha256 = hash('sha256', $brainKey);
		$privKey = PrivateKeyFactory::fromHex($hashSha256);
		$privWif = $privKey->toWif();
		return $privWif;
	}

	/**
	 * Get Private Key / WIF from seed
	 *
	 * @param      string  $seed   The seed
	 *
	 * @return     array   private wif
	 */
	public function fromSeed($seed)
	{
		if (gettype($seed) != "string") {
			return ['error' => 'string required for seed'];
		} else {
			return PrivateKeyFactory::fromHex(hash('sha256', $seed))->toWif();
		}
	}

	/**
	 * Get Private Key / WIF from a buffer
	 * buffer is the same as hex
	 *
	 * @param      string         $buffer  The buffer/hex
	 *
	 * @return     array|string   array on failure|wif on success
	 */
	public function fromBuffer($buffer)
	{
		if (!Buffer::hex($buffer)) {
			return ['error' => 'Expecting paramter to be a Buffer type'];
		} else if (strlen($buffer) == 32) {
			return ['error' => 'Empty Buffer'];
		} else {
			return PrivateKeyFactory::fromHex($buffer)->toWif();
		}
	}

	/**
	 * Check if the given string is wif
	 *
	 * @param      string   $wif    The wif
	 *
	 * @return     boolean  True if wif, False otherwise.
	 */
	public function isWif($wif)
	{
		try {
			PrivateKeyFactory::fromWif($wif);
			return true;
		} catch(\Exception $e) {
			return false;
		}
	}

	/**
	 * Get wif from wif
	 *
	 * @param      string  $wif    The wif
	 *
	 * @return     string  The wif
	 */
	public static function fromWif($wif)
	{
		return (new PrivateKeyFactory())->fromWif($wif)->toWif();
	}


	/**
	 * @param string $privateWif Private (posting key?) wif
	 *
	 * @return string outputs Private key as string of binary
	 * @throws \Exception
	 */
	public static function keyFromWif($privateWif) {
		// checking wif version
		$base58 = new Base58();
		$wifBuffer = new ByteBuffer();
		$wifBuffer->write($base58->decode($privateWif)->getBinary());
		$version = $wifBuffer->readInt8(0);
		if ($version !== 128) {
				//        assert.equal(0x80, version, `Expected version ${0x80}, instead got ${version}`);
				throw new \Exception('Expected version 128, instead got ' . $version);
		}

		// checking WIF checksum
		$private_key = $wifBuffer->read(0, $wifBuffer->length() - 4);
		$checksum = $wifBuffer->read($wifBuffer->length() - 4, 4);
		$new_checksum = hash('sha256', $private_key, true);
		$new_checksum = hash('sha256', $new_checksum, true);
		$new_checksum = substr($new_checksum, 0, 4);
		if ($new_checksum !== $checksum) {
				throw new \Exception('Invalid WIF key (checksum miss-match)');
		}

		// getting private_key
		$private_key = substr($private_key, 1);
		$length = strlen($private_key);
		if ($length !== 32) {
				throw new \Exception('Expecting 32 bytes for private_key, instead got ' . $length);
		}

		return $private_key;
	}

}

?>

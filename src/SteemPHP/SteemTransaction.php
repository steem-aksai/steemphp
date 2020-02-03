<?php

namespace SteemPHP;

use Elliptic\EC;
use Elliptic\EC\Signature;
use SteemPHP\SteemPrivate;
use SteemPHP\SteemConfig;
use SteemPHP\Operations\OperationSerializer;
use t3ran13\ByteBuffer\ByteBuffer;

class SteemTransaction
{

    /**
     * @param object $trx transaction object
     *
     * @return string transaction message
     */
    public static function getTransactionMessage($trx)
    {
		$cid = SteemConfig::STEEMIT_CHAIN_ID;
		// convert transaction into binary
		// fwrite(STDOUT, print_r($trx, TRUE));
		$buf = OperationSerializer::serializeTransaction($trx);
		// fwrite(STDOUT, print_r("\nBINARY:\n", TRUE));
		// fwrite(STDOUT, print_r($buf, TRUE));
		// fwrite(STDOUT, print_r("\nBINARY DONE\n", TRUE));
        return $cid . $buf; //Buffertools::concat($cid, $buf); //Buffer.concat([$cid, $buf])
    }

    /**
     * @param string $msg serialized Tx with prefix chain id
     * @param string $privateWif
     *
     * @return string hex
     * @throws \Exception
     */
    public static function sign($trx, $privateWif)
    {
        $ec = new EC('secp256k1');

        $i = 0;
        while (true) {

            $msg = SteemTransaction::getTransactionMessage($trx);

            // fwrite(STDOUT, print_r("\nMSG: \t\t", TRUE));
            // fwrite(STDOUT, print_r($msg, TRUE));
            // fwrite(STDOUT, print_r("\nMSG DONE\n", TRUE));

            $msg32Hex = hash('sha256', hex2bin($msg), false);
            // $privateKeyHex = bin2hex(Auth::PrivateKeyFromWif($privateWif));
            $privateKeyHex = bin2hex(SteemPrivate::keyFromWif($privateWif));
            // fwrite(STDOUT, print_r("\nPrivate Key: \t\t", TRUE));
            // fwrite(STDOUT, print_r($privateKeyHex, TRUE));
            // fwrite(STDOUT, print_r("\nPrivate Key DONE\n", TRUE));
            $key = $ec->keyFromPrivate($privateKeyHex, 'hex');

            $signature = $key->sign($msg32Hex, 'hex', ['canonical' => true]);
            /** @var Signature $signature*/

            $der = $signature->toDER('hex');
            // fwrite(STDOUT, print_r("\nSignature:\n", TRUE));
            // fwrite(STDOUT, print_r($signature, TRUE));
            // fwrite(STDOUT, print_r("\nSignature DONE\n", TRUE));
            // fwrite(STDOUT, print_r("\nDer:\n", TRUE));
            // fwrite(STDOUT, print_r($der, TRUE));
            // fwrite(STDOUT, print_r("\nDer DONE\n", TRUE));
            if (self::isSignatureCanonical(hex2bin($der))) {
                break;
            } else {
                $trx['expiration'] = (new \DateTime($trx['expiration']))
                    ->add(new \DateInterval('PT0M1S'))
                    ->format('Y-m-d\TH:i:s\.000');
            }

            $i++;
            if ($i % 10 == 0) {
                // print error when failed
                fwrite(STDOUT, print_r("\nWARN: {$i} attemps to find canonical signature\n", TRUE));
            }
            if ($i >= 100) {
                throw new \Exception("Can't find canonical signature after {$i} attempts");
            }
        }

        $recid = $ec->getKeyRecoveryParam($msg32Hex, $signature, $key->getPublic());

        $compactSign = $signature->r->toString(16) . $signature->s->toString(16);
        $serializedSig = base_convert($recid + 4 + 27, 10, 16) . $compactSign;

        $length = strlen($serializedSig);
        if ($length !== 130) { // 65 symbols
            throw new \Exception('Expecting 65 bytes for Tx signature, instead got ' . $length);
        }

        return array(
            "sig" => $serializedSig,
            "trx" => $trx
        );
    }

    /**
     * @param string $der string of binary
     *
     * @return bool
     */
    public static function isSignatureCanonical($der)
    {
        $buffer = new ByteBuffer();
        $buffer->write($der);
        $lenR = $buffer->readInt8(3);
        $lenS = $buffer->readInt8(5 + $lenR);

        // fwrite(STDOUT, print_r("\nBuffer length: {$lenR} / {$lenS}\n", TRUE));

        return $lenR === 32 && $lenS === 32;
    }

}


?>

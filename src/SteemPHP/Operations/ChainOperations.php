<?php

namespace SteemPHP\Operations;

class ChainOperations
{
    const OPERATION_VOTE            = 'vote'; //STEEM/GOLOS/whaleshares
    const OPERATION_COMMENT         = 'comment'; //STEEM/GOLOS/whaleshares
    const OPERATION_COMMENT_OPTIONS = 'comment_options'; //STEEM/GOLOS/whaleshares
    const OPERATION_TRANSFER        = 'transfer';
    const OPERATION_CUSTOM_JSON     = 'custom_json';
    const OPERATION_CUSTOM          = 'custom';//only for VIZ
    const OPERATION_DELETE_COMMENT  = 'delete_comment';

    /** @var array */
    // protected static $opMap = [];

    /**
     * @param string $operationName
     *
     * @return integer
     * @throws \Exception
     */
    public static function getOperationId($operationName)
    {
        $ops = OperationTypes::IDS;

        if (!isset($ops[$operationName])) {
            throw new \Exception("There is no information about operation:'{$operationName}'. Please add ID for this operation");
        }

        return $ops[$operationName];
    }
}




?>

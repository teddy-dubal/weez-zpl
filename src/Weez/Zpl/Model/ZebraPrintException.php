<?php

namespace Weez\Zpl\Model;

use Exception;

/**
 * Description of ZebraPrintException
 *
 * @author teddy
 */
class ZebraPrintException extends Exception
{

    /**
     * Default Constructor
     *
     * @param message
     *            message
     */
    public function __construct($message, $t) {
        parent::__construct($message, $t);
    }

}

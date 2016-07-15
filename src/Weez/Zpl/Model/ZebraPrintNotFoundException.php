<?php


namespace Weez\Zpl\Model;

/**
 * Description of ZebraPrintNotFoundException
 *
 * @author teddy
 */
class ZebraPrintNotFoundException extends ZebraPrintException {

    /**
     *
     */
    private static $serialVersionUID = 1;

    public function __construct($message, $t) {
        parent::__construct($message, $t);
    }

}

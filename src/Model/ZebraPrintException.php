<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Weez\Model;

/**
 * Description of ZebraPrintException
 *
 * @author teddy
 */
class ZebraPrintException extends \Exception {

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

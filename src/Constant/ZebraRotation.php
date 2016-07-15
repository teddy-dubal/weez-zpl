<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Weez\Zpl\Constant;

/**
 * Description of ZebraRotation
 *
 * @author teddy
 */
class ZebraRotation {

    const NORMAL           = "N";
    const ROTATE_90        = "R";
    const INVERTED         = "I";
    const READ_FROM_BOTTOM = "B";

    private $letter;

    public function __construct($letter) {
        $this->letter = $letter;
    }

    /**
     * @return the letter
     */
    public function getLetter() {
        return $letter;
    }

}

<?php


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
        return $this->letter;
    }

}

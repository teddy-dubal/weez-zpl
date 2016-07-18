<?php


namespace Weez\Zpl\Constant;

/**
 *
 * @author teddy
 */
class ZebraFont {

    const ZEBRA_ZERO = 0;
    const ZEBRA_A    = "A";
    const ZEBRA_B    = "B";
    const ZEBRA_C    = "C";
    const ZEBRA_D    = "D";
    const ZEBRA_F    = "F";
    const ZEBRA_G    = "G";

    private $letter;
    /**
     *
     * @param string $letter
     */
    public function __construct($letter) {
        $this->letter = $letter;
    }

    /**
     *
     * @return string
     */
    public function getLetter() {
        return $this->letter;
    }
}

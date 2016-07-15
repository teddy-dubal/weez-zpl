<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Weez\Zpl\Constant;

/**
 * Description of ZebraFont
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

    public function __construct($letter) {
        $this->letter = $letter;
    }

    /**
     * @return the letter
     */
    public function getLetter() {
        return $this->letter;
    }

    /**
     * Fonction use for preview to find an equivalent font compatible with Graphic2D
     *
     * @param zebraFont
     * @return
     */
    public static function findBestEquivalentFontForPreview($zebraFont) {
        return "Arial";
    }

}

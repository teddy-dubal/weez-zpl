<?php

namespace Weez\Zpl\Model\Element;

use Weez\Zpl\Utils\ZplUtils;

/**
 * Element to create a bar code 39
 * 
 * Zpl command : ^B3 and ^BY
 * 
 * @author ttropard
 * 
 */
class ZebraBarCode39 extends ZebraBarCode {

    private $checkDigit43 = false;
    /**
     *
     * @param type $positionX
     * @param type $positionY
     * @param type $text
     * @param type $barCodeHeigth
     * @param type $barCodeWidth
     * @param type $wideBarRatio
     * @param type $checkDigit43
     * @param type $showTextInterpretation
     * @param type $showTextInterpretationAbove
     */
    public function __construct($positionX, $positionY, $text, $barCodeHeigth, $barCodeWidth, $wideBarRatio = null, $checkDigit43 = false, $showTextInterpretation = false, $showTextInterpretationAbove = false)
    {
        parent::__construct($positionX, $positionY, $text, $barCodeHeigth, $barCodeWidth, $showTextInterpretation, $showTextInterpretationAbove, $wideBarRatio);
        $this->setCheckDigit43($checkDigit43);
    }

    public function getZplCode($printerOptions = null)
    {
        $zpl = $this->getStartZplCodeBuilder();
        $zpl .= ZplUtils::zplCommandSautLigne("B3", [
                    $this->zebraRotation->getLetter(),
                    $this->barCodeHeigth,
                    $this->checkDigit43,
                    $this->showTextInterpretation,
                    $this->showTextInterpretationAbove
        ]);
        $zpl .= "^FD";
        $zpl .= $this->text;
        $zpl .= ZplUtils::zplCommandSautLigne("FS");
        return $zpl;
    }

    public function isCheckDigit43()
    {
        return $this->checkDigit43;
    }

    public function setCheckDigit43($checkDigit43)
    {
        $this->checkDigit43 = $checkDigit43;
        return $this;
    }

}

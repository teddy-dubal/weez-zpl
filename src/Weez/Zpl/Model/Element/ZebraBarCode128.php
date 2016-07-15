<?php

namespace Weez\Zpl\Model\Element;

use Weez\Zpl\Constant\ZebraRotation;
use Weez\Zpl\Utils\ZplUtils;

/**
 * Element to create a bar code 128
 * 
 * Zpl command : ^BC
 * 
 * @author matthiasvets
 * 
 */
class ZebraBarCode128 extends ZebraBarCode
{

    private $checkDigit43 = false;
    /**
     *
     * @param type $positionX
     * @param type $positionY
     * @param type $text
     * @param type $barCodeHeigth
     * @param type $barCodeWidth
     * @param type $showTextInterpretation
     * @param type $showTextInterpretationAbove
     * @param type $wideBarRatio
     */
    public function __construct($positionX, $positionY, $text, $barCodeHeigth = null, $barCodeWidth = null, $showTextInterpretation = false, $showTextInterpretationAbove = false, $wideBarRatio = null)
    {
        parent::__construct($positionX, $positionY, $text, $barCodeHeigth, $barCodeWidth, $showTextInterpretation, $showTextInterpretationAbove, $wideBarRatio);
    }

    public function getZplCode($printerOptions = null)
    {
        $zpl = $this->getStartZplCodeBuilder();
        $zpl .= ZplUtils::zplCommandSautLigne("BC", [
                    $this->zebraRotation->getLetter(),
                    $this->barCodeHeigth,
                    $this->showTextInterpretation,
                    $this->showTextInterpretationAbove,
                    $this->checkDigit43]);
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

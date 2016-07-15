<?php

namespace Weez\Zpl\Model\Element;

use Weez\Zpl\Constant\ZebraRotation;
use Weez\Zpl\Utils\ZplUtils;

/**
 * Element to create a bar code 39
 * 
 * Zpl command : ^B3 and ^BY
 * 
 * @author ttropard
 * 
 */
class ZebraBarCode39 extends ZebraBarCode
{

    private $checkDigit43 = false;

    public function __construct($positionX, $positionY, $text, $barCodeHeigth, $showTextInterpretation, $showTextInterpretationAbove)
    {
        parent::__construct($positionX, $positionY, $text, $barCodeHeigth, $showTextInterpretation, $showTextInterpretationAbove);
    }

    public function getZplCode($printerOptions)
    {
        $zpl = $this->getStartZplCodeBuilder();
        $zpl .= ZplUtils::zplCommandSautLigne("B3", [$this->zebraRotation->getLetter(),
                    $this->barCodeHeigth, $this->checkDigit43, $this->showTextInterpretation,
                    $this->showTextInterpretationAbove]);
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

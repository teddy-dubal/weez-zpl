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

    public function __construct($positionX, $positionY, $text, $barCodeHeigth, $showTextInterpretation, $showTextInterpretationAbove)
    {
        parent::__construct($positionX, $positionY, $text, $barCodeHeigth, $showTextInterpretation, $showTextInterpretationAbove);
    }

    public function getZplCode($printerOptions)
    {
        $zpl = $this->getStartZplCodeBuilder();
        $zpl .= ZplUtils::zplCommandSautLigne("BC", ZebraRotation::getLetter(), $this->barCodeHeigth, $this->showTextInterpretation, $this->showTextInterpretationAbove, $this->checkDigit43);
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

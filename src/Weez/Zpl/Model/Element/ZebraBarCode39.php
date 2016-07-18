<?php

namespace Weez\Zpl\Model\Element;

use Weez\Zpl\Utils\ZplUtils;

/**
 * Element to create a bar code 39
 * 
 * Zpl command : ^B3 and ^BY
 * 
 * 
 * 
 */
class ZebraBarCode39 extends ZebraBarCode {

    private $checkDigit43 = false;
    /**
     *
     * @param float $positionX left margin (explain in dots)
     * @param float $positionY top margin (explain in dots)
     * @param string $text code to write
     * @param float $barCodeHeigth height of code bar
     * @param float $barCodeWidth width of code bar
     * @param boolean $showTextInterpretation true to print interpretation line
     * @param boolean $showTextInterpretationAbove true to add above, false to add below
     */
    public function __construct($positionX, $positionY, $text, $barCodeHeigth, $barCodeWidth, $wideBarRatio = null, $checkDigit43 = false, $showTextInterpretation = false, $showTextInterpretationAbove = false)
    {
        parent::__construct($positionX, $positionY, $text, $barCodeHeigth, $barCodeWidth, $showTextInterpretation, $showTextInterpretationAbove, $wideBarRatio);
        $this->setCheckDigit43($checkDigit43);
    }
    /**
     *  {@inheritdoc}
     */
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

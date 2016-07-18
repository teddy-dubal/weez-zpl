<?php

namespace Weez\Zpl\Model\Element;

use Weez\Zpl\Model\PrinterOptions;
use Weez\Zpl\Utils\ZplUtils;

/**
 * Element to create a bar code 128
 * 
 * Zpl command : ^BC
 * 
 * @author matthiasvets
 * 
 */
class ZebraBarCode128 extends ZebraBarCode {

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
     * @param int $wideBarRatio
     */
    public function __construct($positionX, $positionY, $text, $barCodeHeigth = null, $barCodeWidth = null, $showTextInterpretation = false, $showTextInterpretationAbove = false, $wideBarRatio = null)
    {
        parent::__construct($positionX, $positionY, $text, $barCodeHeigth, $barCodeWidth, $showTextInterpretation, $showTextInterpretationAbove, $wideBarRatio);
    }
    /**
     *
     * {@inheritdoc}
     */
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
    /**
     *
     * @return boolean
     */
    public function isCheckDigit43()
    {
        return $this->checkDigit43;
    }
    /**
     *
     * @param boolean $checkDigit43
     * @return self
     */
    public function setCheckDigit43($checkDigit43)
    {
        $this->checkDigit43 = $checkDigit43;
        return $this;
    }

}

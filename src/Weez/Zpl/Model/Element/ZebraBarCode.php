<?php

namespace Weez\Zpl\Model\Element;

use Weez\Zpl\Constant\ZebraRotation;
use Weez\Zpl\Model\ZebraElement;
use Weez\Zpl\Utils\ZplUtils;

/**
 * Abstract Zebra element to represent a bar code instruction
 * 
 * Command ZPL : All instruction starting ^B
 * 
 * @author ttropard
 * 
 */
abstract class ZebraBarCode extends ZebraElement
{

    protected $barCodeHeigth;
    protected $moduleWidth;
    protected $wideBarRatio;
    protected $zebraRotation;

    /**
     * Parameters used to print text( default on bellow)
     * 
     */
    protected $showTextInterpretation = true;

    /**
     * Parameters to set to true if you want textInterpretation above code (top)
     */
    protected $showTextInterpretationAbove = false;
    protected $text;

    /**
     * Constructeur used to print text (above or below) with code
     *
     * @param positionX
     *            left margin (explain in dots)
     * @param positionY
     *            top margin (explain in dots)
     * @param text
     *            code to write
     * @param barCodeHeigth
     *            height of code bar
     * @param showTextInterpretation
     *            true to print interpretation line
     * @param showTextInterpretationAbove
     *            true to add above, false to add below
     */
    public function __construct($positionX, $positionY, $text, $barCodeHeigth = null, $barCodeWidth = null, $showTextInterpretation = false, $showTextInterpretationAbove = false, $wideBarRatio = null)
    {
        $this->positionX                   = $positionX;
        $this->positionY                   = $positionY;
        $this->barCodeHeigth               = $barCodeHeigth;
        $this->moduleWidth                 = $barCodeWidth;
        $this->wideBarRatio                = $wideBarRatio;
        $this->text                        = $text;
        $this->showTextInterpretation      = $showTextInterpretation;
        $this->showTextInterpretationAbove = $showTextInterpretationAbove;
        $this->zebraRotation               = new ZebraRotation(ZebraRotation::NORMAL);
    }

    public function getStartZplCodeBuilder()
    {
        $zpl = '';
//On précise la position
        $zpl .= $this->getZplCodePosition();
        $zpl .= "\n";
        if ($this->moduleWidth != null) {
            $zpl .= ZplUtils::zplCommandSautLigne("BY", [
                        $this->moduleWidth,
                        $this->wideBarRatio,
                        $this->barCodeHeigth
            ]);
        }
        return $zpl;
    }

    /**
     * Used to draw label preview.
     * This method should be overloader by child class.
     *
     * Default draw a rectangle
     *
     * @param graphic
     */
    public function drawPreviewGraphic($printerOptions, $graphic)
    {
        $top  = 0;
        $left = 0;
        if ($this->positionX != null) {
            $left = ZplUtils::convertPointInPixel($this->positionX);
        }
        if ($this->positionY != null) {
            $top = ZplUtils::convertPointInPixel($this->positionY);
        }
        $graphic->setColor(Color::BLACK);

        $font = new Font("Arial", Font::BOLD, $this->barCodeHeigth / 2);

        $graphic->drawRect($left, $top, ZplUtils::convertPointInPixel(round($this->moduleWidth * $this->wideBarRatio * 9 * count($this->text))), ZplUtils::convertPointInPixel($this->barCodeHeigth));

        $this->drawTopString($graphic, $font, $this->text, $left, $top);
    }

    public function getBarCodeWidth()
    {
        return $this->moduleWidth;
    }

    public function getBarCodeHeigth()
    {
        return $this->barCodeHeigth;
    }

    public function getWideBarRatio()
    {
        return $this->wideBarRatio;
    }

    public function getZebraRotation()
    {
        return $this->zebraRotation;
    }

    public function isShowTextInterpretation()
    {
        return $this->showTextInterpretation;
    }

    public function isShowTextInterpretationAbove()
    {
        return $this->showTextInterpretationAbove;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setBarCodeWidth($barCodeWidth)
    {
        $this->moduleWidth = $barCodeWidth;
        return $this;
    }

    public function setBarCodeHeigth($barCodeHeigth)
    {
        $this->barCodeHeigth = $barCodeHeigth;
        return $this;
    }

    public function setWideBarRatio($wideBarRatio)
    {
        $this->wideBarRatio = $wideBarRatio;
        return $this;
    }

    public function setZebraRotation($zebraRotation)
    {
        $this->zebraRotation = $zebraRotation;
        return $this;
    }

    public function setShowTextInterpretation($showTextInterpretation)
    {
        $this->showTextInterpretation = $showTextInterpretation;
        return $this;
    }

    public function setShowTextInterpretationAbove($showTextInterpretationAbove)
    {
        $this->showTextInterpretationAbove = $showTextInterpretationAbove;
        return $this;
    }

    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Weez\Model;

/**
 * Description of ZebraElement
 *
 * @author teddy
 */
abstract class ZebraElement {

    /**
     * x-axis location (in dots)
     */
    protected $positionX;

    /**
     * y-axis location (in dots)
     */
    protected $positionY;

    /**
     * Will draw a default box on the graphic if drawGraphic method is not overload
     *
     */
    protected $defaultDrawGraphic = true;

    /**
     * @return the positionX
     */
    public function getPositionX() {
        return $this->positionX;
    }

    /**
     * @param positionX
     *            the positionX to set
     */
    public function setPositionX($positionX) {
        $this->$positionX = $positionX;
        return $this;
    }

    /**
     * @return the positionY
     */
    public function getPositionY() {
        return positionY;
    }

    /**
     * @param positionY
     *            the positionY to set
     */
    public function setPositionY($positionY) {
        $this->$positionY = $positionY;
        return $this;
    }

    /**
     * Return Zpl code for this Element
     *
     * @return
     */
    public function getZplCode($printerOptions) {
        return "";
    }

    /**
     * Function used by child class if you want to set position before draw your element.
     *
     * @return
     */
    protected function getZplCodePosition() {
        $zpl = "";
        if ($positionX != null && $positionY != null) {
//$zpl.append(ZplUtils.zplCommand("FT", positionX, positionY));
        }
        return $zpl;
    }

    /**
     * Used to draw label preview.
     * This method should be overloader by child class.
     *
     * Default draw a rectangle
     *
     * @param printerOptions
     *            TODO
     * @param graphic
     */
    public function drawPreviewGraphic($printerOptions, $graphic) {
        if ($defaultDrawGraphic) {
            $top  = 0;
            $left = 0;
            if ($positionX != null) {
                $left = round(($positionX / $printerOptions->getZebraPPP()->getDotByMm()) * 10);
            }
            if ($positionY != null) {
                $top = round(($positionY / $printerOptions->getZebraPPP()->getDotByMm()) * 10);
            }
            $graphic->setColor(Color::BLACK);
            $graphic->drawRect($left, $top, 100, 20);
            $this->drawTopString($graphic, new Font("Arial", Font . BOLD, 11), "Default", $left, $top);
        }
    }

    /**
     * Function to draw Element, based on top position.
     *
     * Default drawString write text on vertical middle (Zebra not)
     *
     * @param graphic
     * @param font
     * @param text
     * @param positionX
     * @param positionY
     */
    protected function drawTopString($graphic, $font, $text, $positionX, $positionY) {
        $graphic->setFont($font);
        $fm         = $graphic->getFontMetrics($font);
        $rect       = $fm->getStringBounds($text, $graphic);
        $textHeight = (int) ($rect->getHeight());
        $positionY  = $positionY + $textHeight;
        $graphic->drawString($text, $positionX, $positionY); // Draw the string.
    }

}

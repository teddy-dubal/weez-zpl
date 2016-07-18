<?php

namespace Weez\Zpl\Model\Element;

use Weez\Zpl\Model\ZebraElement;
use Weez\Zpl\Utils\ZplUtils;

/**
 * Zebra element to create a box (or line)
 * 
 * Zpl command : ^GB
 * 
 * @author matthiasvets
 * 
 */
class ZebraGraficBox extends ZebraElement
{

    private $width;
    private $height;
    private $borderTickness;
    private $lineColor;
    /**
     *
     * @param float $positionX
     * @param float $positionY
     * @param float $width
     * @param float $height
     * @param int $borderTickness
     * @param string $lineColor
     */
    public function __construct($positionX, $positionY, $width, $height, $borderTickness = 1, $lineColor = 'B') {
        $this->positionX      = $positionX;
        $this->positionY      = $positionY;
        $this->width          = $width;
        $this->height         = $height;
        $this->borderTickness = $borderTickness;
        $this->lineColor      = $lineColor;
    }

    /**
     *
     * {@inheritdoc}
     */
    public function getZplCode($printerOptions = null) {
        $zpl = '';
        $zpl .= $this->getZplCodePosition();
        $zpl .= "\n";
        $zpl .= ZplUtils::zplCommand("GB", [
                    $this->width,
                    $this->height,
                    $this->borderTickness,
                    $this->lineColor
        ]);
        $zpl .= "^FS";
        $zpl .= "\n";
        return $zpl;
    }
}

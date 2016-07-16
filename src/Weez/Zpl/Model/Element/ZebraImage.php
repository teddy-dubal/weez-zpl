<?php

namespace Weez\Zpl\Model\Element;

use Weez\Zpl\Model\ZebraElement;
use Weez\Zpl\Utils\ZplUtils;
use Zebra\Zpl\Image;

/**
 * Zebra element to create image
 * 
 * Zpl command : 
 * 
 * @author matthiasvets
 * 
 */
class ZebraImage extends ZebraElement {

    private $ressource;
    private $compression;
    /**
     *
     * @param type $positionX
     * @param type $positionY
     * @param string $path
     * @param string $compression ['A' => Ascii data | 'B'=> Binary data]
     */
    public function __construct($positionX, $positionY, $path, $compression = 'A') {
        $this->ressource   = new Image(file_get_contents($path));
        $this->compression = $compression;
        $this->positionX   = $positionX;
        $this->positionY      = $positionY;
    }

    /* (non-Javadoc)
     * @see fr.w3blog.zpl.model.element.ZebraElement#getZplCode(fr.w3blog.zpl.model.PrinterOptions)
     */
    public function getZplCode($printerOptions = null) {
        $bytesPerRow = $this->ressource->width();
        $byteCount   = $fieldCount  = $bytesPerRow * $this->ressource->height();
        $zpl = '';
        $zpl .= $this->getZplCodePosition();
        $zpl .= "\n";
        $zpl .= ZplUtils::zplCommand("GF", [
                    $this->compression,
                    $byteCount,
                    $fieldCount,
                    $bytesPerRow,
                    $this->ressource->toAscii()]);
        $zpl .= "^FS";
        $zpl .= "\n";
        return $zpl;
    }

}

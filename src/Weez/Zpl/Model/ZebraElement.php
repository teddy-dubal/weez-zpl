<?php


namespace Weez\Zpl\Model;

use Weez\Zpl\Utils\ZplUtils;

/**
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
     *
     * @return float
     */
    public function getPositionX() {
        return $this->positionX;
    }

    /**
     *
     * @param float $positionX
     * @return self
     */
    public function setPositionX($positionX) {
        $this->positionX = $positionX;
        return $this;
    }

    /**
     *
     * @return float
     */
    public function getPositionY() {
        return $this->positionY;
    }

    /**
     *
     * @param float $positionY
     * @return self
     */
    public function setPositionY($positionY) {
        $this->positionY = $positionY;
        return $this;
    }

    /**
     *
     * Return Zpl code for this Element
     * 
     * @param PrinterOptions|null $printerOptions
     * @return string
     */
    public function getZplCode($printerOptions = null) {
        return "";
    }

    /**
     * Function used by child class if you want to set position before draw your element.
     *
     * @return string
     */
    protected function getZplCodePosition() {
        $zpl = "";
        if ($this->positionX != null && $this->positionY != null) {
            $zpl .= ZplUtils::zplCommand("FT", [$this->positionX, $this->positionY]);
        }
        return $zpl;
    }
}

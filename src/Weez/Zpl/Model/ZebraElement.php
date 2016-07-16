<?php


namespace Weez\Zpl\Model;

use Weez\Zpl\Utils\ZplUtils;

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
        $this->positionX = $positionX;
        return $this;
    }

    /**
     * @return the positionY
     */
    public function getPositionY() {
        return $this->positionY;
    }

    /**
     * @param positionY
     *            the positionY to set
     */
    public function setPositionY($positionY) {
        $this->positionY = $positionY;
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
        if ($this->positionX != null && $this->positionY != null) {
            $zpl .= ZplUtils::zplCommand("FT", [$this->positionX, $this->positionY]);
        }
        return $zpl;
    }
}

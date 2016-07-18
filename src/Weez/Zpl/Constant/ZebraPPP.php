<?php

namespace Weez\Zpl\Constant;

/**
 * Contante used to define printed precision
 *
 * @author teddy
 */
class ZebraPPP {
    const DPI_203 = 8;
    const DPI_300 = 12;
    const DPI_600 = 23.5;

    private $dotByMm;
    /**
     *
     * @param float $dotByMm
     */
    public function __construct($dotByMm) {
        $this->dotByMm = $dotByMm;
    }

    /**
     * @return float
     */
    public function getDotByMm() {
        return $this->dotByMm;
    }

}

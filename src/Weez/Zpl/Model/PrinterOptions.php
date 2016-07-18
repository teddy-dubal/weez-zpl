<?php

namespace Weez\Zpl\Model;

use Weez\Zpl\Constant\ZebraPPP;

/**
 *
 * @author teddy
 */
class PrinterOptions
{

    private $zebraPPP;
    private $defaultZebraFont = null;
    private $defaultFontSize  = null;
    /**
     *
     * @param ZebraPPP|null $zebraPPP
     */
    public function __construct($zebraPPP = null)
    {
        $this->zebraPPP = $zebraPPP ? : new ZebraPPP(ZebraPPP::DPI_300);
    }

    /**
     * @return ZebraPPP
     */
    public function getZebraPPP()
    {
        return $this->zebraPPP;
    }

    /**
     *
     * @param ZebraPPP $zebraPPP
     * @return self
     */
    public function setZebraPPP($zebraPPP)
    {
        $this->zebraPPP = $zebraPPP;
        return $this;
    }

    /**
     *
     * @return ZebraFont
     */
    public function getDefaultZebraFont()
    {
        return $this->defaultZebraFont;
    }

    /**
     *
     * @return float
     */
    public function getDefaultFontSize()
    {
        return $this->defaultFontSize;
    }

    /**
     *
     * @param ZebraFont $defaultZebraFont
     * @return self
     */
    public function setDefaultZebraFont($defaultZebraFont)
    {
        $this->defaultZebraFont = $defaultZebraFont;
        return $this;
    }

    /**
     *
     * @param float $defaultFontSize
     * @return \Weez\Zpl\Model\PrinterOptions
     */
    public function setDefaultFontSize($defaultFontSize)
    {
        $this->defaultFontSize = $defaultFontSize;
        return $this;
    }

}

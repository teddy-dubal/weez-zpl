<?php

namespace Weez\Zpl\Model;

use Weez\Zpl\Constant\ZebraPPP;

/**
 * Description of PrinterOptions
 *
 * @author teddy
 */
class PrinterOptions
{

    private $zebraPPP;
    private $defaultZebraFont = null;
    private $defaultFontSize  = null;

    public function __construct($zebraPPP = null)
    {
        $this->zebraPPP = $zebraPPP ? : ZebraPPP::DPI_300;
    }

    /**
     * @return the zebraPPP
     */
    public function getZebraPPP()
    {
        return $this->zebraPPP;
    }

    /**
     * @param zebraPPP
     *            the zebraPPP to set
     */
    public function setZebraPPP($zebraPPP)
    {
        $this->zebraPPP = $zebraPPP;
        return $this;
    }

    /**
     * @return the defaultZebraFont
     */
    public function getDefaultZebraFont()
    {
        return $this->defaultZebraFont;
    }

    /**
     * @return the defaultFontSize
     */
    public function getDefaultFontSize()
    {
        return $this->defaultFontSize;
    }

    /**
     * @param defaultZebraFont
     *            the defaultZebraFont to set
     */
    public function setDefaultZebraFont($defaultZebraFont)
    {
        $this->defaultZebraFont = $defaultZebraFont;
        return $this;
    }

    /**
     * @param defaultFontSize
     *            the defaultFontSize to set
     */
    public function setDefaultFontSize($defaultFontSize)
    {
        $this->defaultFontSize = $defaultFontSize;
        return $this;
    }

}

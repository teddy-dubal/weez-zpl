<?php

namespace Weez\Zpl\Model;

use Weez\Zpl\Constant\ZebraPrintMode;
use Weez\Zpl\Utils\ZplUtils;

/**
 * Description of ZebraLabel
 *
 * @author teddy
 */
class ZebraLabel
{

    /**
     * Width explain in dots
     *
     * @var float
     */
    private $widthDots;

    /**
     * Height explain in dots
     *
     * @var float
     */
    private $heightDots;

    /**
     *
     * @var ZebraPrintMode
     */
    private $zebraPrintMode;

    /**
     *
     * @var PrinterOptions
     */
    private $printerOptions;

    /**
     *
     * @var array
     */
    private $zebraElements  = [];

    /**
     *
     * @param floatheightDots|null height explain in dots
     * @param float widthDots|null width explain in dots
     * @param PrinterOptions|null
     */
    public function __construct($widthDots = null, $heightDots = null, $printerOptions = null)
    {
        $this->widthDots      = $widthDots;
        $this->heightDots     = $heightDots;
        $this->zebraPrintMode = new ZebraPrintMode(ZebraPrintMode::TEAR_OFF);
        $this->printerOptions = $printerOptions ? : new PrinterOptions();
    }

    /**
     * Function to add Element on etiquette.
     *
     * Element is abstract, you should use one of child Element( ZebraText, ZebraBarcode, etc)
     *
     * @param ZebraElement $zebraElement
     * @return self
     */
    public function addElement($zebraElement)
    {
        $this->zebraElements[] = $zebraElement;
        return $this;
    }

    /**
     *
     * @param defaultZebraFont
     * @return self
     */

    /**
     * Use to define a default Zebra font on the label
     *
     * @param ZebraFont $defaultZebraFont
     * @return self
     */
    public function setDefaultZebraFont($defaultZebraFont)
    {
        $this->printerOptions->setDefaultZebraFont($defaultZebraFont);
        return $this;
    }

    /**
     *
     * Use to define a default Zebra font size on the label (11,13,14).
     * Not explain in dots (convertion is processed by library)
     *
     * @param int $defaultFontSize
     * @return self
     */
    public function setDefaultFontSize($defaultFontSize)
    {
        $this->printerOptions->setDefaultFontSize($defaultFontSize);
        return $this;
    }
    /**
     *
     * @return float
     */
    public function getWidthDots()
    {
        return $this->widthDots;
    }
    /**
     *
     * @param float $widthDots
     * @return self
     */
    public function setWidthDots($widthDots)
    {
        $this->widthDots = $widthDots;
        return $this;
    }
    /**
     *
     * @return float
     */
    public function getHeightDots()
    {
        return $this->heightDots;
    }
    /**
     *
     * @param float $heightDots
     * @return self
     */
    public function setHeightDots($heightDots)
    {
        $this->heightDots = $heightDots;
        return $this;
    }

    /**
     *
     * @return PrinterOptions
     */
    public function getPrinterOptions()
    {
        return $this->printerOptions;
    }
    /**
     *
     * @param PrinterOptions $printerOptions
     * @return self
     */
    public function setPrinterOptions($printerOptions)
    {
        $this->printerOptions = $printerOptions;
        return $this;
    }

    /**
     *
     * @return ZebraPrintMode
     */
    public function getZebraPrintMode()
    {
        return $this->zebraPrintMode;
    }

    /**
     *
     * @param ZebraPrintMode $zebraPrintMode
     * @return ZebraLabel
     */
    public function setZebraPrintMode($zebraPrintMode)
    {
        $this->zebraPrintMode = $zebraPrintMode;
        return $this;
    }

    /**
     *
     * @return array
     */
    public function getZebraElements()
    {
        return $this->zebraElements;
    }


    /**
     *
     * @param ZebraElement $zebraElements
     * @return self
     */
    public function setZebraElements($zebraElements)
    {
        $this->zebraElements = $zebraElements;
        return $this;
    }
    /**
     *
     * @return string
     */
    public function getZplCode()
    {
        $zpl = '';
        $zpl .= ZplUtils::zplCommandSautLigne("XA"); //Start Label
        $zpl .= ZplUtils::zplCommandSautLigne("LH", [0, 0]); // Rotation : reset
        $zpl .= ZplUtils::zplCommandSautLigne("FW", ['N', 0]); // Rotation : reset
        $zpl .= ZplUtils::zplCommandSautLigne("PO", ['N']); //Print orientation : normal
        $zpl .= ZplUtils::zplCommandSautLigne("CF", [0]); //Start Label
        $zpl .= $this->zebraPrintMode->getZplCode();

        if ($this->widthDots != null) {
            //Define width for label
            $zpl .= ZplUtils::zplCommandSautLigne("PW", [$this->widthDots]);
        }

        if ($this->heightDots != null) {
            $zpl .= ZplUtils::zplCommandSautLigne("LL", [$this->heightDots]);
        }

        //Default Font and Size
        if ($this->printerOptions->getDefaultZebraFont() != null && $this->printerOptions->getDefaultFontSize() != null) {
            $zpl .= ZplUtils::zplCommandSautLigne("CF", [ZplUtils::extractDotsFromFont($this->printerOptions->getDefaultZebraFont(), $this->printerOptions->getDefaultFontSize(), $this->printerOptions->getZebraPPP()->getDotByMm())]);
        }
        foreach ($this->zebraElements as $zebraElements) {
            $zpl .= $zebraElements->getZplCode($this->printerOptions);
        }
        $zpl .= ZplUtils::zplCommandSautLigne("XZ"); //End Label
        return $zpl;
    }
}

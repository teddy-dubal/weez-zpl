<?php

namespace Weez\Zpl\Model;

use Exception;
use Weez\Zpl\Constant\ZebraPrintMode;
use Weez\Zpl\Utils\ZplUtils;

/**
 * Description of ZebraLabel
 *
 * @author teddy
 */
class ZebraLabel
{

    //put your code here
    /**
     * Width explain in dots
     */
    private $widthDots;

    /**
     * Height explain in dots
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
    private $zebraElements  = [];

    /**
     *
     * @param heightDots
     *            height explain in dots
     * @param widthDots
     *            width explain in dots
     * @param printerOptions
     */
    public function __construct($widthDots = null, $heightDots = null, $printerOptions = null)
    {
        $this->widthDots      = $widthDots;
        $this->heightDots     = $heightDots;
        $this->zebraPrintMode = new ZebraPrintMode(ZebraPrintMode::TEAR_OFF);
        $this->printerOptions = new PrinterOptions();
    }

    /**
     * Function to add Element on etiquette.
     *
     * Element is abstract, you should use one of child Element( ZebraText, ZebraBarcode, etc)
     *
     * @param zebraElement
     * @return self
     */
    public function addElement($zebraElement)
    {
        $this->zebraElements[] = $zebraElement;
        return $this;
    }

    /**
     * Use to define a default Zebra font on the label
     *
     * @param defaultZebraFont
     * @return self
     */
    public function setDefaultZebraFont($defaultZebraFont)
    {
        $this->printerOptions->setDefaultZebraFont($defaultZebraFont);
        return $this;
    }

    /**
     * Use to define a default Zebra font size on the label (11,13,14).
     * Not explain in dots (convertion is processed by library)
     *
     * @param defaultFontSize
     *            the defaultFontSize to set
     */
    public function setDefaultFontSize($defaultFontSize)
    {
        $this->printerOptions->setDefaultFontSize($defaultFontSize);
        return $this;
    }

    public function getWidthDots()
    {
        return $this->widthDots;
    }

    public function setWidthDots($widthDots)
    {
        $this->widthDots = $widthDots;
        return $this;
    }

    public function getHeightDots()
    {
        return $this->heightDots;
    }

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

    public function setPrinterOptions($printerOptions)
    {
        $this->printerOptions = $printerOptions;
        return $this;
    }

    /**
     * @return the zebraPrintMode
     */
    public function getZebraPrintMode()
    {
        return $this->zebraPrintMode;
    }

    /**
     * @param zebraPrintMode
     *            the zebraPrintMode to set
     */
    public function setZebraPrintMode($zebraPrintMode)
    {
        $this->zebraPrintMode = $zebraPrintMode;
        return $this;
    }

    /**
     * @return the zebraElements
     */
    public function getZebraElements()
    {
        return $this->zebraElements;
    }

    /**
     * @param zebraElements
     *            the zebraElements to set
     */
    public function setZebraElements($zebraElements)
    {
        $this->zebraElements = $zebraElements;
        return $this;
    }

    public function getZplCode()
    {
        $zpl = '';
        $zpl .= ZplUtils::zplCommandSautLigne("XA"); //Start Label
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
            $zpl .= ZplUtils::zplCommandSautLigne("CF", [ZplUtils::extractDotsFromFont($this->printerOptions->getDefaultZebraFont(), $this->printerOptions->getDefaultFontSize(), $this->printerOptions->getZebraPPP())]);
        }
        foreach ($this->zebraElements as $zebraElements) {
            $zpl .= $zebraElements->getZplCode($this->printerOptions);
        }
        $zpl .= ZplUtils::zplCommandSautLigne("XZ"); //End Label
        return $zpl;
    }

    /**
     * Function use to have a preview of label rendering (not reflects reality).
     *
     * Use it just to see disposition on label
     *
     * @return Graphics2D
     */
    public function getImagePreview()
    {
        if ($this->widthDots != null && $this->heightDots != null) {
            $widthPx  = ZplUtils::convertPointInPixel($this->widthDots);
            $heightPx = ZplUtils::convertPointInPixel($this->heightDots);
            $image = new BufferedImage($widthPx, $heightPx, BufferedImage::TYPE_INT_ARGB);
            $graphic  = $image->createGraphics();
            $graphic->setRenderingHint(RenderingHints::KEY_ANTIALIASING, RenderingHints::VALUE_ANTIALIAS_ON);
            $graphic->setComposite(AlphaComposite::Src);
            $graphic->fillRect(0, 0, $widthPx, $heightPx);

            $graphic->setColor(Color::BLACK);
            $graphic->setFont(new Font("Arial", Font::BOLD, 11));
            foreach ($this->zebraElements as $zebraElements) {
                $zebraElements->drawPreviewGraphic($this->printerOptions, $graphic);
            }
            return $image;
        } else {
            throw new Exception("Graphics Preview is only available ont label sized");
        }
    }

}

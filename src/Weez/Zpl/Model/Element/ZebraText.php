<?php

namespace Weez\Zpl\Model\Element;

use Weez\Zpl\Constant\ZebraRotation;
use Weez\Zpl\Model\PrinterOptions;
use Weez\Zpl\Model\ZebraElement;
use Weez\Zpl\Utils\ZplUtils;

/**
 * Zebra element to add Text to specified position.
 * 
 * 
 */
class ZebraText extends ZebraElement
{

    protected $zebraFont = null;

    /**
     * Explain Font Size (11,13,14).
     * Not in dots.
     */
    protected $fontSize      = null;
    protected $zebraRotation;
    protected $text;

    /**
     *
     * @param type $positionX
     * @param type $positionY
     * @param type $text
     * @param type $fontSize
     * @param type $zebraFont
     * @param type $zebraRotation
     */
    public function __construct($positionX, $positionY, $text, $fontSize = null, $zebraFont = null, $zebraRotation = null) {
        $this->zebraFont     = $zebraFont;
        $this->fontSize      = $fontSize;
        $this->zebraRotation = $zebraRotation ? : new ZebraRotation(ZebraRotation::NORMAL);
        $this->text          = $text;
        $this->positionX     = $positionX;
        $this->positionY      = $positionY;
        $this->printerOptions = new PrinterOptions();
    }

    /* (non-Javadoc)
     * @see fr.w3blog.zpl.model.element.ZebraElement#getZplCode(fr.w3blog.zpl.model.PrinterOptions)
     */

    public function getZplCode($_printerOptions = null) {
        $printerOptions = $_printerOptions? : $this->printerOptions;
        $zpl = '';
        $zpl .= $this->getZplCodePosition();
        
        if (!is_null($this->fontSize) && !is_null($this->zebraFont)) {
            //This element has specified size and font
            $dimension = ZplUtils::extractDotsFromFont($this->zebraFont, $this->fontSize, $printerOptions->getZebraPPP()->getDotByMm());
            $zpl .= ZplUtils::zplCommand("A", [$this->zebraFont->getLetter() . $this->zebraRotation->getLetter(),
                        $dimension[0], $dimension[1]]);
        } else if (!is_null($this->fontSize) && !is_null($printerOptions->getDefaultZebraFont())) {
            //This element has specified size, but with default font
            $dimension = ZplUtils::extractDotsFromFont($printerOptions->getDefaultZebraFont(), $this->fontSize, $printerOptions->getZebraPPP()->getDotByMm());
            $zpl .= ZplUtils::zplCommand("A", [$printerOptions->getDefaultZebraFont()->getLetter() . $this->zebraRotation->getLetter(),
                        $dimension[0], $dimension[1]]);
        }

        $zpl .= "^FH\\^FD"; //We allow hexadecimal and start element
        $zpl .= ZplUtils::convertAccentToZplAsciiHexa($this->text);
        $zpl .= ZplUtils::zplCommandSautLigne("FS");

        return $zpl;
    }
}

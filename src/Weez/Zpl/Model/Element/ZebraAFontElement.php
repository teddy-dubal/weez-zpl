<?php
namespace Weez\Zpl\Model\Element;

use Weez\Zpl\Constant\ZebraFont;
use Weez\Zpl\Constant\ZebraRotation;
use Weez\Zpl\Model\PrinterOptions;
use Weez\Zpl\Model\ZebraElement;
use Weez\Zpl\Utils\ZplUtils;

/**
 * Element to set a font and size (explain in dot).
 * 
 * This command is apply only on the next element (in zebraElements list).
 * 
 * This command could be use when your font and PPP is not yet implemented
 * 
 * ZPL Command : ^A
 * 
 * 
 * 
 */
class ZebraAFontElement extends ZebraElement
{

    private $zebraFont;
    private $zebraRotation;
    private $dotHeigth;
    private $dotsWidth;

    /**
     *
     * Constructor to use if you want have non-horizontal text.
     * 
     * @param ZebraFont $zebraFont
     * @param int $zebraRotation
     * @param float $dotHeigth height explain in dots
     * @param float $dotsWidth width explain in dots
     */
    public function __construct($zebraFont, $zebraRotation, $dotHeigth, $dotsWidth)
    {
        $this->zebraFont     = $zebraFont;
        $this->zebraRotation = $zebraRotation ? : new ZebraRotation(ZebraRotation::NORMAL);
        $this->dotHeigth     = $dotHeigth;
        $this->dotsWidth      = $dotsWidth;
    }

/**
     *
     * @param PrinterOptions $printerOptions
     * @return string
     */
    public function getZplCode($printerOptions = null)
    {
        return ZplUtils::zplCommandSautLigne("A", [
                    $this->zebraFont->getLetter(),
                    $this->zebraRotation->getLetter(),
                    $this->dotHeigth,
                    $this->dotsWidth
        ]);
    }

}

<?php

namespace Weez\Zpl\Model\Element;

use Weez\Zpl\Model\ZebraElement;

/**
 * Object use if you want add Zpl Code not supported by this library
 * 
 * @author ttropard
 * 
 */
class ZebraNativeZpl extends ZebraElement
{

    private $zplCode;

    public function __construct($zplCode)
    {
        $this->zplCode            = $zplCode;
        $this->defaultDrawGraphic = false;
    }

    /* (non-Javadoc)
     * @see fr.w3blog.zpl.model.ZPLElement#getZplCode()
     */

    public function getZplCode($printerOptions)
    {
        return $this->zplCode;
    }

}

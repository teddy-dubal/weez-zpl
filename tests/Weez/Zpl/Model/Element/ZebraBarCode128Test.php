<?php

namespace Weez\Zpl\Model\Element;

use PHPUnit\Framework\TestCase;

/**
 * Element to create a bar code 128
 * 
 * Zpl command : ^BC
 * 
 * @author matthiasvets
 * 
 */
class ZebraBarCode128Test extends TestCase
{
 public function testZplOutput()
    {
        $barcode = new ZebraBarCode128(70, 1000, "0235600703875191516022937128", 190, 4, false, false, 2);
        $this->assertEquals("^FT70,1000\n^BY4,2,190\n^BCN,190,N,N,N\n^FD0235600703875191516022937128^FS\n", $barcode->getZplCode(null));
    }

}

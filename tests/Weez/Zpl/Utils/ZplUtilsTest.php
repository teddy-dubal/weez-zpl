<?php

namespace Weez\Zpl\Utils;

use PHPUnit\Framework\TestCase;

/**
 * Common method used to manipulate ZPL
 * 
 * @author ttropard
 * 
 */
class ZplUtilsTest extends TestCase
{

    /**
     * Test with only label without element
     */
    public function testZebraLabelAlone()
    {

        $this->assertEquals("^XA", ZplUtils::zplCommand("XA"));
        $this->assertEquals("^FT5,6", ZplUtils::zplCommand("FT", [5, 6]));
        $this->assertEquals("^FT5,,6", ZplUtils::zplCommand("FT", [5, null, 6]));

        $this->assertEquals("^XA\n", ZplUtils::zplCommandSautLigne("XA"));
        $this->assertEquals("^FT5,6\n", ZplUtils::zplCommandSautLigne("FT", [5, 6]));
        $this->assertEquals("^FT5,,6\n", ZplUtils::zplCommandSautLigne("FT", [5,
                    null, 6]));
    }

}

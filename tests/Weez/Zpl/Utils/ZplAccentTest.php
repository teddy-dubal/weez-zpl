<?php

namespace Weez\Zpl\Utils;

use PHPUnit\Framework\TestCase;

/**
 * Common method used to manipulate ZPL
 * 
 * @author ttropard
 * 
 */
class ZplAccentTest extends TestCase
{

    /**
     * Test with only label without element
     */
    public function testZebraLibrary1()
    {
        $this->assertEquals("Qt\\82", ZplUtils::convertAccentToZplAsciiHexa("Qté"));
        $this->assertEquals("\\85", ZplUtils::convertAccentToZplAsciiHexa("à"));
    }

}

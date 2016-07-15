<?php

namespace Weez\Zpl\Model;

use PHPUnit\Framework\TestCase;

/**
 * Description of ZebraLabel
 *
 * @author teddy
 */
class ZebraLabelTest extends TestCase
{

    /**
     * Test with only label without element
     */
    public function testZebraLabelAlone()
    {
        $zebraLabel = new ZebraLabel();
        $this->assertEquals("^XA\n^MMT\n^XZ\n", $zebraLabel->getZplCode());
    }

    /**
     * Test with only label without element
     */
    public function testZebraLabelSize()
    {
        $zebraLabel = new ZebraLabel(500, 760);
        $this->assertEquals("^XA\n^MMT\n^PW500\n^LL760\n^XZ\n", $zebraLabel->getZplCode());
    }

}

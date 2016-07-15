<?php

namespace Weez\Zpl\Model;

use PHPUnit\Framework\TestCase;
use Weez\Zpl\Constant\ZebraFont;
use Weez\Zpl\Model\Element\ZebraBarCode39;
use Weez\Zpl\Model\Element\ZebraText;

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

    public function testZplOutput2()
    {
        $zebraLabel = new ZebraLabel(912, 912);
//        $zebraLabel->setDefaultZebraFont(ZebraFont::ZEBRA_ZERO);

//        $zebraLabel->addElement(new ZebraText(10, 84, "Product:", 14));
//        $zebraLabel->addElement(new ZebraText(395, 85, "Camera", 14));
//
//        $zebraLabel->addElement(new ZebraText(10, 161, "CA201212AA", 14));
//
//        //Add Code Bar 39
//        $zebraLabel->addElement(new ZebraBarCode39(10, 297, "CA201212AA", 118, 2, 2));
//
//        $zebraLabel->addElement(new ZebraText(10, 365, "Qté:", 11));
//        $zebraLabel->addElement(new ZebraText(180, 365, "3", 11));
//        $zebraLabel->addElement(new ZebraText(317, 365, "QA", 11));
//
//        $zebraLabel->addElement(new ZebraText(10, 520, "Ref log:", 11));
//        $zebraLabel->addElement(new ZebraText(180, 520, "0035", 11));
//        $zebraLabel->addElement(new ZebraText(10, 596, "Ref client:", 11));
//        $zebraLabel->addElement(new ZebraText(180, 599, "1234", 11));
        echo $zebraLabel->getZplCode();
        exit;
        $this->assertEquals(1, 1);
    }

}

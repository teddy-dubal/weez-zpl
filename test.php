<?php

use Weez\Zpl\Constant\ZebraFont;
use Weez\Zpl\Model\Element\ZebraBarCode39;
use Weez\Zpl\Model\Element\ZebraGraficBox;
use Weez\Zpl\Model\Element\ZebraImage;
use Weez\Zpl\Model\Element\ZebraQrCode;
use Weez\Zpl\Model\Element\ZebraText;
use Weez\Zpl\Model\ZebraLabel;

/*
 * The MIT License
 *
 * Copyright 2016 teddy.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * Description of test
 *
 * @author teddy
 */
$rootDir   = __DIR__;
$vendorDir = $rootDir . '/vendor/';

require_once $vendorDir . 'autoload.php';

//$faker      = Factory::create();
//        $fakerImage = $faker->image(null, 200, 200);
$zebraLabel = new ZebraLabel(912, 912);
$zebraLabel->setDefaultZebraFont(new ZebraFont(ZebraFont::ZEBRA_ZERO));
$zebraLabel->addElement(new ZebraText(10, 84, "Product:", 14));
$zebraLabel->addElement(new ZebraText(395, 84, "Camera", 14));

$zebraLabel->addElement(new ZebraGraficBox(10, 100, 800, 5));

$zebraLabel->addElement(new ZebraText(10, 161, "CA201212AA", 14));

//Add Code Bar 39
$zebraLabel->addElement(new ZebraBarCode39(10, 297, "CA201212AA", 118, 2, 2));

$zebraLabel->addElement(new ZebraText(10, 365, "Qté:", 11));
$zebraLabel->addElement(new ZebraText(180, 365, "3", 11));
$zebraLabel->addElement(new ZebraText(317, 365, "QA", 11));

$zebraLabel->addElement(new ZebraText(10, 520, "Ref log:", 11));
$zebraLabel->addElement(new ZebraText(180, 520, "0035", 11));
$zebraLabel->addElement(new ZebraText(10, 596, "Ref client:", 11));
$zebraLabel->addElement(new ZebraText(180, 599, "1234", 11));
$zebraLabel->addElement(new ZebraImage(350, 650, $rootDir . '/assets/img/test_150.png'));
$zebraLabel->addElement(new ZebraQrCode(350, 750, 'test'));

echo $zebraLabel->getZplCode();

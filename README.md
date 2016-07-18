
# Weez-ZPL

Inspired by [w3blogfr/zebra-zpl](https://github.com/w3blogfr/zebra-zpl)

This library will help you to quickly generate ZPL code for your Zebra printer.

Library support only most commons ZPL commons (Text, Code bar 39)

For the moment, library was tested on Zebra 300 dpi with native font zebra-0. I

But you can insert natif zpl at all times.

You can also fork this project and share code if you make this library better.

## Getting started

Clone the repository and install dependencies:

```bash
$ git clone https://github.com/teddy-dubal/weez-zpl.git
$ cd weez-zpl/docker
$ docker-compose up
$ docker exec -it docker_appzpl_1 bash
$ su application
$ composer install
$ php test.php
```

```php
$faker      = Factory::create();
$fakerImage = $faker->image(null, 150, 150, 'transport', true);
//Init Label
$zebraLabel = new ZebraLabel(912, 912);
$zebraLabel->setDefaultZebraFont(new ZebraFont(ZebraFont::ZEBRA_ZERO));
//Add Text element
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
//Add Image from Url
$zebraLabel->addElement(new ZebraImage(350, 850, $fakerImage));
//Add Qr Code
$zebraLabel->addElement(new ZebraQrCode(350, 297, 'test'));

echo $zebraLabel->getZplCode();

```
## Native code

If you need to customise your label

```php
$zebraLabel.addElement(new ZebraNativeZpl("^KD0\n"));
/*
You can also use usefull fonction ZplUtils.zplCommand to generate a zpl command (with many variables)
*/
ZplUtils::zplCommand("A", ["0", "R"]); //will return ^A,0,R
```

## Zpl Viewver
http://labelary.com/viewer.html


> Written with [StackEdit](https://stackedit.io/).
# LCB_Faq
Frequently Asked Questions plugin for Magento2 with multistore support

## Installation

php bin/magento module:enable LCB_Faq  
php bin/magento setup:upgrade  
php bin/magento setup:db-schema:upgrade  
php bin/magento setup:di:compile  

## Usage

Edit FAQ in content management  
Visit FAQ page on /faq route

### Categories

Currently category support can be providen only with plugin interaction  
Sample usage  

```
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:ObjectManager/etc/config.xsd">
    <type name="LCB\Faq\Model\Category">
        <plugin name="SmilepenFaq" type="Smilepen\Pages\Plugin\Faq\Category" sortOrder="1" />
    </type>
</config>
```

```
<?php

namespace Smilepen\Pages\Plugin\Faq;

class Category {

    public function afterGetOptionArray(
    \LCB\Faq\Model\Category $category
    )
    {
        return array(
            1 => 'Allgemeines',
            2 => 'Zahnaufhellung'
        );
    }

}
```

## Changelog

### [1.0.1]

Added plugin support for categories

### [1.0.2]

Fix for question and answer character limit
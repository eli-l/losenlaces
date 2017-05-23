<?php

// Magento obligatory comments
//@license Magento full legacy

<?php

$installer = $this;
$installer->startSetup();

$helloCont = <<<EOF
<div>Hello world</div>
EOF;

$identified = "magento_is_cool";

Mage::getModel('cms/block')
        ->load($identifier, 'identifier')
        ->setIdentifier($identifier)
        ->setContent($helloCont)
        ->setTitle("Magento")
        ->setStores(array(0))
        ->save();

$installer->endSetup();
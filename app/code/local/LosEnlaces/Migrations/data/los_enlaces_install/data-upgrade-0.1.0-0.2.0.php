<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$installer = $this;
$installer->startSetup();

$helloCont = <<<EOF
{{block type="cms/block" block_id="magento_is_cool"}}
EOF;

$identifier = "scandiweb-loves-spain";

Mage::getModel('cms/page')
        ->load($identifier, 'identifier')
        ->setIdentifier($identifier)
        ->setContent($helloCont)
        ->setRootTemplate('one_column')
        ->setTitle("CMS page")
        ->setStores(array(0))
        ->save();

$installer->endSetup();

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$installer = $this;
$installer->startSetup();

$whitelistBlock = Mage::getModel('admin/block')->load('cms/block', 'block_name');
$whitelistBlock->setData('block_name', 'cms/block')
               ->setData('is_allowed', 1)
               ->save();

$installer->endSetup();

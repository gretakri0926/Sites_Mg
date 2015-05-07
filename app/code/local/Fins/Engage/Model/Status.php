<?php

class Fins_Engage_Model_Status extends Varien_Object
{
    const STATUS_ENABLED	= 1;
    const STATUS_DISABLED	= 2;

    static public function getOptionArray()
    {
        return array(
            self::STATUS_ENABLED    => Mage::helper('engage')->__('Enabled'),
            self::STATUS_DISABLED   => Mage::helper('engage')->__('Disabled')
        );
    }
}
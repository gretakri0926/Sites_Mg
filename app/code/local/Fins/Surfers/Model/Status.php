<?php

class Fins_Surfers_Model_Status extends Varien_Object
{
    const STATUS_ENABLED	= 1;
    const STATUS_DISABLED	= 2;

    static public function getOptionArray()
    {
        return array(
            self::STATUS_ENABLED    => Mage::helper('surfers')->__('Enabled'),
            self::STATUS_DISABLED   => Mage::helper('surfers')->__('Disabled')
        );
    }
}
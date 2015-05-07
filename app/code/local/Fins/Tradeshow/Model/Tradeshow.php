<?php

class Fins_Tradeshow_Model_Tradeshow extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('tradeshow/tradeshow');
    }
}
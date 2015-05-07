<?php

class Fins_Engage_Model_Engage extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('engage/engage');
    }
}
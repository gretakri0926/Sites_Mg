<?php

class Fins_Surfers_Model_Surfers extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('surfers/surfers');
    }
}
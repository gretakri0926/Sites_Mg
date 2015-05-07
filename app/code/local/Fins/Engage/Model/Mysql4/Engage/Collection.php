<?php

class Fins_Engage_Model_Mysql4_Engage_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('engage/engage');
    }
}
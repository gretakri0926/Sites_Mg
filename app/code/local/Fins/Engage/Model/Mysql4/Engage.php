<?php

class Fins_Engage_Model_Mysql4_Engage extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the engage_id refers to the key field in your database table.
        $this->_init('engage/engage', 'engage_id');
    }
}
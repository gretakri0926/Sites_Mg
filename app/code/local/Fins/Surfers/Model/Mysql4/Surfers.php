<?php

class Fins_Surfers_Model_Mysql4_Surfers extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the surfers_id refers to the key field in your database table.
        $this->_init('surfers/surfers', 'surfers_id');
    }
}
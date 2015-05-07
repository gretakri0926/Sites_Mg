<?php

class Fins_Commission_Model_Mysql4_Commission extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the commission_id refers to the key field in your database table.
        $this->_init('commission/commission', 'commission_id');
    }
}
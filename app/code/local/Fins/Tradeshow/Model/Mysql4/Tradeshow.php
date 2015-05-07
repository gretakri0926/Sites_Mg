<?php

class Fins_Tradeshow_Model_Mysql4_Tradeshow extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the tradeshow_id refers to the key field in your database table.
        $this->_init('tradeshow/tradeshow', 'tradeshow_id');
    }
}
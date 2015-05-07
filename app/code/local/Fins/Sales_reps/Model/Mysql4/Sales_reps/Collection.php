<?php

class Fins_Sales_reps_Model_Mysql4_Sales_reps_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('sales_reps/sales_reps');
    }
}
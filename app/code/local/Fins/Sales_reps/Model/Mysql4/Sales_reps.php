<?php

class Fins_Sales_reps_Model_Mysql4_Sales_reps extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the sales_reps_id refers to the key field in your database table.
        $this->_init('sales_reps/sales_reps', 'sales_reps_id');
    }
}
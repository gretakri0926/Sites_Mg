<?php

class Fins_Sales_reps_Model_Sales_reps extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('sales_reps/sales_reps');
    }
}
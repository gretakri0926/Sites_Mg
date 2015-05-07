<?php
class Fins_Sales_reps_Block_Sales_reps extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getSales_reps()     
     { 
        if (!$this->hasData('sales_reps')) {
            $this->setData('sales_reps', Mage::registry('sales_reps'));
        }
        return $this->getData('sales_reps');
        
    }
}
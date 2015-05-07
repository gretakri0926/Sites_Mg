<?php
class Fins_Commission_Block_Commission extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getCommission()     
     { 
        if (!$this->hasData('commission')) {
            $this->setData('commission', Mage::registry('commission'));
        }
        return $this->getData('commission');
        
    }
}

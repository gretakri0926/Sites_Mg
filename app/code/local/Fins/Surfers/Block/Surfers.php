<?php
class Fins_Surfers_Block_Surfers extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getSurfers()     
     { 
        if (!$this->hasData('surfers')) {
            $this->setData('surfers', Mage::registry('surfers'));
        }
        return $this->getData('surfers');
        
    }
}
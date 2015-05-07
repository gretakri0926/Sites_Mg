<?php
class Fins_Engage_Block_Engage extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getEngage()     
     { 
        if (!$this->hasData('engage')) {
            $this->setData('engage', Mage::registry('engage'));
        }
        return $this->getData('engage');
        
    }
}

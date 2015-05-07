<?php
class Fins_Tradeshow_Block_Tradeshow extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getTradeshow()     
     { 
        if (!$this->hasData('tradeshow')) {
            $this->setData('tradeshow', Mage::registry('tradeshow'));
        }
        return $this->getData('tradeshow');
        
    }
}
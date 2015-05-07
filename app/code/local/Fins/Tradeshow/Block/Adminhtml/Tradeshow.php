<?php
class Fins_Tradeshow_Block_Adminhtml_Tradeshow extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_tradeshow';
    $this->_blockGroup = 'tradeshow';
    $this->_headerText = Mage::helper('tradeshow')->__('Lead Manager');
    $this->_addButtonLabel = Mage::helper('tradeshow')->__('Add Item');
    parent::__construct();
  }
}

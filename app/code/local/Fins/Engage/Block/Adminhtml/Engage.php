<?php
class Fins_Engage_Block_Adminhtml_Engage extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_engage';
    $this->_blockGroup = 'engage';
    $this->_headerText = Mage::helper('engage')->__('Item Manager');
    $this->_addButtonLabel = Mage::helper('engage')->__('Add Item');
    parent::__construct();
  }
}

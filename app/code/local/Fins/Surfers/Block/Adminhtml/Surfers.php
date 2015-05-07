<?php
class Fins_Surfers_Block_Adminhtml_Surfers extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_surfers';
    $this->_blockGroup = 'surfers';
    $this->_headerText = Mage::helper('surfers')->__('View Surf Team');
    $this->_addButtonLabel = Mage::helper('surfers')->__('Add New Surfer');
    parent::__construct();
  }
}

<?php
class Fins_Sales_reps_Block_Adminhtml_Sales_reps extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_sales_reps';
    $this->_blockGroup = 'sales_reps';
    $this->_headerText = Mage::helper('sales_reps')->__('Item Manager');
    $this->_addButtonLabel = Mage::helper('sales_reps')->__('Add Item');
    parent::__construct();
  }
}
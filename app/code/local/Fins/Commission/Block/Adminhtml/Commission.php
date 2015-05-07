<?php
class Fins_Commission_Block_Adminhtml_Commission extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {

        // $this->_setTemplate('fins/commission/list.phtml');
        $this->_controller = 'adminhtml_commission';
        $this->_blockGroup = 'commission';
        $this->_headerText = Mage::helper('commission')->__('Sales Representative Commissions');
        $this->_addButtonLabel = Mage::helper('commission')->__('Add Commission Rate');
        parent::__construct();
    }
}

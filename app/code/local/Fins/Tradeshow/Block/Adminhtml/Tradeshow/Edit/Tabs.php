<?php

class Fins_Tradeshow_Block_Adminhtml_Tradeshow_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('tradeshow_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('tradeshow')->__('Lead Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('tradeshow')->__('Lead Edit'),
          'title'     => Mage::helper('tradeshow')->__('Item Details'),
          'content'   => $this->getLayout()->createBlock('tradeshow/adminhtml_tradeshow_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}

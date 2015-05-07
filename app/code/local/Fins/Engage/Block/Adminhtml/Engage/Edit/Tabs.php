<?php

class Fins_Engage_Block_Adminhtml_Engage_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('engage_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('engage')->__('Item Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('engage')->__('Item Information'),
          'title'     => Mage::helper('engage')->__('Item Information'),
          'content'   => $this->getLayout()->createBlock('engage/adminhtml_engage_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}
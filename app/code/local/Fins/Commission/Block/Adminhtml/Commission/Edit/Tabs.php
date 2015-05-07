<?php

class Fins_Commission_Block_Adminhtml_Commission_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('commission_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('commission')->__('Item Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('commission')->__('Edit Rate Details'),
          'title'     => Mage::helper('commission')->__('Edit Rate Details'),
          'content'   => $this->getLayout()->createBlock('commission/adminhtml_commission_edit_tab_form')->toHtml(),
      ));

      $this->addTab('users_rate', array(
          'label'     => Mage::helper('commission')->__('Users with this Rate'),
          // 'class'     => 'ajax',
          'title'     => Mage::helper('commission')->__('Users with this Rate'),
          'content'   => $this->getLayout()->createBlock('commission/adminhtml_commission_edit_users_grid')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}

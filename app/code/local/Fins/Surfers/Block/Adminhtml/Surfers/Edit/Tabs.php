<?php

class Fins_Surfers_Block_Adminhtml_Surfers_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('surfers_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('surfers')->__('Surfer Information Section'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('surfers')->__('Surfer'),
          'title'     => Mage::helper('surfers')->__('Surfer'),
          'content'   => $this->getLayout()->createBlock('surfers/adminhtml_surfers_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}

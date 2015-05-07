<?php

class Fins_Commission_Block_Adminhtml_Commission_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('commission_form', array('legend'=>Mage::helper('commission')->__('Item information')));
     
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('commission')->__('Commission Rate Name'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
      ));

      /*
      $fieldset->addField('filename', 'file', array(
          'label'     => Mage::helper('commission')->__('File'),
          'required'  => false,
          'name'      => 'filename',
	  ));
       */
		
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('commission')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('commission')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('commission')->__('Disabled'),
              ),
          ),
      ));
     
      $fieldset->addField('content', 'text', array(
          'name'      => 'content',
          'label'     => Mage::helper('commission')->__('Commission Rate'),
          'required'  => true
      ));
     
      if ( Mage::getSingleton('adminhtml/session')->getCommissionData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getCommissionData());
          Mage::getSingleton('adminhtml/session')->setCommissionData(null);
      } elseif ( Mage::registry('commission_data') ) {
          $form->setValues(Mage::registry('commission_data')->getData());
      }
      return parent::_prepareForm();
  }
}

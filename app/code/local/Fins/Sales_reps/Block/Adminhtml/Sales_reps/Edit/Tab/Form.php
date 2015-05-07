<?php

class Fins_Sales_reps_Block_Adminhtml_Sales_reps_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('sales_reps_form', array('legend'=>Mage::helper('sales_reps')->__('Item information')));
     
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('sales_reps')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
      ));

      $fieldset->addField('filename', 'file', array(
          'label'     => Mage::helper('sales_reps')->__('File'),
          'required'  => false,
          'name'      => 'filename',
	  ));
		
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('sales_reps')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('sales_reps')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('sales_reps')->__('Disabled'),
              ),
          ),
      ));
     
      $fieldset->addField('content', 'editor', array(
          'name'      => 'content',
          'label'     => Mage::helper('sales_reps')->__('Content'),
          'title'     => Mage::helper('sales_reps')->__('Content'),
          'style'     => 'width:700px; height:500px;',
          'wysiwyg'   => false,
          'required'  => true,
      ));
     
      if ( Mage::getSingleton('adminhtml/session')->getSales_repsData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getSales_repsData());
          Mage::getSingleton('adminhtml/session')->setSales_repsData(null);
      } elseif ( Mage::registry('sales_reps_data') ) {
          $form->setValues(Mage::registry('sales_reps_data')->getData());
      }
      return parent::_prepareForm();
  }
}
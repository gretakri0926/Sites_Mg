<?php

class Fins_Surfers_Block_Adminhtml_Surfers_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('surfers_form', array('legend'=>Mage::helper('surfers')->__('Item information')));
     
      $fieldset->addField('name', 'text', array(
          'label'     => Mage::helper('surfers')->__('Surfer Name'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'name',
      ));

      $fieldset->addField('filename', 'file', array(
          'label'     => Mage::helper('surfers')->__('Image: size(325, 530)px'),
          'required'  => false,
          'name'      => 'filename',
	  ));
     
      $fieldset->addField('influences', 'editor', array(
          'name'      => 'influences',
          'label'     => Mage::helper('surfers')->__('Influences'),
          'title'     => Mage::helper('surfers')->__('Influences'),
          'style'     => 'width:500px; height:100px;',
          'wysiwyg'   => false,
          'required'  => true,
      ));
     
      $fieldset->addField('accomplishment', 'editor', array(
          'name'      => 'accomplishment',
          'label'     => Mage::helper('surfers')->__('Biggest Accomplishment'),
          'title'     => Mage::helper('surfers')->__('Biggest Accomplishment'),
          'style'     => 'width:500px; height:100px;',
          'wysiwyg'   => false,
          'required'  => true,
      ));
     
      $fieldset->addField('why_ride', 'editor', array(
          'name'      => 'why_ride',
          'label'     => Mage::helper('surfers')->__('Why do you ride Fin-S'),
          'title'     => Mage::helper('surfers')->__('Why do you ride Fin-S'),
          'style'     => 'width:500px; height:100px;',
          'wysiwyg'   => false,
          'required'  => true,
      ));
     
      $fieldset->addField('hometown', 'editor', array(
          'name'      => 'hometown',
          'label'     => Mage::helper('surfers')->__('Hometown'),
          'title'     => Mage::helper('surfers')->__('Hometown'),
          'style'     => 'width:500px; height:100px;',
          'wysiwyg'   => false,
          'required'  => true,
      ));
		
      $fieldset->addField('twitter', 'text', array(
          'label'     => Mage::helper('surfers')->__('Twitter Link'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'twitter',
      ));
		
      $fieldset->addField('main', 'select', array(
          'label'     => Mage::helper('surfers')->__('Use on front team page'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('surfers')->__('Yes'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('surfers')->__('No'),
              ),
          ),
      ));
		
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('surfers')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('surfers')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('surfers')->__('Disabled'),
              ),
          ),
      ));
     
      if ( Mage::getSingleton('adminhtml/session')->getSurfersData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getSurfersData());
          Mage::getSingleton('adminhtml/session')->setSurfersData(null);
      } elseif ( Mage::registry('surfers_data') ) {
          $form->setValues(Mage::registry('surfers_data')->getData());
      }
      return parent::_prepareForm();
  }
}

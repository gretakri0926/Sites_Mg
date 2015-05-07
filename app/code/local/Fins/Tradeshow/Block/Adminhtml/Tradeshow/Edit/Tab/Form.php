<?php

class Fins_Tradeshow_Block_Adminhtml_Tradeshow_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('tradeshow_form', array('legend'=>Mage::helper('tradeshow')->__('Item information')));
     
      $fieldset->addField('tradeshow_id', 'hidden', array(
          'label'     => Mage::helper('tradeshow')->__('id'),
          'name'      => 'tradeshow_id',
      ));

      $fieldset->addField('firstname', 'text', array(
          'label'     => Mage::helper('tradeshow')->__('First Name'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'firstname',
      ));

      $fieldset->addField('lastname', 'text', array(
          'label'     => Mage::helper('tradeshow')->__('Last Name'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'lastname',
      ));

      $fieldset->addField('company_name', 'text', array(
          'label'     => Mage::helper('tradeshow')->__('Company Name'),
          'required'  => false,
          'name'      => 'company_name',
	  ));

      $fieldset->addField('email', 'text', array(
          'label'     => Mage::helper('tradeshow')->__('Email'),
          'required'  => false,
          'name'      => 'email',
	  ));

      $fieldset->addField('phone', 'text', array(
          'label'     => Mage::helper('tradeshow')->__('Phone'),
          'required'  => false,
          'name'      => 'phone',
	  ));

      $fieldset->addField('zip', 'text', array(
          'label'     => Mage::helper('tradeshow')->__('Zip'),
          'required'  => false,
          'name'      => 'zip',
	  ));

      $fieldset->addField('boards_built_per_month', 'text', array(
          'label'     => Mage::helper('tradeshow')->__('Boards Built Per Month'),
          'required'  => false,
          'name'      => 'boards_built_per_month',
	  ));

      $fieldset->addField('boards_sold_per_month', 'text', array(
          'label'     => Mage::helper('tradeshow')->__('Boards Sold Per Month'),
          'required'  => false,
          'name'      => 'boards_sold_per_month',
	  ));

      $fieldset->addField('aftermarket_fins_sold_per_month', 'text', array(
          'label'     => Mage::helper('tradeshow')->__('After Market Fin Sets Sold / Month'),
          'required'  => false,
          'name'      => 'aftermarket_fins_sold_per_month',
	  ));
		
      $fieldset->addField('business_type', 'select', array(
          'label'     => Mage::helper('tradeshow')->__('Business Type'),
          'name'      => 'business_type',
          'values'    => array(
              array(
                  'value'     => 'manufacturer',
                  'label'     => Mage::helper('tradeshow')->__('Board Manufacturer'),
              ),
              array(
                  'value'     => 'retail',
                  'label'     => Mage::helper('tradeshow')->__('Retail Store'),
              ),
              array(
                  'value'     => 'both',
                  'label'     => Mage::helper('tradeshow')->__('Both'),
              ),
              array(
                  'value'     => 'distributor',
                  'label'     => Mage::helper('tradeshow')->__('Distributor'),
              ),
              array(
                  'value'     => 'other',
                  'label'     => Mage::helper('tradeshow')->__('Other'),
              ),
          ),
      ));
     
      $fieldset->addField('content', 'editor', array(
          'name'      => 'content',
          'label'     => Mage::helper('tradeshow')->__('Comment'),
          'title'     => Mage::helper('tradeshow')->__('Comment'),
          'style'     => 'width:400px; height:100px;',
          'wysiwyg'   => false,
          'required'  => false,
      ));

      $fieldset->addField('followed_up', 'select', array(
          'label'     => Mage::helper('tradeshow')->__('Followed Up?'),
          'name'      => 'followed_up',
          'values'    => array(
              array(
                  'value'     => 'no',
                  'label'     => Mage::helper('tradeshow')->__('no'),
              ),
              array(
                  'value'     => 'yes',
                  'label'     => Mage::helper('tradeshow')->__('yes'),
              ),
          ),
      ));

      $fieldset->addField('followed_up_by', 'text', array(
          'label'     => Mage::helper('tradeshow')->__('Followed Up By:'),
          'required'  => false,
          'name'      => 'followed_up_by',
	  ));

      $fieldset->addField('converted', 'select', array(
          'label'     => Mage::helper('tradeshow')->__('Converted?'),
          'name'      => 'converted',
          'values'    => array(
              array(
                  'value'     => 'no',
                  'label'     => Mage::helper('tradeshow')->__('no'),
              ),
              array(
                  'value'     => 'yes',
                  'label'     => Mage::helper('tradeshow')->__('yes'),
              ),
          ),
      ));
     
      if ( Mage::getSingleton('adminhtml/session')->getTradeshowData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getTradeshowData());
          Mage::getSingleton('adminhtml/session')->setTradeshowData(null);
      } elseif ( Mage::registry('tradeshow_data') ) {
          $form->setValues(Mage::registry('tradeshow_data')->getData());
      }
      return parent::_prepareForm();
  }
}

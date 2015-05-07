<?php

class Fins_Sales_reps_Block_Adminhtml_Sales_reps_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'sales_reps';
        $this->_controller = 'adminhtml_sales_reps';
        
        $this->_updateButton('save', 'label', Mage::helper('sales_reps')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('sales_reps')->__('Delete Item'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('sales_reps_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'sales_reps_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'sales_reps_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('sales_reps_data') && Mage::registry('sales_reps_data')->getId() ) {
            return Mage::helper('sales_reps')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('sales_reps_data')->getTitle()));
        } else {
            return Mage::helper('sales_reps')->__('Add Item');
        }
    }
}
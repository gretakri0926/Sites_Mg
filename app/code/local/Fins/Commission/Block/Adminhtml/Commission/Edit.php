<?php

class Fins_Commission_Block_Adminhtml_Commission_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'commission';
        $this->_controller = 'adminhtml_commission';
        
        $this->_updateButton('save', 'label', Mage::helper('commission')->__('Save Commission Rate'));
        $this->_updateButton('delete', 'label', Mage::helper('commission')->__('Delete Commission Rate'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Commission Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('commission_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'commission_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'commission_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('commission_data') && Mage::registry('commission_data')->getId() ) {
            return Mage::helper('commission')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('commission_data')->getTitle()));
        } else {
            return Mage::helper('commission')->__('Add Item');
        }
    }
}

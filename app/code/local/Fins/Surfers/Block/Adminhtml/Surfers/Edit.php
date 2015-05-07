<?php

class Fins_Surfers_Block_Adminhtml_Surfers_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'surfers';
        $this->_controller = 'adminhtml_surfers';
        
        $this->_updateButton('save', 'label', Mage::helper('surfers')->__('Save Surfer Info'));
        $this->_updateButton('delete', 'label', Mage::helper('surfers')->__('Delete Surfer'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('surfers_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'surfers_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'surfers_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('surfers_data') && Mage::registry('surfers_data')->getId() ) {
            return Mage::helper('surfers')->__("Edit Surfer '%s'", $this->htmlEscape(Mage::registry('surfers_data')->getTitle()));
        } else {
            return Mage::helper('surfers')->__('Add Surfer');
        }
    }
}

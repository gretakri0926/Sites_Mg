<?php

class Fins_Tradeshow_Block_Adminhtml_Tradeshow_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'tradeshow';
        $this->_controller = 'adminhtml_tradeshow';
        
        $this->_updateButton('save', 'label', Mage::helper('tradeshow')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('tradeshow')->__('Delete Item'));
		
        $this->_addButton('convert', array(
            'label'     => Mage::helper('adminhtml')->__('Convert to Client'),
            'onclick'   => 'convertToCustomer()',
            'class'     => 'save',
          ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('tradeshow_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'tradeshow_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'tradeshow_content');
                }
            }

            function convertToCustomer(){
              $('edit_form').writeAttribute('action', '/store/index.php/tradeshow/adminhtml_tradeshow/convert/');
              $('edit_form').submit();
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('tradeshow_data') && Mage::registry('tradeshow_data')->getId() ) {
            return Mage::helper('tradeshow')->__("Edit Lead: %s", $this->htmlEscape(Mage::registry('tradeshow_data')->getEmail()));
        } else {
            return Mage::helper('tradeshow')->__('Add Lead');
        }
    }
}

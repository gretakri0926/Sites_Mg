<?php

    class Mage_Adminhtml_Block_Catalog_Product_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
    {
 
        public function render(Varien_Object $row)
        {
            $value = $row->getData($this->getColumn()->getIndex());
            if ($value != 'no_selection') {
            return '<img src="http://www.fin-s.com/store/media/catalog/product/' .$value. '" />';
            } else {
            return '<p>no image set</p>';
            }
        }

    }
?>

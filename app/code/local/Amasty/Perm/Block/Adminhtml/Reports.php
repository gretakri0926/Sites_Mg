<?php
/**
 * @copyright   Copyright (c) 2009-2011 Amasty (http://www.amasty.com)
 */
class Amasty_Perm_Block_Adminhtml_Reports extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('ampermGridReport');
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $orders = Mage::getResourceModel('sales/order_grid_collection');           
        $userId = $this->getRequest()->getParam('user_id', 0);    
        $permissionManager = Mage::getModel('amperm/perm');
        $permissionManager->addOrdersRestriction($orders, $userId); 
                            
        $this->setCollection($orders);
        return parent::_prepareCollection();
    }  
    
    protected function _prepareColumns()
    {
        $this->addColumn('increment_id', array(
            'header'    => Mage::helper('customer')->__('Order #'),
            'width'     => '100',
            'index'     => 'increment_id',
        ));

        $this->addColumn('created_at', array(
            'header'    => Mage::helper('customer')->__('Purchase On'),
            'index'     => 'created_at',
            'type'      => 'datetime',
        ));

        $this->addColumn('billing_name', array(
            'header'    => Mage::helper('customer')->__('Bill to Name'),
            'index'     => 'billing_name',
        ));

        $this->addColumn('shipping_name', array(
            'header'    => Mage::helper('customer')->__('Shipped to Name'),
            'index'     => 'shipping_name',
        ));

        $this->addColumn('grand_total', array(
            'header'    => Mage::helper('customer')->__('Order Total'),
            'index'     => 'grand_total',
            'type'      => 'currency',
            'currency'  => 'order_currency_code',
        ));

        if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn('store_id', array(
                'header'    => Mage::helper('customer')->__('Bought From'),
                'index'     => 'store_id',
                'type'      => 'store',
                'store_view' => true
            ));
        }
        
        $this->addColumn('status', array(
            'header' => Mage::helper('sales')->__('Status'),
            'index' => 'status',
            'type'  => 'options',
            'width' => '70px',
            'options' => Mage::getSingleton('sales/order_config')->getStatuses(),
        ));         
        
        $this->addColumn('action', array(
            'header'    => Mage::helper('customer')->__('Action'),
            'index'     => 'entity_id',
            'type'      => 'action',
            'filter'    => false,
            'sortable'  => false,
            'actions'   => array(
                array(
                    'caption' => Mage::helper('sales')->__('View Order'),
                    'url'     => array('base'=>'adminhtml/sales_order/view'),
                    'field'   => 'entity_id' 
                ),
            )
        ));         
        
        return parent::_prepareColumns();
    } 

    public function getGridUrl()
    {
        return $this->getUrl('*/*/reports', array('_current' => true));
    }

    public function getRowUrl($row)
    {
       return $this->getUrl('adminhtml/sales_order/view', array('order_id' => $row->getEntityId()));
    } 

}

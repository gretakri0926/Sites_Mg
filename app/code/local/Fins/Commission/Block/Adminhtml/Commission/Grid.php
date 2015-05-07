<?php

class Fins_Commission_Block_Adminhtml_Commission_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('commissionGrid');
      $this->setDefaultSort('commission_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('commission/commission')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      /*
      $this->addColumn('commission_id', array(
          'header'    => Mage::helper('commission')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'commission_id',
      ));
       */

      $this->addColumn('title', array(
          'header'    => Mage::helper('commission')->__('Commission Rate Name'),
          'align'     =>'left',
          'index'     => 'title',
      ));

      $this->addColumn('content', array(
			'header'    => Mage::helper('commission')->__('Commission Rate (in %)'),
			'width'     => '150px',
			'index'     => 'content',
      ));

      $this->addColumn('status', array(
          'header'    => Mage::helper('commission')->__('Status'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'status',
          'type'      => 'options',
          'options'   => array(
              1 => 'Enabled',
              2 => 'Disabled',
          ),
      ));
	  
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('commission')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('commission')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
		$this->addExportType('*/*/exportCsv', Mage::helper('commission')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('commission')->__('XML'));
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('commission_id');
        $this->getMassactionBlock()->setFormFieldName('commission');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('commission')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('commission')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('commission/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('commission')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('commission')->__('Status'),
                         'values' => $statuses
                     )
             )
        ));
        return $this;
    }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

}

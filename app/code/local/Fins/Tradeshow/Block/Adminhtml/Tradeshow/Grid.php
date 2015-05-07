<?php

class Fins_Tradeshow_Block_Adminhtml_Tradeshow_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('tradeshowGrid');
      $this->setDefaultSort('tradeshow_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('tradeshow/tradeshow')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('converted', array(
          'header'    => Mage::helper('tradeshow')->__('Converted?'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'converted',
      ));

      $this->addColumn('created_time', array(
          'header'    => Mage::helper('tradeshow')->__('Date'),
          'align'     =>'left',
          'index'     => 'created_time',
      ));

      $this->addColumn('firstname', array(
          'header'    => Mage::helper('tradeshow')->__('Name'),
          'align'     =>'left',
          'index'     => 'firstname',
      ));

      $this->addColumn('email', array(
          'header'    => Mage::helper('tradeshow')->__('Email'),
          'align'     =>'left',
          'index'     => 'email',
      ));

      $this->addColumn('phone', array(
          'header'    => Mage::helper('tradeshow')->__('Phone'),
          'align'     =>'left',
          'index'     => 'phone',
      ));

      $this->addColumn('referred_page', array(
          'header'    => Mage::helper('tradeshow')->__('Referred From'),
          'align'     =>'left',
          'index'     => 'referred_page',
      ));

      $this->addColumn('business_type', array(
          'header'    => Mage::helper('tradeshow')->__('Type'),
          'align'     =>'left',
          'index'     => 'business_type',
      ));

      $this->addColumn('get_newsletter', array(
          'header'    => Mage::helper('tradeshow')->__('Subscribe'),
          'align'     =>'left',
          'index'     => 'get_newsletter',
      ));

      // $this->addColumn('title', array(
      //     'header'    => Mage::helper('tradeshow')->__('Title'),
      //     'align'     =>'left',
      //     'index'     => 'title',
      // ));

	  /*
      $this->addColumn('content', array(
			'header'    => Mage::helper('tradeshow')->__('Item Content'),
			'width'     => '150px',
			'index'     => 'content',
      ));
	  */

      // $this->addColumn('status', array(
      //     'header'    => Mage::helper('tradeshow')->__('Status'),
      //     'align'     => 'left',
      //     'width'     => '80px',
      //     'index'     => 'status',
      //     'type'      => 'options',
      //     'options'   => array(
      //         1 => 'Enabled',
      //         2 => 'Disabled',
      //     ),
      // ));
	  
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('tradeshow')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('tradeshow')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
		$this->addExportType('*/*/exportCsv', Mage::helper('tradeshow')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('tradeshow')->__('XML'));
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('tradeshow_id');
        $this->getMassactionBlock()->setFormFieldName('tradeshow');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('tradeshow')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('tradeshow')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('tradeshow/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('tradeshow')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('tradeshow')->__('Status'),
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

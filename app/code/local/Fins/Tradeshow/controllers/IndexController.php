<?php
class Fins_Tradeshow_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/tradeshow?id=15 
    	 *  or
    	 * http://site.com/tradeshow/id/15 	
    	 */
    	/* 
		$tradeshow_id = $this->getRequest()->getParam('id');

  		if($tradeshow_id != null && $tradeshow_id != '')	{
			$tradeshow = Mage::getModel('tradeshow/tradeshow')->load($tradeshow_id)->getData();
		} else {
			$tradeshow = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($tradeshow == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$tradeshowTable = $resource->getTableName('tradeshow');
			
			$select = $read->select()
			   ->from($tradeshowTable,array('tradeshow_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$tradeshow = $read->fetchRow($select);
		}
		Mage::register('tradeshow', $tradeshow);
		*/

			
		$this->loadLayout();     
        $this->getLayout()->getBlock('head')->setTitle($this->__('Fin-S Contact | Wholesaler Application'));
		$this->renderLayout();
    }

    public function testAction() {
        echo 'asdf';
    }

}

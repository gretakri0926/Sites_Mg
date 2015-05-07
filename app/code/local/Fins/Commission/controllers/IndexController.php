<?php
class Fins_Commission_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/commission?id=15 
    	 *  or
    	 * http://site.com/commission/id/15 	
    	 */
    	/* 
		$commission_id = $this->getRequest()->getParam('id');

  		if($commission_id != null && $commission_id != '')	{
			$commission = Mage::getModel('commission/commission')->load($commission_id)->getData();
		} else {
			$commission = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($commission == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$commissionTable = $resource->getTableName('commission');
			
			$select = $read->select()
			   ->from($commissionTable,array('commission_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$commission = $read->fetchRow($select);
		}
		Mage::register('commission', $commission);
		*/

			
		$this->loadLayout();     
		$this->renderLayout();
    }
}
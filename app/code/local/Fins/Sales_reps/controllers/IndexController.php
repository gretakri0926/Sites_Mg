<?php
class Fins_Sales_reps_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/sales_reps?id=15 
    	 *  or
    	 * http://site.com/sales_reps/id/15 	
    	 */
    	/* 
		$sales_reps_id = $this->getRequest()->getParam('id');

  		if($sales_reps_id != null && $sales_reps_id != '')	{
			$sales_reps = Mage::getModel('sales_reps/sales_reps')->load($sales_reps_id)->getData();
		} else {
			$sales_reps = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($sales_reps == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$sales_repsTable = $resource->getTableName('sales_reps');
			
			$select = $read->select()
			   ->from($sales_repsTable,array('sales_reps_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$sales_reps = $read->fetchRow($select);
		}
		Mage::register('sales_reps', $sales_reps);
		*/

			
		$this->loadLayout();     
		$this->renderLayout();
    }
}
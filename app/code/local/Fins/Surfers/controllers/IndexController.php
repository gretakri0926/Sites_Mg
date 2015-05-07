<?php
class Fins_Surfers_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/surfers?id=15 
    	 *  or
    	 * http://site.com/surfers/id/15 	
    	 */
		$surfers_id = $this->getRequest()->getParam('id');

  		if($surfers_id != null && $surfers_id != '')	{
			$surfers = Mage::getModel('surfers/surfers')->load($surfers_id)->getData();
		} else {
			$surfers = null;
		}	
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	if($surfers == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$surfersTable = $resource->getTableName('surfers');
			
			$select = $read->select()
			   ->from($surfersTable,array('surfers_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$surfers = $read->fetchRow($select);
		}
		Mage::register('surfers', $surfers);

		$this->loadLayout();     
        $this->getLayout()->getBlock('head')->setTitle($this->__('Fin-S Surf Team'));
		$this->renderLayout();
    }
}

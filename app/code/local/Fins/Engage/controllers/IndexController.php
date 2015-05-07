<?php
class Fins_Engage_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/engage?id=15 
    	 *  or
    	 * http://site.com/engage/id/15 	
    	 */
    	/* 
		$engage_id = $this->getRequest()->getParam('id');

  		if($engage_id != null && $engage_id != '')	{
			$engage = Mage::getModel('engage/engage')->load($engage_id)->getData();
		} else {
			$engage = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($engage == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$engageTable = $resource->getTableName('engage');
			
			$select = $read->select()
			   ->from($engageTable,array('engage_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$engage = $read->fetchRow($select);
		}
		Mage::register('engage', $engage);
		*/

			
		$this->loadLayout();     
		$this->renderLayout();
    }

    public function createAction() {
        if ($this->getRequest()->isPost()) {
            $req = $this->getRequest();

            $params['name'] = $req->getParam('name');
            $params['email'] = $req->getParam('email');
            $params['referred_page'] = 'home page';

            try {
                $connection = Mage::getSingleton('core/resource')->getConnection('core_write'); 
                $insert_query = $connection->query("INSERT INTO tradeshow (name, email, referred_page, created_time) VALUES ('$params[name]', '$params[email]', '$params[referred_page]', NOW())");
                $message = 'Thank you for signing up. We will respond to ' . $params['email'] . 'with updates and special offers';
            } catch (Exception $e) {
                $message = $e;
            }
        } 

        // $this->_getSession()->addError($message);

        // $this->loadLayout();     
        // $this->renderLayout();

        // should redirect to thank you page
        $this->_redirectUrl('http://www.fin-s.com');
    }
}

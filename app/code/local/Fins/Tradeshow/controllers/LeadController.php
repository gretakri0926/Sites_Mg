<?php
class Fins_Tradeshow_LeadController extends Mage_Core_Controller_Front_Action
{
    /**
     * Action list where need check enabled cookie
     *
     * @var array
     */
    protected $_cookieCheckActions = array('loginPost', 'createpost');

    /**
     * Retrieve customer session model object
     *
     * @return Mage_Customer_Model_Session
     */
    protected function _getSession()
    {
        return Mage::getSingleton('customer/session');
    }

    /**
     * Action predispatch
     *
     * Check customer authentication for some actions
     */
    public function preDispatch()
    {
        // a brute-force protection here would be nice

        parent::preDispatch();

        if (!$this->getRequest()->isDispatched()) {
            return;
        }

        $action = $this->getRequest()->getActionName();
        $openActions = array(
            'create',
            'login',
            'logoutsuccess',
            'forgotpassword',
            'forgotpasswordpost',
            'resetpassword',
            'resetpasswordpost',
            'confirm',
            'confirmation'
        );
        $pattern = '/^(' . implode('|', $openActions) . ')/i';

        if (!preg_match($pattern, $action)) {
            if (!$this->_getSession()->authenticate($this)) {
                $this->setFlag('', 'no-dispatch', true);
            }
        } else {
            $this->_getSession()->setNoReferer(true);
        }
    }

    /**
     * Action postdispatch
     *
     * Remove No-referer flag from customer session after each action
     */
    public function postDispatch()
    {
        parent::postDispatch();
        $this->_getSession()->unsNoReferer(false);
    }

    /**
     * Default customer account page
     */
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
		$this->renderLayout();
    }

    public function createAction() {
        if ($this->getRequest()->isPost() && ($this->getRequest()->getParam('email') != '')) {
            $req = $this->getRequest();

            $params['firstname'] = $req->getParam('firstname');
            $params['email'] = $req->getParam('email');
            $params['referred_page'] = $req->getParam('referred_page');

            if ($params['referred_page'] == 'homepage') {
              $params['lastname'] = ' ';
              $params['company_name'] = '';
              $params['phone'] = '';
              $params['zip'] = '';
              $params['business_type'] = '';
              $biz_type = 'other';
              $params['boards_built_per_month'] = '';
              $params['boards_sold_per_month'] = '';
              $params['aftermarket_fins_sold_per_month'] = '';
              $params['comment'] = $req->getParam('comment');
              $params['newsletter'] = $req->getParam('newsletter');

            } elseif ($params['referred_page'] == 'lead_collector') {
              $params['lastname'] = $req->getParam('lastname');
              $params['company_name'] = $req->getParam('company_name');
              $params['phone'] = $req->getParam('phone');
              $params['zip'] = $req->getParam('zipcode');
              $params['business_type'] = $req->getParam('business_type');
              $biz_type = $req->getParam('business_type');
              $params['boards_built_per_month'] = $req->getParam('boards_built_per_month');
              $params['boards_sold_per_month'] = $req->getParam('boards_sold_per_month');
              $params['aftermarket_fins_sold_per_month'] = $req->getParam('aftermarket_fins_sold_per_month');
              $params['comment'] = $req->getParam('comment');
              $params['newsletter'] = $req->getParam('newsletter');
            }

           try {
               $connection = Mage::getSingleton('core/resource')->getConnection('core_write'); 
               $insert_query = $connection->query("INSERT INTO tradeshow (firstname, lastname, company_name, email, phone, zip, business_type, boards_built_per_month, boards_sold_per_month, aftermarket_fins_sold_per_month, content, referred_page, get_newsletter, created_time) VALUES ('$params[firstname]', '$params[lastname]', '$params[company_name]', '$params[email]', '$params[phone]', '$params[zip]', '$biz_type', '$params[boards_built_per_month]', '$params[boards_sold_per_month]', '$params[aftermarket_fins_sold_per_month]', '$params[comment]', '$params[referred_page]', '$params[newsletter]', NOW())");
               $message = 'Thank you for signing up. We will respond to ' . $params['email'] . 'with updates and special offers';
           } catch (Exception $e) {
               $message = $e;
           }
        } 

        // $this->_getSession()->addError($message);
        // $this->loadLayout();     
        // $this->renderLayout();
        $this->_redirectUrl('http://www.fin-s.com');
    }

}

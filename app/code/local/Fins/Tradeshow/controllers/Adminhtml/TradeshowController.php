<?php

class Fins_Tradeshow_Adminhtml_TradeshowController extends Mage_Adminhtml_Controller_action
{

	protected function _initAction() {
		$this->loadLayout()
			->_setActiveMenu('tradeshow/items')
			->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));
		
		return $this;
	}   
 
	public function indexAction() {
		$this->_initAction()
			->renderLayout();
	}

	public function editAction() {
		$id     = $this->getRequest()->getParam('id');
		$model  = Mage::getModel('tradeshow/tradeshow')->load($id);

		if ($model->getId() || $id == 0) {
			$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
			if (!empty($data)) {
				$model->setData($data);
			}

			Mage::register('tradeshow_data', $model);

			$this->loadLayout();
			$this->_setActiveMenu('tradeshow/items');

			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));

			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

			$this->_addContent($this->getLayout()->createBlock('tradeshow/adminhtml_tradeshow_edit'))
				->_addLeft($this->getLayout()->createBlock('tradeshow/adminhtml_tradeshow_edit_tabs'));

			$this->renderLayout();
		} else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('tradeshow')->__('Item does not exist'));
			$this->_redirect('*/*/');
		}
	}
 
	public function convertAction() {
    $session = $this->_getSession();
    $session->setEscapeMessages(true); // prevent XSS injection in user input
    if ($this->getRequest()->isPost()) {

        $tradeshow_id = $this->getRequest()->getParam('tradeshow_id'); 
        $connection = Mage::getSingleton('core/resource')->getConnection('core_write'); 
        $update_query = $connection->query("UPDATE tradeshow SET converted = 'yes' WHERE tradeshow_id = '$tradeshow_id'");

      if (!$customer = Mage::registry('current_customer')) {
        $customer = Mage::getModel('customer/customer')->setId(null);
      }

      /* @var $customerForm Mage_Customer_Model_Form */
      $customerForm = Mage::getModel('customer/form');
      $customerForm->setFormCode('customer_account_create')
        ->setEntity($customer);

      $customerData = $customerForm->extractData($this->getRequest());

      /**
       * Initialize customer group id
       */
      $customer->getGroupId();

      try {
        $customerForm->compactData($customerData);
        $customer->setPassword('temppassword');

        $customer->save();

        Mage::dispatchEvent('customer_register_success',
          array('account_controller' => $this, 'customer' => $customer)
        );

      } catch (Mage_Core_Exception $e) {
        echo $e;
      } catch (Exception $e) {
        echo $e;
      }
    }

    // $this->_redirectError(Mage::getUrl('*/*/create', array('_secure' => true)));
    $this->_redirect('../index.php/admin/customer/index/', array('_secure' => true));
  }

  public function newAction() {
    $this->_forward('edit');
  }

  public function saveAction() {
    if ($data = $this->getRequest()->getPost()) {

      if(isset($_FILES['filename']['name']) && $_FILES['filename']['name'] != '') {
        try {	
          /* Starting upload */	
          $uploader = new Varien_File_Uploader('filename');

          // Any extention would work
          $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
          $uploader->setAllowRenameFiles(false);

          // Set the file upload mode 
          // false -> get the file directly in the specified folder
          // true -> get the file in the product like folders 
          //	(file.jpg will go in something like /media/f/i/file.jpg)
          $uploader->setFilesDispersion(false);

          // We set media as the upload dir
          $path = Mage::getBaseDir('media') . DS ;
          $uploader->save($path, $_FILES['filename']['name'] );

        } catch (Exception $e) {

        }

        //this way the name is saved in DB
        $data['filename'] = $_FILES['filename']['name'];
      }


      $model = Mage::getModel('tradeshow/tradeshow');		
      $model->setData($data)
        ->setId($this->getRequest()->getParam('id'));

      try {
        if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL) {
          $model->setCreatedTime(now())
            ->setUpdateTime(now());
        } else {
          $model->setUpdateTime(now());
        }	

        $model->save();
        Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('tradeshow')->__('Item was successfully saved'));
        Mage::getSingleton('adminhtml/session')->setFormData(false);

        if ($this->getRequest()->getParam('back')) {
          $this->_redirect('*/*/edit', array('id' => $model->getId()));
          return;
        }
        $this->_redirect('*/*/');
        return;
      } catch (Exception $e) {
        Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        Mage::getSingleton('adminhtml/session')->setFormData($data);
        $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
        return;
      }
    }
    Mage::getSingleton('adminhtml/session')->addError(Mage::helper('tradeshow')->__('Unable to find item to save'));
    $this->_redirect('*/*/');
  }

  public function deleteAction() {
    if( $this->getRequest()->getParam('id') > 0 ) {
      try {
        $model = Mage::getModel('tradeshow/tradeshow');

        $model->setId($this->getRequest()->getParam('id'))
          ->delete();

        Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
        $this->_redirect('*/*/');
      } catch (Exception $e) {
        Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
      }
    }
    $this->_redirect('*/*/');
  }

  public function massDeleteAction() {
    $tradeshowIds = $this->getRequest()->getParam('tradeshow');
    if(!is_array($tradeshowIds)) {
      Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
    } else {
      try {
        foreach ($tradeshowIds as $tradeshowId) {
          $tradeshow = Mage::getModel('tradeshow/tradeshow')->load($tradeshowId);
          $tradeshow->delete();
        }
        Mage::getSingleton('adminhtml/session')->addSuccess(
          Mage::helper('adminhtml')->__(
            'Total of %d record(s) were successfully deleted', count($tradeshowIds)
          )
        );
      } catch (Exception $e) {
        Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
      }
    }
    $this->_redirect('*/*/index');
  }

  public function massStatusAction()
  {
    $tradeshowIds = $this->getRequest()->getParam('tradeshow');
    if(!is_array($tradeshowIds)) {
      Mage::getSingleton('adminhtml/session')->addError($this->__('Please select item(s)'));
    } else {
      try {
        foreach ($tradeshowIds as $tradeshowId) {
          $tradeshow = Mage::getSingleton('tradeshow/tradeshow')
            ->load($tradeshowId)
            ->setStatus($this->getRequest()->getParam('status'))
            ->setIsMassupdate(true)
            ->save();
        }
        $this->_getSession()->addSuccess(
          $this->__('Total of %d record(s) were successfully updated', count($tradeshowIds))
        );
      } catch (Exception $e) {
        $this->_getSession()->addError($e->getMessage());
      }
    }
    $this->_redirect('*/*/index');
  }

  public function exportCsvAction()
  {
    $fileName   = 'tradeshow.csv';
    $content    = $this->getLayout()->createBlock('tradeshow/adminhtml_tradeshow_grid')
      ->getCsv();

    $this->_sendUploadResponse($fileName, $content);
  }

  public function exportXmlAction()
  {
    $fileName   = 'tradeshow.xml';
    $content    = $this->getLayout()->createBlock('tradeshow/adminhtml_tradeshow_grid')
      ->getXml();

    $this->_sendUploadResponse($fileName, $content);
  }

  protected function _sendUploadResponse($fileName, $content, $contentType='application/octet-stream')
  {
    $response = $this->getResponse();
    $response->setHeader('HTTP/1.1 200 OK','');
    $response->setHeader('Pragma', 'public', true);
    $response->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true);
    $response->setHeader('Content-Disposition', 'attachment; filename='.$fileName);
    $response->setHeader('Last-Modified', date('r'));
    $response->setHeader('Accept-Ranges', 'bytes');
    $response->setHeader('Content-Length', strlen($content));
    $response->setHeader('Content-type', $contentType);
    $response->setBody($content);
    $response->sendResponse();
die;
  }
}

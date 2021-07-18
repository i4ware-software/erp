<?php 

/**
 * ZF-Ext Framework
 * @package    Tes
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

require_once 'Zend/Controller/Action.php';
/** 
 * Zend_Controller_Action: For Timesheet Example. 
 * This Making all JavaScripts for ExtJS. 
 */

class Customers_JavascriptController extends Zend_Controller_Action
{
    /** @variable: protected ALC var.. */
    protected $_acl;
  /**
	 * Here we initialice ACL helper from Zion Framework.
	 * Zion Framework is located in /zf/library/Auth/Zion
	 * folder that root is in this software include path.
	 */
	public function __init() {
	
		
		$viewRenderer =
			Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
		$viewRenderer->setView($view)
					 ->setViewSuffix('js');	
	}
	
	public function preDispatch()
    {
        // change view encoding
        $this->view->setEncoding('UTF-8');
		$this->_helper->viewRenderer->setViewSuffix('js');
    }
    
	public function indexAction()
    {
	    $request = $this->getRequest();
	    /** @variable: Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** @variable: Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** @variable: Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** @variable: Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');
		/** @variable: Object variable. Example use: echo $translate->_("my_text"); */
		$translate = Zend_Registry::get('translate');
		/** Object variable. */
          $userRole = Zend_Registry::get('userRole');
          /** Object variable. */
          $acl = Zend_Registry::get('ACL');
          
        $request = $this->getRequest();
        
        //$redirect = (string) $request->getParam('os_location');
		
		$this->view->customers = $translate->_("Customers_Tes");
		$this->view->nocustomers = $translate->_("Customers_No_Customers");
		$this->view->search = $translate->_("Customers_Search");
		$this->view->page = $translate->_("Customers_Page");
		$this->view->refresh = $translate->_("Customers_Refresh");
		$this->view->refresh_tooltip = $translate->_("Customers_Refresh_Tooltip");
		$this->view->new_customer = $translate->_("Customers_New_Customer");
		$this->view->new_customer_tooltip = $translate->_("Customers_New_Customer_Tooltip");
		$this->view->submit = $translate->_("Customers_Submit");
		$this->view->close = $translate->_("Customers_Close");
		$this->view->sending = $translate->_("Customers_Sending");
		$this->view->error = $translate->_("Customers_Error");
		$this->view->success = $translate->_("Customers_Success");
		$this->view->delete_customer = $translate->_("Customers_Delete");
		$this->view->delete_customer_tooltip = $translate->_("Customers_Delete_Tooltip");
		$this->view->areyousuretitle = $translate->_("Customers_Are_You_Sure");
		$this->view->areyousuredeletetext = $translate->_("Customers_Are_You_Sure_Text");
		$this->view->customer_name = $translate->_("Customers_Customer_Name");
		$this->view->customer_email = $translate->_("Customers_Customer_Email");
		$this->view->customer_phone = $translate->_("Customers_Customer_Phone");
		$this->view->customer_zip = $translate->_("Customers_Customer_Zip");
		$this->view->customer_city = $translate->_("Customers_Customer_City");
		$this->view->customer_address = $translate->_("Customers_Customer_Address");
		$this->view->vat_id = $translate->_("Customers_Vat_Id");
		
    }
    
}


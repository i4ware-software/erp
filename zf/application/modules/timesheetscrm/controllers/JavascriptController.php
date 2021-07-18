<?php 

/**
 * ZF-Ext Framework
 * @package    Jobseekers
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

require_once 'Zend/Controller/Action.php';
/** 
 * Zend_Controller_Action: For Timesheet Example. 
 * This Making all JavaScripts for ExtJS. 
 */

class Timesheetscrm_JavascriptController extends Zend_Controller_Action
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
		
		$this->view->timesheet_name = $translate->_("Timesheetscrm_Timesheet_Name");
		$this->view->refresh = $translate->_("Timesheetscrm_Refresh");
		$this->view->refresh_tooltip = $translate->_("Timesheetscrm_Refresh_Tooltip");
		$this->view->search = $translate->_("Timesheetscrm_Search");
		$this->view->page = $translate->_("Timesheetscrm_Page");
		$this->view->notimesheets = $translate->_("Timesheetscrm_No_Timesheets");
		$this->view->next = $translate->_("Timesheetscrm_Next");
		$this->view->status = $translate->_("Timesheetscrm_Status");
		$this->view->username = $translate->_("Timesheetscrm_Username");
		$this->view->createnew = $translate->_("Timesheetscrm_Create_New");
		$this->view->createnew_tooltip = $translate->_("Timesheetscrm_Create_New_Tooltip");
		$this->view->agreement_id = $translate->_("Timesheetscrm_Agreeement_Id");
		$this->view->edit_timesheet = $translate->_("Timesheetscrm_Edit_Timesheet");
		$this->view->edit_timesheet_tooltip = $translate->_("Timesheetscrm_Edit_Timesheet_Tooltip");
		$this->view->agreement = $translate->_("Timesheetscrm_Agreement");
		$this->view->submit = $translate->_("Timesheetscrm_Submit");
		$this->view->success = $translate->_("Timesheetscrm_Success");
		$this->view->error = $translate->_("Timesheetscrm_Error");
		$this->view->sending = $translate->_("Timesheetscrm_Sending");
		$this->view->close = $translate->_("Timesheetscrm_Close");
		$this->view->memo = $translate->_("Timesheetscrm_Memo");
		$this->view->order_id = $translate->_("Timesheetscrm_Order_Id");
		$this->view->occupation = $translate->_("Timesheetscrm_Occupation");
		
    }
    
    public function agreementAction()
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
    
    	$this->view->agree_agreement = $translate->_("Timesheetscrm_Agree_Agreement");
    	$this->view->agree_agreement_tooltip = $translate->_("Timesheetscrm_Agree_Agreement_Tooltip");
    
    }
    
}


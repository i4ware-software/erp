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

class Timesheet_JavascriptController extends Zend_Controller_Action
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
          /** Object variable */
          $userId = Zend_Registry::get('userId');
          /** @variable: Object variable. Example use: echo $translate->_("my_text"); */
          $translate = Zend_Registry::get('translate');
          
        $request = $this->getRequest();
        
        //$redirect = (string) $request->getParam('os_location');
		
		$this->view->timesheet_name = $translate->_("Timesheet_Timesheet_Name");
		$this->view->refresh = $translate->_("Timesheet_Refresh");
		$this->view->refresh_tooltip = $translate->_("Timesheet_Refresh_Tooltip");
		$this->view->search = $translate->_("Timesheet_Search");
		$this->view->page = $translate->_("Timesheet_Page");
		$this->view->notimesheets = $translate->_("Timesheet_No_Timesheets");
		$this->view->next = $translate->_("Timesheet_Next");
		$this->view->status = $translate->_("Timesheet_Status");
		$this->view->username = $translate->_("Timesheet_Username");
		$this->view->createnew = $translate->_("Timesheet_Create_New");
		$this->view->createnew_tooltip = $translate->_("Timesheet_Create_New_Tooltip");
		$this->view->agreement_id = $translate->_("Timesheet_Agreeement_Id");
		$this->view->edit_timesheet = $translate->_("Timesheet_Edit_Timesheet");
		$this->view->edit_timesheet_tooltip = $translate->_("Timesheet_Edit_Timesheet_Tooltip");
		$this->view->agreement = $translate->_("Timesheet_Agreement");
		$this->view->submit = $translate->_("Timesheet_Submit");
		$this->view->success = $translate->_("Timesheet_Success");
		$this->view->error = $translate->_("Timesheet_Error");
		$this->view->sending = $translate->_("Timesheet_Sending");
		$this->view->close = $translate->_("Timesheet_Close");
		$this->view->access_denied = $translate->_("Timesheet_Access_Denied");
		$this->view->access_denied_text = $translate->_("Timesheet_Access_Denied_Text");
		$this->view->memo = $translate->_("Timesheet_Memo");
		$this->view->order_id = $translate->_("Timesheet_Order_Id");
		$this->view->occupation = $translate->_("Timesheet_Occupation");
		$this->view->user_id = $userId;
		$this->view->start_date = $translate->_("Timesheet_Start_Date");
		$this->view->date_completed = $translate->_("Timesheet_Date_Completed");
		$this->view->permanent = $translate->_("Timesheet_Permanent");
		$this->view->true = $translate->_("Timesheet_True");
		$this->view->false = $translate->_("Timesheet_False");
		
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
    
    	$this->view->agree_agreement = $translate->_("Timesheet_Agree_Agreement");
    	$this->view->agree_agreement_tooltip = $translate->_("Timesheet_Agree_Agreement_Tooltip");
    	$this->view->agree_agreement_alert_title = $translate->_("Timesheet_Agree_Agreement_Alert_Title");
    	$this->view->agree_agreement_alert_text = $translate->_("Timesheet_Agree_Agreement_Alert_Text");
    
    }
    
}


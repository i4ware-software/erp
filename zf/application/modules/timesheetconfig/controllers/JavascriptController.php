<?php 

/**
 * ZF-Ext Framework
 * @package    Timesheet Config
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

require_once 'Zend/Controller/Action.php';
/** 
 * Zend_Controller_Action: For Timesheet Example. 
 * This Making all JavaScripts for ExtJS. 
 */

class Timesheetconfig_JavascriptController extends Zend_Controller_Action
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
		
		$this->view->timesheet_config = $translate->_("Timesheetconfig_Timesheet_Config");
		$this->view->config_information = $translate->_("Timesheetconfig_Config_Information");
		$this->view->financial_id = $translate->_("Timesheetconfig_Financial_Id");
		$this->view->submit = $translate->_("Timesheetconfig_Submit");
		$this->view->loading = $translate->_("Timesheetconfig_Loading");
		$this->view->warning = $translate->_("Timesheetconfig_Warning");
		$this->view->sending = $translate->_("Timesheetconfig_Sending");
		$this->view->success = $translate->_("Timesheetconfig_Success");
		$this->view->error = $translate->_("Timesheetconfig_Error");
		$this->view->salary = $translate->_("Timesheetconfig_Salary");
		$this->view->config_compilation = $translate->_("Timesheetconfig_Compilation");
		$this->view->subject = $translate->_("Timesheetconfig_Subject");
		$this->view->bodyhtml = $translate->_("Timesheetconfig_Body_HTML");
		$this->view->bodytext = $translate->_("Timesheetconfig_Body_TEXT");
		$this->view->config_timesheet = $translate->_("Timesheetconfig_Timesheet");
		$this->view->config_cron = $translate->_("Timesheetconfig_Cron");
		$this->view->config_due_dates = $translate->_("Timesheetconfig_Due_Dates");
		$this->view->config_employee = $translate->_("Timesheetconfig_Employee");
		$this->view->config_customer_agrees = $translate->_("Timesheetconfig_Customer_Agrees");
		$this->view->config_customer_disagrees = $translate->_("Timesheetconfig_Customer_Disagrees");
		$this->view->config_admin_agrees = $translate->_("Timesheetconfig_Admin_Agrees");
		$this->view->config_admin_disagrees = $translate->_("Timesheetconfig_Admin_Disagrees");
		
    }
    
}


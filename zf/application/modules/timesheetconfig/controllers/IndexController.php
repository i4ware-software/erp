<?php 

/**
 * ZF-Ext Framework
 * @package    Timesheet Config
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

require_once 'Zend/Controller/Action.php';
/** Zend_Controller_Action */

class Timesheetconfig_IndexController extends Zend_Controller_Action
{

    public function __init()
    {
      $this->_acl = $this->_helper->getHelper('acl');

    }	
	public function indexAction()
    {
	

	    $request = $this->getRequest();
	
        /** Object variable. Example use: $logger->err("Some error"); */
		$logger = Zend_Registry::get('LOGGER');
		/** Object variable. Example use: $something = $config->database; */
		$config = Zend_Registry::get('config');
		/** Object variable. Example use: print $date->get(); */
		$date = Zend_Registry::get('date');
		/** Object variable. Example use: $stmt = $db->query($sql); */
		$db = Zend_Registry::get('dbAdapter');		
		  /** Object variable. */
          $userRole = Zend_Registry::get('userRole');
          /** Object variable. */
          $acl = Zend_Registry::get('ACL');
          /** @variable: Object variable. Example use: echo $translate->_("my_text"); */
          $translate = Zend_Registry::get('translate');
          
          $request = $this->getRequest();
		
		$this->view->portal = $config->portal;
		$this->view->layout = $config->layout;
		$this->view->agreements = $translate->_("Timesheetconfig_Agreements_Variable_Description");
		$this->view->qualifications = $translate->_("Timesheetconfig_Qualifications_Variable_Description");
		$this->view->trials = $translate->_("Timesheetconfig_Trials_Variable_Description");
		$this->view->fullname = $translate->_("Timesheetconfig_Fullname_Variable_Description");
		$this->view->fullname_employee = $translate->_("Timesheetconfig_Fullname_Employee_Variable_Description");
		$this->view->startdate = $translate->_("Timesheetconfig_Start_Date_Variable_Description");
		$this->view->enddate = $translate->_("Timesheetconfig_End_Date_Variable_Description");
		$this->view->workplace = $translate->_("Timesheetconfig_Workplace_Variable_Description");
		$this->view->company_name = $translate->_("Timesheetconfig_Company_Name_Variable_Description");
		$this->view->switch_phonenumber = $translate->_("Timesheetconfig_Switch_Phonenumber_Variable_Description");
		$this->view->company_email = $translate->_("Timesheetconfig_Company_Email_Variable_Description");
		$this->view->customer_person_company = $translate->_("Timesheetconfig_Customer_Person_Company_Variable_Description");
		$this->view->customer_person_name = $translate->_("Timesheetconfig_Customer_Person_Name_Variable_Description");
		$this->view->customer_person_email = $translate->_("Timesheetconfig_Customer_Person_Email_Variable_Description");
		$this->view->erplink = $translate->_("Timesheetconfig_Erp_Link_Variable_Description");
		$this->view->username = $translate->_("Timesheetconfig_Username_Variable_Description");
		
    }

}

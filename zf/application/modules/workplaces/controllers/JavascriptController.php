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

class Workplaces_JavascriptController extends Zend_Controller_Action
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
		
		$this->view->workplaces = $translate->_("Workplaces_Workplaces");
		$this->view->workplace_name = $translate->_("Workplaces_Workplace_Name");
		$this->view->contact_person_name = $translate->_("Workplaces_Contact_Person_Name");
		$this->view->contact_person_firstname = $translate->_("Workplaces_Contact_Person_Firstname");
		$this->view->contact_person_lastname = $translate->_("Workplaces_Contact_Person_Lastname");
		$this->view->contact_person_phone = $translate->_("Workplaces_Contact_Person_Phone");
		$this->view->contact_person_email = $translate->_("Workplaces_Contact_Person_Email");
		$this->view->order_id = $translate->_("Workplaces_Order_Id");
		$this->view->password = $translate->_("Workplaces_Password");
		$this->view->verify = $translate->_("Workplaces_Verify");
		$this->view->username = $translate->_("Workplaces_Username");
		$this->view->noworkplaces = $translate->_("Workplaces_No_Workplaces");
		$this->view->search = $translate->_("Workplaces_Search");
		$this->view->page = $translate->_("Workplaces_Page");
		$this->view->refresh = $translate->_("Workplaces_Refresh");
		$this->view->refresh_tooltip = $translate->_("Workplaces_Refresh_Tooltip");
		$this->view->new_workplace = $translate->_("Workplaces_New_Workplace");
		$this->view->new_workplace_tooltip = $translate->_("Workplaces_New_Workplace_Tooltip");
		$this->view->new_without_workplace = $translate->_("Workplaces_New_Without_Workplace");
		$this->view->new_without_workplace_tooltip = $translate->_("Workplaces_New_Without_Workplace_Tooltip");
		$this->view->submit = $translate->_("Workplaces_Submit");
		$this->view->close = $translate->_("Workplaces_Close");
		$this->view->sending = $translate->_("Workplaces_Sending");
		$this->view->error = $translate->_("Workplaces_Error");
		$this->view->success = $translate->_("Workplaces_Success");
		$this->view->delete_workplace = $translate->_("Workplaces_Delete");
		$this->view->delete_workplace_tooltip = $translate->_("Workplaces_Delete_Tooltip");
		$this->view->areyousuretitle = $translate->_("Workplaces_Are_You_Sure");
		$this->view->areyousuredeletetext = $translate->_("Workplaces_Are_You_Sure_Text");
		$this->view->customer_address = $translate->_("Workplaces_Customer_Address");
		$this->view->resourse_workplace = $translate->_("Workplaces_Add_Resourse");
		$this->view->resourse_workplace_tooltip = $translate->_("Workplaces_Add_Resourse_Tooltip");
		$this->view->refresh_employees = $translate->_("Workplaces_Refresh_Employees");
		$this->view->refresh_employees_tooltip = $translate->_("Workplaces_Refresh_Employees_Tooltip");
		$this->view->noemployees = $translate->_("Workplaces_No_Employees");
		$this->view->fullname = $translate->_("Workplaces_Fullname");
		$this->view->employee_name = $translate->_("Workplaces_Employee_Name");
		$this->view->delete_resourse_workplace = $translate->_("Workplaces_Delete_Resource");
		$this->view->delete_resourse_workplace_tooltip = $translate->_("Workplaces_Delete_Resource_Tooltip");
		$this->view->start_date = $translate->_("Workplaces_Start_Date");
		$this->view->date_completed = $translate->_("Workplaces_Date_Completed");
		$this->view->permanent = $translate->_("Workplaces_Permanent");
		$this->view->true = $translate->_("Workplaces_True");
		$this->view->false = $translate->_("Workplaces_False");
		$this->view->project_id = $translate->_("Workplaces_Project_Id");
		$this->view->profitcenter_id = $translate->_("Workplaces_Profitcenter_Id");
		$this->view->accepter = $translate->_("Workplaces_Accepter");
		$this->view->change_accepter = $translate->_("Workplaces_Change_Accepter");
		$this->view->change_accepter_tooltip = $translate->_("Workplaces_Change_Accepter_Tooltip");
		$this->view->target = $translate->_("Workplaces_Customer_Target");
		
    }
    
}


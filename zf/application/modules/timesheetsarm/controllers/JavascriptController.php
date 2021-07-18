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

class Timesheetsarm_JavascriptController extends Zend_Controller_Action
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
          
        $request = $this->getRequest();
        
        //$redirect = (string) $request->getParam('os_location');
		
		$this->view->timesheet_name = $translate->_("Timesheetshrm_Timesheet_Name");
		$this->view->refresh = $translate->_("Timesheetshrm_Refresh");
		$this->view->refresh_tooltip = $translate->_("Timesheetshrm_Refresh_Tooltip");
		$this->view->search = $translate->_("Timesheetshrm_Search");
		$this->view->page = $translate->_("Timesheetshrm_Page");
		$this->view->notimesheets = $translate->_("Timesheetshrm_No_Timesheets");
		$this->view->next = $translate->_("Timesheetshrm_Next");
		$this->view->status = $translate->_("Timesheetshrm_Status");
		$this->view->username = $translate->_("Timesheetshrm_Username");
		$this->view->createnew = $translate->_("Timesheetshrm_Create_New");
		$this->view->createnew_tooltip = $translate->_("Timesheetshrm_Create_New_Tooltip");
		$this->view->agreement_id = $translate->_("Timesheetshrm_Agreeement_Id");
		$this->view->edit_timesheet = $translate->_("Timesheetshrm_Edit_Timesheet");
		$this->view->edit_timesheet_tooltip = $translate->_("Timesheetshrm_Edit_Timesheet_Tooltip");
		$this->view->agreement = $translate->_("Timesheetshrm_Agreement");
		$this->view->submit = $translate->_("Timesheetshrm_Submit");
		$this->view->success = $translate->_("Timesheetshrm_Success");
		$this->view->error = $translate->_("Timesheetshrm_Error");
		$this->view->sending = $translate->_("Timesheetshrm_Sending");
		$this->view->close = $translate->_("Timesheetshrm_Close");
		$this->view->access_denied = $translate->_("Timesheetsarm_Access_Denied");
		$this->view->access_denied_text = $translate->_("Timesheetsarm_Access_Denied_Text");
		$this->view->memo = $translate->_("Timesheetsarm_Memo");
		$this->view->order_id = $translate->_("Timesheetsarm_Order_Id");
		$this->view->occupation = $translate->_("Timesheetsarm_Occupation");
		$this->view->delete_timesheet = $translate->_("Timesheetsarm_Delete_Timesheet");
		$this->view->delete_timesheet_tooltip = $translate->_("Timesheetsarm_Delete_Timesheet_Tooltip");
		$this->view->areyousuretitle = $translate->_("Timesheetsarm_Are_You_Sure_Title");
		$this->view->areyousuretext = $translate->_("Timesheetsarm_Are_You_Sure_Text");
		$this->view->user_id = $userId;
		$this->view->start_date = $translate->_("Timesheetsarm_Start_Date");
		$this->view->date_completed = $translate->_("Timesheetsarm_Date_Completed");
		$this->view->permanent = $translate->_("Timesheetsarm_Permanent");
		$this->view->true = $translate->_("Timesheetsarm_True");
		$this->view->false = $translate->_("Timesheetsarm_False");
		$this->view->datetime_created = $translate->_("Timesheetsarm_Date_Time_Created");
		$this->view->description = $translate->_("Timesheetsarm_Description");
		$this->view->invoicing = $translate->_("Timesheetsarm_Invoicing");
		$this->view->salary = $translate->_("Timesheetsarm_Salary");
		$this->view->workplace_name = $translate->_("Timesheetsarm_Workplace_Name");
		$this->view->pay_timesheet = $translate->_("Timesheetsarm_Pay_Timesheet");
		$this->view->pay_timesheet_tooltip = $translate->_("Timesheetsarm_Pay_Timesheet_Tooltip");
		$this->view->pdf_timesheet = $translate->_("Timesheetsarm_Pdf_Timesheet");
		$this->view->pdf_timesheet_tooltip = $translate->_("Timesheetsarm_Pdf_Timesheet_Tooltip");
		$this->view->puuttuu = $translate->_("Timesheetsarm_Puuttuu");
		$this->view->payment_history = $translate->_("Timesheetsarm_Payment_History");
		$this->view->history = $translate->_("Timesheetsarm_History");
		$this->view->payment_date = $translate->_("Timesheetsarm_Payment_Date");
		$this->view->payment_file = $translate->_("Timesheetsarm_Payment_File");
		$this->view->salary_settings = $translate->_("Timesheetsarm_Salary_Settings");
		$this->view->timesheet_settings = $translate->_("Timesheetsarm_Timesheet_Settings");
		$this->view->load_payment_file = $translate->_("Timesheetsarm_Load_Payment_File");
		$this->view->load_payment_file_tooltip = $translate->_("Timesheetsarm_No_Cards");
		$this->view->nocards = $translate->_("Timesheetsarm_No_Cards");
		$this->view->salarycards = $translate->_("Timesheetsarm_Salary_Cards");
		$this->view->unemployment = $translate->_("Timesheetsarm_Unemployment");
		$this->view->datepayment = $translate->_("Timesheetsarm_Datepayment");
		$this->view->responsibility = $translate->_("Timesheetsarm_Responsibility");
		$this->view->group = $translate->_("Timesheetsarm_Group");
		$this->view->tax = $translate->_("Timesheetsarm_Tax");
		$this->view->TyELTT = $translate->_("Timesheetsarm_TyELTT");
		$this->view->TyELTT53 = $translate->_("Timesheetsarm_TyELTT53");
		$this->view->unemploymentTT = $translate->_("Timesheetsarm_UnemploymentTT");
		$this->view->AY = $translate->_("Timesheetsarm_Ay");
		$this->view->download = $translate->_("Timesheetsarm_Downlaod_Salary_Card");
		$this->view->download_tooltip = $translate->_("Timesheetsarm_Downlaod_Salary_Card_Tooltip");
		$this->view->delete_salary_card = $translate->_("Timesheetsarm_Delete_Salary_Card");
		$this->view->delete_salary_card_tooltip = $translate->_("Timesheetsarm_Delete_Salary_Card_Tooltip");
		$this->view->nopermission = $translate->_("Timesheetsarm_No_Permission");
		$this->view->nopermission_text = $translate->_("Timesheetsarm_No_Permission_Text");
		
    }
    
}


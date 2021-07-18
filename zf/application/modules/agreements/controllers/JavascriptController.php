<?php 

/**
 * ZF-Ext Framework
 * @package    Agreements
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

require_once 'Zend/Controller/Action.php';
/** 
 * Zend_Controller_Action: For Timesheet Example. 
 * This Making all JavaScripts for ExtJS. 
 */

class Agreements_JavascriptController extends Zend_Controller_Action
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
		$this->view->module = $translate->_("Agreements_Agreements");
		$this->view->replace = $translate->_("Agreements_Replace");
		$this->view->agreement = $translate->_("Agreements_Argreement");
		$this->view->startplace = $translate->_("Agreements_Startplace");
		$this->view->sotu = $translate->_("Agreements_Sotu");
		$this->view->employee = $translate->_("Agreements_Employee");
		$this->view->address = $translate->_("Agreements_Address");
		$this->view->zip = $translate->_("Agreements_Zip");
		$this->view->city = $translate->_("Agreements_City");
		$this->view->phone = $translate->_("Agreements_Phone");
		$this->view->email = $translate->_("Agreements_Email");
		$this->view->taxnumber = $translate->_("Agreements_Taxnumber");
		$this->view->page = $translate->_("Agreements_Page");
		$this->view->search = $translate->_("Agreements_Search");
		$this->view->noagreements = $translate->_("Agreements_No_Agreements");
		$this->view->refresh = $translate->_("Agreements_Refresh");
		$this->view->refresh_tooltip = $translate->_("Agreements_Refresh_Tooltip");
		$this->view->missing = $translate->_("Agreements_Missing");
		$this->view->new_agreement = $translate->_("Agreements_New_Agreement");
		$this->view->new_agreement_tooltip = $translate->_("Agreements_New_Agreement_Tooltip");
		$this->view->submit = $translate->_("Agreements_Submit");
		$this->view->close = $translate->_("Agreements_Close");
		$this->view->error = $translate->_("Agreements_Error");
		$this->view->success = $translate->_("Agreements_Success");
		$this->view->sending = $translate->_("Agreements_Sending");
		$this->view->only_pdf_allowed = $translate->_("Agreements_Only_PDF_Allowed");
		$this->view->select_pdf = $translate->_("Agreements_Select_PDF");
		$this->view->select_pdf_label = $translate->_("Agreements_Select_PDF_Label");
		$this->view->start_date = $translate->_("Agreements_Start_Date");
		$this->view->effective_date = $translate->_("Agreements_Effective_Date");
		$this->view->permanent = $translate->_("Agreements_Permanent");
		$this->view->submit = $translate->_("Agreements_Submit");
		$this->view->workplace = $translate->_("Agreements_Workplace");
		$this->view->noqualifications = $translate->_("Agreements_No_Qualifications");
		$this->view->qualification_name = $translate->_("Agreements_Qualification_Name");
		$this->view->refresh_qualifications = $translate->_("Agreements_Refresh_Qualifications");
		$this->view->refresh_qualifications_tooltip = $translate->_("Agreements_Refresh_Qualifications_Tooltip");
		$this->view->employee_name = $translate->_("Agreements_Employee_Name");
		$this->view->date_started = $translate->_("Agreements_Date_Started");
		$this->view->date_completed = $translate->_("Agreements_Date_Completed");
		$this->view->active = $translate->_("Agreements_Active");
		$this->view->experience_in_years = $translate->_("Agreements_Experience_In_Years");
		$this->view->description = $translate->_("Agreements_Description");
		$this->view->firstname = $translate->_("Agreements_Firstname");
		$this->view->lastname = $translate->_("Agreements_Lastname");
		$this->view->true = $translate->_("Agreements_True");
		$this->view->false = $translate->_("Agreements_False");
		$this->view->years = $translate->_("Agreements_Years");
		$this->view->empty_text_worktime = $translate->_("Agreements_Empty_Text_Worktime");
		$this->view->empty_text_type = $translate->_("Agreements_Empty_Text_Type");
		$this->view->year = $translate->_("Agreements_Year");
		$this->view->type = $translate->_("Agreements_Type");
		$this->view->worktime = $translate->_("Agreements_Worktime");
		$this->view->employment_type = $translate->_("Agreements_Employment_Type");
		$this->view->period = $translate->_("Agreements_Period");
		$this->view->parttime = $translate->_("Agreements_Parttime");
		$this->view->hours_in_a_day = $translate->_("Agreements_Hours_In_A_Day");
		$this->view->warranty_work_hours = $translate->_("Agreements_Warranty_Work_Hours");
		$this->view->employment_type_reasoon = $translate->_("Agreements_Employment_Type_Reason");
		$this->view->update_agreement = $translate->_("Agreements_Update_Agreement");
		$this->view->update_agreement_tooltip = $translate->_("Agreements_Update_Agreement_Tooltip");
		$this->view->view_agreement = $translate->_("Agreements_View_Agreement");
		$this->view->agree = $translate->_("Agreements_Agree");
		$this->view->empty_text_agree = $translate->_("Agreements_Empty_Text_Agree");
		$this->view->time = $translate->_("Agreements_Time");
		$this->view->bank_account = $translate->_("Agreements_Bank_Account");
		$this->view->delete_agreement = $translate->_("Agreements_Delete_Agreement");
		$this->view->delete_agreement_tooltip = $translate->_("Agreements_Delete_Agreement_Tooltip");
		$this->view->areyousuretitle = $translate->_("Agreements_Are_You_Sure");
		$this->view->areyousuredeleteagreementtext = $translate->_("Agreements_Are_You_Sure_Text");
		$this->view->additional = $translate->_("Agreements_Addidional");
		$this->view->salary = $translate->_("Agreements_Salary");
		$this->view->salaries = $translate->_("Agreements_Salaries");
		$this->view->salary_unit = $translate->_("Agreements_Salary_Unit");
		$this->view->salary_other_what = $translate->_("Agreements_Salary_Other_What");
		$this->view->salary_terms_and_conditions = $translate->_("Agreements_Salary_Terms_And_Conditions");
		$this->view->empty_salary_terms_and_conditions = $translate->_("Agreements_Empty_Salary_Terms_And_Conditions");
		$this->view->terms_and_conditions = $translate->_("Agreements_Terms_And_Conditions");
		$this->view->employment_laws = $translate->_("Agreements_Employment_Laws");
		$this->view->empty_employment_laws = $translate->_("Agreements_Empty_Employment_Laws");
		$this->view->job_title_and_tasks = $translate->_("Agreements_Job_Title_And_Tasks");
		$this->view->job = $translate->_("Agreements_Job");
		$this->view->tasks = $translate->_("Agreements_Tasks");
		$this->view->benefits = $translate->_("Agreements_Benefits");
		$this->view->salary_payment_period = $translate->_("Agreements_Salary_Payment_Period");
		$this->view->empty_salary_payment_period = $translate->_("Agreements_Empty_Salary_Payment_Period");
		$this->view->employee_agrees_worktime = $translate->_("Agreements_Employee_Agrees_Worktime");
		$this->view->trial = $translate->_("Agreements_Trial");
		$this->view->tab_1 = $translate->_("Agreements_Tab_1");
		$this->view->tab_2 = $translate->_("Agreements_Tab_2");
		$this->view->tab_3 = $translate->_("Agreements_Tab_3");
		$this->view->tab_4 = $translate->_("Agreements_Tab_4");
		$this->view->tab_5 = $translate->_("Agreements_Tab_5");
		$this->view->tab_6 = $translate->_("Agreements_Tab_6");
		$this->view->tab_7 = $translate->_("Agreements_Tab_7");
		$this->view->user = $translate->_("Agreements_User");
		$this->view->worktime_id_1 = (string) $db->fetchone("SELECT worktime_name FROM hrm_worktime WHERE worktime_id = ".$db->quote(1, 'INTEGER').";");
		$this->view->worktime_id_2 = (string) $db->fetchone("SELECT worktime_name FROM hrm_worktime WHERE worktime_id = ".$db->quote(2, 'INTEGER').";");
		$this->view->worktime_id_3 = (string) $db->fetchone("SELECT worktime_name FROM hrm_worktime WHERE worktime_id = ".$db->quote(3, 'INTEGER').";");
		$this->view->worktime_id_4 = (string) $db->fetchone("SELECT worktime_name FROM hrm_worktime WHERE worktime_id = ".$db->quote(4, 'INTEGER').";");
		$this->view->type_id_1 = (string) $db->fetchone("SELECT type_name FROM hrm_employment_type WHERE type_id = ".$db->quote(1, 'INTEGER').";");
		$this->view->type_id_2 = (string) $db->fetchone("SELECT type_name FROM hrm_employment_type WHERE type_id = ".$db->quote(2, 'INTEGER').";");
		$this->view->type_id_3 = (string) $db->fetchone("SELECT type_name FROM hrm_employment_type WHERE type_id = ".$db->quote(3, 'INTEGER').";");
		$this->view->worklaws_id_1 = $translate->_("Agreements_Laws_1");
		$this->view->worklaws_id_2 = $translate->_("Agreements_Laws_2");
	    $this->view->salary_period_terms_and_conditions = $translate->_("Agreements_Salary_Period_Terms_And_Condtions");
	    $this->view->salary_period_id_1 = $translate->_("Agreements_Salary_Period_Id_1");
	    $this->view->salary_period_id_2 = $translate->_("Agreements_Salary_Period_Id_2");
	    $this->view->salary_period_id_3 = $translate->_("Agreements_Salary_Period_Id_3");
	    $this->view->salary_period_id_4 = $translate->_("Agreements_Salary_Period_Id_4");
	    $this->view->salary_id_1 = $translate->_("Agreements_Salary_Id_1");
	    $this->view->salary_id_2 = $translate->_("Agreements_Salary_Id_2");
	    $this->view->salary_id_3 = $translate->_("Agreements_Salary_Id_3");
	    $this->view->salary_id_4 = $translate->_("Agreements_Salary_Id_4");
	    $this->view->active = $translate->_("Agreements_Active");
	    $this->view->active_tooltip = $translate->_("Agreements_Active_Tooltip");
	    $this->view->inactive = $translate->_("Agreements_Inactive");
	    $this->view->inactive_tooltip = $translate->_("Agreements_Inactive_Tooltip");
	    $this->view->username = $translate->_("Agreements_Username");
	    $this->view->password = $translate->_("Agreements_Password");
	    $this->view->verify = $translate->_("Agreements_Verify");
	    $this->view->userdata = $translate->_("Agreements_Userdata");
	    $this->view->tes = $translate->_("Agreements_Tes");
	    $this->view->clear = $translate->_("Agreements_Clear");
	    $this->view->clear_tooltip = $translate->_("Agreements_Clear_Tooltip");
	    $this->view->upcoming = $translate->_("Agreements_Upcoming");
	    $this->view->upcoming_tooltip = $translate->_("Agreements_Upcoming_Tooltip");
	    $this->view->create_user = $translate->_("Agreements_Create_User");
	    $this->view->salary_performance_terms_and_condtions = $translate->_("Agreements_Salary_Performance");
	    $this->view->empty_text_performance_terms_and_condtions = $translate->_("Agreements_Empty_Text_Performance");
	    $this->view->customer = $translate->_("Agreements_Customer");
	    $this->view->export = $translate->_("Agreements_Export");
	    $this->view->export_tooltip = $translate->_("Agreements_Export_Tooltip");
	    $this->view->trial_end_date = $translate->_("Agreements_Trial_End_Date");
	    $this->view->export_emails_excel = $translate->_("Agreements_Export_Emails_Excel");
	    $this->view->export_emails_excel_tooltip = $translate->_("Agreements_Export_Emails_Excel_Tooltip");
	    $this->view->BIC = $translate->_("Agreements_BIC");
	    $this->view->taxation_city = $translate->_("Agreements_Taxation_City");
	    $this->view->basic_prosent = $translate->_("Agreements_Basic_Prosent");
	    $this->view->extra_prosent = $translate->_("Agreements_Extra_Prosent");
	    $this->view->Yearlysalarylimit = $translate->_("Agreements_Yearlysalarylimit");
	    $this->view->Taxationcountingmethod = $translate->_("Agreements_Taxationcountingmethod");
	    $this->view->Taxcard_come_into_effect_date = $translate->_("Agreements_Taxcard_Come_Into_Effect_Date");
	    $this->view->Retrimentmodel = $translate->_("Agreements_Retrimentmodel");
	    $this->view->AY_membershippaymentpersent = $translate->_("Agreements_AY_Membershippaymentpersent");
	    $this->view->asuntoetu = $translate->_("Agreements_Real_Estate");
	    $this->view->asuntoetu_sahko = $translate->_("Agreements_Real_Estate_Elec");
	    $this->view->autotallietu = $translate->_("Agreements_Garage_Benefit");
	    $this->view->ravintoetu = $translate->_("Agreements_Meal_Benefit");
	    $this->view->autoetu = $translate->_("Agreements_Car_Benefit");
	    $this->view->puhelinetu = $translate->_("Agreements_Phone_Benefit");
	    $this->view->message_date = $translate->_("Agreements_Message_Date");
    }
    
    public function inactiveAction()
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
		$this->view->module = $translate->_("Agreements_Agreements");
		$this->view->replace = $translate->_("Agreements_Replace");
		$this->view->agreement = $translate->_("Agreements_Argreement");
		$this->view->startplace = $translate->_("Agreements_Startplace");
		$this->view->sotu = $translate->_("Agreements_Sotu");
		$this->view->employee = $translate->_("Agreements_Employee");
		$this->view->address = $translate->_("Agreements_Address");
		$this->view->zip = $translate->_("Agreements_Zip");
		$this->view->city = $translate->_("Agreements_City");
		$this->view->phone = $translate->_("Agreements_Phone");
		$this->view->email = $translate->_("Agreements_Email");
		$this->view->taxnumber = $translate->_("Agreements_Taxnumber");
		$this->view->page = $translate->_("Agreements_Page");
		$this->view->search = $translate->_("Agreements_Search");
		$this->view->noagreements = $translate->_("Agreements_No_Agreements");
		$this->view->refresh = $translate->_("Agreements_Refresh");
		$this->view->refresh_tooltip = $translate->_("Agreements_Refresh_Tooltip");
		$this->view->missing = $translate->_("Agreements_Missing");
		$this->view->new_agreement = $translate->_("Agreements_New_Agreement");
		$this->view->new_agreement_tooltip = $translate->_("Agreements_New_Agreement_Tooltip");
		$this->view->submit = $translate->_("Agreements_Submit");
		$this->view->close = $translate->_("Agreements_Close");
		$this->view->error = $translate->_("Agreements_Error");
		$this->view->success = $translate->_("Agreements_Success");
		$this->view->sending = $translate->_("Agreements_Sending");
		$this->view->only_pdf_allowed = $translate->_("Agreements_Only_PDF_Allowed");
		$this->view->select_pdf = $translate->_("Agreements_Select_PDF");
		$this->view->select_pdf_label = $translate->_("Agreements_Select_PDF_Label");
		$this->view->start_date = $translate->_("Agreements_Start_Date");
		$this->view->effective_date = $translate->_("Agreements_Effective_Date");
		$this->view->permanent = $translate->_("Agreements_Permanent");
		$this->view->submit = $translate->_("Agreements_Submit");
		$this->view->workplace = $translate->_("Agreements_Workplace");
		$this->view->noqualifications = $translate->_("Agreements_No_Qualifications");
		$this->view->qualification_name = $translate->_("Agreements_Qualification_Name");
		$this->view->refresh_qualifications = $translate->_("Agreements_Refresh_Qualifications");
		$this->view->refresh_qualifications_tooltip = $translate->_("Agreements_Refresh_Qualifications_Tooltip");
		$this->view->employee_name = $translate->_("Agreements_Employee_Name");
		$this->view->date_started = $translate->_("Agreements_Date_Started");
		$this->view->date_completed = $translate->_("Agreements_Date_Completed");
		$this->view->active = $translate->_("Agreements_Active");
		$this->view->experience_in_years = $translate->_("Agreements_Experience_In_Years");
		$this->view->description = $translate->_("Agreements_Description");
		$this->view->firstname = $translate->_("Agreements_Firstname");
		$this->view->lastname = $translate->_("Agreements_Lastname");
		$this->view->true = $translate->_("Agreements_True");
		$this->view->false = $translate->_("Agreements_False");
		$this->view->years = $translate->_("Agreements_Years");
		$this->view->empty_text_worktime = $translate->_("Agreements_Empty_Text_Worktime");
		$this->view->empty_text_type = $translate->_("Agreements_Empty_Text_Type");
		$this->view->year = $translate->_("Agreements_Year");
		$this->view->type = $translate->_("Agreements_Type");
		$this->view->worktime = $translate->_("Agreements_Worktime");
		$this->view->employment_type = $translate->_("Agreements_Employment_Type");
		$this->view->period = $translate->_("Agreements_Period");
		$this->view->parttime = $translate->_("Agreements_Parttime");
		$this->view->hours_in_a_day = $translate->_("Agreements_Hours_In_A_Day");
		$this->view->warranty_work_hours = $translate->_("Agreements_Warranty_Work_Hours");
		$this->view->employment_type_reasoon = $translate->_("Agreements_Employment_Type_Reason");
		$this->view->update_agreement = $translate->_("Agreements_Update_Agreement");
		$this->view->update_agreement_tooltip = $translate->_("Agreements_Update_Agreement_Tooltip");
		$this->view->view_agreement = $translate->_("Agreements_View_Agreement");
		$this->view->agree = $translate->_("Agreements_Agree");
		$this->view->empty_text_agree = $translate->_("Agreements_Empty_Text_Agree");
		$this->view->time = $translate->_("Agreements_Time");
		$this->view->bank_account = $translate->_("Agreements_Bank_Account");
		$this->view->delete_agreement = $translate->_("Agreements_Delete_Agreement");
		$this->view->delete_agreement_tooltip = $translate->_("Agreements_Delete_Agreement_Tooltip");
		$this->view->areyousuretitle = $translate->_("Agreements_Are_You_Sure");
		$this->view->areyousuredeleteagreementtext = $translate->_("Agreements_Are_You_Sure_Text");
		$this->view->additional = $translate->_("Agreements_Addidional");
		$this->view->salary = $translate->_("Agreements_Salary");
		$this->view->salaries = $translate->_("Agreements_Salaries");
		$this->view->salary_unit = $translate->_("Agreements_Salary_Unit");
		$this->view->salary_other_what = $translate->_("Agreements_Salary_Other_What");
		$this->view->salary_terms_and_conditions = $translate->_("Agreements_Salary_Terms_And_Conditions");
		$this->view->empty_salary_terms_and_conditions = $translate->_("Agreements_Empty_Salary_Terms_And_Conditions");
		$this->view->terms_and_conditions = $translate->_("Agreements_Terms_And_Conditions");
		$this->view->employment_laws = $translate->_("Agreements_Employment_Laws");
		$this->view->empty_employment_laws = $translate->_("Agreements_Empty_Employment_Laws");
		$this->view->job_title_and_tasks = $translate->_("Agreements_Job_Title_And_Tasks");
		$this->view->job = $translate->_("Agreements_Job");
		$this->view->tasks = $translate->_("Agreements_Tasks");
		$this->view->benefits = $translate->_("Agreements_Benefits");
		$this->view->salary_payment_period = $translate->_("Agreements_Salary_Payment_Period");
		$this->view->empty_salary_payment_period = $translate->_("Agreements_Empty_Salary_Payment_Period");
		$this->view->employee_agrees_worktime = $translate->_("Agreements_Employee_Agrees_Worktime");
		$this->view->trial = $translate->_("Agreements_Trial");
		$this->view->tab_1 = $translate->_("Agreements_Tab_1");
		$this->view->tab_2 = $translate->_("Agreements_Tab_2");
		$this->view->tab_3 = $translate->_("Agreements_Tab_3");
		$this->view->tab_4 = $translate->_("Agreements_Tab_4");
		$this->view->tab_5 = $translate->_("Agreements_Tab_5");
		$this->view->tab_6 = $translate->_("Agreements_Tab_6");
		$this->view->tab_7 = $translate->_("Agreements_Tab_7");
		$this->view->user = $translate->_("Agreements_User");
		$this->view->worktime_id_1 = (string) $db->fetchone("SELECT worktime_name FROM hrm_worktime WHERE worktime_id = ".$db->quote(1, 'INTEGER').";");
		$this->view->worktime_id_2 = (string) $db->fetchone("SELECT worktime_name FROM hrm_worktime WHERE worktime_id = ".$db->quote(2, 'INTEGER').";");
		$this->view->worktime_id_3 = (string) $db->fetchone("SELECT worktime_name FROM hrm_worktime WHERE worktime_id = ".$db->quote(3, 'INTEGER').";");
		$this->view->worktime_id_4 = (string) $db->fetchone("SELECT worktime_name FROM hrm_worktime WHERE worktime_id = ".$db->quote(4, 'INTEGER').";");
		$this->view->type_id_1 = (string) $db->fetchone("SELECT type_name FROM hrm_employment_type WHERE type_id = ".$db->quote(1, 'INTEGER').";");
		$this->view->type_id_2 = (string) $db->fetchone("SELECT type_name FROM hrm_employment_type WHERE type_id = ".$db->quote(2, 'INTEGER').";");
		$this->view->type_id_3 = (string) $db->fetchone("SELECT type_name FROM hrm_employment_type WHERE type_id = ".$db->quote(3, 'INTEGER').";");
		$this->view->worklaws_id_1 = $translate->_("Agreements_Laws_1");
		$this->view->worklaws_id_2 = $translate->_("Agreements_Laws_2");
	    $this->view->salary_period_terms_and_conditions = $translate->_("Agreements_Salary_Period_Terms_And_Condtions");
	    $this->view->salary_period_id_1 = $translate->_("Agreements_Salary_Period_Id_1");
	    $this->view->salary_period_id_2 = $translate->_("Agreements_Salary_Period_Id_2");
	    $this->view->salary_period_id_3 = $translate->_("Agreements_Salary_Period_Id_3");
	    $this->view->salary_period_id_4 = $translate->_("Agreements_Salary_Period_Id_4");
	    $this->view->salary_id_1 = $translate->_("Agreements_Salary_Id_1");
	    $this->view->salary_id_2 = $translate->_("Agreements_Salary_Id_2");
	    $this->view->salary_id_3 = $translate->_("Agreements_Salary_Id_3");
	    $this->view->salary_id_4 = $translate->_("Agreements_Salary_Id_4");
	    $this->view->active = $translate->_("Agreements_Active");
	    $this->view->active_tooltip = $translate->_("Agreements_Active_Tooltip");
	    $this->view->inactive = $translate->_("Agreements_Inactive");
	    $this->view->inactive_tooltip = $translate->_("Agreements_Inactive_Tooltip");
	    $this->view->tes = $translate->_("Agreements_Tes");
	    $this->view->upcoming = $translate->_("Agreements_Upcoming");
	    $this->view->upcoming_tooltip = $translate->_("Agreements_Upcoming_Tooltip");
	    $this->view->salary_performance_terms_and_condtions = $translate->_("Agreements_Salary_Performance");
	    $this->view->empty_text_performance_terms_and_condtions = $translate->_("Agreements_Empty_Text_Performance");
	    $this->view->customer = $translate->_("Agreements_Customer");
	    $this->view->trial_end_date = $translate->_("Agreements_Trial_End_Date");
	    $this->view->BIC = $translate->_("Agreements_BIC");
	    $this->view->taxation_city = $translate->_("Agreements_Taxation_City");
	    $this->view->basic_prosent = $translate->_("Agreements_Basic_Prosent");
	    $this->view->extra_prosent = $translate->_("Agreements_Extra_Prosent");
	    $this->view->Yearlysalarylimit = $translate->_("Agreements_Yearlysalarylimit");
	    $this->view->Taxationcountingmethod = $translate->_("Agreements_Taxationcountingmethod");
	    $this->view->Taxcard_come_into_effect_date = $translate->_("Agreements_Taxcard_Come_Into_Effect_Date");
	    $this->view->Retrimentmodel = $translate->_("Agreements_Retrimentmodel");
	    $this->view->AY_membershippaymentpersent = $translate->_("Agreements_AY_Membershippaymentpersent");
	    $this->view->asuntoetu = $translate->_("Agreements_Real_Estate");
	    $this->view->asuntoetu_sahko = $translate->_("Agreements_Real_Estate_Elec");
	    $this->view->autotallietu = $translate->_("Agreements_Garage_Benefit");
	    $this->view->ravintoetu = $translate->_("Agreements_Meal_Benefit");
	    $this->view->autoetu = $translate->_("Agreements_Car_Benefit");
	    $this->view->puhelinetu = $translate->_("Agreements_Phone_Benefit");
	    $this->view->message_date = $translate->_("Agreements_Message_Date");
    }
    
    public function upcomingAction()
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
    	$this->view->module = $translate->_("Agreements_Agreements");
    	$this->view->replace = $translate->_("Agreements_Replace");
    	$this->view->agreement = $translate->_("Agreements_Argreement");
    	$this->view->startplace = $translate->_("Agreements_Startplace");
    	$this->view->sotu = $translate->_("Agreements_Sotu");
    	$this->view->employee = $translate->_("Agreements_Employee");
    	$this->view->address = $translate->_("Agreements_Address");
    	$this->view->zip = $translate->_("Agreements_Zip");
    	$this->view->city = $translate->_("Agreements_City");
    	$this->view->phone = $translate->_("Agreements_Phone");
    	$this->view->email = $translate->_("Agreements_Email");
    	$this->view->taxnumber = $translate->_("Agreements_Taxnumber");
    	$this->view->page = $translate->_("Agreements_Page");
    	$this->view->search = $translate->_("Agreements_Search");
    	$this->view->noagreements = $translate->_("Agreements_No_Agreements");
    	$this->view->refresh = $translate->_("Agreements_Refresh");
    	$this->view->refresh_tooltip = $translate->_("Agreements_Refresh_Tooltip");
    	$this->view->missing = $translate->_("Agreements_Missing");
    	$this->view->new_agreement = $translate->_("Agreements_New_Agreement");
    	$this->view->new_agreement_tooltip = $translate->_("Agreements_New_Agreement_Tooltip");
    	$this->view->submit = $translate->_("Agreements_Submit");
    	$this->view->close = $translate->_("Agreements_Close");
    	$this->view->error = $translate->_("Agreements_Error");
    	$this->view->success = $translate->_("Agreements_Success");
    	$this->view->sending = $translate->_("Agreements_Sending");
    	$this->view->only_pdf_allowed = $translate->_("Agreements_Only_PDF_Allowed");
    	$this->view->select_pdf = $translate->_("Agreements_Select_PDF");
    	$this->view->select_pdf_label = $translate->_("Agreements_Select_PDF_Label");
    	$this->view->start_date = $translate->_("Agreements_Start_Date");
    	$this->view->effective_date = $translate->_("Agreements_Effective_Date");
    	$this->view->permanent = $translate->_("Agreements_Permanent");
    	$this->view->submit = $translate->_("Agreements_Submit");
    	$this->view->workplace = $translate->_("Agreements_Workplace");
    	$this->view->noqualifications = $translate->_("Agreements_No_Qualifications");
    	$this->view->qualification_name = $translate->_("Agreements_Qualification_Name");
    	$this->view->refresh_qualifications = $translate->_("Agreements_Refresh_Qualifications");
    	$this->view->refresh_qualifications_tooltip = $translate->_("Agreements_Refresh_Qualifications_Tooltip");
    	$this->view->employee_name = $translate->_("Agreements_Employee_Name");
    	$this->view->date_started = $translate->_("Agreements_Date_Started");
    	$this->view->date_completed = $translate->_("Agreements_Date_Completed");
    	$this->view->active = $translate->_("Agreements_Active");
    	$this->view->experience_in_years = $translate->_("Agreements_Experience_In_Years");
    	$this->view->description = $translate->_("Agreements_Description");
    	$this->view->firstname = $translate->_("Agreements_Firstname");
    	$this->view->lastname = $translate->_("Agreements_Lastname");
    	$this->view->true = $translate->_("Agreements_True");
    	$this->view->false = $translate->_("Agreements_False");
    	$this->view->years = $translate->_("Agreements_Years");
    	$this->view->empty_text_worktime = $translate->_("Agreements_Empty_Text_Worktime");
    	$this->view->empty_text_type = $translate->_("Agreements_Empty_Text_Type");
    	$this->view->year = $translate->_("Agreements_Year");
    	$this->view->type = $translate->_("Agreements_Type");
    	$this->view->worktime = $translate->_("Agreements_Worktime");
    	$this->view->employment_type = $translate->_("Agreements_Employment_Type");
    	$this->view->period = $translate->_("Agreements_Period");
    	$this->view->parttime = $translate->_("Agreements_Parttime");
    	$this->view->hours_in_a_day = $translate->_("Agreements_Hours_In_A_Day");
    	$this->view->warranty_work_hours = $translate->_("Agreements_Warranty_Work_Hours");
    	$this->view->employment_type_reasoon = $translate->_("Agreements_Employment_Type_Reason");
    	$this->view->update_agreement = $translate->_("Agreements_Update_Agreement");
    	$this->view->update_agreement_tooltip = $translate->_("Agreements_Update_Agreement_Tooltip");
    	$this->view->view_agreement = $translate->_("Agreements_View_Agreement");
    	$this->view->agree = $translate->_("Agreements_Agree");
    	$this->view->empty_text_agree = $translate->_("Agreements_Empty_Text_Agree");
    	$this->view->time = $translate->_("Agreements_Time");
    	$this->view->bank_account = $translate->_("Agreements_Bank_Account");
    	$this->view->delete_agreement = $translate->_("Agreements_Delete_Agreement");
    	$this->view->delete_agreement_tooltip = $translate->_("Agreements_Delete_Agreement_Tooltip");
    	$this->view->areyousuretitle = $translate->_("Agreements_Are_You_Sure");
    	$this->view->areyousuredeleteagreementtext = $translate->_("Agreements_Are_You_Sure_Text");
    	$this->view->additional = $translate->_("Agreements_Addidional");
    	$this->view->salary = $translate->_("Agreements_Salary");
    	$this->view->salaries = $translate->_("Agreements_Salaries");
    	$this->view->salary_unit = $translate->_("Agreements_Salary_Unit");
    	$this->view->salary_other_what = $translate->_("Agreements_Salary_Other_What");
    	$this->view->salary_terms_and_conditions = $translate->_("Agreements_Salary_Terms_And_Conditions");
    	$this->view->empty_salary_terms_and_conditions = $translate->_("Agreements_Empty_Salary_Terms_And_Conditions");
    	$this->view->terms_and_conditions = $translate->_("Agreements_Terms_And_Conditions");
    	$this->view->employment_laws = $translate->_("Agreements_Employment_Laws");
    	$this->view->empty_employment_laws = $translate->_("Agreements_Empty_Employment_Laws");
    	$this->view->job_title_and_tasks = $translate->_("Agreements_Job_Title_And_Tasks");
    	$this->view->job = $translate->_("Agreements_Job");
    	$this->view->tasks = $translate->_("Agreements_Tasks");
    	$this->view->benefits = $translate->_("Agreements_Benefits");
    	$this->view->salary_payment_period = $translate->_("Agreements_Salary_Payment_Period");
    	$this->view->empty_salary_payment_period = $translate->_("Agreements_Empty_Salary_Payment_Period");
    	$this->view->employee_agrees_worktime = $translate->_("Agreements_Employee_Agrees_Worktime");
    	$this->view->trial = $translate->_("Agreements_Trial");
    	$this->view->tab_1 = $translate->_("Agreements_Tab_1");
    	$this->view->tab_2 = $translate->_("Agreements_Tab_2");
    	$this->view->tab_3 = $translate->_("Agreements_Tab_3");
    	$this->view->tab_4 = $translate->_("Agreements_Tab_4");
    	$this->view->tab_5 = $translate->_("Agreements_Tab_5");
    	$this->view->tab_6 = $translate->_("Agreements_Tab_6");
    	$this->view->tab_7 = $translate->_("Agreements_Tab_7");
    	$this->view->user = $translate->_("Agreements_User");
    	$this->view->worktime_id_1 = (string) $db->fetchone("SELECT worktime_name FROM hrm_worktime WHERE worktime_id = ".$db->quote(1, 'INTEGER').";");
    	$this->view->worktime_id_2 = (string) $db->fetchone("SELECT worktime_name FROM hrm_worktime WHERE worktime_id = ".$db->quote(2, 'INTEGER').";");
    	$this->view->worktime_id_3 = (string) $db->fetchone("SELECT worktime_name FROM hrm_worktime WHERE worktime_id = ".$db->quote(3, 'INTEGER').";");
    	$this->view->worktime_id_4 = (string) $db->fetchone("SELECT worktime_name FROM hrm_worktime WHERE worktime_id = ".$db->quote(4, 'INTEGER').";");
    	$this->view->type_id_1 = (string) $db->fetchone("SELECT type_name FROM hrm_employment_type WHERE type_id = ".$db->quote(1, 'INTEGER').";");
    	$this->view->type_id_2 = (string) $db->fetchone("SELECT type_name FROM hrm_employment_type WHERE type_id = ".$db->quote(2, 'INTEGER').";");
    	$this->view->type_id_3 = (string) $db->fetchone("SELECT type_name FROM hrm_employment_type WHERE type_id = ".$db->quote(3, 'INTEGER').";");
    	$this->view->worklaws_id_1 = $translate->_("Agreements_Laws_1");
    	$this->view->worklaws_id_2 = $translate->_("Agreements_Laws_2");
    	$this->view->salary_period_terms_and_conditions = $translate->_("Agreements_Salary_Period_Terms_And_Condtions");
    	$this->view->salary_period_id_1 = $translate->_("Agreements_Salary_Period_Id_1");
    	$this->view->salary_period_id_2 = $translate->_("Agreements_Salary_Period_Id_2");
    	$this->view->salary_period_id_3 = $translate->_("Agreements_Salary_Period_Id_3");
    	$this->view->salary_period_id_4 = $translate->_("Agreements_Salary_Period_Id_4");
    	$this->view->salary_id_1 = $translate->_("Agreements_Salary_Id_1");
    	$this->view->salary_id_2 = $translate->_("Agreements_Salary_Id_2");
    	$this->view->salary_id_3 = $translate->_("Agreements_Salary_Id_3");
    	$this->view->salary_id_4 = $translate->_("Agreements_Salary_Id_4");
    	$this->view->active = $translate->_("Agreements_Active");
    	$this->view->active_tooltip = $translate->_("Agreements_Active_Tooltip");
    	$this->view->inactive = $translate->_("Agreements_Inactive");
    	$this->view->inactive_tooltip = $translate->_("Agreements_Inactive_Tooltip");
    	$this->view->tes = $translate->_("Agreements_Tes");
    	$this->view->upcoming = $translate->_("Agreements_Upcoming");
    	$this->view->upcoming_tooltip = $translate->_("Agreements_Upcoming_Tooltip");
    	$this->view->salary_performance_terms_and_condtions = $translate->_("Agreements_Salary_Performance");
    	$this->view->empty_text_performance_terms_and_condtions = $translate->_("Agreements_Empty_Text_Performance");
    	$this->view->customer = $translate->_("Agreements_Customer");
    	$this->view->trial_end_date = $translate->_("Agreements_Trial_End_Date");
    	$this->view->BIC = $translate->_("Agreements_BIC");
    	$this->view->taxation_city = $translate->_("Agreements_Taxation_City");
    	$this->view->basic_prosent = $translate->_("Agreements_Basic_Prosent");
    	$this->view->extra_prosent = $translate->_("Agreements_Extra_Prosent");
    	$this->view->Yearlysalarylimit = $translate->_("Agreements_Yearlysalarylimit");
    	$this->view->Taxationcountingmethod = $translate->_("Agreements_Taxationcountingmethod");
    	$this->view->Taxcard_come_into_effect_date = $translate->_("Agreements_Taxcard_Come_Into_Effect_Date");
    	$this->view->Retrimentmodel = $translate->_("Agreements_Retrimentmodel");
    	$this->view->AY_membershippaymentpersent = $translate->_("Agreements_AY_Membershippaymentpersent");
    	$this->view->asuntoetu = $translate->_("Agreements_Real_Estate");
    	$this->view->asuntoetu_sahko = $translate->_("Agreements_Real_Estate_Elec");
    	$this->view->autotallietu = $translate->_("Agreements_Garage_Benefit");
    	$this->view->ravintoetu = $translate->_("Agreements_Meal_Benefit");
    	$this->view->autoetu = $translate->_("Agreements_Car_Benefit");
    	$this->view->puhelinetu = $translate->_("Agreements_Phone_Benefit");
    	$this->view->message_date = $translate->_("Agreements_Message_Date");
    
    }
    
}


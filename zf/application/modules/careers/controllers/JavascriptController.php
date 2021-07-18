<?php 

/**
 * ZF-Ext Framework
 * @package    Careers
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

require_once 'Zend/Controller/Action.php';
/** 
 * Zend_Controller_Action: For Timesheet Example. 
 * This Making all JavaScripts for ExtJS. 
 */

class Careers_JavascriptController extends Zend_Controller_Action
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
		
		$this->view->career = $translate->_("Careers_Career");
		$this->view->sotu = $translate->_("Careers_Sotu");
		$this->view->employee = $translate->_("Careers_Employee");
		$this->view->address = $translate->_("Careers_Address");
		$this->view->zip = $translate->_("Careers_Zip");
		$this->view->city = $translate->_("Careers_City");
		$this->view->phone = $translate->_("Careers_Phone");
		$this->view->email = $translate->_("Careers_Email");
		$this->view->taxnumber = $translate->_("Careers_Taxnumber");
		$this->view->page = $translate->_("Careers_Page");
		$this->view->search = $translate->_("Careers_Search");
		$this->view->nocareers = $translate->_("Careers_No_Careers");
		$this->view->refresh = $translate->_("Careers_Refresh");
		$this->view->refresh_tooltip = $translate->_("Careers_Refresh_Tooltip");
		$this->view->new_career = $translate->_("Careers_Career");
		$this->view->new_career_tooltip = $translate->_("Careers_Career_Tooltip");
		$this->view->close = $translate->_("Careers_Close");
		$this->view->submit = $translate->_("Careers_Submit");
		$this->view->error = $translate->_("Careers_Error");
		$this->view->select_pdf_label = $translate->_("Careers_Select_Pdf_Label");
		$this->view->select_pdf_label_qualification = $translate->_("Careers_Select_Pdf_Label_Qualification");
		$this->view->select_pdf = $translate->_("Careers_Select_Pdf");
		$this->view->only_pdf_allowed = $translate->_("Careers_Only_Pdf_Allowed");
		$this->view->download = $translate->_("Careers_Download");
		$this->view->download_tooltip = $translate->_("Careers_Download_Tooltip");
		$this->view->firstname = $translate->_("Careers_Firstname");
		$this->view->lastname = $translate->_("Careers_Lastname");
		$this->view->noqualifications = $translate->_("Careers_No_Qualifications");
		$this->view->qualification_name = $translate->_("Careers_Qualification_Name");
		$this->view->refresh_qualifications = $translate->_("Careers_Refresh_Qualifications");
		$this->view->refresh_qualifications_tooltip = $translate->_("Careers_Refresh_Qualifications_Tooltip");
		$this->view->employee_name = $translate->_("Careers_Employee_Name");
		$this->view->date_started = $translate->_("Careers_Date_Started");
		$this->view->date_completed = $translate->_("Careers_Date_Completed");
		$this->view->active = $translate->_("Careers_Active");
		$this->view->experience_in_years = $translate->_("Careers_Experience_In_Years");
		$this->view->true = $translate->_("Careers_True");
		$this->view->false = $translate->_("Careers_False");
		$this->view->years = $translate->_("Careers_Years");
		$this->view->effective_date = $translate->_("Careers_Effective_Date");
		$this->view->year = $translate->_("Careers_Year");
		$this->view->experience_in_years = $translate->_("Careers_Experience_In_Years");
		$this->view->new_qualification = $translate->_("Careers_New_Qualification");
		$this->view->new_qualification_tooltip = $translate->_("Careers_New_Qualification_Tooltip");
		$this->view->puuttuu = $translate->_("Careers_Missing");
		$this->view->missing = $translate->_("Careers_Missing_City");
		$this->view->download_certificate = $translate->_("Careers_Download_Certificate");
		$this->view->download_certificate_tooltip = $translate->_("Careers_Download_Certificate_Tooltip");
		$this->view->move_career = $translate->_("Careers_Move_Career");
		$this->view->move_career_tooltip = $translate->_("Careers_Move_Career_Tooltip");
		$this->view->delete_career = $translate->_("Careers_Delete_Career");
		$this->view->delete_career_tooltip = $translate->_("Careers_Delete_Career_Tooltip");
		$this->view->areyousuretitle = $translate->_("Careers_Are_You_Sure_Title");
		$this->view->areyousuretext = $translate->_("Careers_Are_You_Sure_Text");
		$this->view->areyousuredeletetext = $translate->_("Careers_Are_You_Sure_Delete_Text");
		$this->view->areyousuredeletecareertext = $translate->_("Careers_Are_You_Sure_Delete_Career_Text");
		$this->view->delete_qualification = $translate->_("Careers_Delete_Qualification");
		$this->view->delete_qualification_tooltip = $translate->_("Careers_Delete_Qualification_Tooltip");
		$this->view->replace_cv = $translate->_("Careers_Replace_CV");
		$this->view->replace_cv_tooltip = $translate->_("Careers_Replace_CV_Tooltip");
		$this->view->bank_account = $translate->_("Careers_Bank_Account");
		$this->view->replace_qualification = $translate->_("Careers_Replace_Qualification");
		$this->view->replace_qualification_tooltip = $translate->_("Careers_Replace_Qualification_Tooltip");
		$this->view->replaceqa = $translate->_("Careers_Replace_Qa");
		$this->view->job_title = $translate->_("Careers_Job_Title");
		$this->view->salary = $translate->_("Careers_Salary");
		$this->view->tes = $translate->_("Careers_Tes");
		$this->view->start_date = $translate->_("Careers_Start_Date");
		//$this->view->job_title = $translate->_("Careers_Job_Title");
		$this->view->BIC = $translate->_("Careers_BIC");
		$this->view->taxation_city = $translate->_("Careers_Taxation_City");
		$this->view->basic_prosent = $translate->_("Careers_Basic_Prosent");
		$this->view->extra_prosent = $translate->_("Careers_Extra_Prosent");
		$this->view->Yearlysalarylimit = $translate->_("Careers_Yearlysalarylimit");
		$this->view->Taxationcountingmethod = $translate->_("Careers_Taxationcountingmethod");
		$this->view->Taxcard_come_into_effect_date = $translate->_("Careers_Taxcard_Come_Into_Effect_Date");
		$this->view->Retrimentmodel = $translate->_("Careers_Retrimentmodel");
		$this->view->AY_membershippaymentpersent = $translate->_("Careers_AY_Membershippaymentpersent");
		$this->view->qualifications = $translate->_("Careers_Qualifications");
		$this->view->taxcards = $translate->_("Careers_Taxcards");
		$this->view->notaxcards = $translate->_("Careers_Notaxcards");
		$this->view->date_come_to_effective = $translate->_("Careers_Date_Come_To_Effective");
		$this->view->download_taxcards = $translate->_("Careers_Download_Taxcards");
		$this->view->download_taxcards_tooltip = $translate->_("Careers_Download_Taxcards_Tooltip");
		$this->view->new_taxcard = $translate->_("Careers_New_Taxcard");
		$this->view->new_taxcard_tooltip = $translate->_("Careers_New_Taxcard_Tooltip");
		$this->view->delete_taxcard = $translate->_("Careers_Delete_Taxcard");
		$this->view->delete_taxcard_tooltip = $translate->_("Careers_Delete_Taxcard_Tooltip");
		$this->view->replace_taxcard = $translate->_("Careers_Replace_Taxcard");
		$this->view->replace_taxcard_tooltip = $translate->_("Careers_Replace_Taxcard_Tooltip");
		$this->view->select_pdf_label_taxcard = $translate->_("Careers_Select_Pdf_Label_Taxcard");
		$this->view->replacetc = $translate->_("Careers_Replace_Taxcard");
		
    }
    
}


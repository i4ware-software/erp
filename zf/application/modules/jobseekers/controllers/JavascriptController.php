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

class Jobseekers_JavascriptController extends Zend_Controller_Action
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
		
		$this->view->career = $translate->_("Jobseekers_Career");
		$this->view->sotu = $translate->_("Jobseekers_Sotu");
		$this->view->employee = $translate->_("Jobseekers_Employee");
		$this->view->address = $translate->_("Jobseekers_Address");
		$this->view->zip = $translate->_("Jobseekers_Zip");
		$this->view->city = $translate->_("Jobseekers_City");
		$this->view->phone = $translate->_("Jobseekers_Phone");
		$this->view->email = $translate->_("Jobseekers_Email");
		$this->view->taxnumber = $translate->_("Jobseekers_Taxnumber");
		$this->view->page = $translate->_("Jobseekers_Page");
		$this->view->search = $translate->_("Jobseekers_Search");
		$this->view->nojobseekers = $translate->_("Jobseekers_No_Jobseekers");
		$this->view->refresh = $translate->_("Jobseekers_Refresh");
		$this->view->refresh_tooltip = $translate->_("Jobseekers_Refresh_Tooltip");
		$this->view->new_career = $translate->_("Jobseekers_Career");
		$this->view->new_career_tooltip = $translate->_("Jobseekers_Career_Tooltip");
		$this->view->close = $translate->_("Jobseekers_Close");
		$this->view->submit = $translate->_("Jobseekers_Submit");
		$this->view->error = $translate->_("Jobseekers_Error");
		$this->view->select_pdf_label = $translate->_("Jobseekers_Select_Pdf_Label");
		$this->view->select_pdf = $translate->_("Jobseekers_Select_Pdf");
		$this->view->only_pdf_allowed = $translate->_("Jobseekers_Only_Pdf_Allowed");
		$this->view->download = $translate->_("Jobseekers_Download");
		$this->view->download_tooltip = $translate->_("Jobseekers_Download_Tooltip");
		$this->view->firstname = $translate->_("Jobseekers_Firstname");
		$this->view->lastname = $translate->_("Jobseekers_Lastname");
		$this->view->noqualifications = $translate->_("Jobseekers_No_Qualifications");
		$this->view->qualification_name = $translate->_("Jobseekers_Qualification_Name");
		$this->view->refresh_qualifications = $translate->_("Jobseekers_Refresh_Qualifications");
		$this->view->refresh_qualifications_tooltip = $translate->_("Careers_Refresh_Qualifications_Tooltip");
		$this->view->employee_name = $translate->_("Jobseekers_Employee_Name");
		$this->view->date_started = $translate->_("Jobseekers_Date_Started");
		$this->view->date_completed = $translate->_("Jobseekers_Date_Completed");
		$this->view->active = $translate->_("Jobseekers_Active");
		$this->view->experience_in_years = $translate->_("Jobseekers_Experience_In_Years");
		$this->view->true = $translate->_("Jobseekers_True");
		$this->view->false = $translate->_("Jobseekers_False");
		$this->view->years = $translate->_("Jobseekers_Years");
		$this->view->effective_date = $translate->_("Jobseekers_Effective_Date");
		$this->view->year = $translate->_("Jobseekers_Year");
		$this->view->experience_in_years = $translate->_("Jobseekers_Experience_In_Years");
		$this->view->new_qualification = $translate->_("Jobseekers_New_Qualification");
		$this->view->new_qualification_tooltip = $translate->_("Jobseekers_New_Qualification_Tooltip");
		$this->view->puuttuu = $translate->_("Jobseekers_Missing");
		$this->view->missing = $translate->_("Jobseekers_Missing_City");
		$this->view->download_certificate = $translate->_("Jobseekers_Download_Certificate");
		$this->view->download_certificate_tooltip = $translate->_("Jobseekers_Download_Certificate_Tooltip");
		$this->view->sending = $translate->_("Jobseekers_Sending");
		$this->view->success = $translate->_("Jobseekers_Success");
		$this->view->move_career = $translate->_("Jobseekers_Move_Career");
		$this->view->move_career_tooltip = $translate->_("Jobseekers_Move_Career_Tooltip");
		$this->view->areyousuretitle = $translate->_("Jobseekers_Are_You_Sure_Title");
		$this->view->areyousuretext = $translate->_("Jobseekers_Are_You_Sure_Text");
		$this->view->areyousuredeletetext = $translate->_("Jobseekers_Are_You_Sure_Delete_Text");
		$this->view->delete_qualification = $translate->_("Jobseekers_Delete_Qualification");
		$this->view->delete_qualification_tooltip = $translate->_("Jobseekers_Delete_Qualification_Tooltip");
		$this->view->replace_cv = $translate->_("Jobseekers_Replace_CV");
		$this->view->replace_cv_tooltip = $translate->_("Jobseekers_Replace_CV_Tooltip");
		$this->view->bank_account = $translate->_("Jobseekers_Bank_Account");
		$this->view->replace_qualification = $translate->_("Jobseekers_Replace_Qualification");
		$this->view->replace_qualification_tooltip = $translate->_("Jobseekers_Replace_Qualification_Tooltip");
		$this->view->replaceqa = $translate->_("Jobseekers_Replace_Qa");
		$this->view->delete_career = $translate->_("Jobseekers_Delete_Career");
		$this->view->delete_career_tooltip = $translate->_("Jobseekers_Delete_Career_Tooltip");
		$this->view->areyousuredeletetext = $translate->_("Jobseekers_Are_You_Sure_Delete_Text");
		$this->view->areyousuredeletecareertext = $translate->_("Jobseekers_Are_You_Sure_Delete_Career_Text");
		$this->view->BIC = $translate->_("Jobseekers_BIC");
		$this->view->taxation_city = $translate->_("Jobseekers_Taxation_City");
		$this->view->basic_prosent = $translate->_("Jobseekers_Basic_Prosent");
		$this->view->extra_prosent = $translate->_("Jobseekers_Extra_Prosent");
		$this->view->Yearlysalarylimit = $translate->_("Jobseekers_Yearlysalarylimit");
		$this->view->Taxationcountingmethod = $translate->_("Jobseekers_Taxationcountingmethod");
		$this->view->Taxcard_come_into_effect_date = $translate->_("Jobseekers_Taxcard_Come_Into_Effect_Date");
		$this->view->Retrimentmodel = $translate->_("Jobseekers_Retrimentmodel");
		$this->view->AY_membershippaymentpersent = $translate->_("Jobseekers_AY_Membershippaymentpersent");
		
    }
    
}


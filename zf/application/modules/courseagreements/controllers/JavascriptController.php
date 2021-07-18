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

class Courseagreements_JavascriptController extends Zend_Controller_Action
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
		
		$this->view->career = $translate->_("Courseagreements_Career");
		$this->view->sotu = $translate->_("Courseagreements_Sotu");
		$this->view->employee = $translate->_("Courseagreements_Employee");
		$this->view->address = $translate->_("Courseagreements_Address");
		$this->view->zip = $translate->_("Courseagreements_Zip");
		$this->view->city = $translate->_("Courseagreements_City");
		$this->view->phone = $translate->_("Courseagreements_Phone");
		$this->view->email = $translate->_("Courseagreements_Email");
		$this->view->taxnumber = $translate->_("Courseagreements_Taxnumber");
		$this->view->page = $translate->_("Courseagreements_Page");
		$this->view->search = $translate->_("Courseagreements_Search");
		$this->view->nojobseekers = $translate->_("Courseagreements_No_Jobseekers");
		$this->view->refresh = $translate->_("Courseagreements_Refresh");
		$this->view->refresh_tooltip = $translate->_("Courseagreements_Refresh_Tooltip");
		$this->view->new_career = $translate->_("Courseagreements_Career");
		$this->view->new_career_tooltip = $translate->_("Courseagreements_Career_Tooltip");
		$this->view->close = $translate->_("Courseagreements_Close");
		$this->view->submit = $translate->_("Courseagreements_Submit");
		$this->view->error = $translate->_("Courseagreements_Error");
		$this->view->select_pdf_label = $translate->_("Courseagreements_Select_Pdf_Label");
		$this->view->select_pdf_label_qualification = $translate->_("Courseagreements_Select_Pdf_Label_Qualification");
		$this->view->select_pdf = $translate->_("Courseagreements_Select_Pdf");
		$this->view->only_pdf_allowed = $translate->_("Courseagreements_Only_Pdf_Allowed");
		$this->view->download = $translate->_("Courseagreements_Download");
		$this->view->download_tooltip = $translate->_("Courseagreements_Download_Tooltip");
		$this->view->firstname = $translate->_("Courseagreements_Firstname");
		$this->view->lastname = $translate->_("Courseagreements_Lastname");
		$this->view->noqualifications = $translate->_("Courseagreements_No_Qualifications");
		$this->view->qualification_name = $translate->_("Courseagreements_Qualification_Name");
		$this->view->refresh_qualifications = $translate->_("Courseagreements_Refresh_Qualifications");
		$this->view->refresh_qualifications_tooltip = $translate->_("Careers_Refresh_Qualifications_Tooltip");
		$this->view->employee_name = $translate->_("Courseagreements_Employee_Name");
		$this->view->date_started = $translate->_("Courseagreements_Date_Started");
		$this->view->date_completed = $translate->_("Courseagreements_Date_Completed");
		$this->view->active = $translate->_("Courseagreements_Active");
		$this->view->experience_in_years = $translate->_("Courseagreements_Experience_In_Years");
		$this->view->true = $translate->_("Courseagreements_True");
		$this->view->false = $translate->_("Courseagreements_False");
		$this->view->years = $translate->_("Courseagreements_Years");
		$this->view->effective_date = $translate->_("Courseagreements_Effective_Date");
		$this->view->year = $translate->_("Courseagreements_Year");
		$this->view->experience_in_years = $translate->_("Courseagreements_Experience_In_Years");
		$this->view->new_qualification = $translate->_("Courseagreements_New_Qualification");
		$this->view->new_qualification_tooltip = $translate->_("Courseagreements_New_Qualification_Tooltip");
		$this->view->puuttuu = $translate->_("Courseagreements_Missing");
		$this->view->missing = $translate->_("Courseagreements_Missing_City");
		$this->view->download_certificate = $translate->_("Courseagreements_Download_Certificate");
		$this->view->download_certificate_tooltip = $translate->_("Courseagreements_Download_Certificate_Tooltip");
		$this->view->sending = $translate->_("Courseagreements_Sending");
		$this->view->success = $translate->_("Courseagreements_Success");
		$this->view->move_career = $translate->_("Courseagreements_Move_Career");
		$this->view->move_career_tooltip = $translate->_("Courseagreements_Move_Career_Tooltip");
		$this->view->areyousuretitle = $translate->_("Courseagreements_Are_You_Sure_Title");
		$this->view->areyousuretext = $translate->_("Courseagreements_Are_You_Sure_Text");
		$this->view->areyousuredeletetext = $translate->_("Courseagreements_Are_You_Sure_Delete_Text");
		$this->view->delete_qualification = $translate->_("Courseagreements_Delete_Qualification");
		$this->view->delete_qualification_tooltip = $translate->_("Courseagreements_Delete_Qualification_Tooltip");
		$this->view->replace_cv = $translate->_("Courseagreements_Replace_CV");
		$this->view->replace_cv_tooltip = $translate->_("Courseagreements_Replace_CV_Tooltip");
		$this->view->bank_account = $translate->_("Courseagreements_Bank_Account");
		$this->view->replace_qualification = $translate->_("Courseagreements_Replace_Qualification");
		$this->view->replace_qualification_tooltip = $translate->_("Courseagreements_Replace_Qualification_Tooltip");
		$this->view->replaceqa = $translate->_("Courseagreements_Replace_Qa");
		$this->view->delete_career = $translate->_("Courseagreements_Delete_Career");
		$this->view->delete_career_tooltip = $translate->_("Courseagreements_Delete_Career_Tooltip");
		$this->view->areyousuredeletetext = $translate->_("Courseagreements_Are_You_Sure_Delete_Text");
		$this->view->areyousuredeletecareertext = $translate->_("Courseagreements_Are_You_Sure_Delete_Career_Text");
		$this->view->value = $translate->_("Courseagreements_Value");
		$this->view->information = $translate->_("Courseagreements_Information");
		$this->view->due_date = $translate->_("Courseagreements_Due_Date");
		$this->view->expirion_date = $translate->_("Courseagreements_Expirion_Date");
		
    }
    
}


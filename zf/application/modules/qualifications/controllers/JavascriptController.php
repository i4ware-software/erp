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

class Qualifications_JavascriptController extends Zend_Controller_Action
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
		
		$this->view->qualifications = $translate->_("Qualifications_Qualifications");
		$this->view->education_name = $translate->_("Qualifications_Education_Name");
		$this->view->education_type = $translate->_("Qualifications_Education_Type");
		$this->view->noqualifications = $translate->_("Qualifications_No_Qualifications");
		$this->view->search = $translate->_("Qualifications_Search");
		$this->view->page = $translate->_("Qualifications_Page");
		$this->view->refresh = $translate->_("Qualifications_Refresh");
		$this->view->refresh_tooltip = $translate->_("Qualifications_Refresh_Tooltip");
		$this->view->new_qualification = $translate->_("Qualifications_New_Qualification");
		$this->view->new_qualification_tooltip = $translate->_("Qualifications_New_Qualification_Tooltip");
		$this->view->new_education = $translate->_("Qualifications_New_Education");
		$this->view->submit = $translate->_("Qualifications_Submit");
		$this->view->close = $translate->_("Qualifications_Close");
		$this->view->sending = $translate->_("Qualifications_Sending");
		$this->view->error = $translate->_("Qualifications_Error");
		$this->view->success = $translate->_("Qualifications_Success");
		$this->view->delete_qualification = $translate->_("Qualifications_Delete");
		$this->view->delete_qualification_tooltip = $translate->_("Qualifications_Delete_Tooltip");
		$this->view->areyousuretitle = $translate->_("Qualifications_Are_You_Sure");
		$this->view->areyousuredeletetext = $translate->_("Qualifications_Are_You_Sure_Text");
		
    }
    
}


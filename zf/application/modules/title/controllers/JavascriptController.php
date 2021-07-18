<?php 

/**
 * ZF-Ext Framework
 * @package    Title
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

require_once 'Zend/Controller/Action.php';
/** 
 * Zend_Controller_Action: For Timesheet Example. 
 * This Making all JavaScripts for ExtJS. 
 */

class Title_JavascriptController extends Zend_Controller_Action
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
		
		$this->view->title = $translate->_("Title_Title");
		$this->view->new_title = $translate->_("Title_New_Title");
		$this->view->new_title_tooltip = $translate->_("Title_New_Title_Tooltip");
		$this->view->delete_title = $translate->_("Title_Delete_Title");
		$this->view->delete_title_tooltip = $translate->_("Title_Delete_Title_Tooltip");
		$this->view->refresh = $translate->_("Title_Refresh");
		$this->view->refresh_tooltip = $translate->_("Title_Refresh_Tooltip");
		$this->view->submit = $translate->_("Title_Submit");
		$this->view->sending = $translate->_("Title_Sending");
		$this->view->success = $translate->_("Title_Success");
		$this->view->error = $translate->_("Title_Error");
		$this->view->close = $translate->_("Title_Close");
		$this->view->areyousuretitle = $translate->_("Title_Are_You_Sure_Title");
		$this->view->areyousuredeletetext = $translate->_("Title_Are_You_Sure_Text");
		$this->view->search = $translate->_("Title_Search");
		$this->view->notitles = $translate->_("Title_No_Titles");
		$this->view->page = $translate->_("Title_Page");
		$this->view->education_title = $translate->_("Title_Education_Title");
		$this->view->education_title_tooltip = $translate->_("Title_Education_Title_Tooltip");
		$this->view->delete_education_title = $translate->_("Title_Delete_Education_Title");
		$this->view->delete_education_title_tooltip = $translate->_("Title_Delete_Education_Title_Tooltip");
		$this->view->education_name = $translate->_("Title_Education_Name");
		$this->view->addeducation = $translate->_("Title_Add_Education");
		$this->view->experience_in_years = $translate->_("Title_Experience_In_Years");
		$this->view->year = $translate->_("Title_Year");
		$this->view->years = $translate->_("Title_Years");
		
    }
    
}


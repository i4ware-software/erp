<?php 

/**
 * ZF-Ext Framework
 * @package    Timesheet
 * @license    http://www.gnu.org/copyleft/gpl.html     GNU GPL
 */

require_once 'Zend/Controller/Action.php';
/** 
 * Zend_Controller_Action: For Timesheet Example. 
 * This Making all JavaScripts for ExtJS. 
 */

class Projects_JavascriptController extends Zend_Controller_Action
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
		
		$this->view->refresh = $translate->_("Projects_Refresh");
		$this->view->refresh_tooltip = $translate->_("Projects_Refresh_Tooltip");
		$this->view->deselect = $translate->_("Projects_Deselect");
		$this->view->deselect_tooltip = $translate->_("Projects_Deselect_Tooltip");
		$this->view->nimi = $translate->_("Projects_Nimi");
		$this->view->tili_nimi = $translate->_("Projects_Project_Nimi");
		$this->view->tili_id = $translate->_("Projects_Project_Id");
		$this->view->addnew = $translate->_("Projects_Add_New");
		$this->view->addnew_tooltip = $translate->_("Projects_Add_New_Tooltip");
		$this->view->delete = $translate->_("Projects_Delete");
		$this->view->delete_tooltip = $translate->_("Projects_Delete_Tooltip");
		$this->view->success = $translate->_("Projects_Success");
		$this->view->sending = $translate->_("Projects_Sending");
		$this->view->loading = $translate->_("Projects_Loading");
		$this->view->error = $translate->_("Projects_Error");
		$this->view->new = $translate->_("Projects_New");
		$this->view->submit = $translate->_("Projects_Submit");
		$this->view->close = $translate->_("Projects_Close");
		$this->view->areyousuretitle = $translate->_("Projects_Are_You_Sure_Title");
		$this->view->areyousuretext = $translate->_("Projects_Are_You_Sure_Text");
		$this->view->module = $translate->_("Projects_Projects");
		$this->view->export = $translate->_("Projects_Export");
		$this->view->export_tooltip = $translate->_("Projects_Export_Tooltip");
		$this->view->import = $translate->_("Projects_Import");
		$this->view->import_tooltip = $translate->_("Projects_Import_Tooltip");
		$this->view->select_xls = $translate->_("Projects_Select_Xls");
		$this->view->select_xls_label = $translate->_("Projects_Select_Xls_Label");
		$this->view->only_xls_allowed = $translate->_("Projects_Only_Xls_Allowed");
		$this->view->browse = $translate->_("Projects_Browse");
		$this->view->nimi_nro = $translate->_("Projects_Nimi_Nro");
		
    }
}


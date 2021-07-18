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

class Accounts_JavascriptController extends Zend_Controller_Action
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
		
		$this->view->refresh = $translate->_("Accounts_Refresh");
		$this->view->refresh_tooltip = $translate->_("Accounts_Refresh_Tooltip");
		$this->view->deselect = $translate->_("Accounts_Deselect");
		$this->view->deselect_tooltip = $translate->_("Account_Deselect_Tooltip");
		$this->view->nimi = $translate->_("Accounts_Nimi");
		$this->view->tili_nimi = $translate->_("Accounts_Tili_Nimi");
		$this->view->tili_id = $translate->_("Accounts_Tili_Id");
		$this->view->addnew = $translate->_("Accounts_Add_New");
		$this->view->addnew_tooltip = $translate->_("Accounts_Add_New_Tooltip");
		$this->view->delete = $translate->_("Accounts_Delete");
		$this->view->delete_tooltip = $translate->_("Accounts_Delete_Tooltip");
		$this->view->success = $translate->_("Accounts_Success");
		$this->view->sending = $translate->_("Accounts_Sending");
		$this->view->loading = $translate->_("Accounts_Loading");
		$this->view->error = $translate->_("Accounts_Error");
		$this->view->new = $translate->_("Accounts_New");
		$this->view->submit = $translate->_("Accounts_Submit");
		$this->view->close = $translate->_("Accounts_Close");
		$this->view->areyousuretitle = $translate->_("Accounts_Are_You_Sure_Title");
		$this->view->areyousuretext = $translate->_("Accounts_Are_You_Sure_Text");
		$this->view->export = $translate->_("Accounts_Export");
		$this->view->export_tooltip = $translate->_("Accounts_Export_Tooltip");
		$this->view->import = $translate->_("Accounts_Import");
		$this->view->import_tooltip = $translate->_("Accounts_Import_Tooltip");
		$this->view->select_xls = $translate->_("Accounts_Select_Xls");
		$this->view->select_xls_label = $translate->_("Accounts_Select_Xls_Label");
		$this->view->only_xls_allowed = $translate->_("Accounts_Only_Xls_Allowed");
		$this->view->browse = $translate->_("Accounts_Browse");
		
    }
}

